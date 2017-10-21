<?php 

require_once ("../engine/User.class.php");
require_once ("../engine/Db.class.php");
require_once ("../engine/ViewPage.class.php");
require_once ("../model/Agenda.class.php");

$user 		= new User ();
$dbOracle 	= new Db ($user);

$dbData 	= new DbData ($dbOracle);
$agenda 	= new Agenda($dbOracle);
$view 		= new ViewPage('Agenda','Agenda');

echo '<br>';
echo "<strong>Eventos do dia " . $_GET["dt"] . "</strong>"; 

$depart = $user->GetCurrDept();

$dbData->Get("select Id from Agenda where '$_GET[dt]' between dtinicio and dttermino and depart_id = '$depart' order by dtinicio,dttermino");

while ($row = $dbData->Row())
{
	echo $view->Div(array("style"=>"width:1000px;")) . $agenda->GetAgendaInfo($row[ID]) . $view->CloseDiv();
}


?>