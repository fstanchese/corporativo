<?php
	//header ("Content-Type: text/html; charset=UTF-8");

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	include("../engine/Dbf.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	
	$user	= new User();
	$app	= new App("Demonstraчуo de Conexуo com arquivos DBF", "Demonstraчуo de Conexуo com arquivos DBF", array("ADM", "CPD"), $user);
	$view	= new ViewPage($app->title, $app->description);
	
	$view->Explain ("Ajuda");	
	$view->Header($user, $nav);
	
	$form = new Form();
	$form->Fieldset();
	
	$form->Input("Nome do arquivo DBF", "text", array("name"=>"p_DBFName"));
	$form->Button("submit", array("value"=>"Enviar"));
	
	$form->CloseFieldset();
	unset($form);
	
	

	if ($_POST[p_DBFName] != "")
	{
		$dbf = new Dbf($_POST[p_DBFName]);
		
		
		$info = $dbf->GetHeaderInfo();

		$grid = new DataGrid($dbf->GetHeaderNames());
		
		while ($row = $dbf->Row())
		{
			foreach($row as $key => $val)
			{
				if ($key !== "deleted")
					$grid->Content(iconv("IBM850", "ISO-8859-1//TRANSLIT", $val));
				
			}
			if (++$count > 10000)
				break;
				
		}
	}
	
	
	
	
	
	unset($view);
	unset($app);
	unset($user);

?>