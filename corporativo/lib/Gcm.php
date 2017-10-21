<?php

define("GOOGLE_API_KEY_LOCAL", "AIzaSyBMKltxDa2SN5Z6INF2RwD3kzm2sqdbLU4");

define("GOOGLE_API_KEY_GM", "AIzaSyAjX7Q38Ek8hgsprUwDv9og7wkCZ_HFHMI");
/*
 * 
 */
class Gcm {		
	
	function __construct() {
		 
	}

	/**
	 * Método responsável por enviar a notificação push para o servidor do Google
	 *	@param string $registatoin_ids
	 *	@param string $message
	 */
	public function notificar($registration_ids, $message) {
		
		//Endereço do Google para o POST
		$url = 'https://android.googleapis.com/gcm/send';

		$fields = array(
				'registration_ids' => $registration_ids,
				'data' =>$message,
		);

		$headers = array(
				'Authorization: key=' . GOOGLE_API_KEY_GM,
				'Content-Type: application/json'
		);

		//Abre conexão
		$ch = curl_init();		

		//Envio dos valores do POST
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//Desabilita temporariamente o Certificado SSL
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

		// Executa o POST
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}

		//Fecha conexão
		curl_close($ch);
		return $result;
	}

}

?>