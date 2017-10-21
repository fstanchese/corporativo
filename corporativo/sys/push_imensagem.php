<?php
include_once '../lib/Gcm.php';

/*
 * GET para envio de notificação
 */
if (isset($_GET["regId"]) && isset($_GET["message"])) {
	
	$regId = $_GET["regId"];
	$message = $_GET["message"];	

	$gcm = new GCM();
	
	$registration_ids = array($regId);
	$message = array("price" => $message);

	$result = $gcm->notificar($registration_ids, $message);

	echo "Resposta: " . $result;
}
?>