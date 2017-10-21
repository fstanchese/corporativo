<?php 

/**
 * 
 * 	APARA UM ITEM DA TABELA
 * 
 */

	if($_POST[action] == "deleteItem")
	{
		
		require_once("../engine/User.class.php");
		require_once("../engine/Db.class.php");


		$user 		= new User ();
		$dbOracle 	= new Db ($user);

		$dbData = new DbData ($dbOracle);

		if(!$dbData->Set("DELETE FROM ".$_POST["table"]." WHERE id = '".$_POST["idDel"]."'"))
		{
			return $dbData->ShowError();
		}
		else
		{
			$dbData->Commit(); 
			echo "1";

		}
		
		unset($user);
		unset($dbOracle);
		unset($dbData);
		die();
		
		
	}

	
	/**
	 *
	 * 	CARREGA COMBOS EM AJAX
	 *
	 */	
	
	
	if($_POST["p_action"] == "InputReq")
	{

						
		require_once("../engine/User.class.php");
		require_once("../engine/Db.class.php");
		require_once("../engine/Sql.class.php");
		
		
		$user 		= new User ();
		$dbOracle 	= new Db ($user);
		
		DbData::ShowMsgError(0);
		
		$dbData = new DbData ($dbOracle);
		
		$sql = new Sql ();
		
		
		if($_POST["arKey"] != "")
		{
			
			$aux = explode(",",$_POST["arKey"]);
			
		}
		
		
		if($_POST["arVal"] != "")
		{
				
			$aux2 = explode(",",$_POST["arVal"]);
				
		}
		
		
		if(is_array($aux))
		{
			
			foreach($aux as $key => $value)
				$array[$value] = $aux2[$key];
			
		}
		
		
		//echo $sql->QueryFile($_POST["p_Query"],$array);
		$dbData->Get($sql->QueryFile($_POST["p_Query"],$array));

		

			while($row = $dbData->Row ())
			{
				
				$result[] = array(
					'id' => $row['ID'],
					'recognize' => utf8_encode($row['RECOGNIZE'])
				);
			}
		
		
		
		echo json_encode($result);
		
		unset($user);
		unset($dbOracle);
		unset($dbData);
		die();
		
	}

	
	/**
	 *
	 * 	MUDA O TEMA
	 *
	 */
	
	if($_POST["p_action"] == "changeTheme")
	{
		
		session_name ("optimizer");
		session_start ();
		
		
		$_SESSION["theme"] = $_POST["theme"];
		
	}

	
	/**
	 * 
	 * Monta a DataGrid de ISEL
	 * 
	 */
	
	if($_POST["p_action"] == "gridAjax")
	{
		
		require_once("../engine/User.class.php");
		require_once("../engine/Db.class.php");
		require_once("../engine/Sql.class.php");
		require_once("../engine/DataGrid.class.php");
		
		
		$user 		= new User ();
		$dbOracle 	= new Db ($user);
		
		DbData::ShowMsgError(0);
		
		$dbData = new DbData ($dbOracle);
		$view   = new View();
		$sql = new Sql ();
		
		if($_POST["arKey"] != "")
		{
				
			$aux = explode(",",utf8_decode($_POST["arKey"]));
				
		}
		
		if($_POST["arVal"] != "")
		{
		
			$aux2 = explode(",",utf8_decode($_POST["arVal"]));
		
		}
		
		
		if(is_array($aux))
		{
				
			foreach($aux as $key => $value)
				$array[$value] = $aux2[$key];
				
		}
		
		$dbData->Get($sql->QueryFile($_POST["p_Query"],$array));

		
		if($dbData->Count() > 100)
		{
			
			echo '0';
			
			die();
		}

		
	
		
		$grid = new DataGrid(explode("|||",utf8_decode($_POST[arLabel])));
		
		while($row = $dbData->Row())
		{
			if($_POST[idLabel] == "")
				$class = array('class'=>'colSelId','idIsel'=>$row[ID]);
			else
				$class = array('class'=>'colSelId','idIsel'=>$row[$_POST[idLabel]]);
			
			
			foreach(explode("|||",$_POST[arCols]) as $key => $value)
			{
				
				if ($row[strtoupper(trim($value))] == 'on' || $row[strtoupper(trim($value))] == 'off')
					$grid->Content($view->OnOff($row[strtoupper(trim($value))]),$class);
				else
					$grid->Content($row[strtoupper(trim($value))],$class);
				
				$class="";
			
			}

		}
		
		unset($grid);
		unset($sql);
		unset($dbData);
		unset($dbOracle);
		unset($user);
		
		
		die();
		
	}
	
	
	
	/**
	 * 
	 * Monta o Autocompletar
	 * 
	 */
	if($_POST["p_action"] == "autoComplete")
	{
		
		list($modelName,$method) = explode(".",$_POST[execute]);
		
		
		
		require_once("../engine/User.class.php");
		require_once("../engine/Db.class.php");
		
		
		require_once("../model/".$modelName.".class.php");
		
		
		
		$user 		= new User ();
		$db			= new Db ($user,$_POST[db]);

		$dbData 	= new DbData ($db);
		$model 		= new $modelName ($db);
			
		
		DbData::ShowMsgError(0);
		
		$model->$method($_POST[val]);
		
		unset($model);
		unset($dbData);
		unset($dbOracle);
		unset($user);
		
		
		die();
		
		
	}
	


?>