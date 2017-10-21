<?php
	include("../engine/User.class.php");

	$user = new User ();
	
	include("../engine/Db.class.php");

	$dbOracle 	= new Db ($user);
	
	$dbData 	= new DbData ($dbOracle);
	
	$p_sql= "update diplproc set dtconvocacao=sysdate where id=".$_POST[p_DiplProc_Id];
	
	$dbData->Set($p_sql);
	$dbData->Commit();
	
	$p_sql = "select wpessoa_id as wpessoa_id from diplproc where id=".$_POST[p_DiplProc_Id];
	$dbData->Get($p_sql);
	
	$row = $dbData->Row();
	$p_WPessoa_Id = $row[WPESSOA_ID];
	
	$p_sql = "select email1 as email from wpessoa where id=".$p_WPessoa_Id;
	$dbData->Get($p_sql);

	$row = $dbData->Row();
	
	$p_texto = 'Vocк estб convocado(a), consulte a convocaзгo no Portal da Universidade - нcone "Convocaзгo аs Cerimфnias", por meio de login e senha.'; 
	
	$p_WPessoa_Email = $row[EMAIL];

	mail( "$p_WPessoa_Email", "Convocaзгo Cerimфnia", "$p_texto", "From: saojudas@saojudas.br\r\n" );	
	
	unset($dbData);
	unset($dbOracle);
?>