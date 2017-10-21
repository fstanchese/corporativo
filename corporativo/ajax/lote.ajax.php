<?php 

require_once ("../engine/User.class.php");
require_once ("../engine/Db.class.php");


$user 		= new User ();
$dbOracle 	= new Db ($user);



if ($_GET[vTipo] == 'ConsultaSenha')
{
	
	require_once '../model/CAEvXWPes.class.php';
	require_once '../model/CASenha.class.php';
	require_once '../engine/View.class.php';
	
	$caSenha 	= new CASenha($dbOracle);
	$caEv 		= new CAEvXWPes($dbOracle);
	
	if($_GET[vSenha] != "")
	{
		$senhaDet 	= $caSenha->GetIdInfo(($_GET[vSenha]+201200000000000));
		
		if($senhaDet[ID] == '') die('0');

		$caEvId = $caEv->GetIdByEventoWPessoaLote($senhaDet[WPESSOA_ID]);
	
		$_SESSION[LOTESENHA][] =  $caEvId."_".($_GET[vSenha]+201200000000000)."_".$_GET[vSecretaria];
		$_SESSION[LOTESENHA] = array_unique($_SESSION[LOTESENHA]);
		
	}
	
	$view = new View();
	
	
	if(is_array($_SESSION[LOTESENHA]))
	{
		foreach($_SESSION[LOTESENHA] as $senha)
		{

			$aMat = explode("_",$senha);
			$senhaDet 	= $caSenha->GetIdInfo($aMat[1]);
			echo $view->Div().$view->Img(array("class"=>"delSenha","style"=>"cursor:pointer","src"=>"../images/del.png","idr"=>$senha))."  ".
					end(explode("-",$senhaDet[CASENHAREGRA_NOME])).
					str_pad($senhaDet[NUMERO],3,0,STR_PAD_LEFT)." - ".
					$senhaDet[WPESSOA_NOME] ;
					if ($aMat[2] == 'on')
						echo ' (Secretaria) '.
					$view->CloseDiv();
		}
		
		echo $view->Br();
		
		echo $view->P("Total de Senhas: ".count($_SESSION[LOTESENHA]));
	}
	
	unset($user);
	unset($dbOracle);
	unset($caSenha);
	unset($caEv);
	
	die();
}




if ($_GET[vTipo] == 'ExcluiSenha')
{

	$chave = array_search($_REQUEST[vSenha],$_SESSION[LOTESENHA]);
	
	unset($_SESSION[LOTESENHA][$chave]);
	
	die();
	
}





?>