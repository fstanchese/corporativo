<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Lista de Alunos por Lote - Capa","Lista de Alunos por Lote - Capa",array('ADM','CPD','CASENHAGER','CASENHA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	$dbOracle = new Db ($user);
	$dbData = new DbData ($dbOracle);	
	
	$nav 		= new Navigation($user, $app,$dbData);
	
	
	if($_GET[numero] == "")
	{
		include("../engine/ViewPage.class.php");
		include("../engine/Form.class.php");
		
		require_once '../model/CAEvento.class.php';
		
		$caEvento = new CAEvento($dbOracle);
	
		$view = new ViewPage($app->title,$app->description);
	
		$view->Header($user,$nav);
		
	
		$form = new Form(array("method"=>"get"));	
	
			$form->Fieldset();	
		
				$form->Input("Número do Lote",'text',array('name'=>'numero',"required"=>'1'));
					
			$form->CloseFieldset ();
		
			$form->Fieldset();
			
				$form->Button("submit",array("name"=>"enviar","value"=>"Gerar Lista"));
		
	
			$form->CloseFieldset ();
	
		unset($form);
	}
	else
	{
		

		require_once("../engine/ViewReport.class.php");
		
		require_once("../model/Depart.class.php");
		require_once("../model/Campus.class.php");
		require_once("../model/Sala.class.php");
		require_once("../model/LoteProc.class.php");
		require_once("../model/CAWPesDet.class.php");
		
		
		$depart 	= new Depart($dbOracle);
		$campus 	= new Campus($dbOracle);
		$sala   	= new Sala($dbOracle);
		$loteProc 	= new LoteProc($dbOracle);
		$wpesDet	= new CAWPesDet($dbOracle);
		
		
		$qtdeLote = $dbData->Row($dbData->Get("SELECT count(*) as qtde FROM lotefluxo WHERE numero = '".($_REQUEST[numero])."'"));
		
		$primeiraLinha = $dbData->Row($dbData->Get("SELECT * FROM lotefluxo WHERE numero = '".($_REQUEST[numero])."'"));
		
		
		$dadosDepart 	= $depart->GetIdInfo($primeiraLinha[DEPART_ID]);
		$dadosCampus 	= $campus->GetIdInfo($primeiraLinha[CAMPUS_ID]);
		//$dadosSala 		= $sala->GetIdInfo($primeiraLinha[SALA_ID]);
		$dadosLoteProc 	= $loteProc->GetIdInfo($primeiraLinha[LOTEPROC_ID]);
		
		
	
		$viewReport = new ViewReport($app->title,"Lote: ".$primeiraLinha[NUMERO]." - ".$dadosDepart[NOMEREDUZ]." - ".$dadosCampus[NOME]." - ".$dadosCampus[NOME]." ".$dadosLoteProc[NOME]." - Qtde Proc (".$qtdeLote[QTDE].")");
		
		$viewReport->Header();
	
		$viewReport->IncludeJS("jquery.js");
		$viewReport->IncludeJS("jquery-barcode.js");
		
		$linesPerPage = 0;
				
		$dbData->Get("SELECT LoteFluxo.* 
				FROM LoteFluxo,CAEvXWPes 
				WHERE CAEvXWPes.Id = LoteFluxo.CAEvXWPes_Id and numero = '".($_REQUEST[numero])."' order by WPessoa_gsRecognize(WPessoa_Id)");
		
		
		
		$cont = 0;
		
		
		
		while($row = $dbData->Row())
		{
			
			$dadosPessoa = $wpesDet->GetWPesInfo($row[CAEVXWPES_ID]);
			
			$vStyle = "";
			
			if($cont % 2 == 0 || $cont == 0)
			{

				$vStyle = "border-right:1px solid #444;width:50%";
				
				$linesPerPage++;
				
				if($linesPerPage == 5)
				{
						
					echo $viewReport->CloseTr().$viewReport->CloseTable().$viewReport->Footer().$viewReport->Header().$viewReport->Table(array("style"=>"margin-bottom:2px;background:none!important;border:1px solid #444")).$viewReport->Tr();
						
						
					$linesPerPage = 1;
				}
				else
				{
					if($cont > 0)
						
						echo $viewReport->CloseTr().$viewReport->Tr();
						
					echo $viewReport->Table(array("style"=>"margin-bottom:2px;background:none!important;border:1px solid #444;")).$viewReport->Tr();
				}
				
				
				

								
				
				
				
			}
			
			
			
			echo	$viewReport->Td(array("style"=>$vStyle)).
						$viewReport->Table(array("cellpadding"=>"0","cellspacing"=>"0","style"=>"font-size:10px;background:white!important")).
							$viewReport->Tr();
			
			
			$cont2 = 0;
			
			
			// PEGAR AS INFORMAÇÕES DO ALUNO
			
			foreach($dadosPessoa as $key => $valor)
			{
				
				if($cont2 == 2)
				{
				
					$cont2 = 0;
					echo $viewReport->CloseTr().$viewReport->Tr();
				
				}
				if($key == "CASENHATI_ID")
				{
					$key = "";
					$valor = " ";
				}
					echo $viewReport->Td().$key." ".$viewReport->Strong($valor).$viewReport->CloseTd();
				
					$cont2++;
				
				
			}
			
			
			//echo substr($row[CASENHA_ID],-9);
			echo $viewReport->CloseTable().$viewReport->Br()._CodeBar(substr($row[CASENHA_ID],-9),10,20,0).$viewReport->CloseTd();
			//echo $viewReport->CloseTable().$viewReport->Br().substr($row[CASENHA_ID],-9).$viewReport->CloseTd();
			
			
			$cont++;
			
			
		
		}
		
		
		unset($viewReport);
		
		
		
	}
	
	
	unset($depart);
	unset($campus);
	unset($sala);
	unset($loteProc);
	unset($wpesDet);
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>	