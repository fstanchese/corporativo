<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Auto Atendimento","Auto Atendimento",array('ADM','CPD','SAA', 'CPDEST'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/AutoAtend.class.php");

	
	$dbOracle 	= new Db ($user);


	$dbData 	= new DbData ($dbOracle);
	
	

	$nav 		= new Navigation($user, $app, $dbData);

	$autoAtend 	= new AutoAtend($dbOracle);


	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $autoAtend->GetIdInfo($_POST[p_AutoAtend_Id]);
	}
	
	//verifica se o evento foi passado por parametro - Paginacao
	if($_GET["p_AutoAtend_Id"] != "") $linhaSelected[ID] = $_GET["p_AutoAtend_Id"]; 
	
	
	//Quando cria o objeto View пїЅ necessпїЅrio passar o Titulo da PпїЅgina	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$autoAtend->IUD($_POST);
	$view->Header($user,$nav);
 

	$form = new Form();

		$form->Fieldset("Auto Atendimento");
		
			$form->Input('',		'hidden',			array("name"=>'p_AutoAtend_Id',"value"=>$linhaSelected[ID]));
		
			
			$form->Input('Nome','text',array("required"=>'1',"name"=>'p_Nome', "value"=>$linhaSelected[NOME], "class"=>"size50"));
			$form->Input('Нcone','text',array("required"=>'1',"name"=>'p_Icone', "value"=>$linhaSelected[ICONE], "class"=>"size50"));
			$form->Input('Aзгo','text',array("required"=>'1',"name"=>'p_Acao', "value"=>$linhaSelected[ACAO], "class"=>"size50"));
			$form->Input('Descriзгo','text',array("required"=>'0',"name"=>'p_Descricao', "value"=>$linhaSelected[DESCRICAO], "class"=>"size50"));
						

			
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	
	
	
	if($_GET["p_O_Option"] == "search")
	{

		$aDados = $autoAtend->GetInfo();
		
		if(is_array($aDados))
		{
			$grid = new DataGrid(array("Nome", "Нcone", "Aзгo", "Descriзгo", "Editar", "Del"));
				
				foreach($aDados as $row)
				{
					$grid->Content($row[NOME]);
					$grid->Content($row[ICONE]);
					$grid->Content($row[ACAO]);
					$grid->Content($row[DESCRICAO]);
					$grid->Content($view->Edit($autoAtend,$row[ID]));
					$grid->Content($view->Delete($autoAtend,$row[ID]));
				}
		
		
			unset($grid);
		}
	}
	
	unset($autoAtend);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>