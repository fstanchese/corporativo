<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Reembolsos do FIES","Reembolsos do FIES",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/PostoBanc.class.php");
	include("../model/Boleto.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dData 		= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	$postoBanc	= new PostoBanc($dbOracle);
	$boleto 	= new Boleto($dbOracle);
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		//$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->Input("Data Base","date",array("name"=>"p_Data1"));			
		
		$form->CloseFieldset ();
			
		$form->Fieldset();
							
			$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em PDF"));
			$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em Excel"));
							
		$form->CloseFieldset ();	
			
		unset ($form);
		
		
		unset($view);	
		unset($nav);	
	}	
	else 
	{
		
		
		if($_POST[p_Data1] == "") $_POST[p_Data1] = date('d/m/Y');

		$sql = "SELECT 
					Bolsa.Id,
				 	Bolsa.Dt     as DtBolsa,
				 	Bolsa.WPessoa_Id,
					WPessoa.Nome as WPessoa_Nome,
				 	WPessoa.Codigo as WPessoa_Codigo,
					Bolsa.Matric_Id as Matric_Id,
				    to_char(PagtoUso_gnValorMensal(Bolsa.Matric_Id,1),'999G999D99') as ValorBol,
				    Bolsa.Percentual,
				    Bolsa.Valor
				FROM
					Bolsa,
					WPessoa
				WHERE
					Bolsa.State_Id = 3000000018003
				AND
					WPessoa.Id = Bolsa.WPessoa_Id
				AND
					BolsaTi_Id = 10600000000048
				AND
					'".$_POST[p_Data1]."' between trunc(DtInicio) and trunc(DtTermino) 
				ORDER BY
					WPessoa.Nome
				";

		$vAno = substr($_POST[p_Data1],6,4);
		
		if ($_POST["consultar"] == "Gerar em PDF")
		{
	
			include("../engine/ReportPDF.class.php");
			
			$vDescricao = 'Data Base: ' . $_POST[p_Data1] ; 
			
			$dbData->Get($sql);

			
			$viewReport = new ReportPDF($app->title,$vDescricao,"G","L");
							
			$arH[0]['TEXT'] = utf8_encode("Código");
			$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[1]['TEXT'] = utf8_encode("Nome");
			$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[2]['TEXT'] = utf8_encode("Mens.Base");
			$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			$arH[3]['TEXT'] = utf8_encode("Valor");
			$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[4]['TEXT'] = utf8_encode("Dt.Bolsa");
			$arH[4]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');			
			
			$arH[5]['TEXT'] = utf8_encode("Boleto");
			$arH[5]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[6]['TEXT'] = utf8_encode("Vlr.Pago");
			$arH[6]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[7]['TEXT'] = utf8_encode("Ocorr");
			$arH[7]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

			$arH[8]['TEXT'] = utf8_encode("Dt.Ocorr");
			$arH[8]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
			
			$arH[9]['TEXT'] = utf8_encode("Reemb");
			$arH[9]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
			
			$viewReport->GridHeader($arH,array(20,50,20,20,20,30,20,40,20,20));
				
			$vTotal = 0; $vCor = array(233,240,240); $aBoleto = array();
			while ($rep = $dbData->Row())
			{
				
				$sqlOcorr = "select 
								id,
								dt,
								WOcorr_gsRetDeferimento(WOcorr.Id) as Deferimento 
							from 
								WOcorr 
							where 
								to_char(WOcorr.Dt,'yyyy') = '".$vAno."'
							and 
								WOcorrAss_Id = 5100000000075 
							and 
								WPessoa_Id ='" . $rep["WPESSOA_ID"]."'";
				
				$aOcorr = $dData->Row($dData->Get($sqlOcorr));
				
				$vOcorr = 'Não Possui';
				If (is_array($aOcorr))
				{
					$vOcorr = substr($aOcorr["DEFERIMENTO"],0,11);
				}
				
				$sqlDeb = "select min(dtprevisao) as Dt from debcred where bolsa_origem_id='".$rep["ID"]."'";
				$aDebCred = $dData->Row($dData->Get($sqlDeb));
				$vDeb = '';
				If (is_array($aDebCred))
				{
					
					if (substr($aDebCred[DT],3,2) != '01')
					{
						$vDeb = $aDebCred[DT];
						$vDebFormat = substr($aDebCred[DT],6,4).substr($aDebCred[DT],3,2);

						$sqlBol = "select
										Boleto.Referencia,
								 		to_char(Recebimento.Valor,'999G999D99') as Valor ,
										to_char(ReembComp.Valor,'999G999D99') as Valor_Reemb
									from
										boleto,
										Recebimento,
										ReembComp
									where
										boleto.id not in (select boleto_destino_id from debcred where bolsa_origem_Id='".$rep[ID]."')
									and
										Recebimento.Id = ReembComp.Recebimento_Id (+)
									and
										Recebimento.Boleto_Id = Boleto.Id
									and
										Boleto.BoletoTi_Id = 92200000000003
									and
										substr(Boleto.ordemref,1,4) = '".substr($aDebCred[DT],6,4)."'
									and 
										State_Base_Id = 3000000000004
									and
										WPessoa_Sacado_Id ='".$rep["WPESSOA_ID"]."'
									order by Boleto.Referencia";
						
						$dbDataAux->Get($sqlBol);
						while ($repBol = $dbDataAux->Row())
						{
							$viewReport->GridContent(array("TEXT"=>$rep["WPESSOA_CODIGO"],"TEXT_ALIGN"=>"C","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>$rep["WPESSOA_NOME"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>$rep["VALORBOL"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>$rep["VALOR"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>$rep["DTBOLSA"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>$repBol["REFERENCIA"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>$repBol["VALOR"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>_NVL($aOcorr["DEFERIMENTO"],'Não Possui'),"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>$aOcorr["DT"],"TEXT_ALIGN"=>"L","BACKGROUND_COLOR"=>array(220,230,240)));
							$viewReport->GridContent(array("TEXT"=>$repBol["VALOR_REEMB"],"TEXT_ALIGN"=>"R","BACKGROUND_COLOR"=>array(220,230,240)));
								
						}
						
						
					}
											
				}
		
			}
			
		
			
		}

		
		//Gerar em Excell
		if ($_POST["consultar"] == "Gerar em Excel")
		{
			require_once("../engine/Excel.class.php");

			unset($rep);
			
			$excel = new Excel($app->title.'_'.$_POST[p_Data1]);
			
			$excel->Header(array("Código","Nome","Mens.Base","Valor","Dt.Bolsa","Boleto","Vlr.Pago","Ocorr","Dt.Ocorr","Reemb"));
			
			$dbData->Get($sql);
		
			$vTotal = 0;
			
			while ($rep = $dbData->Row())
			{
				
				$sqlOcorr = "select 
								id,
								to_char(dt,'dd/mm/yyyy') as dt,
								WOcorr_gsRetDeferimento(WOcorr.Id) as Deferimento 
							from 
								WOcorr 
							where 
								to_char(WOcorr.Dt,'yyyy') = '".$vAno."'
							and 
								WOcorrAss_Id = 5100000000075 
							and 
								WPessoa_Id ='" . $rep["WPESSOA_ID"]."'";
				
				$aOcorr = $dData->Row($dData->Get($sqlOcorr));
				
				$vOcorr = 'Não Possui';
				If (is_array($aOcorr))
				{
					$vOcorr = substr($aOcorr["DEFERIMENTO"],0,11);
				}
				
				$sqlDeb = "select min(dtprevisao) as Dt from debcred where bolsa_origem_id='".$rep["ID"]."'";
				$aDebCred = $dData->Row($dData->Get($sqlDeb));
				$vDeb = '';
				If (is_array($aDebCred))
				{
					
					if (substr($aDebCred[DT],3,2) != '01')
					{
						$vDeb = $aDebCred[DT];

						$sqlBol = "select
										Boleto.Referencia,
								 		Recebimento.Valor,
										ReembComp.Valor as Valor_Reemb
									from
										boleto,
										Recebimento,
										ReembComp
									where
										boleto.id not in (select boleto_destino_id from debcred where bolsa_origem_Id='".$rep[ID]."')
									and
										Recebimento.Id = ReembComp.Recebimento_Id (+)
									and
										Recebimento.Boleto_Id = Boleto.Id
									and
										Boleto.BoletoTi_Id = 92200000000003
									and
										substr(Boleto.ordemref,1,4) = '".substr($aDebCred[DT],6,4)."'
									and 
										State_Base_Id = 3000000000004
									and
										WPessoa_Sacado_Id ='".$rep["WPESSOA_ID"]."'
									order by Boleto.Referencia";
						
						$dbDataAux->Get($sqlBol);
						while ($repBol = $dbDataAux->Row())
						{

							$excel->Content($rep["WPESSOA_CODIGO"]);
							$excel->Content($rep["WPESSOA_NOME"]);
							$excel->Content($rep["VALORBOL"]);
							$excel->Content($rep["VALOR"]);
							$excel->Content($rep["DTBOLSA"]);
							$excel->Content($repBol["REFERENCIA"]);
							$excel->Content($repBol["VALOR"]);
							$excel->Content(_NVL($aOcorr["DEFERIMENTO"],'Não Possui'));
							$excel->Content($aOcorr["DT"]);
							$excel->Content($repBol["VALOR_REEMB"]);
								
						}
						
					}
											
				}
							
			}

			

			//unset($excel);
			
			
		}
		
	}
	

	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>