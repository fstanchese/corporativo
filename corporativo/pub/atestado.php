<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ('aluno','jdfoj8303m3o9');
	//$user = new User ();
	//$app = new App("Atestado","Atestado",array('ADM','CPD'),$user);
		
	include("../engine/Db.class.php");
	include("../engine/ViewPortal.class.php");

	include("../model/AutDoc.class.php");
	
	$dbOracle = new Db ($user);
	
	$dbData = new DbData ($dbOracle);
	
	$view = new ViewPortal($app->title,$app->description);
	$view->IncludeCSS('atestados.css');

	$code = "$('.logoOficial').append('<img src=\"../images/logo_usjt_oficial.png\">');";
	$code .= "$('.rodape').append('<img src=\"../images/rodape_oficial.png\" width=\"300px\">');";
	echo $view->JS($code);
	
	$autDoc 	= new AutDoc($dbOracle);

	
	$sDocumento = $autDoc->GetDocumento(str_replace("-", "", strtoupper($_GET['p_Hash'])));
	

	if ($sDocumento != '')
	{
		echo $sDocumento ; 

		echo $view->BtImprimir();

	}	
	else
	{
		echo $view->Div(array("class"=>"quadro"));
		echo "<h3>Atenção, código de autenticidade não localizado.</>";
		echo $view->CloseDiv();
	}
	
	
	unset ($dbOracle);
	unset ($dbData);
	unset ($view);
	unset ($autDoc);
	
	
?>
