<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Procedimentos dos Lotes","Cadastro de Procedimentos dos Lotes",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/LoteProc.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	$loteProc	= new LoteProc($dbOracle);	
	


	if($_POST[p_O_Option] == "select")
	{		
		//$dbData->Get($loteProc->Query("qId",array("p_BoletoTi_Id"=>$_POST[p_BoletoTi_Id])));
		$linhaSelected = $loteProc->GetIdInfo($_POST[p_LoteProc_Id]);
		
	}
	
	if($_GET["p_LoteProc_Id"] != "") $linhaSelected[LOTEPROC_ID] = $_GET["p_LoteProc_Id"]; 
	
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$loteProc->IUD($_POST);
	

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_LoteProc_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Procedimento','text',array("name"=>'p_Nome', "class"=>"size50", "required"=>'1',"value"=>$linhaSelected[NOME]));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	

	if($_GET["p_O_Option"] == "search")
	{
	
		$aLoteProc = $loteProc->GetInfo();
	
		if(is_array($aLoteProc))
		{
			$grid = new DataGrid(array("Nome","Editar","Del"));
			
			foreach ($aLoteProc as $row)
			{
				
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($view->Edit($loteProc,$row[ID]));
				$grid->Content($view->Delete($loteProc,$row[ID]));
								  				
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