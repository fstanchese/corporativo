<?php

	set_time_limit(3600);
	// and contabilcur.id=204200000000151	

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	require_once("../model/Campus.class.php");
	
	$user = new User ();
	$app = new App("Relatório de Fechamento Contábil","Relatório de Fechamento Contábil",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	
	$dbOracle = new Db ($user);
	$dbData = new DbData ($dbOracle);
	$campus	= new Campus ($dbOracle);
	

	if($_POST[enviar] == "")
	{
		include("../engine/ViewPage.class.php");
		include("../engine/Form.class.php");

	

		$arMes['01'] = 'JAN';
		$arMes['02'] = 'FEV';
		$arMes['03'] = 'MAR';
		$arMes['04'] = 'ABR';
		$arMes['05'] = 'MAI';
		$arMes['06'] = 'JUN';
		$arMes['07'] = 'JUL';
		$arMes['08'] = 'AGO';
		$arMes['09'] = 'SET';
		$arMes['10'] = 'OUT';
		$arMes['11'] = 'NOV';
		$arMes['12'] = 'DEZ';
		
		$arAno['2015'] = '2015';
		$arAno['2014'] = '2014';
		$arAno['2013'] = '2013';
		$arAno['2012'] = '2012';
		$arAno['2011'] = '2011';
		$arAno['2010'] = '2010';
		$arAno['2009'] = '2009';
		$arAno['2008'] = '2008';
		$arAno['2007'] = '2007';		


		$view 	= new ViewPage($app->title,$app->description);
	
		$view->Header($user,$nav);
		
	
		$form = new Form();	
	
			$form->Fieldset();	
		
				$form->Input("Mês",'select',array('name'=>'p_Mes',"required"=>'1',"option"=>$arMes));
				$form->Input("Ano",'select',array('name'=>'p_Ano',"required"=>'1',"option"=>$arAno));
				$form->Input("Data Base","date",array("required"=>"1","name"=>'p_Data',"class"=>"size80"));				
				$form->Input("Unidade",'select',array("required"=>"1","name"=>'p_Campus_Id',"option"=>$campus->Calculate()));
				
			$form->CloseFieldset ();
		
			$form->Fieldset();
			
				$form->Button("submit",array("name"=>"enviar","value"=>"Gerar Relatório"));
		
	
			$form->CloseFieldset ();			

	
		unset($form);
		unset($view);
		
	}
	else
	{
		
		$vUnidade = $campus->Recognize($_POST[p_Campus_Id]);
		
		require_once("../model/Boleto.class.php");	
		
		$boleto = new Boleto($dbOracle);
		
		
		include("../model/BoletoItem.class.php");
		$boletoitem = new BoletoItem ( $dbOracle );
		
		
		
		
		/* colocar competencia na reserva de vaga, somente as que não tem competencia*/
		$sql = "select
					boleto.id          as id,
					boleto.referencia  as referencia,
					boleto.competencia as competencia,
				    mens_competencia,
				    mens_curso_id,
				    mens_campus_id 
				from
					boleto,
					(
					select
						wpessoa_sacado_id as wpessoa_id, 
				        boleto.id         as boleto_id,
				        competencia       as mens_competencia,
				        boleto.curso_id   as mens_curso_id,
				        boleto.campus_id  as mens_campus_id
					from
						boleto,
						debcred,
						matric,
						pagtop
					where				
						matric.state_id >= 3000000002002
					and
						debcred.matric_origem_id = matric.id
					and
						pagtop.parcela = 1
					and
						debcred.pagtop_id = pagtop.id
					and
						boleto.id = debcred.boleto_destino_id
					and
						boleto.state_base_id = 3000000000004
					and
						boleto.boletoti_id = 92200000000003
					and
						boleto.competencia = '".$_POST[p_Ano].$_POST[p_Mes]."'
					) boletomens				
				where
					boleto.state_base_id = 3000000000004 
				and
					boleto.referencia like '%".$_POST[p_Ano]."%' 
				and
					boleto.boletoti_id = 92200000000008
				and 
					boleto.wpessoa_sacado_id = boletomens.wpessoa_id
				and 
					not exists (
								select
									reembcomp.id 
								from
									reembcomp,
									recebimento 
								where
									recebimento.id = reembcomp.recebimento_id 
								and 
									boleto_id = boleto.id
								)
				and
					boleto.competencia is null" ;

		$dbData->Get($sql);
		
		$arUPD = array();
		
		
		while ($arBoleto = $dbData->Row())
		{
			$arUPD[p_O_Option] = "update";
			$arUPD[boleto_id] = $arBoleto[ID];
			$arUPD[competencia] = $arBoleto[MENS_COMPETENCIA];
			$arUPD[curso_id] = $arBoleto[MENS_CURSO_ID];
			$arUPD[campus_id] = $arBoleto[MENS_CAMPUS_ID];
			$boleto->IUD($arUPD);
			//echo $arBoleto[ID] . '<br>';
		}
		
		
		$sql = "select
					*
				from
				(
					(	
					(
					select 
						boleto.id       as boleto_id,
				        matric.state_id as matric_state,
						referencia,
						boleto.competencia as competencia
					from
						boleto,
						debcred,
						matric
					where
						matric.state_id < 3000000002002
					and 
						debcred.matric_origem_id = matric.id
					and 
						boleto.id = debcred.boleto_destino_id
					and
						boleto.state_base_id = 3000000000006
					and
						Boleto.BoletoTi_Id = 92200000000003
					and
						nferps is null
					and 
						boleto.competencia = '".$_POST[p_Ano].$_POST[p_Mes]."'
					)				
					union
					(
					select
						boleto.id       as boleto_id,
				        matric.state_id as matric_state,
						referencia,
						boleto.competencia as competencia
					from 
						boleto, 
						debcred, 
						matric
					where 
						matric.state_id >= 3000000002002
					and 
						debcred.matric_origem_id = matric.id
					and 
						boleto.id = debcred.boleto_destino_id
					and
						boleto.state_base_id in (3000000000003, 3000000000006, 3000000000009)
					and
						Boleto.BoletoTi_Id = 92200000000003
					and
						nferps is null
					and 
						boleto.competencia = '".$_POST[p_Ano].$_POST[p_Mes]."'
					and 
						exists (
						select 
							boleto.id 
						from 
							debcred, 
							pagtop, 
							boleto
						where 
							pagtop.parcela = 1
						and 
							debcred.pagtop_id = pagtop.id
						and 
							boleto.state_base_id = 3000000000003
						and
							boleto.id = debcred.boleto_destino_id
						and 
							debcred.matric_origem_id = matric.id
						)
					)
					union
					(			
					select 
						boleto.id       as boleto_id,
				        tempstrito.state_matric_id as matric_state,
						referencia,
						boleto.competencia as competencia
					from
						boleto,
						debcred,
						tempstrito
					where
						tempstrito.state_matric_id < 3000000002002
					and 
						debcred.tempstrito_origem_id = tempstrito.id
					and 
						boleto.id = debcred.boleto_destino_id
					and
						boleto.state_base_id = 3000000000006
					and
						Boleto.BoletoTi_Id = 92200000000003
					and
						nferps is null
					and 
						boleto.competencia = '".$_POST[p_Ano].$_POST[p_Mes]."'			
					)
					) boletoCompetencia
				)
				where
					not exists (select id from tempsped where tempsped.boleto_id = boletoCompetencia.boleto_id)
				order by boleto_id";		
		
		
		
		
		
		if ($_POST[p_Mes] == "12")
		{
			$nCompetenciaNova = $_POST[p_Ano]+1 . "01";
		}
		else
		{			
			$nCompetenciaNova = $_POST[p_Ano].$_POST[p_Mes]+1;
		}
		
		
		$dbData->Get($sql);
		
		$arUPD = array();
		
		$nMostra = 1;
		

		while ($arBoleto = $dbData->Row())
		{
			if ($nMostra == 1)
			{
				$nMostra = 0;
				echo 'mudar competencia <br>';
			}				
				
			$arUPD[p_O_Option] = "update";
			$arUPD[boleto_id] = $arBoleto[BOLETO_ID];
			$arUPD[competencia] = $nCompetenciaNova;			
			$boleto->IUD($arUPD);
			echo $arBoleto[BOLETO_ID] . ' ' . $arBoleto[MATRIC_STATE]  . ' ' . $arBoleto[REFERENCIA] . '  ' . $nCompetenciaNova . '<br>';
		}
		
		unset($boleto);
/* comentei a partir daqui para gerar relatório no formato novo.*/		
/*		require_once("../engine/ViewReport.class.php");
		$viewReport = new ViewReport($app->title,"Unidade " . $vUnidade . " - Competência ".$_POST[p_Mes]."/".$_POST[p_Ano],array("Grupo","Mensalidade","Licenciatura","Dependências","Adaptações","Bolsa","Acréscimos","Vl. Gerado", "Vl. Inscrição","Vl. Reserva", "Líquido a Receber","QB","Valor Médio","QA","FIES",'Cred. Educ.'),"paisagem");
		$viewReport->Header(array("Grupo","Mensalidade","Licenciatura","Dependências","Adaptações","Bolsa","Acréscimos","Vl. Gerado", "Vl. Inscrição","Vl. Reserva", "Líquido a Receber","QB","Valor Médio","QA","FIES",'Cred. Educ.'));		
*/		
		/*
		 * já estava comentado. $sql = "select curso.nome as curso, sum(boletoitem.valor) as valor
					from boleto, boletoitem, matric, turmaofe, turma, curso, wpessoa
					where boleto.id = boletoitem.boleto_id
					and boleto.wpessoa_sacado_id = wpessoa.id
					and matric.wpessoa_id = wpessoa.id
					and matric.turmaofe_id = turmaofe.id
					and turmaofe.turma_id = turma.id
					and turma.curso_id = curso.id
					and boleto.competencia = '201309'
					and boletoitem.boletoitemti_id = 166600000000025
					and matric.state_id = 3000000002002
					and boleto.campus_id like '%01'
					and state_base_id  in (3000000000004,3000000000006)
					group by curso.nome order by curso";*/
		
		
	/*
	 * * já estava comentado. 	$sql = "select cursocontabil.nome as curso, replace(sum(boletoitem.valor),',','.') as valor
					from 
			 		  	boleto,
					  	boletoitem, 
            			cursocontabil
					where
         			cursocontabil.curso_id (+) = boleto.curso_id
          			and
					boletoitemti_id in (166600000000025,  166600000000037 )
					and
					boletoitem.state_id = 3000000017001
					and
					boleto.id = boletoitem.Boleto_id
					and
					boletoti_id = 92200000000003 
					and
					competencia='".$_POST[p_Ano].$_POST[p_Mes]."'					
					and
					boleto.campus_id like '%01'				
				    and
					state_base_id  not in (3000000000001,3000000000008,3000000000009)
					group by cursocontabil.nome
					order by 1,2
							";*/
		
		/**/
/*		$sql = "(
				select contabilcur.nome                as curso,
			  		replace(sum(boletoitem.valor),',','.') as valor,
			  		contabilgru.nome as tipoitem,
					count(boleto.id) as qteBoleto
				from boleto,
			  		boletoitem,
			  		boletoitemti,
			  		contabilcur,
					contabilgru
				where
					contabilcur.curso_id (+) = boleto.curso_id
				and 
					boletoitem.state_id          = 3000000017001
				and 
					boletoitemti.id = contabilgru.boletoitemti_id (+)
				and 
					boletoitem.BOLETOITEMTI_ID = BOLETOITEMTI.id
				and 
					boleto.id                    = boletoitem.Boleto_id
				and 
					boletoti_id                  = 92200000000003
				and 
					competencia                  ='".$_POST[p_Ano].$_POST[p_Mes]."'
				and 
					boleto.campus_id = '". $_POST[p_Campus_Id]."'
				and 
					state_base_id not in (3000000000001,3000000000008,3000000000009)
				group by contabilcur.nome,  contabilgru.nome
				)
				union
				(
				select contabilcur.nome                as curso,
			  		replace(sum(boleto.valor),',','.') as valor,
			  		boletoti.nome as tipoitem,
					0 as qteBoleto
				from boleto,
			  		contabilcur,
					Boletoti
				where
					contabilcur.curso_id (+) = boleto.curso_id
				and 
					boletoti_id = boletoti.id (+)
				and 
					boletoti_id                  = 92200000000008
				and 
					competencia                  ='".$_POST[p_Ano].$_POST[p_Mes]."'
				and 
					boleto.campus_id = '". $_POST[p_Campus_Id]."'
				and 
					state_base_id not in (3000000000001,3000000000008,3000000000009)
				group by contabilcur.nome,  boletoti.nome
				)							
				order by 1,3";
				
		
		$dbData->Get($sql);
	
		while ($abc = $dbData->Row())
		{
			
			$arFech[$abc[CURSO]][$abc[TIPOITEM]] = $abc[VALOR];
			
			if($abc[TIPOITEM] != "FIES" && $abc[TIPOITEM] != "Crédito Educativo")
			{
				$arFech[$abc[CURSO]][VALORGERADO] += $abc[VALOR];
			    $arFech[$abc[CURSO]][VALORLIQUIDO] += $abc[VALOR];
			}
			
			if($abc[TIPOITEM] == "Reserva de Vaga")
			{
				$arFech[$abc[CURSO]][VALORLIQUIDO] -= $abc[VALOR];
			}
				
			$arFech[$abc[CURSO]][QTEBOLETO] += $abc[QTEBOLETO];			
			
		}
		
		
		$sql = "(
				select contabilcur.nome                as curso,
			  		replace(sum(boletoitem.valor),',','.') as valor,
			  		'Crédito Educativo' as tipoitem,
					count(boleto.id) as qteBoleto
				from boleto,
			  		boletoitem,
			  		boletoitemti,
			  		contabilcur,
					contabilgru
				where
					contabilcur.curso_id (+) = boleto.curso_id
				and
					boletoitem.state_id          = 3000000017001
				and
					boletoitemti.id = contabilgru.boletoitemti_id (+)
				and
					boletoitem.BOLETOITEMTI_ID = BOLETOITEMTI.id
				and
					boleto.id                    = boletoitem.Boleto_id
				and
					boletoti_id                  = 92200000000018
				and
					competencia                  ='".$_POST[p_Ano].$_POST[p_Mes]."'
				and
					boleto.campus_id = '". $_POST[p_Campus_Id]."'
				and
					state_base_id not in (3000000000001,3000000000008,3000000000009)
				group by contabilcur.nome,  contabilgru.nome
				)
				union
				(
				select contabilcur.nome                as curso,
			  		replace(sum(boleto.valor),',','.') as valor,
			  		'FIES' as tipoitem,
					count(boleto.id) as qteBoleto
				from boleto,
			  		contabilcur,
					Boletoti
				where
					contabilcur.curso_id (+) = boleto.curso_id
				and
					boletoti_id = boletoti.id (+)
				and
					boletoti_id                  = 92200000000015
				and
					competencia                  ='".$_POST[p_Ano].$_POST[p_Mes]."'
				and
					boleto.campus_id = '". $_POST[p_Campus_Id]."'
				and
					state_base_id not in (3000000000001,3000000000008,3000000000009)
				group by contabilcur.nome,  boletoti.nome
				)
				order by 1,3";

		$dbData->Get($sql);
		
		while ($abc = $dbData->Row())
		{				
			$arFech[$abc[CURSO]][$abc[TIPOITEM]] += $abc[VALOR];			
		}
		
		
		
		foreach($arFech as $curso => $dados)
		{
			
			$arTotal['Mensalidade'] 		+= $dados['Mensalidade'];
			$arTotal['Licenciatura']		+= $dados['Licenciatura'];
			$arTotal['Dependência'] 		+= $dados['Dependência'];
			$arTotal['Adaptação'] 			+= $dados['Adaptação'];
			$arTotal['Acréscimos'] 			+= $dados['Acréscimos'];
			$arTotal['Bolsa'] 				+= $dados['Bolsa'];
			$arTotal['FIES'] 				+= $dados['FIES'];
			$arTotal['QTEBOLETO']			+= $dados['QTEBOLETO'];
			$arTotal['VALORGERADO']			+= $dados['VALORGERADO'];
			$arTotal['VALORLIQUIDO']		+= $dados['VALORLIQUIDO'];
			$arTotal['Crédito Educativo'] 	+= $dados['Crédito Educativo'];
			$arTotal['Reserva de Vaga'] 	+= $dados['Reserva de Vaga'];
			
		}
		

		//print_r($arFech);
		
		
		
		foreach($arFech as $curso => $dados)
		{
			
		
			
			$viewReport->Content($curso);
			$viewReport->Content(_FormatValor($dados['Mensalidade']),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['Licenciatura']),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['Dependência']),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['Adaptação']),array("align"=>"right"));
			$viewReport->Content(_FormatValor(-1*$dados['Bolsa']),array("align"=>"right"));
			
			$viewReport->Content(_FormatValor($dados['Acréscimos']),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['VALORGERADO']),array("align"=>"right"));
			
			
			$viewReport->Content(_FormatValor(0),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['Reserva de Vaga']),array("align"=>"right"));
			
			$viewReport->Content(_FormatValor($dados['VALORLIQUIDO']),array("align"=>"right"));
			
			
			
			$viewReport->Content($dados['QTEBOLETO'],array("align"=>"right"));
			$viewReport->Content(_FormatValor(@($dados['VALORLIQUIDO']/$dados['QTEBOLETO'])),array("align"=>"right"));
			
			$viewReport->Content(_FormatValor(0),array("align"=>"right"));
			
			
			$viewReport->Content(_FormatValor(-1*$dados['FIES']),array("align"=>"right"));
			$viewReport->Content(_FormatValor(-1*$dados['Crédito Educativo']),array("align"=>"right"));
			
				
			
		}
		
		
		
		$viewReport->Content("Total");
		$viewReport->Content(_FormatValor($arTotal['Mensalidade']),array("align"=>"right"));
		$viewReport->Content(_FormatValor($arTotal['Licenciatura']),array("align"=>"right"));
		$viewReport->Content(_FormatValor($arTotal['Dependência']),array("align"=>"right"));
		$viewReport->Content(_FormatValor($arTotal['Adaptação']),array("align"=>"right"));
		$viewReport->Content(_FormatValor(-1*$arTotal['Bolsa']),array("align"=>"right"));
			
		$viewReport->Content(_FormatValor($arTotal['Acréscimos']),array("align"=>"right"));
		$viewReport->Content(_FormatValor($arTotal['VALORGERADO']),array("align"=>"right"));
		
			
		
		$viewReport->Content(_FormatValor(0),array("align"=>"right"));
			
		$viewReport->Content(_FormatValor($arTotal['Reserva de Vaga']),array("align"=>"right"));
		
		$viewReport->Content(_FormatValor($arTotal['VALORLIQUIDO']),array("align"=>"right"));
			
		$viewReport->Content($arTotal['QTEBOLETO'],array("align"=>"right"));
		$viewReport->Content(_FormatValor(@($arTotal['VALORLIQUIDO']/$arTotal['QTEBOLETO'])),array("align"=>"right"));
			
		$viewReport->Content(_FormatValor(0),array("align"=>"right"));
		
		
		$viewReport->Content(_FormatValor(-1*$arTotal['FIES']),array("align"=>"right"));
		$viewReport->Content(_FormatValor(-1*$arTotal['Crédito Educativo']),array("align"=>"right"));

		
		unset ($viewReport);

*
*/		

	//	 terminar comentario aqui 
		
/// teste de novo formato de geração de relatório

		/* 
		 * boletos gerados na competencia
		 */
		
		require_once("../model/ContabilFech.class.php");
		require_once("../model/Boleto.class.php");
		require_once("../model/BoletoItem.class.php");
		require_once("../model/RateioBol.class.php");
				
		$contabilfech = new ContabilFech($dbOracle);		
		$boleto = new Boleto($dbOracle);
		$boletoitem = new BoletoItem($dbOracle);
		$rateiobol = new RateioBol($dbOracle);

		
		$sql = $contabilfech->Query('qBoletos', array('p_O_Data'=>$_POST[p_Data], 'p_Boleto_Competencia'=>$_POST[p_Ano].$_POST[p_Mes], 'p_Campus_Id'=>$_POST[p_Campus_Id]));
	
		
		$arFech = array();
		$arTotal = array();
		
		$dbData->Get($sql);	

		
		while ($abc = $dbData->Row())
		{

			if ($abc['CURSO'] == '' and $abc['BOLETOTI_ID'] <> 92200000000008)
				echo 'Sem Curso ' . $abc['BOLETO_ID'] . '<br>';
			$vState = $boleto->GetStateData($abc['BOLETO_ID'], $_POST['p_Data']);
			if ($vState <> 3000000000008 && $vState <> 3000000000009)
			{
                $entrei = '';
				$nTeste = 0;				
				/*
				 *  boletos de reserva de vaga não deve entrar na mensalidade, somente no valor total do boleto, o mesmo é descontado do boleto de matricula.
				 */
				if ($abc['BOLETOTI_ID'] == 92200000000008)
				{
					$aItens['Reserva de Vaga'] = $abc['VALOR'];	
					$entrei = 'AAA ';			
				}
				else 
				{
					$arFech[$abc['CURSO']]['QTEBOLETO']++;
					$aItens =  $boletoitem->GetItensData( $abc['BOLETO_ID'] , $_POST['p_Data'], 'NOME_CONTABIL');
				}
				
			
				foreach($aItens as $key => $value)
				{
					$arFech[$abc['CURSO']][$key] += $value;
					
					$nTeste += $value;
						
					if($key != "FIES" && $key != "Crédito Educativo")
					{
						$arFech[$abc['CURSO']]['VALORGERADO'] += $value;
						$arFech[$abc['CURSO']]['VALORLIQUIDO'] += $value;
					}
				
					if($key == "Reserva de Vaga")
					{
						$arFech[$abc['CURSO']]['VALORLIQUIDO'] -= $value;
						$nTeste -= $value;
					}
				}
				
				/* 
				 * valor referente ao rateio (boleto divido pago por dois sacados) deve constar como desconto no boleto para não dar diferença na bolsa no total final
				 */
				$nValorRateio = 0;
				
				$nValorRateio = $rateiobol->GetValorDestino( $abc['BOLETO_ID'],  $_POST["p_Data"] );
				
  if ( $nValorRateio > 0 || $nValorRateio < 0)
  	echo 'valor diferente soma - ' .  $nValorRateio . '  ' . $abc['BOLETO_ID']  . '<br>';  	  
				
				$arFech[$abc['CURSO']]['Bolsa'] -= $nValorRateio; 
				if ($abc['VALOR'] > 0 && count($aItens) < 1)
				{
					$arFech[$abc['CURSO']]['Acréscimos'] += $abc['VALOR'];
					$arFech[$abc['CURSO']]['VALORGERADO'] += $abc['VALOR'];
					$arFech[$abc['CURSO']]['VALORLIQUIDO'] += $abc['VALOR'];
					$nTeste += $abc['VALOR'];						
				}
		
				if ($nTeste !=0 and ((str_replace(',','.',$abc['VALOR']) <> str_replace(',','.',$nTeste))) ) 
				{
					echo $abc['BOLETOTI_ID'] . ' valor diferente soma - ' .  $nTeste . '  boleto - ' . _FormatValor( $abc['VALOR'] ) . '  ' . $abc['BOLETO_ID'] . '   ' .  $abc['STATE_BASE_ID'] . ' func ' . $vState . '<br>';
				}		
			}	
		}
		
		unset ( $contabilfech );
        unset ( $boleto );
        unset ( $boletoitem );
        unset ( $rateiobol );
		
		/*
		 * boletos de fies não aditado gerado dentro da competencia o valor deve sair do fies e entrar no valor que o aluno deve pagar, devido a ser responsabilidade do mesmo.
		 * 
		*/
		
		$sql = "(
				select contabilcur.nome                as curso,
			  		replace(sum(boletoitem.valor),',','.') as valor,
			  		'Crédito Educativo' as tipoitem,
					count(boleto.id) as qteBoleto
				from boleto,
			  		boletoitem,
			  		boletoitemti,
			  		contabilcur,
					contabilgru
				where
					contabilcur.curso_id (+) = boleto.curso_id
				and
					boletoitem.state_id          = 3000000017001
				and
					boletoitemti.id = contabilgru.boletoitemti_id (+)
				and
					boletoitem.BOLETOITEMTI_ID = BOLETOITEMTI.id
				and
					boleto.id                    = boletoitem.Boleto_id
				and
					state_base_id not in (3000000000001,3000000000008,3000000000009)
				and
					to_date(boleto.dt) <= to_date('". $_POST[p_Data]. "')			
				and
					boletoti_id                  = 92200000000018
				and
					competencia                  ='".$_POST[p_Ano].$_POST[p_Mes]."'
				and
					boleto.campus_id = '". $_POST[p_Campus_Id]."'
				group by contabilcur.nome,  contabilgru.nome
				)
				union
				(
				select contabilcur.nome                as curso,
			  		replace(sum(boleto.valor),',','.') as valor,
			  		'FIES' as tipoitem,
					count(boleto.id) as qteBoleto
				from boleto,
			  		contabilcur,
					Boletoti
				where
					contabilcur.curso_id (+) = boleto.curso_id
				and
					boletoti_id = boletoti.id (+)
				and
					state_base_id not in (3000000000001,3000000000008,3000000000009)
				and
					to_date(boleto.dt) <= to_date('". $_POST[p_Data]. "')			
				and
					boletoti_id                  = 92200000000015
				and
					competencia                  ='".$_POST[p_Ano].$_POST[p_Mes]."'
				and
					boleto.campus_id = '". $_POST[p_Campus_Id]."'							
				group by contabilcur.nome,  boletoti.nome
				)
				order by 1,3";
		
		$dbData->Get($sql);
		
		while ($abc = $dbData->Row())
		{
			$arFech[$abc['CURSO']][$abc['TIPOITEM']] += $abc['VALOR'];
		}
		
		/*
		 * totalizando relatório
		 */
		
		foreach($arFech as $curso => $dados)
		{
				
			$arTotal['Mensalidade'] 		+= $dados['Mensalidade'];
			$arTotal['Licenciatura']		+= $dados['Licenciatura'];
			$arTotal['Dependência'] 		+= $dados['Dependência'];
			$arTotal['Adaptação'] 			+= $dados['Adaptação'];
			$arTotal['Acréscimos'] 			+= $dados['Acréscimos'];
			$arTotal['Bolsa'] 				+= $dados['Bolsa'];
			$arTotal['FIES'] 				+= $dados['FIES'];
			$arTotal['QTEBOLETO']			+= $dados['QTEBOLETO'];
			$arTotal['VALORGERADO']			+= $dados['VALORGERADO'];
			$arTotal['VALORLIQUIDO']		+= $dados['VALORLIQUIDO'];
			$arTotal['Crédito Educativo'] 	+= $dados['Crédito Educativo'];
			$arTotal['Reserva de Vaga'] 	+= $dados['Reserva de Vaga'];
				
		}
		
		
		//print_r($arFech);
		
		$aHeader = array("Grupo","Mensalidade","Licen","DP","ADAP","Bolsa","Acréscimos","Valor<BR>Gerado", "Valor<BR>Inscrição","Valor<BR>Reserva", "Líquido a<BR>Receber","QB","Valor<BR>Médio","QA","FIES","Crédito<BR>Educativo","Liquido<BR>Aluno");
		
		require_once("../engine/ViewReport.class.php");
		$viewReport = new ViewReport($app->title,"Unidade " . $vUnidade . " - Competência ".$_POST[p_Mes]."/".$_POST[p_Ano] . ' - Data Base: ' . $_POST[p_Data],$aHeader,"paisagem", 22);
		$viewReport->Header($aHeader);
		
		
		foreach($arFech as $curso => $dados)
		{
				
		
				
			$viewReport->Content($curso);
			$viewReport->Content(_FormatValor($dados['Mensalidade']),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['Licenciatura']),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['Dependência']),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['Adaptação']),array("align"=>"right"));
			$viewReport->Content(_FormatValor(-1*$dados['Bolsa']),array("align"=>"right"));
				
			$viewReport->Content(_FormatValor($dados['Acréscimos']),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['VALORGERADO']),array("align"=>"right"));
				
				
			$viewReport->Content(_FormatValor(0),array("align"=>"right"));
			$viewReport->Content(_FormatValor($dados['Reserva de Vaga']),array("align"=>"right"));
				
			$viewReport->Content(_FormatValor($dados['VALORLIQUIDO']),array("align"=>"right"));
				
				
				
			$viewReport->Content($dados['QTEBOLETO'],array("align"=>"right"));
			$viewReport->Content(_FormatValor(@($dados['VALORLIQUIDO']/$dados['QTEBOLETO'])),array("align"=>"right"));
				
			$viewReport->Content(_FormatValor(0),array("align"=>"right"));
				
				
			$viewReport->Content(_FormatValor(-1*$dados['FIES']),array("align"=>"right"));
			$viewReport->Content(_FormatValor(-1*$dados['Crédito Educativo']),array("align"=>"right"));
				
			$viewReport->Content(_FormatValor(@($dados['VALORLIQUIDO']+$dados['FIES']+$dados['Crédito Educativo'])),array("align"=>"right"));		
				
		}
		
		
		
		$viewReport->Content("Total");
		$viewReport->Content(_FormatValor($arTotal['Mensalidade']),array("align"=>"right"));
		$viewReport->Content(_FormatValor($arTotal['Licenciatura']),array("align"=>"right"));
		$viewReport->Content(_FormatValor($arTotal['Dependência']),array("align"=>"right"));
		$viewReport->Content(_FormatValor($arTotal['Adaptação']),array("align"=>"right"));
		$viewReport->Content(_FormatValor(-1*$arTotal['Bolsa']),array("align"=>"right"));
			
		$viewReport->Content(_FormatValor($arTotal['Acréscimos']),array("align"=>"right"));
		$viewReport->Content(_FormatValor($arTotal['VALORGERADO']),array("align"=>"right"));
		
			
		
		$viewReport->Content(_FormatValor(0),array("align"=>"right"));
			
		$viewReport->Content(_FormatValor($arTotal['Reserva de Vaga']),array("align"=>"right"));
		
		$viewReport->Content(_FormatValor($arTotal['VALORLIQUIDO']),array("align"=>"right"));
			
		$viewReport->Content($arTotal['QTEBOLETO'],array("align"=>"right"));
		$viewReport->Content(_FormatValor(@($arTotal['VALORLIQUIDO']/$arTotal['QTEBOLETO'])),array("align"=>"right"));
			
		$viewReport->Content(_FormatValor(0),array("align"=>"right"));
		
		
		$viewReport->Content(_FormatValor(-1*$arTotal['FIES']),array("align"=>"right"));
		$viewReport->Content(_FormatValor(-1*$arTotal['Crédito Educativo']),array("align"=>"right"));
		
		$viewReport->Content(_FormatValor(@($arTotal['VALORLIQUIDO']+$arTotal['FIES']+$arTotal['Crédito Educativo'])),array("align"=>"right"));		
				
		
		unset($viewReport);		
		
		
	}
	
	unset($campus);	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>	