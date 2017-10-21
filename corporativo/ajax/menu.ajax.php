<?php 

require_once("../model/SisMenu.class.php");
require_once ("../engine/User.class.php");
require_once ("../engine/Db.class.php");


$user 		= new User ();
$dbOracle 	= new Db ($user);

$sisMenuInt = new SisMenu($dbOracle);

$dbData = new DbData ($dbOracle);

if ($_GET[vTipo] == "removeMenu")
{
	
	$sql = "update SisMenu set SisMenu_Pai_Id=null where id=$_GET[vId]";
	if(!$dbData->Set($sql))
	{
		return $dbData->ShowError();
	}
	else
	{
		$dbData->Commit();
	}

	$sql = "update SisMenu set SisMenu_Pai_Id=null where SisMenu_Pai_id=$_GET[vId]";
	if(!$dbData->Set($sql))
	{
		return $dbData->ShowError();
	}
	else
	{
		$dbData->Commit();
	}
	
	
	die();

}

if ($_GET[vTipo] == "ListMenu")
{

	$vUsuario = $user->GetId();
	$dbData->Get("select SisMenu.Id,SisMenu.Nome,IndexGui.GUIName,IndexGui.ProcName from SisMenu,IndexGui where SisMenu.IndexGui_Id = IndexGui.Id (+) and SisMenu_Pai_Id = '$_GET[vId]' and SisMenu.WPessoa_Id = '$vUsuario' order by SisMenu.Nome, IndexGui.ProcName");
	while($rowInt = $dbData->Row ())
	{
		$vClass = '';
		if ( $rowInt[NOME] != '' )
		{
			$vImg 	= 'pasta.png';
			$vGUI	= $vProc = $rowInt[NOME];
			$vClass = 'subdir';
		}
		else
		{
			$vImg 	= 'monitor.gif';
			$vGUI = $rowInt[GUINAME];
			$vProc  = $rowInt[PROCNAME];
		}
		echo "<div class='itemMenu' id='".$rowInt[ID]."'>
					<img width='13px' src='../images/".$vImg."' class='".$vClass."' proc='".$vProc."' id='dir_".$rowInt[ID]."' gui='".$vGUI."' idr='".$rowInt[ID]."'>
					<img class='removeMenu' id='".$rowInt[ID]."' style='cursor:pointer' src='/images/errado.png' title='Excluir Item' proc='".$vProc."'  gui='".$vGUI."' img='".$vImg."'>
					".$vGUI."</div>";
	}
	
	
	die();

}


if ($_GET[vTipo] == 'DropMenu')
{

	$sql = "update SisMenu set SisMenu_Pai_Id=$_GET[vId] where id=$_GET[vIdOrigem]";
	if(!$dbData->Set($sql))
	{
		return $dbData->ShowError();
	}
	else
	{
		$dbData->Commit();
	}

	die();

}

if ($_GET[vTipo] == 'cancRepos')
{

	$sql = "delete SisMenu where id='$_GET[vId]'";
	if(!$dbData->Set($sql))
	{
		return $dbData->ShowError();
	}
	else
	{
		$dbData->Commit();
	}
	
	print '<font style="font-size:12px;">Item excluído com sucesso...';
	die();
}

if ($_GET[vTipo] == "removeMenuRaiz")
{

	$sql = "update SisMenu set SisMenu_Pai_Id=null where SisMenu_Pai_id=$_GET[vId]";
	if(!$dbData->Set($sql))
	{
		return $dbData->ShowError();
	}
	else
	{
		$dbData->Commit();
	}

	$sql = "delete SisMenu where id=$_GET[vId]";
	if(!$dbData->Set($sql))
	{
		return $dbData->ShowError();
	}
	else
	{
		$dbData->Commit();
	}
	
	

	die();

}


unset($user);
unset($dbOracle);
unset($dbData);


?>