<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Total de Valores Recebidos por Competência","Total de Valores Recebidos por Competência",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/Recebimento.class.php");
	include("../model/Campus.class.php");
	include("../model/Boleto.class.php");
	include("../model/ParcelXBol.class.php");
	include("../model/TempDivxBol.class.php");
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	
	$recebimento	= new Recebimento($dbOracle);
	$campus 		= new Campus($dbOracle);
	$boleto		 	= new Boleto($dbOracle);
	$parcelxbol 	= new ParcelXBol($dbOracle);
	$tempdivxbol 	= new TempDivxBol($dbOracle);
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		//$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->Input('Unidade','select',array("name"=>'p_Campus_Id',"option"=>$campus->Calculate()));
		
			$form->LabelMultipleInput("Periodo");			
			$form->MultipleInput("","date",array("required"=>"1","name"=>'p_DataIni',"class"=>"size80"));
			$form->MultipleInput(" à ","date",array("required"=>"1","name"=>'p_DataFim',"class"=>"size80"));	
			$form->Input('Separar valores recebidos via boleto parcelado?',	'checkbox' , array("name"=>'p_Separar', "value"=>'on'));					
				
		$form->CloseFieldset ();
			
		$form->Fieldset();
							
			//$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em PDF"));
				
			$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em Excel"));
							
		$form->CloseFieldset ();	
			
		unset ($form);
		
		
		unset($view);	
		unset($nav);	
	}	
	else 
	{
				
		//não verifica boletos do tipo Serviço, Multa Biblioteca,Vestibular,Estacionamento,Mensalidade e Parcto.,DCex,Resíduo Encargos,FIES,Crédito Educativo,Reembolso Indevido
		$sql = "select
				Boleto.Id                                     as Boleto_Id,				
				Boleto.NossoNum                               as NossoNum,
				Boleto.Referencia                             as Referencia,
				Boleto.Dt                                     as DtEmissao,
				to_char(Boleto.Valor,'999G999G990D00')        as Valor_Format,
				Boleto.Valor                                  as Valor,
				Boleto.DtVencto                               as DtVencto,
			    Boleto.Competencia                            as Competencia,
			    Recebimento.DtPagto							  as Pagto,
				to_char(Recebimento.DtPagto,'YYYY/MM')        as PagtoComp,
			    boletoti_id					                  as BoletoTi_Id,
				Campus.Nome                                   as Unidade
			from		
				Boleto,
				Campus,
			    Recebimento
			where
				( Boleto.Campus_Id = '$_POST[p_Campus_Id]'	or	'$_POST[p_Campus_Id]' is null )
			and
			    Boleto.BoletoTi_Id not in (92200000000004,92200000000004,92200000000005,92200000000006,92200000000007,92200000000011,92200000000013,92200000000014,92200000000016,92200000000017,92200000000019)
			and
				Boleto.Id = Recebimento.Boleto_Id
			and
				campus.id = boleto.campus_id	
			and
				( Recebimento.BaixaMTi_id is not null or Recebimento.CNAB_Origem_Id is not null or Recebimento.PostoBanc_Origem_Id is not null )
			and
				trunc(Recebimento.dtPagto) between '$_POST[p_DataIni]' and '$_POST[p_DataFim]'
			order by
				Boleto.Competencia
				";	
			
		
		if($_POST["p_Separar"] == "")
		{
			$_POST["p_Separar"] = "off";		
		}
		
		
		$aCampus = array();
		if($_POST["p_Campus_Id"] != "")
		{
			$aCampus = $campus->GetIdInfo($_POST["p_Campus_Id"]);
		}	
		
		$nVez = 1;

		while($nVez < 3)
		{	
		    $aMesAno = array();
		    $aDados  = array();
		    $dbData->Get($sql);
		    		    
			while ($rep = $dbData->Row())
			{	
				// caso não seja para separar os valores provenientes de parcelamento
				if ($_POST["p_Separar"] == 'off')
				{
					$nVez = 9;
				}			
				if (($rep[BOLETOTI_ID] == 92200000000002 || $rep[BOLETOTI_ID] == 92200000000009) && (($_POST["p_Separar"] == 'off' && $nVez != 2)|| ($_POST["p_Separar"] == 'on' && $nVez == 2)))  
				{
					if ($rep[BOLETOTI_ID] == 92200000000002)
					{
						$aRepParc = $parcelxbol->GetBoletoOrigem($rep[BOLETO_ID], TRUE);
					}
					else 
					{
						$aRepParc = $tempdivxbol->GetBoletoOrigem($rep[NOSSONUM], TRUE);						
					}
					foreach ($aRepParc as $row)
					{
						if ($row["COMPETENCIA"] != '' && $row["BOLETOTI_ID"] == 92200000000003)
						{
							$aDados[$row["COMPETENCIA"]][$rep["PAGTOCOMP"]] += ($row["VLRPRINCIPAL"]);
						}
					}
						
				}
				else
				{					
				    if ($rep[BOLETOTI_ID] == 92200000000003 && ($_POST["p_Separar"] == 'off' || $nVez == 1))
				    {
						$aDados[$rep["COMPETENCIA"]][$rep["PAGTOCOMP"]] += _DecimalPoint($rep["VALOR"]);
				    }
				}				
				$aMesAno[] = $rep[PAGTOCOMP];
			}
				
			$aMesAno = array_unique($aMesAno);				

			sort($aMesAno);				
				
			$cont = 0;
					
	        ksort($aDados);

			//print_r ($aDados);	
	            
    	    $vDescricao = "Competências Recebidas por Mes de Pagamento entre ($_POST[p_DataIni] e $_POST[p_DataFim])";
    	    
    	    if($_POST["p_Campus_Id"] != "")
    	    {
	    	    $vDescricao .= " - Unidade $aCampus[NOME]";
    	    }
    	    	
	
			if ($_POST["consultar"] == "Gerar em PDF")
			{
					
				require_once("../engine/ReportPDF.class.php");
				if ($nVez != 2)
				{
					$viewReport = new ReportPDF($app->title,$vDescricao,"G","L");
				}
			
				$arH[0]['TEXT'] = $nVez;
				$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
				
				$nPosicaoArray = 1;
				$aTamanhoColuna = array(10);
				foreach ($aMesAno as $mesAno)
				{
					$arH[$nPosicaoArray]['TEXT'] = $mesAno;
					$arH[$nPosicaoArray]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
					$nPosicaoArray++;
					$aTamanhoColuna[] = 20;
				}
				
					
				$viewReport->GridHeader($arH,$aTamanhoColuna);
				
				foreach ($aDados as $key => $arComp)
				{
					
					$viewReport->GridContent(array("TEXT"=>$key));
					
					foreach ($aMesAno as $mesAno)
					{					
						$viewReport->GridContent(array("TEXT"=>_NVL(_FormatValor($arComp[$mesAno])), "TEXT_ALIGN" => "R"));								
					}
					
				}
					
				$viewReport->CloseTable();
			
			}	
	
			if ($_POST["consultar"] == "Gerar em Excel")
			{
				require_once("../engine/Excel.class.php");
					
				if ($nVez != 2)
				{
					$excel = new Excel($vDescricao);
							
					$arH[0] = $aCampus[NOME];
				
					$nPosicaoArray = 1;
					foreach ($aMesAno as $mesAno)
					{
						$arH[$nPosicaoArray] = $mesAno;
						$nPosicaoArray++;
					}			
					
									
					$excel->Header($arH);				
				}
				
				if ($_POST["p_Separar"] == 'on')
				{
					if ($nVez == 1)
					{
						$excel->Content('Mensalidade Baixada');
					}
					else
					{
						$excel->Content('Mensalidade Baixada Através de Parcelamento Quitado');
					}
					foreach ($aMesAno as $mesAno)
					{
						$excel->Content('');
					}
				}
				
				foreach ($aDados as $key => $arComp)
				{
					$excel->Content($key);
							
					foreach ($aMesAno as $mesAno)
					{
						$excel->Content(_NVL(_FormatValor($arComp[$mesAno])));
					}
								
				}
						
				if ($nVez > 1)
				{				
					$excel->EndTable();
				}				
			
					
			}
			$nVez++;
		}	
	}
	
	unset($excel);	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>