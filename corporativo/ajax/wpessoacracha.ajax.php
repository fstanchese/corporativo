<?php 
 

include("../engine/User.class.php");
include("../engine/Db.class.php");


$user 		= new User ();
$dbOracle 	= new Db ($user);

$dbData = new DbData ($dbOracle);





if($_GET[p_Action] == "getEmpresas")
{
	
	
	require_once("../engine/View.class.php");
	require_once("../model/WPesXEmp.class.php");
	
	
	$view 			= new View();
	$wpesxemp 		= new WPesXEmp($dbOracle);
	
	
	$arEmpresas = $wpesxemp->GetEmpresa($_GET[prestador_id]);
	
	echo "<option value='' > Selecione</option>";
	
	foreach($arEmpresas[ID] as $key => $id)
	{
		
		echo "<option value='".$id."' >".$arEmpresas[FANTASIA][$key]." </option>";
		
	}
	
	die();
	
	
}

unset($user);
unset($dbOracle);
unset($dbData);
die();


?>