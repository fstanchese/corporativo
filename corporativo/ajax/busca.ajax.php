<?php 
 

include("../engine/User.class.php");
include("../engine/Db.class.php");


$user 		= new User ();
$dbOracle 	= new Db ($user);

$dbData = new DbData ($dbOracle);

 
$sql = "INSERT INTO sismenu (wpessoa_id, indexgui_id, raiz) VALUES ('".$_SESSION["p_WPessoa_Id"]."', '".$_POST["indexgui"]."','off')";

if(!$dbData->Set($sql))
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


?>