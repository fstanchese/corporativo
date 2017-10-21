<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user 			= new User ();
	$app = new App("Cadastro de Tipos de Anexos utilizados pelo S.A.A.","Cadastro de Tipos de Anexos utilizados pelo S.A.A.",array('ADM','CPD','SAA_ANALISTA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");	
	include("../engine/Form.class.php");
	
	
	include("../model/AnexoTi.class.php");
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);
	
	$anexoTi 	= new AnexoTi ($dbOracle);
		

	if($_POST[p_O_Option] == 'select') 
	{
		
		$dadosSelect = $anexoTi->GetIdInfo($_POST[AnexoTi_Id]);

	}
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain('IUD');
	$view->Header($user, $nav);
	
	
	$anexoTi->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
		$form->Input('',		'hidden',	array("name"=>'AnexoTi_Id',"value"=>$dadosSelect[ID]));
		$form->Input('Anexo','text',		array("name"=>"p_Anexo","class"=>"size60",'value'=>$dadosSelect[ANEXO]));

		$form->Input('Ativar Tipo de Anexo?','checkbox', 	array("name"=>'p_Ativo','checked'=>$dadosSelect[ATIVO], "value"=>'on'));
	
	
	$form->CloseFieldset();
	
	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();

	
	unset($form);


	if ($_GET[p_O_Option] == 'search')
	{

		$aCons = $anexoTi->GetInfo();

		$grid = new DataGrid(array("Anexo","Ativo","Editar","Excluir"));
		
		foreach($aCons as $row){
			
				$grid->Content($row[ANEXO],array('align'=>'left'));
				$grid->Content($view->OnOff($row[ATIVO]),array('align'=>'left'));
				$grid->Content($view->Edit($anexoTi,$row[ID]),array('width'=>'05%'));				
				$grid->Content($view->Delete($anexoTi,$row[ID]),array('width'=>'05%'));
							
		}
		
		unset($grid);
		
		
	}	
	
	unset($anexoTi);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>