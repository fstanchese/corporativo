<?php 

session_name ("optimizer");
session_start ();

session_destroy();

$_SESSION[p_WPessoa_Id] = "";
$_SESSION[nome] = "";
$_SESSION[user] = "";
$_SESSION[pass] = "";
$_SESSION[dept] = "";
$_SESSION[groups] = "";
$_SESSION[Depart_Id] = "";
$_SESSION[unidade_atual] = "";
$_SESSION[unidades] = "";
$_SESSION[ipaddr] = "";


header("Location:../sys/login.php");

?>