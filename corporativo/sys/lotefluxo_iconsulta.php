<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Consulta de Lote","Consulta de Lote",array('ADM','CPD','CASENHAGER'),$user);
	

	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/DataGrid.class.php");
		
	include("../model/LoteFluxo.class.php");
	include("../model/LoteProc.class.php");
	include("../model/CAEvXWPes.class.php");
	include("../model/CAWPesDet.class.php");
	include("../model/Depart.class.php");
	include("../model/Campus.class.php");	
	include("../model/Sala.class.php");
	

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	

	$loteFluxo	= new LoteFluxo($dbOracle);
	$loteProc	= new LoteProc($dbOracle);
	$caEvXWPes	= new CAEvXWPes($dbOracle);
	$caWPesDet	= new CAWPesDet($dbOracle);
	$depart		= new Depart($dbOracle);
	$campus		= new Campus($dbOracle);
	$sala		= new Sala($dbOracle);
		
	$view 		= new ViewPage($app->title,$app->description);
	
	
	
	$view->Header($user);
	
	
	

	$form = new Form();

		$form->Fieldset("Número do Lote");
			
			$form->Input("Lote",'text',	array("name"=>'p_NumeroLote', "class"=>"size10"));
		
			$form->Button ("submit", array ("value"=>"Selecionar"));
		
		$form->CloseFieldset ();
		


	
	
	
	if($_POST[p_NumeroLote] != "")
	{
		
			echo $view->JS(
					"
						$(document).on('click','.btnGerar',function()
						{
							
							window.open($(this).attr('url'));
				
						})
						
				
				");
		
		
		
		
		

		$primeiraLinha = $dbData->Row($dbData->Get("SELECT * FROM lotefluxo WHERE numero = '".($_POST[p_NumeroLote])."'"));
		
		
		
		$form->Fieldset("Informações do Lote");
			$form->Input('Número do Lote','label', $primeiraLinha[NUMERO]);
			$form->Input('Processo','label', $loteProc->Recognize($primeiraLinha[LOTEPROC_ID]));
			$form->Input('Departamento','label',$depart->Recognize($primeiraLinha[DEPART_ID]));
			$form->Input('Sala','label',$sala->Recognize($primeiraLinha[SALA_ID]));
			$form->Input('Unidade','label',$campus->Recognize($primeiraLinha[CAMPUS_ID]));
		$form->CloseFieldset ();
		
		$dbData->Get("SELECT * FROM lotefluxo WHERE dtrecebimento is not null and lotefluxo.numero = '".$_POST[p_NumeroLote]."' ");		
		
		if($dbData->Count () > 0)
		{
				
			$grid = new DataGrid(array("Pessoa","CPF"),"Itens Recebidos",FALSE);
				
			while($row = $dbData->Row ())
			{
		
				$aPessoa = $caWPesDet->GetWPesInfo($row[CAEVXWPES_ID]);
				
				$grid->Content($aPessoa[NOME],array('align'=>'left'));
				$grid->Content($aPessoa[CPF],array('align'=>'right'));
			}
		}
		
		unset($grid);
		
		
		
		$dbData->Get("SELECT LoteFluxo.* 
				FROM lotefluxo,CAEvXWPes 
				WHERE CAEvXWPes.Id = LoteFluxo.CAEvXWPes_Id and dtrecebimento is null and lotefluxo.numero = '".$_POST[p_NumeroLote]."' order by WPessoa_gsRecognize(WPessoa_Id)");
		
		if($dbData->Count () > 0)
		{
		
			$grid = new DataGrid(array("Pessoa","CPF"),"Itens Não Recebidos",FALSE);
		
			while($row = $dbData->Row ())
			{
		
				$aPessoa = $caWPesDet->GetWPesInfo($row[CAEVXWPES_ID]);
		
				$grid->Content($aPessoa[NOME],array('align'=>'left'));
				$grid->Content($aPessoa[CPF],array('align'=>'right'));
			}
		}
		
		
		
		unset($grid);
		
	
		echo $view->Br() . $view->Br();
		
			$form->Fieldset();
				$form->Button ("button", array ("value"=>"Gerar Capa","class"=>"btnGerar","url"=>"../rep/lotefluxo_ircapaprouni.php?numero=".$_POST[p_NumeroLote]."&enviar=Gerar+Lista"));
				
				$form->Button ("button", array ("value"=>"Gerar Simplificado","class"=>"btnGerar","url"=>"../rep/lotefluxo_irsimplificadoprouni.php?numero=".$_POST[p_NumeroLote]."&enviar=Gerar+Lista"));
				
				
				$form->Button ("button", array ("value"=>"Gerar Simplificado - Nome e RA","class"=>"btnGerar","url"=>"../rep/lotefluxo_irsimplificadoprouninomera.php?numero=".$_POST[p_NumeroLote]."&enviar=Gerar+Lista"));
				
				
				
			$form->CloseFieldset ();
			
	}
	
	
	unset($form);
	
	
	unset($loteFluxo);
	unset($loteProc);
	unset($caEvXWPes);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>