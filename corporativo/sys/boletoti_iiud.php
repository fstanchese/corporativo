<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Tipo de Boletos","Cadastro de Tipo de Boletos",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/BoletoTi.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$boletoti = new BoletoTi($dbOracle);	
	


	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($boletoti->Query("qId",array("p_BoletoTi_Id"=>$_POST[p_BoletoTi_Id])));
		$linhaSelected = $dbData->Row();
		
		print_r($linhaSelected);
	}
	
	if($_GET["p_BoletoTi_Id"] != "") $linhaSelected[BOLETOTI_ID] = $_GET["p_BoletoTi_Id"]; 
	
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	if(($_POST["p_O_Option"] == "insert" || $_POST["p_O_Option"] == "update" ) && $_POST["p_Imprimir"] == "")	$_POST["p_Imprimir"] = "off";
	if(($_POST["p_O_Option"] == "insert" || $_POST["p_O_Option"] == "update" ) && $_POST["p_Parcelar"] == "")	$_POST["p_Parcelar"] = "off";
	if(($_POST["p_O_Option"] == "insert" || $_POST["p_O_Option"] == "update" ) && $_POST["p_Exibir"] == "")		$_POST["p_Exibir"] = "off";
	
 	
	$boletoti->IUD($_POST);
	

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_BoletoTi_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Tipo de Boleto','text',array("name"=>'p_Nome', "class"=>"size20", "required"=>'1',"value"=>$linhaSelected[NOME]));
			
			$form->Input('Pode ser Impresso?',	'onoff' , array("name"=>'p_Imprimir', "value"=>$linhaSelected[IMPRIMIR]));
				
			$form->Input('Pode ser Parcelado?',	'onoff' , array("name"=>'p_Parcelar', "value"=>$linhaSelected[PARCELAR]));
			
			$form->Input('Exibir em Seleções?',	'onoff' , array("name"=>'p_Exibir', "value"=>$linhaSelected[EXIBIR]));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$aboletoTi = $boletoti->GetInfo();
	
		if($dbData->Count () > 0)
		{
			$grid = new DataGrid(array("Nome","Pode ser Impresso","Pode ser Parcelado","Exibir","Editar","Del"));
			
			foreach ($aboletoTi as $row)
			{
				
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($view->OnOff($row[IMPRIMIR]),array('align'=>'center'));
				$grid->Content($view->OnOff($row[PARCELAR]),array('align'=>'center'));
				$grid->Content($view->OnOff($row[EXIBIR]),array('align'=>'center'));
				$grid->Content($view->Edit($boletoti,$row[ID]));
				$grid->Content($view->Delete($boletoti,$row[ID]));
								  				echo '  ->' . $row[IMPRIMIR];
			}
		}
		
		unset($grid);
		
	}
	
	unset($view);	
	unset($boletoti);
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);

?>