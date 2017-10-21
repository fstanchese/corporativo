<?php
include("../engine/User.class.php");
include("../engine/Db.class.php");

$user = new User('aluno',"jdfoj8303m3o9");

$dbOracle = new Db ($user);
$dbData = new DbData ($dbOracle);

/**
 * Registrar aparelho na base de dados
*/
if ($_POST["action"] == "Registrar" && isset($_POST["pwId"]) && isset($_POST["regId"])) {

	$pwId = _Decrypt($_POST["pwId"]);
	$gcm_regid = $_POST["regId"];

	if(is_numeric($pwId)){

		$p_sql_gcm = "SELECT id FROM Push WHERE WPessoa_Id = $pwId and GcmKey = '".$gcm_regid."'";
		$array_result = $dbData->Row($dbData->Get($p_sql_gcm));

		//atualiza a coluna DtAcesso se estiver cadastrado
		if(is_array($array_result)){

			$p_sql_update = "UPDATE Push SET DtAcesso = SYSDATE WHERE GcmKey = '".$gcm_regid."' ";

			if ($dbData->Set($p_sql_update))
			{
				$dbData->Commit();
			}

		//realiza a inserчуo
		}else{

			$p_sql_insert = "INSERT INTO Push (WPessoa_Id, GcmKey, DtAcesso) VALUES ($pwId, '".$gcm_regid."', SYSDATE)";

			if ($dbData->Set($p_sql_insert))
			{
				$dbData->Commit();
			}
		}

	}
}

/**
 * Cancelar registro do aparelho na base de dados
 */
if ($_POST["action"] == "Cancelar" && isset($_POST["regId"])) {

	$gcm_regid = $_POST["regId"];

	$p_sql_gcm = "SELECT id FROM Push WHERE GcmKey = '".$gcm_regid."'";
	$array_result = $dbData->Row($dbData->Get($p_sql_gcm));

	if(is_array($array_result)){

		$p_sql = "DELETE FROM Push WHERE GcmKey = '".$gcm_regid."' ";

		if ($dbData->Set($p_sql))
		{
			$dbData->Commit();
		}

	}
}

/**
 * @deprecated Sendo utilizado na versуo 1.4 do usjt_app_aluno.
 * Atualizar data de acesso do aparelho na base de dados
 */
if ($_POST["action"] == "Atualizar" && isset($_POST["regId"])) {

	$gcm_regid = $_POST["regId"];

	$p_sql_gcm = "SELECT id FROM Push WHERE GcmKey = '".$gcm_regid."'";
	$array_result = $dbData->Row($dbData->Get($p_sql_gcm));

	if(is_array($array_result)){

		$p_sql = "UPDATE Push SET DtAcesso = SYSDATE WHERE GcmKey = '".$gcm_regid."' ";

		if ($dbData->Set($p_sql))
		{
			$dbData->Commit();
		}

	}
}

unset($user);
unset($dbData);
unset($dbOracle);
die();

?>