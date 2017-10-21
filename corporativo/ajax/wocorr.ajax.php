<?php 

require_once ("../engine/User.class.php");
require_once ("../engine/Db.class.php");
require_once ("../engine/ViewPage.class.php");
require_once ("../model/WOcorr.class.php");
require_once ("../model/WOcorrAssInf.class.php");

$user 		= new User ();
$dbOracle 	= new Db ($user);

$dbData 	= new DbData ($dbOracle);

$wocorr 		= new WOcorr($dbOracle);
$wocorrassinf	= new WOcorrAssInf($dbOracle);


if ($_GET[vTipo] == 'IncAtributo')
{
	include_once('../engine/Form.class.php');

	$aDados = $wocorrassinf->GetIdInfo($_GET[id]);
	
	$aFormat = explode(' ',$aDados[FORMATACAO]);
	
	if ($aDados['ENTRADA'] == 'text' || $aDados['ENTRADA'] == 'date')
	{
	
		$frm 	= new Form();
		$frm->Input($aDados[INFORMACAO],$aDados[ENTRADA],array());		
		unset($frm);
		
	}
	
	
	/*
	echo '<li class="formLabel">'.$aDados[INFORMACAO].'</li>';
	
	if ($aDados['ENTRADA'] == 'text' || $aDados['ENTRADA'] == 'date')
	{
		$aInput = array();
		foreach ($aFormat as $row)
		{
			$aAux = explode('_',$row);
			$valor = str_replace('*',' ',$aAux[1]);
			$sString .= "$aAux[0]=\"$valor\" ";

 		}
	
		echo '<li class="formField"><input name='.$aDados[ATRIBUTO].' id='.$aDados[ATRIBUTO].' type=text '.$sString.'></li>';
	}

	if ($aDados['INPUT'] == 'date')
	{
		echo '<li class="formField"><input name='.$aDados[ATRIBUTO].' type=text '.$sString.'></li>';
	}
*/
	
}




?>