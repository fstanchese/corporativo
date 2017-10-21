<?php 

require_once("../model/GradAlu.class.php");
require_once ("../engine/User.class.php");
require_once ("../engine/Db.class.php");


$user 		= new User ();
$dbOracle 	= new Db ($user);

$gradalu = new GradAlu($dbOracle);

if ($_GET[vTipo] == "mostraDisc")
{
	echo $gradalu->GetGradAluInfo(_Decrypt($_GET[Matric_Id]),null,$_GET[vVisib]) ;
	die();
}

if ($_GET[vTipo] == "mostraFaltas")
{
	echo $gradalu->GetFaltasFormat(_Decrypt($_GET[Matric_Id]));
}

if ($_GET[vTipo] == "detalheFaltas")
{
	echo _Decrypt($_GET[vId]);
}



?>