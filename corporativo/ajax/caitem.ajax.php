<?php

include("../engine/User.class.php");
include("../engine/Db.class.php");


$user 		= new User ();
$dbOracle 	= new Db ($user);

$dbData = new DbData ($dbOracle);

 
if ($_GET["p_Action"] == 'CancelaItens')
{
	
	$sql = "UPDATE caitem SET cancelado = 'on' WHERE ca_id = '".$_GET[p_CA_Id]."'";
	

	$dbData->Set($sql);
	
	die();
	
	
}


if ($_GET["p_Action"] == 'DelCC')
{

	$sql = "DELETE FROM caitemcc WHERE id = '"._Decrypt($_GET[p_CAItemCC_Id])."'";


	$dbData->Set($sql);

	die();


}




?>