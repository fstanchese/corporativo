<?php

	require_once '../engine/User.class.php';
	require_once '../engine/Db.class.php';
	
	$user = new User();
	
	$db = new Db($user);
	
	$dbData = new DbData($db);

	
	$fd = fopen ("bt2.csv", "r");


while (!feof ($fd)) {
	$buffer = fgets($fd);
	$aluno 	= explode(";",$buffer);
	
	$linha = $dbData->Row($dbData->Get("SELECT id FROM caevxwpes WHERE wpessoa_id IN ( SELECT id FROM wpessoa where upper(nome) = '".trim($aluno[0])."')"));
	if($linha[ID] != "")
	{
		echo "INSERT INTO cawpesdet (nome, valor, caevxwpes_id) values ('Endereço','".str_replace("'","´",trim($aluno[1]." - ".$aluno[2]." - ".$aluno[3]))."', '".$linha[ID]."') ;<br>";
		echo "INSERT INTO cawpesdet (nome, valor, caevxwpes_id) values ('Telefone','".str_replace("'","´",trim($aluno[5]))."', '".$linha[ID]."') ;<br>";
		echo "INSERT INTO cawpesdet (nome, valor, caevxwpes_id) values ('E-mail','".str_replace("'","´",trim($aluno[4]))."', '".$linha[ID]."') ;<br>";
	}
	
						
}
//$dbData->Commit();

fclose ($fd);
?>