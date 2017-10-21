<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Informações Matrículas","Informações Matrículas",array('ADM','CPD','MARKETINGGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/PLetivo.class.php");
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dData 		= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	$pLetivo 	= new PLetivo($dbOracle);
	
	$form = new Form();
	
	
	if($_POST['p_PLetivo_Id'] == "")
	{
	

		$nav 		= new Navigation($user, $app,$dbData);
		$view = new ViewPage($app->title,$app->description);
		$view->Header($user,$nav);
		
	
		$form->Fieldset();
				
			$form->Input("Período Letivo",'select',array('name'=>'p_PLetivo_Id',"value"=>$_POST['p_PLetivo_Id'],"required"=>'1',"option"=>$pLetivo->Calculate("Geral")));			
		
		$form->CloseFieldset ();
			
		$form->Fieldset();
							
			$form->Button("submit",array("name"=>"consultar","value"=>"Imprimir"));
							
		$form->CloseFieldset ();	
			

	}	
	else 
	{
		
		$sql = "select 
					matricAtual.state_id    as matric_state,
					boleto.state_base_id    as boleto_state,
					boleto.valor            as boleto_valor,
				    boleto.DtVencto         as Boleto_DtVencto,
					Recebimento.DtPagto     as Boleto_DtPagto,
					Boleto.Dt               as Boleto_Dt,
					(select min(trunc(dt)) from matrichi where col='IP' and matrichi.matric_id = matricatual.id) as dtIP,
					matricAtual.data,
					WPessoa_gnCodigo(matricAtual.WPessoa_Id) as WPessoa_Codigo,
					WPessoa_gsRecognize(matricAtual.WPessoa_Id) as WPessoa_Nome,
					Curso.Nome as Curso_Nome,
					Periodo_gsRecognize(CurrOfe.Periodo_Id) as Periodo_Nome,
					Campus_gsRecognize(CurrOfe.Campus_Id) as Campus_Nome,
					decode (MatricAnt.State_Id,3000000002011, 'Sim','Não')  as Situacao_MatAnt,
					MatricAtual.Id as Matric_Id,
					MatricAtual.WPessoa_Id as WPessoa_Id
				from 
					matric MatricAtual, 
          			matric MatricAnt,
					turmaofe, 
					currofe, 
					curr, 
					curso, 
					debcred, 
					boleto,
					recebimento
				where 
					boleto.id = recebimento.boleto_id (+)
				and
					boleto.ordemref = '201501'
				and
					debcred.pagtop_id is not null
				and 
					debcred.matric_origem_id = matricAtual.id
				and 
					debcred.boleto_destino_id = boleto.id 		 
				and 
          			matricant.state_id in (3000000002010,3000000002011,3000000002014)
		        and
          			matricAtual.matric_ante_id = matricant.id
        		and
					matricAtual.state_id in (3000000002000,3000000002002)
				and 
					matricAtual.turmaofe_id=turmaofe.id 
				and 
					turmaofe.currofe_id=currofe.id 
				and 
					currofe.curr_id = curr.id 
				and 
					curr.curso_id = curso.id 
				and 
					currofe.pletivo_id='".$_POST[p_PLetivo_Id]."'";

		
		$diaAnoAtual =  date('Ymd',strtotime(date("Y-m-d", mktime()) . " - 1 day"));
		
		$dbData->Get($sql);
		while ($rep = $dbData->Row())
		{
			$vTotal++;
			
			if ($rep[BOLETO_VALOR] > 0)
			{
				$vBoletoTodosValor++;
			}
			else
			{
				$vBoletoTodosSemValor++;
			}
				
			
			$aData = explode('/',$rep[DTIP]);
			$vData = $aData[2].$aData[1].$aData[0];
				
			if ($rep[BOLETO_STATE] <> 3000000000001 && $vData <= $diaAnoAtual)
			{
				$vTotalMatric++;
				if ($rep[BOLETO_VALOR] > 0)
				{
					if ($rep[BOLETO_STATE] == 3000000000006)
					{
						$vTotalMatricNãoPago++;
						
						$aBolNValorImp[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
						$aBolNValorImp[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
						$aBolNValorImp[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
						$aBolNValorImp[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
						$aBolNValorImp[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
						$aBolNValorImp[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
						$aBolNValorImp[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
						$aBolNValorImp[$rep[MATRIC_ID]]['DATAMAT'] 		= '';
						$aBolNValorImp[$rep[MATRIC_ID]]['DATAVENCTO']	= $rep[BOLETO_DTVENCTO];
						$aBolNValorImp[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
						$aBolNValorImp[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
						
					
						$aBolTodos[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
						$aBolTodos[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
						$aBolTodos[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
						$aBolTodos[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
						$aBolTodos[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
						$aBolTodos[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
						$aBolTodos[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
						$aBolTodos[$rep[MATRIC_ID]]['MATEFETIVA'] 	= 'Não';
						$aBolTodos[$rep[MATRIC_ID]]['BOLVALOR'] 	= 'Sim';
						$aBolTodos[$rep[MATRIC_ID]]['AGUARDBAIXA']	= 'Sim';
						$aBolTodos[$rep[MATRIC_ID]]['BOLZERADO'] 	= 'Não';
						$aBolTodos[$rep[MATRIC_ID]]['DATAMAT'] 		= $rep[DATA];
						$aBolTodos[$rep[MATRIC_ID]]['DATAVENCTO'] 	= $rep[BOLETO_DTVENCTO];
						$aBolTodos[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
						$aBolTodos[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
						
						$vTotalSemMatric++;
					
					}
					else
					{
						$aDataMat = explode('/',$rep[DATA]);
						$vDataMat = $aDataMat[2].$aDataMat[1].$aDataMat[0];
						
						if ($vDataMat <= $diaAnoAtual)
						{
						
							$vTotalMatricPago++;
						
							$vTotalPago++;
							
							$aBolValorOk[$rep[MATRIC_ID]]['WPESSOA_ID']	= $rep[WPESSOA_ID];
							$aBolValorOk[$rep[MATRIC_ID]]['RA'] 		= $rep[WPESSOA_CODIGO];
							$aBolValorOk[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
							$aBolValorOk[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
							$aBolValorOk[$rep[MATRIC_ID]]['PERIODO'] 	= $rep[PERIODO_NOME];
							$aBolValorOk[$rep[MATRIC_ID]]['CAMPUS'] 	= $rep[CAMPUS_NOME];
							$aBolValorOk[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
							$aBolValorOk[$rep[MATRIC_ID]]['DATAMAT'] 	= $rep[DATA];
							$aBolValorOk[$rep[MATRIC_ID]]['DATAVENCTO']	= $rep[BOLETO_DTVENCTO];
							$aBolValorOk[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
							$aBolValorOk[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
							

							$aBolTodos[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
							$aBolTodos[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
							$aBolTodos[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
							$aBolTodos[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
							$aBolTodos[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
							$aBolTodos[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
							$aBolTodos[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
							$aBolTodos[$rep[MATRIC_ID]]['MATEFETIVA'] 	= 'Sim';
							$aBolTodos[$rep[MATRIC_ID]]['BOLVALOR'] 	= 'Sim';
							$aBolTodos[$rep[MATRIC_ID]]['AGUARDBAIXA']	= 'Não';
							$aBolTodos[$rep[MATRIC_ID]]['BOLZERADO'] 	= 'Não';
							$aBolTodos[$rep[MATRIC_ID]]['DATAMAT'] 		= $rep[DATA];
							$aBolTodos[$rep[MATRIC_ID]]['DATAVENCTO'] 	= $rep[BOLETO_DTVENCTO];
							$aBolTodos[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
							$aBolTodos[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
															
						}
						else
						{
							$vTotalMatricNãoPago++;
							$vTotalSemMatric++;
							
							$aBolNValorImp[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
							$aBolNValorImp[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
							$aBolNValorImp[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
							$aBolNValorImp[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
							$aBolNValorImp[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
							$aBolNValorImp[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
							$aBolNValorImp[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
							$aBolNValorImp[$rep[MATRIC_ID]]['DATAMAT'] 		= '';
							$aBolNValorImp[$rep[MATRIC_ID]]['DATAVENCTO']	= $rep[BOLETO_DTVENCTO];
							$aBolNValorImp[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
							$aBolNValorImp[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
							

							$aBolTodos[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
							$aBolTodos[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
							$aBolTodos[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
							$aBolTodos[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
							$aBolTodos[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
							$aBolTodos[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
							$aBolTodos[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
							$aBolTodos[$rep[MATRIC_ID]]['MATEFETIVA'] 	= 'Não';
							$aBolTodos[$rep[MATRIC_ID]]['BOLVALOR'] 	= 'Sim';
							$aBolTodos[$rep[MATRIC_ID]]['AGUARDBAIXA'] 	= 'Sim';
							$aBolTodos[$rep[MATRIC_ID]]['BOLZERADO'] 	= 'Não';
							$aBolTodos[$rep[MATRIC_ID]]['DATAMAT'] 		= $rep[DATA];
							$aBolTodos[$rep[MATRIC_ID]]['DATAVENCTO'] 	= $rep[BOLETO_DTVENCTO];
							$aBolTodos[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
							$aBolTodos[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
								
							
						}
					}
				}
				else
				{
					$vTotalMatricZerado++;
					
					$vTotalPago++;
					
					$aBolZeradoOk[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
					$aBolZeradoOk[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
					$aBolZeradoOk[$rep[MATRIC_ID]]['NOME'] 			= $rep[WPESSOA_NOME];
					$aBolZeradoOk[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
					$aBolZeradoOk[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
					$aBolZeradoOk[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
					$aBolZeradoOk[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
					$aBolZeradoOk[$rep[MATRIC_ID]]['DATAMAT'] 		= $rep[DATA];
					$aBolZeradoOk[$rep[MATRIC_ID]]['DATAVENCTO']	= $rep[BOLETO_DTVENCTO];
					$aBolZeradoOk[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
					$aBolZeradoOk[$rep[MATRIC_ID]]['BOLETODT'] 		= $rep[BOLETO_DT];
					

					$aBolTodos[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
					$aBolTodos[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
					$aBolTodos[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
					$aBolTodos[$rep[MATRIC_ID]]['MATEFETIVA'] 	= 'Sim';
					$aBolTodos[$rep[MATRIC_ID]]['BOLVALOR'] 	= 'Não';
					$aBolTodos[$rep[MATRIC_ID]]['AGUARDBAIXA']	= 'Não';
					$aBolTodos[$rep[MATRIC_ID]]['BOLZERADO'] 	= 'Sim';
					$aBolTodos[$rep[MATRIC_ID]]['DATAMAT'] 		= $rep[DATA];
					$aBolTodos[$rep[MATRIC_ID]]['DATAVENCTO'] 	= $rep[BOLETO_DTVENCTO];
					$aBolTodos[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
					$aBolTodos[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
				}
			}
			else 
			{
				$vTotalSemMatric++;
				if ($rep[BOLETO_VALOR] > 0)
				{
					$vBoletoValor++;
					
					$aBolNValor[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
					$aBolNValor[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
					$aBolNValor[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
					$aBolNValor[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
					$aBolNValor[$rep[MATRIC_ID]]['PERIODO'] 	= $rep[PERIODO_NOME];
					$aBolNValor[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
					$aBolNValor[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
					$aBolNValor[$rep[MATRIC_ID]]['DATAMAT'] 	= $rep[DATA];
					$aBolNValor[$rep[MATRIC_ID]]['DATAVENCTO'] 	= $rep[BOLETO_DTVENCTO];
					$aBolNValor[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
					$aBolNValor[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
						
					
					$aBolTodos[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
					$aBolTodos[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
					$aBolTodos[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
					$aBolTodos[$rep[MATRIC_ID]]['MATEFETIVA'] 	= 'Não';
					$aBolTodos[$rep[MATRIC_ID]]['BOLVALOR'] 	= 'Sim';
					$aBolTodos[$rep[MATRIC_ID]]['AGUARDBAIXA'] 	= 'Sim';
					$aBolTodos[$rep[MATRIC_ID]]['BOLZERADO'] 	= 'Não';
					$aBolTodos[$rep[MATRIC_ID]]['DATAMAT'] 		= $rep[DATA];
					$aBolTodos[$rep[MATRIC_ID]]['DATAVENCTO'] 	= $rep[BOLETO_DTVENCTO];
					$aBolTodos[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
					$aBolTodos[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
				}
				else
				{
					$vBoletoSemValor++;
					$aBolNZerado[$rep[MATRIC_ID]]['WPESSOA_ID']	= $rep[WPESSOA_ID];
					$aBolNZerado[$rep[MATRIC_ID]]['RA'] 		= $rep[WPESSOA_CODIGO];
					$aBolNZerado[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
					$aBolNZerado[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
					$aBolNZerado[$rep[MATRIC_ID]]['PERIODO'] 	= $rep[PERIODO_NOME];
					$aBolNZerado[$rep[MATRIC_ID]]['CAMPUS'] 	= $rep[CAMPUS_NOME];
					$aBolNZerado[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
					$aBolNZerado[$rep[MATRIC_ID]]['DATAMAT'] 	= '';
					$aBolNZerado[$rep[MATRIC_ID]]['DATAVENCTO']	= $rep[BOLETO_DTVENCTO];
					$aBolNZerado[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
					$aBolNZerado[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
					
						
					$aBolTodos[$rep[MATRIC_ID]]['WPESSOA_ID'] 	= $rep[WPESSOA_ID];
					$aBolTodos[$rep[MATRIC_ID]]['RA'] 			= $rep[WPESSOA_CODIGO];
					$aBolTodos[$rep[MATRIC_ID]]['NOME'] 		= $rep[WPESSOA_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['CURSO'] 		= $rep[CURSO_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['PERIODO'] 		= $rep[PERIODO_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['CAMPUS'] 		= $rep[CAMPUS_NOME];
					$aBolTodos[$rep[MATRIC_ID]]['REPROVADO'] 	= $rep[SITUACAO_MATANT];
					$aBolTodos[$rep[MATRIC_ID]]['MATEFETIVA'] 	= 'Não';
					$aBolTodos[$rep[MATRIC_ID]]['BOLVALOR'] 	= 'Não';
					$aBolTodos[$rep[MATRIC_ID]]['AGUARDBAIXA'] 	= 'Sim';
					$aBolTodos[$rep[MATRIC_ID]]['BOLZERADO'] 	= 'Sim';
					$aBolTodos[$rep[MATRIC_ID]]['DATAMAT'] 		= $rep[DATA];
					$aBolTodos[$rep[MATRIC_ID]]['DATAVENCTO'] 	= $rep[BOLETO_DTVENCTO];
					$aBolTodos[$rep[MATRIC_ID]]['DATAPAGTO'] 	= $rep[BOLETO_DTPAGTO];
					$aBolTodos[$rep[MATRIC_ID]]['BOLETODT'] 	= $rep[BOLETO_DT];
					
				}				
			}
			
		}
		
		$dbData->Get("select pletivo_pai_id from pletivo where id='".$_POST[p_PLetivo_Id]."'");
		$arPLetivo = $dbData->Row();
		
		
		$sql2 = "select 
					WPessoa_gnCodigo(matricAtual.WPessoa_Id) as WPessoa_Codigo,
					WPessoa_gsRecognize(matricAtual.WPessoa_Id) as WPessoa_Nome,
					Curso.Nome as Curso_Nome,
					Periodo_gsRecognize(CurrOfe.Periodo_Id) as Periodo_Nome,
					Campus_gsRecognize(CurrOfe.Campus_Id) as Campus_Nome,
					decode (MatricAnt.State_Id,3000000002011, 'Sim','Não')  as Situacao_MatAnt,
					MatricAtual.Id as Matric_Id,
					MatricAtual.WPessoa_Id as WPessoa_Id,
				    boleto.DtVencto         as Boleto_DtVencto,
					Recebimento.DtPagto     as Boleto_DtPagto,
					Boleto.Dt               as Boleto_Dt,
					boleto.valor            as boleto_valor,
					boleto.state_base_id    as boleto_state,
				    boleto.valor as boleto_valor,
					matricAtual.state_id as matric_state,
  					matricAtual.data as data,
  					(select min(trunc(dt)) from matrichi where col='IP' and matrichi.matric_id = matricatual.id) as dtIP
				from 
  					matric MatricAtual,matric MatricAnt,turmaofe,currofe,curr,curso,debcred,boleto,recebimento
				where 
					boleto.id = recebimento.boleto_id (+)
				and
            		Boleto.ordemref = '201401'
        		and 
            		DebCred.boleto_destino_id = Boleto.Id
        		and 
            		DebCred.PagtoP_Id is not null
        		and
					MatricAnt.state_id in (3000000002010,3000000002011,3000000002014)
				and
            		MatricAtual.Id = DebCred.Matric_Origem_Id
        		and
  					MatricAtual.matric_ante_id = MatricAnt.Id
				and
  					Curso.CursoNivel_Id in (6200000000001,6200000000010,6200000000012)
				and
  					curr.curso_id = curso.id
				and
  					currofe.curr_id = curr.id
				and 
  					matricAtual.turmaofe_id = turmaofe.id 
				and 
  					turmaofe.currofe_id = currofe.id 
				and
  					MatricAtual.MatricTi_Id = 8300000000001
				and 
  					currofe.pletivo_id='". $arPLetivo[PLETIVO_PAI_ID] ."'";
		
		
		$diaAnoAnt =  date('Ymd',strtotime(date("Y-m-d", mktime()) . " - 366 day"));
		$dbData->Get($sql2);
		while ($reps = $dbData->Row())
		{
			$v_Ant_Total++;
			
			$aData = explode('/',$reps[DTIP]);
			$vData = $aData[2].$aData[1].$aData[0];
			//echo $vData . ' ' .$diaAnoAnt .  '<br>'; 
			if ($vData <= $diaAnoAnt && !empty($vData))
			{

				if ($reps[BOLETO_VALOR] > 0)
				{				
					
					$aDataMat = explode('/',$reps[DATA]);
					$vDataMat = $aDataMat[2].$aDataMat[1].$aDataMat[0];
						
					//echo $vDataMat . ' -  ' . $diaAnoAnt . '<br>' ;
					if ($vDataMat <= $diaAnoAnt && !empty($vDataMat))
					{
						$v_AntRematPago++;
						$v_Ant_TotalRemat++;
					}
					else
					{
						$v_Ant_RematNPago++;
						
						$v_Ant_TotalNRemat++;
					}
					
					$v_Ant_BoletoTodosValor++;
				}
				else
				{
					$v_Ant_RematZero++; 	
					$v_Ant_TotalRemat++;
					$v_Ant_BoletoTodosSemValor++;
					
				}
			}
			else
			{
				$v_Ant_TotalNRemat++;
				if ($reps[BOLETO_VALOR] > 0)
				{
					$v_Ant_NRematPago++;
					$v_Ant_BoletoTodosValor++;
				}
				else
				{
					$v_Ant_NRematZero++;
					$v_Ant_BoletoTodosSemValor++;
				}
			}			

			
			//Final 
			if (!empty($vData))
			{
			
				if ($reps[BOLETO_VALOR] > 0)
				{
						
					if (!empty($vDataMat))
					{
						$v_AntFRematPago++;
						$v_AntF_TotalRemat++;
					}
					else
					{
						$v_AntF_RematNPago++;
			
						$v_AntF_TotalNRemat++;
					}
						
					$v_AntF_BoletoTodosValor++;
				}
				else
				{
					$v_AntF_RematZero++;
					$v_AntF_TotalRemat++;
					$v_AntF_BoletoTodosSemValor++;
						
				}
			}
			else
			{
				$v_AntF_TotalNRemat++;
				if ($reps[BOLETO_VALOR] > 0)
				{
					$v_AntF_NRematPago++;
					$v_AntF_BoletoTodosValor++;
				}
				else
				{
					$v_AntF_NRematZero++;
					$v_AntF_BoletoTodosSemValor++;
				}
			}
				
			
			
			
		}
		

		if ($_POST["consultar"] == "Imprimir")
		{
			$view = new ViewPage($app->title,$app->description);
			$view->Header($user,$nav);
				
			$vDescricao = 'Data Base: ' . date('d/m/Y') ;
			
			echo $view->Table(array("border"=>"2","width"=>"40%","cellpadding"=>"2","cellspacing"=>"2")) . 
			
			$view->Tr() .
			$view->Th("Painel comparativo de rematrícula",array("style"=>"border: 1px solid #000; width: 100px; height: 30px;")) .
			$view->Th("D-1 2014",array("style"=>"border: 1px solid #000; width: 100px; height: 30px;")).
			$view->Th("D-1 2015",array("style"=>"border: 1px solid #000; width: 100px; height: 30px;")).
			$view->Th("2014 Final",array("style"=>"border: 1px solid #000; width: 100px; height: 30px;")).
			$view->CloseTr() .
			
			$view->Tr() . 
			$view->Td() . $view->Strong('&nbsp;Total Aptos') . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_Ant_Total ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $view->Link($vTotal,array("href"=>"matric_igerainfo.php?vtipo=total", "target"=>"new")) ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_Ant_Total ) . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() .

			
			$view->Tr() .
			$view->Td() . $view->Strong('&nbsp;Boleto com valor - pagto') . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_Ant_BoletoTodosValor ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $vBoletoTodosValor ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_AntF_BoletoTodosValor ) . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() .
				
			$view->Tr() .
			$view->Td() . $view->Strong('&nbsp;Boleto zerado') . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_Ant_BoletoTodosSemValor ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $vBoletoTodosSemValor ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_AntF_BoletoTodosSemValor ) . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() .
				
			
			$view->Tr() .
			$view->Td() . $view->Strong('Rematrícula Efetivada') . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_Ant_TotalRemat ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $vTotalPago ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_AntF_TotalRemat ) . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() .
				
			$view->Tr() .
			$view->Td() . '&nbsp;&nbsp;Boleto com valor - pagto' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_AntRematPago . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Link($vTotalMatricPago,array("href"=>"matric_igerainfo.php?vtipo=dadosOKV", "target"=>"new")) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_AntFRematPago . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() .

			$view->Tr() .
			$view->Td() . '&nbsp;&nbsp;Boleto zerado' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_Ant_RematZero . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Link($vTotalMatricZerado,array("href"=>"matric_igerainfo.php?vtipo=dadosOKZ", "target"=>"new")) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_AntF_RematZero . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() . 
				
			$view->Tr() .
			$view->Td() . $view->Strong('Rematrícula Não Efetivada') . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_Ant_TotalNRemat ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $vTotalSemMatric ) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Strong( $v_AntF_TotalNRemat ) . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() .
				
			$view->Tr() .
			$view->Td() .'&nbsp;&nbsp;Boleto com valor' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_Ant_NRematPago . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Link($vBoletoValor,array("href"=>"matric_igerainfo.php?vtipo=dadosNV", "target"=>"new")) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_AntF_NRematPago . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() .
			
			$view->Tr() .
			$view->Td() .'&nbsp;&nbsp;Boleto zerado' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_Ant_NRematZero . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $view->Link($vBoletoSemValor,array("href"=>"matric_igerainfo.php?vtipo=dadosNZ", "target"=>"new")) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_AntF_NRematZero . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() . 

			$view->Tr() .
			$view->Td() .'&nbsp;&nbsp;Boleto emitido aguardando baixa' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_Ant_RematNPago . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;"))  . $view->Link($vTotalMatricNãoPago,array("href"=>"matric_igerainfo.php?vtipo=dadosNVI", "target"=>"new")) . '&nbsp;' . $view->CloseTd() .
			$view->Td(array("align"=>"right","style"=>"border: 1px solid #000; width: 100px; height: 30px;")) . $v_AntF_RematNPago . '&nbsp;' . $view->CloseTd() .
			$view->CloseTr() ;
				
			
			$_SESSION["dadosOKV"] 	= $aBolValorOk; 
			$_SESSION["dadosOKZ"] 	= $aBolZeradoOk;
			$_SESSION["dadosNV"] 	= $aBolNValor;
			$_SESSION["dadosNZ"] 	= $aBolNZerado;
			$_SESSION["dadosNVI"] 	= $aBolNValorImp;
			$_SESSION["total"] 		= $aBolTodos;
			
			

		}

	}

	unset ($form);
	unset($view);
	unset($nav);
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>