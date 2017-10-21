<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Tipo de Boleto por Tipo de Carta de Cobrança","Cadastro de Tipo de Boleto por Tipo de Carta de Cobrança",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CCobTiXBolTi.class.php");
	include("../model/CCobCartaTi.class.php");
	include("../model/BoletoTi.class.php");

	

	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	$ccobCartaTi 	= new CCobCartaTi($dbOracle);
	$boletoTi		= new BoletoTi($dbOracle);
	$ccobTiXBolTi	= new CCobTiXBolTi($dbOracle);
		

	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $ccobTiXBolTi->GetIdInfo($_POST["p_CCobTiXBolTi_Id"]);
		
	}
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$ccobTiXBolTi->IUD($_POST);

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('', 'hidden', array("name"=>'p_CCobTiXBolTi_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Tipo de Carta de Cobrança','select' , array("name"=>'p_CCobCartaTi_Id', "required"=>"1", "option"=>$ccobCartaTi->Calculate("Geral")));
			
			$form->Input('Tipo de Boleto','select' , array("name"=>'p_BoletoTi_Id', "required"=>"1", "option"=>$boletoTi->Calculate("CCob")));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
			$form->IUDButtons();
		$form->CloseFieldset ();
		
	unset ($form);
	
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$accobTiXBolTi = $ccobTiXBolTi->GetInfo();
	
		if(is_array($accobTiXBolTi))
		{
			$grid = new DataGrid(array("Carta de Cobrança","Tipo de Boleto","Editar","Del"));
			
			foreach($accobTiXBolTi as $row)
			{				
				$grid->Content($row["CCOBCARTATI_NOME"],array('align'=>'left'));
				$grid->Content($row["BOLETOTI_NOME"],array('align'=>'left'));
				$grid->Content($view->Edit($accobTiXBolTi,$row[ID]));
				$grid->Content($view->Delete($accobTiXBolTi,$row[ID]));				  
								  				
			}
		}
		
		unset($grid);
		
	}
	
	unset($view);	
	unset($ccobCartaTi);
	unset($boletoTi);
	unset($ccobTiXBolTi);	
	unset($nav);		
	unset($dbData);	
	unset($dbOracle);	
	unset($app);	
	unset($user);

?>