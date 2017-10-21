<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Aчѕes de Restriчуo de Cobranчa","Cadastro de Aчѕes de Restriчуo de Cobranчa",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");


	include("../model/CobrEstAcao.class.php");


	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	$cobrEstAcao	= new CobrEstAcao($dbOracle);	
	

	if($_POST[p_O_Option] == "select")
	{		

		$linhaSelected = $$cobrEstAcao->GetIdInfo($_POST['p_CobrEstAcao_Id']);
		print_r($linhaSelected);		
	}
	
	if($_GET["p_CobrEstAcao_Id"] != "") $linhaSelected[COBRESTACAO_ID] = $_GET["p_CobrEstAcao_Id"]; 
	
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$cobrEstAcao->IUD($_POST);
	

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_CobrEstAcao_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input($cobrEstAcao->GetLabel("Nome"),'text',array("name"=>'p_Nome', "class"=>"size20", "required"=>'1',"value"=>$linhaSelected[NOME]));
			

		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$aCobrEstAcao = $cobrEstAcao->GetInfo();
	
		if(is_array($aCobrEstAcao))
		{
			$grid = new DataGrid(array("Nome","Editar","Del"));
			
			foreach ($aCobrEstAcao as $row)
			{
				
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($view->Edit($cobrEstAcao,$row[ID]));
				$grid->Content($view->Delete($cobrEstAcao,$row[ID]));

			}
		}
		
		unset($grid);
		
	}
	
	//unset($view);	
	unset($cobrEstAcao);
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	//unset($app);
	unset($user);

?>