<?php

	require_once '../engine/User.class.php';
	require_once '../engine/Db.class.php';
	
	$user = new User();
	
	$db = new Db($user);
	
	$dbData = new DbData($db);

	
	$fd = fopen ("mooca.csv", "r");
	
	$dbData->Commit();
	die();
while (!feof ($fd)) {
	
	
	
	$buffer = fgets($fd);
	$aluno 	= explode(";",$buffer);
	
	
	if(trim($aluno[3]) != "")
	{
	
		//verificar se está no wpessoa
		$wpessoa = $dbData->Row($dbData->Get("SELECT id FROM wpessoa WHERE cpf= '".trim($aluno[5])."'"));

		$wpId = $wpessoa[ID]; 

					
		$dbData->Set("INSERT INTO caevxwpes (wpessoa_id, caevento_id) VALUES (".$wpId.",199700000000016)");
				
		$CAEvXWPes_Id		 	= $dbData->GetInsertedId("caevxwpes_id");
		
		
		if(trim($aluno[2]) == "BOLSA INTEGRAL")
			$descBolsa = "Obrigatória";
			
		else
			$descBolsa = "Normal";
			
		
		$tipoBolsa = $dbData->Row($dbData->Get("SELECT casenhati.id as id FROM casenhati WHERE caassunto_id in ( SELECT id FROM caassunto WHERE caevento_id = '199700000000016') AND casenhati.descricao = '".$descBolsa."'"));
		
		
		
		
		
		
		
		$ar["Curso"]	 		= trim($aluno[0]);
		$ar["Campus"]	 		= trim('B');
		$ar["Tipo de Bolsa"]	= trim($aluno[2]);
		$ar["Período"]	 		= trim($aluno[1]);
		$ar["Média do ENEM"]	= trim($aluno[7]);
		$ar["Matrícula"]	 	= trim($aluno[4]);
		$ar["CASENHATI_ID"] 	= $tipoBolsa[ID];
		
		
		
		
		foreach($ar as $key => $valor)
		{
		
			$dbData->Set("INSERT INTO cawpesdet (caevxwpes_id, nome, valor) VALUES (".$CAEvXWPes_Id.", '".$key."', '"._NVL($valor)."')");
		
		}	
		
	}
						
}
//$dbData->Commit();

fclose ($fd);
?>