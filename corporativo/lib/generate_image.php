<?php

include("../engine/User.class.php");
include("../engine/Db.class.php");


$user = new User ();
$dbOracle = new Db ($user);
$dbData = new DbData ($dbOracle);


$id = $_GET["id"];  

$dbData->Get("SELECT tipo, imagem FROM wpessoafoto WHERE  wpessoa_id  = ".$id);

$row = $dbData->Row();                        
$bytes  = $row['IMAGEM']->load();     
  	 
header( "Content-Type: image/jpeg" );
header( "Content-disposition:; filename=foto.jpg" );

echo $bytes;




unset($dbData);
unset($dbOracle);
unset($user);

?>