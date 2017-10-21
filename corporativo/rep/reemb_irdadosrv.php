<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Reembolso de Reserva de Vaga - Geração de Planilha","Reembolso de Reserva de Vaga - Geração de Planilha",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/Bolsa.class.php");
		
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);

	
	$bolsa 	= new Bolsa($dbOracle);
	
	if($_POST["consultar"] == "")
	{
	
		$nav 		= new Navigation($user, $app,$dbData);
		//$ajax 		= new Ajax();
		
		$view = new ViewPage($app->title,$app->description);
		
		$view->Header($user,$nav);
	
		$form = new Form();
	
		$form->Fieldset();
				
			$form->LabelMultipleInput("Data");
			$form->MultipleInput("","date",array("name"=>"p_Data1"));
			$form->MultipleInput("a","date",array("name"=>"p_Data2"));
		
		$form->CloseFieldset ();
			
		$form->Fieldset();
							
			$form->Button("submit",array("name"=>"consultar","value"=>"Gerar em Excel"));
							
		$form->CloseFieldset ();	
			
		unset ($form);
		
		
		unset($view);	
		unset($nav);	
	}	
	else 
	{
		
		if($_POST[p_Data1] == "") $_POST[p_Data1] = $_POST[p_Data2] = date('d/m/Y');

		$sql = "select
					wpessoa_gnCodigo(wpessoa_sacado_id) as Codigo,
					wpessoa_gsRecognize(wpessoa_sacado_id) as Nome,
  					Boleto.Referencia as Referencia,
  					Boleto.Valor as VlrBoleto,
  					Recebimento.Valor as VlrRecebido,
  					Boleto.DtVencto as DtVencimento,
  					Recebimento.DtPagto as DtPagamento,
					Boleto.WPessoa_Sacado_Id as WPessoa_Id
				from 
  					recebimento,
  					boleto 
  				where 
     				boleto.id = recebimento.boleto_id 
  				and 
    				boletoti_id=92200000000008 
  				and 
    				boleto.referencia like '%2015%' 
  				and 
    				dtpagto < '01/01/2015'
				order by 2,3";
		
		//Gerar em Excel
		if ($_POST["consultar"] == "Gerar em Excel")
		{
			require_once("../engine/Excel.class.php");
			
			$excel = new Excel($app->title.'_'.$_POST[p_Data1].'_'.$_POST[p_Data2]);
			
			$excel->Header(array("Código","Nome","Referência","Vlr Boleto","Vlr Pago","Data Vencimento","Data Pagamento","Num Ocorr","Dt.Ocorrência","Assunto","Texto Livre"));
			
			$dbData->Get($sql);
		
			$vTotal = 0;
			while ($rep = $dbData->Row())
			{

				$dbDataAux->Get("select wocorr_gnnumocorrencia(WOcorr.Id) as Num, 
																WOcorr.Dt as Data, 
																WOcorrAss_gsRecognize(WOcorrass_Id) as Assunto, 
																wocorrinf_gsRetConteudo(id,999) as Texto 
															from WOcorr 
															where WOcorrAss_Id in (5100000000076,5100000000099,5100000000097,5100000000096,5100000000183,5100000000258,5100000000184,5100000000074,5100000000101,5100000000098,5100000000075)
															and State_Id not in (3000000011008,3000000011007,3000000011005,3000000011001) 
															and WOcorr.Dt > '01/09/2014' 
															and  wpessoa_id = $rep[WPESSOA_ID] order by Data");
				$vData = '';
				$vAssunto = '';
				$vNum = '';
				$vTexto = '';
				
				while ($aOcorr = $dbDataAux->Row())
				{
					$vData .= '*'.	$aOcorr["DATA"];
					$vAssunto .= '/' . $aOcorr["ASSUNTO"];
					$vNum .= '/' . $aOcorr["NUM"];
					$vTexto .= '/' . $aOcorr["TEXTO"];
				}
				
				
				$excel->Content($rep["CODIGO"]);
				$excel->Content($rep["NOME"]);
				$excel->Content($rep["REFERENCIA"]);
				$excel->Content($rep["VLRBOLETO"],array("class"=>"MOEDARS"));
				$excel->Content($rep["VLRRECEBIDO"],array("class"=>"MOEDARS"));
				$excel->Content($rep["DTVENCIMENTO"]);
				$excel->Content($rep["DTPAGAMENTO"]);						
				$excel->Content(substr($vNum,1));
				$excel->Content(substr($vData,1));
				$excel->Content(substr($vAssunto,1));
				$excel->Content(substr($vTexto,1));
				
			}
			
			$excel->EndTable();

			unset($excel);
			
		}
		
	}
	

	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>