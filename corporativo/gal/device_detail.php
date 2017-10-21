<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuário
	$user 			= new User ();
	
	//Instanciar a Aplicação
	$app = new App("GAL - Detalhes do Device","GAL - Detalhes do Device",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	
	
	$dbMySQL = new Db($user,'mysql','mysql.usjt.br|gal|gal@usjt|gal');
	$dbDataM = new DbData ($dbMySQL);
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$device = $dbDataM->Row($dbDataM->Get("SELECT * FROM devices WHERE uniqueID = '".$_GET[device]."'"));
	
	$dbDataM->Get("SELECT * FROM softwares WHERE deviceID = ".$_GET[device]." ORDER BY name");
	
	//Se a consulta possuir resultados
	if($dbDataM->Count () > 0)
	{
		//Instancia o DataGrid passando as colunas
		$grid = new DataGrid(array("Software","Versão"));
	
		echo $vp->H4("Máquina: ".utf8_decode($device[cname])." - ".utf8_decode($device[cpu]));
	
		//Obt?m as linhas da execu??o do arquivo .sql
		while($row = $dbDataM->Row ($_GET[page]))
		{
	
	
			$grid->Content(utf8_decode($row[name]));
			$grid->Content($row[version]);
	
		}
	}
	
	//fecha grid
	unset($grid);
	
	

	unset($cheque);
	unset($user);
	unset($app);
			
?>
						