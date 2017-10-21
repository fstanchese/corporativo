<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Consulta de Documentos Pendentes","Consulta de Documentos Pendentes",array('ADM'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/WPessoaDoc.class.php");
	include("../model/WPessoa.class.php");
	include("../model/WPessoaDocMot.class.php");
	include("../model/WPessoaDocTi.class.php");
	include("../model/Parentesco.class.php");


	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	$wpessoaDoc		= new WPessoaDoc($dbOracle);
	$wpessoa		= new WPessoa($dbOracle);
	$wpessoaDocTi	= new WPessoaDocTi($dbOracle);
	$wpessoaDocMot	= new WPessoaDocMot($dbOracle);
	$parentesco		= new Parentesco($dbOracle);
		

	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $wpessoaDoc->GetIdInfo($_POST[p_WPessoaDoc_Id]);
	}
	
	if($_GET["p_WPessoaDoc_Id"] != "") $linhaSelected[WPESSOADOC_ID] = $_GET["p_WPessoaDoc_Id"]; 
	
	if($_POST["p_Nome"] != "")
	{
		$linhaSelected[WPESSOA_ID] = $_POST[p_Nome];
		$linhaSelected[WPESSOA_NOME] = $_POST[p_Nome___AutoComplete];
	}
	
	$_POST['p_Depart_Id'] 	= 36000000000193;
	$_POST['p_QtdeVias'] 	= 1;
	$_POST['p_WPessoa_Id'] 	= $_POST[p_Nome];
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	$wpessoaDoc->IUD($_POST);

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_WPessoaDoc_Id',"value"=>$linhaSelected[ID]));

			$form->Input("Nome",
					'autocomplete',
					array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_Nome', "class"=>"size70", "label"=>$linhaSelected[WPESSOA_NOME], "value"=>$linhaSelected[WPESSOA_ID]));
				
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
		$form->Button ("submit", array ("name"=>"p_submit", "value"=>"Consultar","id"=>"btnLogin"));
		$form->Button ("submit", array ("name"=>"p_print","value"=>"Imprimir Relatуrio", "id"=>"btnPrint"));
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
    
	if($_POST[p_Nome] != "")
	{
	
		$dbData->Get("select WPessoaDoc.*,WPessoa_gsRecognize(WPessoa_Id) as Pessoa,WPessoaDocTi_gsRecognize(WPessoaDocTi_Id) as DocTi,WPessoaDocMot_gsRecognize(WPessoaDocMot_Id) as DocMot,Parentesco_gsRecognize(Parentesco_Id) as Parente from WPessoaDoc where depart_id=36000000000193 and WPessoa_Id='$_POST[p_Nome]'");
		
	
		if($dbData->Count() > 0)
		{
			$grid = new DataGrid(array("Aluno","Parentesco","Tipo de Documento","Qtde Vias","Prazo","Entregue em","Motivo","Observaзгo","Confirmar Recebimento"));
			
			while ($row = $dbData->Row())
			{
				
				$grid->Content($row[PESSOA],array('align'=>'left'));
				$grid->Content($row[PARENTE],array('align'=>'left'));
				$grid->Content($row[DOCTI],array('align'=>'left'));
				$grid->Content($row[QTDEVIAS],array('align'=>'left'));
				$grid->Content($row[DTENTREGA_DOCSAA],array('align'=>'left'));
				$grid->Content($row[DTENTREGA],array('align'=>'left'));
				$grid->Content($row[DOCMOT],array('align'=>'left'));
				$grid->Content($row[MOTIVO],array('align'=>'left'));
				$grid->Content($view->IconFA("fa-calendar",array("style"=>"color:#0066FF;font-size: 20px;")));				
								  				
			}
		}
		
		unset($grid);
		
	}
	
	unset($view);	
	unset($loteProc);
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>