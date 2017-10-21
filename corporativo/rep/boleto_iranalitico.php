<?php
	
	set_time_limit(7200);
	ini_set('memory_limit', '6144M');
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Relatório Analítico de Boletos","Relatório Analítico de Boletos",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	
	$dbOracle = new Db ($user);
	$dbData = new DbData ($dbOracle);

	
	if($_POST[enviar] == "")
	{
		include("../engine/ViewPage.class.php");
		include("../engine/Form.class.php");

		$view 	= new ViewPage($app->title,$app->description);
	
		$view->Header($user,$nav);
		
	
		$form = new Form();	
	
			$form->Fieldset();	

				$form->Input("Data Base","date",array("required"=>"1","name"=>'p_Data',"class"=>"size80"));				
				
			$form->CloseFieldset();
		
			$form->Fieldset();
							
				$form->Button("submit",array("name"=>"enviar","value"=>"Gerar"));				
							
			$form->CloseFieldset();	
	
		unset($form);
		unset($view);
		
	}
	else
	{		

		require_once("../model/Boleto.class.php");	
		require_once("../model/Recebimento.class.php");
		require_once("../model/Matric.class.php");
		require_once("../model/ContabilFech.class.php");
		require_once("../model/WPessoa.class.php");
		require_once("../model/Curso.class.php");
		require_once("../model/ContabilCur.class.php");
		require_once("../model/State.class.php");
		require_once("../model/Matric.class.php");
		$matric			= new Matric($dbOracle);
		
		$boleto			= new Boleto($dbOracle);
		$recebimento 	= new Recebimento($dbOracle);
		$matric			= new Matric($dbOracle);
		$contabilfech	= new ContabilFech($dbOracle);
		$wpessoa		= new WPessoa($dbOracle);
		$curso			= new Curso($dbOracle);
		$contabilcur	= new ContabilCur($dbOracle);
		$state			= new State($dbOracle);	
		
		
		//metodo para trazer ultima competencia fechada da tabela contabilfech.		
		$aCompetencia = $contabilfech->GetUltimaFechada();
		$vCompetencia = $aCompetencia['COMPETENCIA'];
				
		// query utilizada no oracle
		/*
		$sql = "( select
  					boleto.ordemref									 			as parcela,
  					boletoti.Nome     			   								as Tipo_Titulo,
  					to_char(boleto.dt, 'dd/mm/yyyy')		 					as Geracao_Titulo,
  					to_char(boleto.dtvencto, 'dd/mm/yyyy')		 				as data_prorrogacao,
  					replace(boleto.valor , '.',',')			 			 		as valor_titulo,
  					to_char(last_day('01/' || substr(boleto.competencia,5,2) ||'/' || substr(boleto.competencia,1,4)) , 'dd/mm/yyyy')	as referencia_contabil,
				    boleto.boletoti_id 											as boletoti_id,
				    boleto.id                      		    		            as boleto_id,
				    boleto.state_base_id            		          		    as state_base_id,
  					boleto.competencia  		                                as competencia,
  					wpessoa.codigo		        	                            as matricula,
  					wpessoa.nome                                        		as aluno,
  					wpessoa.id                                                  as wpessoa_id,
  					campus.nome													as Campus_Nome,
  					'Mensalidade'												as Conta_Contabil_Saldo,
  					boleto.nossonum												as Titulo_a_Receber,
  					replace(0 ,',','.')	                                        as Valor_Pago,
  					replace(0 ,',','.')				                            as Saldo_Titulo,
					boleto_gnboletotidata( boleto.id, '" . $_POST[p_Data] . "', boleto.boletoti_id ) as boletoti_data_id	  					
  				from
  					campus,
  					wpessoa,
  					boleto,
  					boletoti
				where
  					boleto.campus_id = campus.id (+)
  				and
  					wpessoa.id = boleto.wpessoa_sacado_id
  				and
  					boletoti.id =  boleto.boletoti_id
  				and
  					(
						exists (select boleto_id from recebimento where to_date(dtpagto) > to_date('" . $_POST[p_Data] . "') and recebimento.boleto_id=boleto.id)
					or
						exists (select distinct boleto_id from boletohi where upper(col) = 'STATE_BASE_ID' and to_date(boletohi.dt) > to_date('" . $_POST[p_Data] . "') and boleto.id=boletohi.boleto_id)
  					or
						boleto.state_base_id in (3000000000002, 3000000000003, 3000000000005, 3000000000006, 3000000000007)
  					)
				and
  					to_date(boleto.dt) <= to_date('" . $_POST[p_Data] . "')
  				and
  					boleto.BoletoTi_Id in ( 92200000000003, 92200000000015 )
  				and
  					boleto.competencia <= " . $vCompetencia . "
  				)
  				union
  				(
				select
  					boleto.ordemref							 					as parcela,
  					boletoti.Nome     			   								as Tipo_Titulo,
  					to_char(boleto.dt, 'dd/mm/yyyy')		 					as Geracao_Titulo,
  					to_char(boleto.dtvencto, 'dd/mm/yyyy') 						as data_prorrogacao,
  					replace(boleto.valor , '.',',')	 			 				as valor_titulo,
  					to_char(last_day('01/' || to_char(boleto.dtvencto,'mm/yyyy')) , 'dd/mm/yyyy')	as referencia_contabil,
				    boleto.boletoti_id											as boletoti_id,
				    boleto.id                      		                		as boleto_id,
				    boleto.state_base_id                      		    		as state_base_id,
  					to_char(boleto.dtvencto,'yyyymm')							as competencia,
  					wpessoa.codigo                                      		as matricula,
  					wpessoa.nome                                        		as aluno,
  					wpessoa.id                                                  as wpessoa_id,
  					campus.nome													as Campus_Nome,
  					'Parcelamento'												as Conta_Contabil_Saldo,
  					boleto.nossonum												as Titulo_a_Receber,
  					replace(0 ,',','.')	                                        as Valor_Pago,
  					replace(0 ,',','.')				                            as Saldo_Titulo,
  					boleto.boletoti_id											as boletoti_data_id  		  					
  				from
  					campus,
  				    wpessoa,
  					boleto,
  					boletoti
				where
  					boleto.campus_id = campus.id (+)
  				and
  					wpessoa.id = boleto.wpessoa_sacado_id
  				and
  					boletoti.id = boleto.boletoti_id
  				and
  					(
						exists (select boleto_id from recebimento where to_date(dtpagto) > to_date('" . $_POST[p_Data] . "') and recebimento.boleto_id=boleto.id)
					or
						exists (select distinct boleto_id from boletohi where upper(col) = 'STATE_BASE_ID' and to_date(boletohi.dt) > to_date('" . $_POST[p_Data] . "') and boleto.id=boletohi.boleto_id)
  					or
						boleto.state_base_id in (3000000000002, 3000000000003, 3000000000005, 3000000000006, 3000000000007)
  					)
				and
  					to_date(boleto.dt) <= to_date('" . $_POST[p_Data] . "')
  				and
  					boleto.BoletoTi_Id in ( 92200000000002,  92200000000009, 92200000000010 )
  				)
  				union
  				(
				select
  					boleto.ordemref							 					as parcela,
  					boletoti.Nome     			   								as Tipo_Titulo,
  					to_char(boleto.dt, 'dd/mm/yyyy')		 					as Geracao_Titulo,
  					to_char(boleto.dtvencto, 'dd/mm/yyyy') 						as data_prorrogacao,
  					replace(boleto.valor, ',','.')	 			 				as valor_titulo,
  					to_char(last_day('01/' || decode(boletoti.id, 92200000000002,  to_char(boleto.dtvencto,'mm/yyyy'), SubStr(boleto.competencia,5,2) || '/' || SubStr(boleto.competencia,1,4))), 'dd/mm/yyyy')	as referencia_contabil,
				    boletoti.id													as boletoti_id,
				    boleto.id                      		                		as boleto_id,
				    boleto.state_base_id                      		    		as state_base_id,
  					decode(boletoti.id, 92200000000002, to_char(boleto.dtvencto,'yyyymm'), boleto.competencia)							as competencia,  							
  					wpessoa_gncodigo(boleto.wpessoa_sacado_id)             		as matricula,
  					wpessoa_gsrecognize(boleto.wpessoa_sacado_id)          		as aluno,
  					boleto.wpessoa_sacado_id                                    as wpessoa_id,
  					campus.nome													as Campus_Nome,
  					boletoti.Nome     			   								as Conta_Contabil_Saldo,
  					boleto.nossonum												as Titulo_a_Receber,
  					replace(recebimento.valor, ',','.')                         as Valor_Pago,
  					replace(boleto.valor - recebimento.valor, ',','.')          as Saldo_Titulo,
					boleto.boletoti_id											as boletoti_data_id  					
  				from
  					campus,
  					boleto,
  					boletoti,
  					recebimento
				where
  					not exists ( select id from cobcartaxbol where cobcartaxbol.boleto_id = boleto.id )
  				and
  					boleto.campus_id = campus.id (+)
  				and
  					boletoti.id = boleto_gnboletotidata( boleto.id, '" . $_POST[p_Data] . "', boleto.boletoti_id )
  				and
					to_date(dtpagto) <= to_date('" . $_POST[p_Data] . "')
				and
  					to_date(boleto.dt) <= to_date('" . $_POST[p_Data] . "')
				and
  					boleto.valor > recebimento.valor							 
				and
					recebimento.boleto_id=boleto.id
  				and
  					boleto.BoletoTi_Id in ( 92200000000002, 92200000000003, 92200000000009, 92200000000012, 92200000000015 )
  				)   			 	
  				order by 10
  				";		
		*/

		//query unindo clipper
		$sql = "( select
  					boleto.ordemref									 			as parcela,
  					boletoti.Nome     			   								as Tipo_Titulo,
  					to_char(boleto.dt, 'dd/mm/yyyy')		 					as Geracao_Titulo,
  					to_char(boleto.dtvencto, 'dd/mm/yyyy')		 				as data_prorrogacao,
  					replace(boleto.valor , '.',',')			 			 		as valor_titulo,
  					to_char(last_day('01/' || substr(boleto.competencia,5,2) ||'/' || substr(boleto.competencia,1,4)) , 'dd/mm/yyyy')	as referencia_contabil,
				    boleto.boletoti_id 											as boletoti_id,
				    boleto.id                      		    		            as boleto_id,
				    boleto.state_base_id            		          		    as state_base_id,
  					boleto.competencia  		                                as competencia,
  					wpessoa.codigo		        	                            as matricula,
  					wpessoa.nome                                        		as aluno,
  					wpessoa.id                                                  as wpessoa_id,
  					campus.nome													as Campus_Nome,
  					'Mensalidade'												as Conta_Contabil_Saldo,
  					boleto.nossonum												as Titulo_a_Receber,
  					replace(0 ,',','.')	                                        as Valor_Pago,
  					replace(0 ,',','.')				                            as Saldo_Titulo,
					boleto_gnboletotidata( boleto.id, '" . $_POST[p_Data] . "', boleto.boletoti_id ) as boletoti_data_id
  				from
  					campus,
  					wpessoa,
  					boleto,
  					boletoti,
					saldo
				where
  					boleto.campus_id = campus.id (+)
  				and
  					wpessoa.id = boleto.wpessoa_sacado_id
  				and
  					boletoti.id =  boleto.boletoti_id
  				and
  					(
						exists (select boleto_id from recebimento where to_date(dtpagto) > to_date('" . $_POST[p_Data] . "') and recebimento.boleto_id=boleto.id)
					or
						exists (select distinct boleto_id from boletohi where upper(col) = 'STATE_BASE_ID' and to_date(boletohi.dt) > to_date('" . $_POST[p_Data] . "') and boleto.id=boletohi.boleto_id)
  					or
						boleto.state_base_id in (3000000000002, 3000000000003, 3000000000005, 3000000000006, 3000000000007)
  					)
				and
  					to_date(boleto.dt) <= to_date('" . $_POST[p_Data] . "')
  				and
  					boleto.BoletoTi_Id in ( 92200000000003, 92200000000015 )
  				and
  					boleto.id = saldo.boleto_id 
  				and 
  					to_date(saldo.dtsaldo) = to_date('" . $_POST[p_Data] . "')
  				)
  				union
  				(
				select
  					boleto.ordemref							 					as parcela,
  					boletoti.Nome     			   								as Tipo_Titulo,
  					to_char(boleto.dt, 'dd/mm/yyyy')		 					as Geracao_Titulo,
  					to_char(boleto.dtvencto, 'dd/mm/yyyy') 						as data_prorrogacao,
  					replace(boleto.valor , '.',',')	 			 				as valor_titulo,
  					to_char(last_day('01/' || to_char(boleto.dtvencto,'mm/yyyy')) , 'dd/mm/yyyy')	as referencia_contabil,
				    boleto.boletoti_id											as boletoti_id,
				    boleto.id                      		                		as boleto_id,
				    boleto.state_base_id                      		    		as state_base_id,
  					to_char(boleto.dtvencto,'yyyymm')							as competencia,
  					wpessoa.codigo                                      		as matricula,
  					wpessoa.nome                                        		as aluno,
  					wpessoa.id                                                  as wpessoa_id,
  					campus.nome													as Campus_Nome,
  					'Parcelamento'												as Conta_Contabil_Saldo,
  					boleto.nossonum												as Titulo_a_Receber,
  					replace(0 ,',','.')	                                        as Valor_Pago,
  					replace(0 ,',','.')				                            as Saldo_Titulo,
  					boleto.boletoti_id											as boletoti_data_id
  				from
  					campus,
  				    wpessoa,
  					boleto,
  					boletoti,
  					saldo		
				where
  					boleto.campus_id = campus.id (+)
  				and
  					wpessoa.id = boleto.wpessoa_sacado_id
  				and
  					boletoti.id = boleto.boletoti_id
  				and
  					(
						exists (select boleto_id from recebimento where to_date(dtpagto) > to_date('" . $_POST[p_Data] . "') and recebimento.boleto_id=boleto.id)
					or
						exists (select distinct boleto_id from boletohi where upper(col) = 'STATE_BASE_ID' and to_date(boletohi.dt) > to_date('" . $_POST[p_Data] . "') and boleto.id=boletohi.boleto_id)
  					or
						boleto.state_base_id in (3000000000002, 3000000000003, 3000000000005, 3000000000006, 3000000000007)
  					)
				and
  					to_date(boleto.dt) <= to_date('" . $_POST[p_Data] . "')
  				and
  					boleto.BoletoTi_Id in ( 92200000000002,  92200000000009, 92200000000010 )
  				and
  					boleto.id = saldo.boleto_id 
  				and 
  					to_date(saldo.dtsaldo) = to_date('" . $_POST[p_Data] . "')  							
  				)
  				union
  				(
				select
  					boleto.ordemref							 					as parcela,
  					boletoti.Nome     			   								as Tipo_Titulo,
  					to_char(boleto.dt, 'dd/mm/yyyy')		 					as Geracao_Titulo,
  					to_char(boleto.dtvencto, 'dd/mm/yyyy') 						as data_prorrogacao,
  					replace(boleto.valor, ',','.')	 			 				as valor_titulo,
  					to_char(last_day('01/' || decode(boletoti.id, 92200000000002,  to_char(boleto.dtvencto,'mm/yyyy'), SubStr(boleto.competencia,5,2) || '/' || SubStr(boleto.competencia,1,4))), 'dd/mm/yyyy')	as referencia_contabil,
				    boletoti.id													as boletoti_id,
				    boleto.id                      		                		as boleto_id,
				    boleto.state_base_id                      		    		as state_base_id,
  					decode(boletoti.id, 92200000000002, to_char(boleto.dtvencto,'yyyymm'), boleto.competencia)							as competencia,
  					wpessoa_gncodigo(boleto.wpessoa_sacado_id)             		as matricula,
  					wpessoa_gsrecognize(boleto.wpessoa_sacado_id)          		as aluno,
  					boleto.wpessoa_sacado_id                                    as wpessoa_id,
  					campus.nome													as Campus_Nome,
  					boletoti.Nome     			   								as Conta_Contabil_Saldo,
  					boleto.nossonum												as Titulo_a_Receber,
  					replace(recebimento.valor, ',','.')                         as Valor_Pago,
  					replace(boleto.valor - recebimento.valor, ',','.')          as Saldo_Titulo,
					boleto.boletoti_id											as boletoti_data_id
  				from
  					campus,
  					boleto,
  					boletoti,
  					recebimento,
  					saldo
				where
  					not exists ( select id from cobcartaxbol where cobcartaxbol.boleto_id = boleto.id )
  				and
  					boleto.campus_id = campus.id (+)
  				and
  					boletoti.id = boleto_gnboletotidata( boleto.id, '" . $_POST[p_Data] . "', boleto.boletoti_id )
  				and
					to_date(dtpagto) <= to_date('" . $_POST[p_Data] . "')
				and
  					to_date(boleto.dt) <= to_date('" . $_POST[p_Data] . "')
				and
  					boleto.valor > recebimento.valor
				and
					recebimento.boleto_id=boleto.id
  				and
  					boleto.BoletoTi_Id in ( 92200000000002, 92200000000003, 92200000000009, 92200000000012, 92200000000015 )
  				and
  					boleto.id = saldo.boleto_id 
  				and 
  					to_date(saldo.dtsaldo) = to_date('" . $_POST[p_Data] . "')			
  				)
  				order by 10
  				";
		
		
		/*  				(
		 select
				boleto.ordemref							 					as parcela,
				boletoti.Nome     			   								as Tipo_Titulo,
				to_char(boleto.dt, 'dd/mm/yyyy')		 					as Geracao_Titulo,
				to_char(boleto.dtvencto, 'dd/mm/yyyy') 						as data_prorrogacao,
				replace(boleto.valor , '.',',')	 			 				as valor_titulo,
				to_char(last_day('01/' || decode(boletoti.id, 92200000000002,  to_char(boleto.dtvencto,'mm/yyyy'), SubStr(boleto.competencia,5,2) || '/' || SubStr(boleto.competencia,1,4))), 'dd/mm/yyyy')	as referencia_contabil,
				boletoti.id													as boletoti_id,
				boleto.id                      		                		as boleto_id,
				boleto.state_base_id                      		    		as state_base_id,
				decode(boletoti.id, 92200000000002, to_char(boleto.dtvencto,'yyyymm'), boleto.competencia)							as competencia,
				wpessoa.codigo                                      		as matricula,
				wpessoa.nome                                        		as aluno,
				wpessoa.id                                                  as wpessoa_id,
				campus.nome													as Campus_Nome,
				boletoti.Nome     			   								as Conta_Contabil_Saldo,
				boleto.nossonum												as Titulo_a_Receber,
				replace(0 ,',','.')	                                        as Valor_Pago,
				replace(0 ,',','.')				                            as Saldo_Titulo
				from
				campus,
				wpessoa,
				boleto,
				boletoti
				where
				boleto.campus_id = campus.id (+)
				and
				wpessoa.id = boleto.wpessoa_sacado_id
				and
				boletoti.id = boleto_gnboletoti(boleto.id)
				and
				(
						exists (select boleto_id from recebimento where to_date(dtpagto) > to_date('" . $_POST[p_Data] . "') and recebimento.boleto_id=boleto.id)
						or
						exists (select distinct boleto_id from boletohi where upper(col) = 'STATE_BASE_ID' and to_date(boletohi.dt) > to_date('" . $_POST[p_Data] . "') and boleto.id=boletohi.boleto_id)
						or
						boleto.state_base_id in (3000000000002, 3000000000003, 3000000000005, 3000000000006, 3000000000007)
				)
				and
				to_date(boleto.dt) <= to_date('" . $_POST[p_Data] . "')
				and
				boleto.BoletoTi_Id in ( 92200000000012 )
		)
		union */
		
		

/*		echo $sql;
    	die();
*/
		
		
		$dbData->Get($sql);
		
		require_once("../engine/Excel.class.php");

		$vDescricao = "Em_Aberto_". $_POST[p_Data] ;
		
		$excel = new Excel($vDescricao);
				
		$arH[0] = "Escola";
		$arH[1] = "Data base do relatório";
		$arH[2] = "Matricula";
		$arH[3] = "Nome do Aluno";
		$arH[4] = "Status Aluno";
		$arH[5] = "Nome Responsável";
		$arH[6] = "% do Responsável";
		$arH[7] = "Nome Curso Sistema";
		$arH[8] = "Nome Curso Contábil";
		$arH[9] = "Campus";
		$arH[10] = "Turno";
		$arH[11] = "Titulação";
		$arH[12] = "Centro de Custo";
		$arH[13] = "Parcela";
		$arH[14] = "Tipo Título";
		$arH[15] = "Titulo a Receber";
		$arH[16] = "Data Geração Título";
		$arH[17] = "Data Pagamento Título";
		$arH[18] = "Data Prorrogação Título";
		$arH[19] = "Valor Título";
		$arH[20] = "Valor Pago";
		$arH[21] = "Saldo Título";
		$arH[22] = "Status Titulo";
		$arH[23] = "Código do Acordo";
		$arH[24] = "Data Acordo";
		$arH[25] = "Plano Pagamento";
		$arH[26] = "Plano Contábil";
		$arH[27] = "Referência do titulo contábil";
		$arH[28] = "Dias Vencido";
		$arH[29] = "Conta Contábil (Saldo)";
		$arH[30] = "Cod. Cliente";
		$arH[31] = "Estabelecimento";
		$arH[32] = "Espécie";

               
        $excel->Header($arH);
        		
		while ($arBoleto = $dbData->Row())			
		{
			
			$vState = $boleto->GetStateData($arBoleto['BOLETO_ID'], $_POST['p_Data'],'CONSIDERAR_ABERTO');			

			$aMatricula = '';
			
			if ($arBoleto['BOLETOTI_DATA_ID'] <> 92200000000012 && ($vState == 3000000000002 || $vState == 3000000000003 || $vState == 3000000000005 || $vState == 3000000000006 || $vState == 3000000000007 || ( $vState == 3000000000004 && $arBoleto['SALDO_TITULO'] > 0.01 ))) //($vState == 3000000000002 || $vState == 3000000000005 || $vState == 3000000000006)
			{
				if ($arBoleto['BOLETOTI_DATA_ID'] == 92200000000009)
				{
					$arBoleto['CONTA_CONTABIL_SALDO'] = 'Parcelamento';
				}					
				$aMatricula = $boleto->GetMatric($arBoleto['BOLETO_ID'], $_POST[p_Data]);
				if (! is_array($aMatricula) )
				{ 				
					$aMatricula		= $wpessoa->GetUltimaMatricula($arBoleto['WPESSOA_ID'], TRUE);
				}				
				
				$aCurso		  		= $curso->GetIdInfo($aMatricula['CURSO_ID']);
				$vContabil_Curso	= $contabilcur->GetNomeCurso($aMatricula['CURSO_ID']);				
				$nDiasVencido 		= $boleto->GetDiasVencido($arBoleto['BOLETO_ID'], $_POST[p_Data] );
				$nValorData 		= $boleto->GetValorData($arBoleto['BOLETO_ID'], $_POST[p_Data]);
				$vstrState          = $state->Recognize($vState);

			
				$excel->Content('Universidade São Judas Tadeu');			
				$excel->Content($_POST[p_Data]);			
				$excel->Content($arBoleto['MATRICULA']);
				$excel->Content($arBoleto['ALUNO']);
				$excel->Content($aMatricula['SITUACAO']);
				$excel->Content($arBoleto['ALUNO']);
				$excel->Content('100');
				$excel->Content($aCurso['NOME']);
				$excel->Content($vContabil_Curso);
				$excel->Content($arBoleto['CAMPUS_NOME']);
				$excel->Content($aMatricula['PERIODO_NOME']);			
				$excel->Content($aMatricula['CURSONIVEL_CODIGO']);
				$excel->Content(' ');
				$excel->Content($arBoleto['PARCELA']);
				$excel->Content($arBoleto['TIPO_TITULO']);
				$excel->Content($arBoleto['TITULO_A_RECEBER']);
				$excel->Content($arBoleto['GERACAO_TITULO']);
				$excel->Content(' ');
				$excel->Content($arBoleto['DATA_PRORROGACAO']);
				$excel->Content(_FormatValor($nValorData));	//---- $excel->Content($arBoleto['VALOR_TITULO']);
				$excel->Content(_FormatValor($arBoleto['VALOR_PAGO']));	
				$excel->Content(_FormatValor($arBoleto['SALDO_TITULO']));	
				$excel->Content($vstrState);
				$excel->Content(' ');				
				$excel->Content(' ');				
				$excel->Content(' ');				
				$excel->Content(' ');				
				$excel->Content($arBoleto['REFERENCIA_CONTABIL']);
				$excel->Content($nDiasVencido);
				$excel->Content($arBoleto['CONTA_CONTABIL_SALDO']);
				$excel->Content(' ');
				$excel->Content(' ');
				$excel->Content(' ');
				//	usei para testar diferença de valor			$excel->Content(_FormatValor($nValorData)-_FormatValor($arBoleto['VALOR_TITULO']));
				
			}
		}
		
		$excel->EndTable();
		
		unset($excel);
		unset($contabilcur);
		unset($curso);		
		unset($wpessoa);		
		unset($contabilfech);		
		unset($matric);		
		unset($recebimento);
		unset($boleto);	

		
	}	

	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);	
?>	