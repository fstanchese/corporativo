<?php 
 

include("../engine/User.class.php");
include("../engine/Db.class.php");


$user 		= new User ();
$dbOracle 	= new Db ($user);

$dbData = new DbData ($dbOracle);

 
if ($_POST["vTipo"] == 'Ativa')
{
	
	$sql = "UPDATE CAMesa set Ativa ='".$_POST[vAtiva]."' where id= $_POST[vId]";
	

	if(!$dbData->Set($sql))
	{
		return $dbData->ShowError();
	}
	else
	{
		$dbData->Commit();
	}
	
	
	
	
}


if($_POST[p_Action] == "getSenhasAtendimento")
{
	
	require_once("../engine/View.class.php");
	
	require_once("../model/CASenhaRegra.class.php");
	
	
	$caSenhaRegra = new CASenhaRegra($dbOracle);
	$arSenhaRegra = $caSenhaRegra->GetSenhaRegraByEvento($_POST[CAEvento_Id]); 
	
	
	$view = new View();
	
	
	$sql = "	SELECT casenha.id, casenha.numero, casenharegra.sigla, camesa.numero as mesa
				FROM casenha, casenharegra, camesa
				WHERE casenha.camesa_id = camesa.id
				AND casenha.casenharegra_id = casenharegra.id
				AND dtsaida is null
				AND	dtchamada is not null AND dttriagem is not null
				AND trunc(casenha.dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
				AND casenharegra.id IN (".implode(", ",$arSenhaRegra[Id]).")
				ORDER BY dtchamada desc	
			";
	
	$dbData->Get($sql);
	
	
	
	
	
	echo $view->Table(array("class"=>"dataGrid")).$view->Caption("Senhas em Atendimento").
			$view->Th("Senha").
			$view->Th("Mesa");
	
	
	
	while($row = $dbData->Row())
	{
		
		echo $view->Tr().
				$view->Td().$row[SIGLA].str_pad($row[NUMERO],3,0, STR_PAD_LEFT).' ('.substr($row[ID],-6).')'.$view->CloseTd().
				$view->Td().$row[MESA].$view->CloseTd().
			$view->CloseTr();
		
	}
	
	echo $view->CloseTable();
	
	unset($caSenhaRegra);
	unset($view);
}


if($_POST[p_Action] == "getSenhasEmEspera")
{

	require_once("../engine/View.class.php");
	
	require_once("../model/CASenhaRegra.class.php");
	
	
	$caSenhaRegra = new CASenhaRegra($dbOracle);
	$arSenhaRegra = $caSenhaRegra->GetSenhaRegraByEvento($_POST[CAEvento_Id]);
	
	
	$view = new View();
	
	$sql = "	SELECT casenha.id, casenha.numero, casenharegra.sigla, casenha.chamada,
			
					LPAD(trunc(( (sysdate - dtespera) * 86400 / 3600)),2,0) ||':' ||
					LPAD(trunc(mod( (sysdate - dtespera) * 86400 , 3600 ) / 60 ),2,0) || ':'||
					LPAD(trunc(mod ( mod ( (sysdate - dtespera) * 86400, 3600 ), 60 )),2,0)	as tempo
			
			
				FROM casenha, casenharegra
				
				WHERE
				casenha.casenharegra_id = casenharegra.id 
				AND emespera = 1
				AND trunc(casenha.dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
				AND casenharegra.id IN (".implode(", ",$arSenhaRegra[Id]).")
				AND dtcancelado is null
				ORDER BY casenha.id
			";
	
	
	
	$dbData->Get($sql);
	
	
	echo $view->Table(array("class"=>"dataGrid")).$view->Caption("Senhas em Espera").
	$view->Th("Senha").$view->Th("Tempo Espera").$view->Th("Vezes Chamada");
	
	
	while($row = $dbData->Row())
	{
	
		echo $view->Tr().
			$view->Td(array("idr"=>$row[ID],"class"=>"pickSenha")).$row[SIGLA].str_pad($row[NUMERO],3,0, STR_PAD_LEFT).' ('.substr($row[ID],-6).')'.$view->CloseTd().$view->Td().$row[TEMPO].$view->CloseTd().$view->Td().$row[CHAMADA].$view->CloseTd().
		$view->CloseTr();
	
	}
	
	echo $view->CloseTable();
	
	unset($caSenhaRegra);
	unset($view);

}


if($_POST[p_Action] == "getSenhasSemInicioAtend")
{

	require_once("../engine/View.class.php");
	
	require_once("../model/CASenhaRegra.class.php");
	
	
	$caSenhaRegra = new CASenhaRegra($dbOracle);
	$arSenhaRegra = $caSenhaRegra->GetSenhaRegraByEvento($_POST[CAEvento_Id]);
	
	$view = new View();
	
	$sql = "	SELECT casenha.id, casenha.numero, casenharegra.sigla, camesa.numero as mesa
				FROM casenha, casenharegra, camesa
				WHERE casenharegra.id = casenha.casenharegra_id
				AND casenha.camesa_id = camesa.id
				AND	dtchamada is not null AND dttriagem is null
				AND emespera = 0
				AND dtcancelado is null
				AND trunc(casenha.dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
				AND casenharegra.id IN (".implode(", ",$arSenhaRegra[Id]).")
				ORDER BY casenha.id
				
			";
	
	$dbData->Get($sql);
	
	
	echo $view->Table(array("class"=>"dataGrid")).$view->Caption("Senhas Chamadas sem Início Atendimento").
	$view->Th("Senha").$view->Th("Mesa");

	
	
	
	while($row = $dbData->Row())
	{
	
		echo $view->Tr().
		$view->Td(array("idr"=>$row[ID],"class"=>"pickSenha")).$row[SIGLA].str_pad($row[NUMERO],3,0, STR_PAD_LEFT).' ('.substr($row[ID],-6).')'.$view->CloseTd().$view->Td().$row[MESA].$view->CloseTd().
		$view->CloseTr();
	
	}
	
	echo $view->CloseTable();
	
	
	unset($caSenhaRegra);
	unset($view);
}



if($_POST[p_Action] == "getSenhasNovas")
{

	require_once("../engine/View.class.php");

	require_once("../model/CASenhaRegra.class.php");


	$caSenhaRegra = new CASenhaRegra($dbOracle);
	$arSenhaRegra = $caSenhaRegra->GetSenhaRegraByEvento($_POST[CAEvento_Id]);

	$view = new View();

	$sql = "	SELECT casenha.id, casenha.numero, casenharegra.sigla
				FROM casenha, casenharegra
				WHERE casenharegra.id = casenha.casenharegra_id
				AND	dtchamada is null AND dttriagem is null
				AND emespera = 0
				AND dtcancelado is null
				AND trunc(casenha.dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
				AND casenharegra.id IN (".implode(", ",$arSenhaRegra[Id]).")
				ORDER BY casenha.id

			";

	$dbData->Get($sql);


	echo $view->Table(array("class"=>"dataGrid")).$view->Caption("Senhas Geradas que não foram Chamadas").
	$view->Th("Senha");




	while($row = $dbData->Row())
	{

		echo $view->Tr().
		$view->Td(array("idr"=>$row[ID],"class"=>"pickSenha")).$row[SIGLA].str_pad($row[NUMERO],3,0, STR_PAD_LEFT).' ('.substr($row[ID],-6).')'.$view->CloseTd().
		$view->CloseTr();

	}

	echo $view->CloseTable();


	unset($caSenhaRegra);
	unset($view);
}
	

if ($_GET[vTipo] == 'GetAtendimentosMesa')
{

	require_once("../engine/View.class.php");
	require_once("../model/CASenhaRegra.class.php");
	require_once("../model/CASenha.class.php");
	require_once("../model/CAMesa.class.php");
	
	
	$caSenhaRegra 	= new CASenhaRegra($dbOracle);
	$caSenha		= new CASenha($dbOracle);
	$caMesa			= new CAMesa($dbOracle);

	$view = new View();
	
	$html = $view->Table(array("class"=>"dataGrid","cellspacing"=>"1"));
	$html .= $view->Caption('Mesa '. str_pad($caMesa->Recognize($_GET[vMesa],"RecNumero"),2,0,STR_PAD_LEFT));
	$html .= $view->Th('Senha',array());
	$html .= $view->Th('Abertura Senha',array());
	$html .= $view->Th('Início Atendimento',array());
	$html .= $view->Th('Término Atendimento',array());
	$html .= $view->Th('Cancelada',array());
	
	$sql = "select casenha.*,to_char(dt,'hh24:mi') as abertura, to_char(dttriagem,'hh24:mi') as inicio, to_char(dtsaida,'hh24:mi') as termino,to_char(dtcancelado,'hh24:mi') as cancelado
		from casenha
		WHERE trunc(dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
		AND caMesa_Id = $_GET[vMesa] 
		order by inicio";

	
	$dbData->Get($sql);
	

	while ($row = $dbData->Row())
	{
		$html .= $view->Tr(array());
		$html .= $view->Td(array("align"=>"center")) . $caSenha->GetSenha($row[ID]) . $view->CloseTd();
		$html .= $view->Td(array("align"=>"center")) . $row[ABERTURA] . $view->CloseTd();
		$html .= $view->Td(array("align"=>"center")) . $row[INICIO] . $view->CloseTd();
		$html .= $view->Td(array("align"=>"center")) . $row[TERMINO] . $view->CloseTd();
		$html .= $view->Td(array("align"=>"center")) . $row[CANCELADO] . $view->CloseTd();
		$html .= $view->CloseTr();
	}
	$html .= $view->CloseTable();
		
		
		
	echo $html ;
	
	
	
}


unset($user);
unset($dbOracle);
unset($dbData);
die();


?>