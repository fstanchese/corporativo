<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Documentos Pendentes - ProUni","Cadastro de Documentos Pendentes - ProUni",array('ADM','PROUNI'),$user);
	
	
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

	if($_GET["p_Nome"] != "")
	{
		$linhaSelected[WPESSOA_ID] = $_GET[p_Nome];
		$linhaSelected[WPESSOA_NOME] = $_GET[p_Nome___AutoComplete];
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
				
			$form->Input($wpessoaDoc->GetLabel('Parentesco_Id'),'select',array("name"=>'p_Parentesco_Id',"value"=>$linhaSelected[PARENTESCO_ID],"option"=>$parentesco->Calculate("Geral")));
			$form->Input($wpessoaDoc->GetLabel('WPessoaDocTi_Id'),'select',array("name"=>'p_WPessoaDocTi_Id', "required"=>'1',"value"=>$linhaSelected[WPESSOADOCTI_ID],"option"=>$wpessoaDocTi->Calculate("Geral")));
			$form->Input($wpessoaDoc->GetLabel('DtEntrega_DocSAA'),'date',array("name"=>'p_DtEntrega_DocSAA', "value"=>$linhaSelected[DTENTREGA_DOCSAA]));
			$form->Input($wpessoaDoc->GetLabel('DtEntrega'),'date',array("name"=>'p_DtEntrega', "value"=>$linhaSelected[DTENTREGA]));
			//$form->Input($wpessoaDoc->GetLabel('WPessoaDocMot_Id'),'select',array("name"=>'p_WPessoaDocMot_Id',"value"=>$linhaSelected[WPESSOADOCMOT_ID],"option"=>$wpessoaDocMot->Calculate("Geral")));
			$form->Input($wpessoaDoc->GetLabel('Motivo'),'textarea',array("name"=>"p_Motivo", "class"=>"size70", "value"=>$linhaSelected[MOTIVO]));
			
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	$dbData->Get("select WPessoaDoc.*,WPessoa_gsRecognize(WPessoa_Id) as Pessoa,WPessoaDocTi_gsRecognize(WPessoaDocTi_Id) as DocTi,WPessoaDocMot_gsRecognize(WPessoaDocMot_Id) as DocMot,Parentesco_gsRecognize(Parentesco_Id) as Parente from WPessoaDoc where depart_id=36000000000193 and WPessoa_Id='$_GET[p_Nome]'");
	

	if($dbData->Count() > 0)
	{
		$grid = new DataGrid(array("Parentesco","Tipo de Documento","Qtde Vias","Prazo","Entregue em","Motivo","Observaчуo","Editar","Del"));
		
		while ($row = $dbData->Row())
		{
			
			$grid->Content(_NVL($row[PARENTE],"Aluno"),array('align'=>'left'));
			$grid->Content($row[DOCTI],array('align'=>'left'));
			$grid->Content($row[QTDEVIAS],array('align'=>'left'));
			$grid->Content($row[DTENTREGA_DOCSAA],array('align'=>'left'));
			$grid->Content($row[DTENTREGA],array('align'=>'left'));
			$grid->Content($row[DOCMOT],array('align'=>'left'));
			$grid->Content($row[MOTIVO],array('align'=>'left'));
			$grid->Content($view->Edit($wpessoaDoc,$row[ID]));
			$grid->Content($view->Delete($wpessoaDoc,$row[ID]));
							  				
		}
	}
	
	unset($grid);
		

	
	unset($view);	
	unset($loteProc);
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>