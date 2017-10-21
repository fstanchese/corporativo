<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Motivos de Restriзгo de Cobranзa","Cadastro de Motivos de Restriзгo de Cobranзa",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CobRestMot.class.php");

	
	$dbOracle = new Db ($user);

	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$cobRestMot	= new CobRestMot($dbOracle);

	if($_POST[p_O_Option] == "select")
	{		

		$linhaSelected = $cobRestMot->GetIdInfo($_POST[p_CobRestMot_Id]);
		
	}
	
	if($_GET["p_CobRestMot_Id"] != "") $linhaSelected[ID] = $_GET["p_CobRestMot_Id"]; 
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	$cobRestMot->IUD($_POST);
	
	//Para montar o Header precisa passar o nome do UsuпїЅrio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
 

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_CobRestMot_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input($cobRestMot->GetLabel("Nome"),'text', array("name"=>'p_Nome',  "value"=>$linhaSelected[NOME]));
			
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
		
	if($_GET["p_O_Option"] == "search")
	{
	
	
	
		$acobRestMot = $cobRestMot->GetInfo();
	
		if(is_array($acobRestMot))
		{
	
			$grid = new DataGrid(array("Nome","Editar","Del"));
			
			foreach($acobRestMot as $row)
			{
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($view->Edit($acobRestMot,$row[ID]));
				$grid->Content($view->Delete($acobRestMot,$row[ID]));
			}
		}
		else
		{
			echo 'Nгo existem itens cadastrados';
		}
		unset($grid);
		
	}
	
	unset($acobRestMot);
	unset($dbData);
	
	unset($dbOracle);
	unset($user);

?>