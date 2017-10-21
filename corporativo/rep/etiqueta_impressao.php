<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Impressão de Etiqueta","Impressão de Etiqueta",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/EtqPimaco.class.php");
	
	
	
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$view 		= new View();
	
	
	$etq = new EtqPimaco($_POST[p_Modelo],$_POST[p_Orientacao]);
		
	
	
	for($x=0;$x<$_POST[p_QtdeEtq];$x++)
	{
		
		$etq->setConteudo(stripslashes($_POST[p_Texto]));
		
	}
	
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>