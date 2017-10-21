<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user 			= new User ();
	$app = new App("Menu de Páginas Relacionadas","Menu de Páginas Relacionadas",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");	
	include("../engine/Form.class.php");
	

	include("../model/SisMenuRel.class.php");
	
	
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	
	$sisMenuRel 	= new SisMenuRel ($dbOracle);
		

	if($_POST[p_O_Option] == 'select') 
	{
		$dbData->Get($sisMenuRel->Query("qId",array("p_SisMenuRel_Id"=>$_POST[SisMenuRel_Id])));
		
		$dbData = $sisMenuRel->Row();
		
	}
	
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain('IUD');
	
	$view->Header($user);
	
	$sisMenuRel->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('',		'hidden',			array("name"=>'SisMenuRel_Id',"value"=>$dadosSelect[ID]));
	$form->Input('Página','isel',				array("name"=>'p_IndexGUI',"href"=>'../box/indexgui_isel.php','value'=>$dadosSelect[INDEXGUI_ID],"label"=>$dadosSelect[INDEXGUI_REC]));
	$form->Input('Página Relacionada','isel',	array("name"=>'p_IndexGUI_Link',"href"=>'../box/indexgui_isel.php','value'=>$dadosSelect[INDEXGUI_LINK_ID],"label"=>$dadosSelect[INDEXGUIREL_REC]));

	
	$form->CloseFieldset();
	
	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();
	unset($form);


	if ($_GET[p_O_Option] == 'search')
	{
		
		$dbData->Get($sisMenuRel->Query('qGeral'));
		
		echo "Total de linhas: ".$dbData->Count ();
		
		
		$grid = new DataGrid(array("Página","Página Relacionada","Editar","Excluir"));
		
		
		
		while($row = $dbData->RowLimit ($_REQUEST[page])){
				
	    
				
				$grid->Content($row[INDEXGUI_REC],array('align'=>'left'));
				$grid->Content($row[INDEXGUIREL_REC],array('align'=>'left'));
				$grid->Content($view->Edit($sisMenuRel,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($sisMenuRel,$row[ID]),array('width'=>'05%'));
							
		}
		
		
		unset($grid);
		
		$dbData->Pagination ();
		
	}	
	
	unset($sisMenuRel);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>