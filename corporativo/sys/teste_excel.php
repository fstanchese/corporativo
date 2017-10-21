<?php
	include("../engine/User.class.php");

	$user = new User ();
	
	include("../engine/Db.class.php");
	include("../engine/Excel.class.php");



	$dbOracle = new Db ($user);

	$dbData = new DbData ($dbOracle);
	
		$dbData->Get("SELECT * FROM ss WHERE rownum < 100");
	
		
			
			$grid = new Excel("Teste");
			
			$grid->Header(array("ID","Descrição","US","DT"));
			
			while($row = $dbData->Row ())
			{
				
				
				
				$grid->Content($row[ID],array('align'=>'left'));
				$grid->Content($row[DESCRICAO],array('align'=>'left'));
				
				$grid->Content($row[US],array('align'=>'left'));
				$grid->Content($row[DT],array('align'=>'left'));
				

			}

	
	unset($tempCheck);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>