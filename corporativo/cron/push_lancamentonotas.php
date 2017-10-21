<?php

	set_time_limit(3600);

	/*
	 * Executar esta página no crontab para envio das notificações PUSH de lançamento de Notas.
	 *  
	 */


	include("../engine/User.class.php");
	include("../engine/Db.class.php");
	
	include("../lib/Gcm.php");
	
	$user 			= new User('usjt',"oracle92");
	
	$dbOracle		= new Db($user);
	$dbData 		= new DbData($dbOracle);
	$dbDataDelete	= new DbData($dbOracle);
	
	$gcm = new GCM();

	$initTime = date("d-m-Y H:i:s");

	$dbData->Get("SELECT gcmkey, msg FROM pushfila ORDER BY dt");
	while($row = $dbData->Row())
	{
		$result = $gcm->notificar(array($row[GCMKEY]), array("price" => $row[MSG]));
		$dbDataDelete->Set("DELETE FROM pushfila WHERE gcmkey='$row[GCMKEY]'");
		
		//$debug .= $result . "\n$\"$row[GCMKEY]\", \"$row[MSG]\"\n";
		$debug .= "\n\"gcmkey\":\"$row[GCMKEY]\", \"msg\":\"$row[MSG]\"\n".$result;
		$cont++;
	}
	
	$endTime = date("d-m-Y H:i:s");
	
	if ($debug != "")
	{
		$debug = "Início: $initTime\nFim: $endTime\nTotal enviados: $cont\n\n" . $debug;
		
		//mail("fernando@usjt.br", "PUSH - Debug", $debug);
		mail("android@saojudas.br", "PUSH - Debug", $debug);
	}
	
	unset($dbData);
	unset($dbOracle);
	unset($user);
		
?>