<?php

/**
	Retira todos os caracteres "inválidos" para guardar arquivos
**/

function _fTrataNome($nome){
	
		$nome = strtr($nome,'&ÀÁÃÂÉÊÍÓÕÔÚÜÇàáãâéêíóõôúüçºª()','eAAAAEEIOOOUUCaaaaeeiooouucoa--');
		$nome = str_replace(" ","-",$nome);
		$nome = str_replace("%","-",$nome);
		$nome = str_replace("!","-",$nome);
		$nome = str_replace("?","-",$nome);
		$nome = str_replace("@","-",$nome);
		$nome = str_replace("´","",$nome);
		$nome = str_replace("`","",$nome);
		$nome = str_replace("'","",$nome);
		$nome = str_replace("\"","",$nome);
		$nome = str_replace("/","-",$nome);
		$nome = str_replace("\\","-",$nome);
		$nome = str_replace(",","",$nome);
		$nome = str_replace(".","",$nome);
		
		$nome = str_replace("---","-",$nome);
		$nome = str_replace("--","-",$nome);
	
		
		return strtolower(trim($nome));
}

/**
	Função Padrão de Envio de E-mail
	$to 		-> para quem
	$assunto 	-> assunto do e-mail
	$mensagem 	-> mensagem do e-mail. Pode ser em HTML
	$deQuem 	-> Caso o remetente seja diferente de iteam@usjt.br
	$copia 		-> Se precisar mandar com cópia
**/

function _SendMail($to,$assunto,$mensagem,$deQuem='iteam@usjt.br',$copia=''){

	$headers = "Return-Path: ".$deQuem."\n";
	$headers .= "X-Sender: ".$deQuem."\n";
	$headers .= "From: ".$deQuem."\n";
	if($copia != '') $headers .= "Cc: ".$copia."\r\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	
	mail($to,$assunto,$mensagem,$headers);
	//log de email

}


function _FormatValor($number)
{
	
	return number_format($number, 2, ',', '.');
	
}

/*
 * Função para tratamento de Erros 
 */

function _Error ($desc)
{
	die ($desc);
}


/*
 * Funções de criptografia
 */

function _UrlEncrypt ($parm)
{
	$securekey = "USJT WEBxADM 2010";
	return (urlencode (base64_encode (mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $securekey, $parm, MCRYPT_MODE_ECB))));
}

function _Encrypt ($parm)
{
	$securekey = "USJT WEBxADM 2010";
	return (base64_encode (mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $securekey, $parm, MCRYPT_MODE_ECB)));
}

function _Decrypt ($parm)
{
	$securekey = "USJT WEBxADM 2010";
	return _AntiInjection((trim (mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $securekey, base64_decode($parm), MCRYPT_MODE_ECB))));
}

function _UrlDecrypt ($parm)
{
	$securekey = "USJT WEBxADM 2010";
	return _AntiInjection((trim (mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $securekey, base64_decode(urldecode($parm)), MCRYPT_MODE_ECB))));
}



function _NVL ($var1, $var2=NULL,$equalsTo = NULL )
{
	
	if ($var1 == "")
	{
		
		if (is_null($var2))
		{
			
			return " - ";
		}
		else
		{
			return $var2;
		}
		
	}
	else
	{
	
		if (!is_null($equalsTo) && $var1 == $equalsTo)
		{

			if (is_null($var2) || $var2 == "")
				return " - ";
			else
				return $var2;
			
		}
		else
		{
			return $var1;
		}
	}
}


function _AntiInjection($sql){

	$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|union|concat|like|information_schema|table_schema|table_name|#||--|\\\\)/"), "" ,$sql);
	$sql = str_replace("'",'',$sql);
	$sql = str_replace("\"",'',$sql);
	$sql = trim($sql);
	$sql = strip_tags($sql);
	$sql = (get_magic_quotes_gpc()) ? $sql : $sql;
	return $sql;
	 

}




function _convertArrayKeysToUtf8($array) {
	$convertedArray = array();
	foreach($array as $key => $value) {
		if(!mb_check_encoding($key, 'UTF-8')) $key = utf8_encode($key);
		if(is_array($value)) $value = _convertArrayKeysToUtf8($value);

		$convertedArray[$key] = $value;
	}
	return $convertedArray;
}


function _diaDaSemana($vDate,$vAbrev=0)
{
	$aSemana = array(array("Domingo","DOM"),
			         array("Segunda","SEG"),
			         array("Terça","TER"),
			         array("Quarta","QUA"),
			         array("Quinta","QUI"),
			         array("Sexta","SEX"),
			         array("Sábado","SAB"));
	
	$aAr = explode( '/',$vDate);
	return $aSemana[date('w',strtotime("$aAr[2]-$aAr[1]-$aAr[0]"))][$vAbrev];
	
}

function _dataExtenso($vDate=NULL)
{
	if ($vDate == '')
	{
		$vDate = date('Y-m-d');
	}
	else
	{
		$arData = explode('/',$vDate);
		$vDate = $arData[2].'-'.$arData[1].'-'.$arData[0];
	}
	
	setlocale(LC_ALL, "pt_BR", "ptb");
	return strftime("São Paulo, %d de %B de %Y ", strtotime($vDate));
	
	
	
}


function _CodeBar($string,$size=15,$height=50,$margin=15,$showNum='true')
{
	
	$html = "
			<script>
				jQuery(document).ready(function(){
			
				
					$('.barCode".$string."').barcode(
						'".$string."',
						'code39',
						{		
						'barWidth': 1,
						'barHeight': ".$height.",
						'moduleSize': 6,
						'showHRI': ".$showNum.",
						'addQuietZone': true,
						'marginHRI': 10,
						'bgColor': '#FFFFFF',
						'color': '#000000',
						'fontSize': ".$size.",
						'output': 'css',
						'posX': 0,
						'posY': 0
								}
					);
			
				});
			</script>
			
	
	
	<center><p class='barCode".$string."' style='margin:".$margin."px 0'>*".$string."*</p></center>";
	
	return $html;
	
}

function _SubtrairTempo($tmpFinal, $tmpInicial){ 
	$tmpFinal = explode(":", $tmpFinal);
	$ss_fn = ($tmpFinal[0] * 3600) + ($tmpFinal[1] * 60) + ($tmpFinal[2]);

	$tmpInicial = explode(":", $tmpInicial);
	$ss_in = ($tmpInicial[0] * 3600) + ($tmpInicial[1] * 60) + ($tmpInicial[2]);

	$ss_rs = $ss_fn - $ss_in;

	return $ss_rs;
}

function _DecimalPoint($valor)
{
	return str_replace(',','.',str_replace('.','',$valor));
}


function _dacMod10 ($p1)
{

	if ( strLen($p1) % 2 == 0 )
		$p1 = "0" . $p1;

	for ( $i=strLen($p1); $i>=1; $i-- )
	{
		if ( $i%2 != 0 )
			$waux = 2;
		else
			$waux = 1;

		$wResult = trim ( (int) ( substr ( $p1, $i-1, 1 ) ) * $waux );

		for ( $j=1; $j<=strLen($wResult); $j++ )
		{
			$wSoma += (int) substr($wResult,$j-1,1) ;
		}
	}

	$wSoma = $wSoma * 9;
	$wRet = trim ( $wSoma % 10 ) ;
	return $wRet;
}


function _FormataCPF($vValor)
{
	$vValor = str_pad($vValor,11,'0',STR_PAD_LEFT);
	$vRet = substr($vValor, 0, 3) . '.' . substr($vValor, 3, 3) . '.' . substr($vValor, 6, 3) . '-' . substr($vValor, 9, 2);
	
	return $vRet;
}

function _ShortName($pNome,$pTamanho)
{
	
	$arrRetira = array("JUNIOR","JÚNIOR","FILHO","NETO","JR");
	
	
	
	if ($pTamanho > strlen($pNome))
		return $pNome;

	$aNome = explode(' ',$pNome);
	$tamanhoAtual = strlen($pNome);
	
	 
	
	$qtdeArr = count($aNome)-1;
	if (in_array(strtoupper($aNome[count($aNome)-1]), $arrRetira))
	{
		$qtdeArr = count($aNome)-2;
	}
	
	
	while ($qtdeArr-- > 1)	
	{

		if (strlen($aNome[$qtdeArr]) > 3 && $pTamanho <= $tamanhoAtual)
		{
			$tamanhoAtual -= strlen($aNome[$qtdeArr]);
			$aNome[$qtdeArr] = substr($aNome[$qtdeArr],0,1).'.';
		}

	}

	$sRet = implode(' ',$aNome);

	return $sRet;
	
}

function _DataAtualExtenso($data="")
{
	if($data == "") $data = strtotime('now'); else $data = strtotime(date('Y-m-d'));
	
	setlocale(LC_ALL, "pt_BR", "ptb");
	return strftime("São Paulo, %d de %B de %Y ", $data);
	
}


function _DateDiffDays($dtFim,$dtIni)
{
	$aux = explode("/",$dtFim);
	$dtFim = $aux[2]."-".$aux[1]."-".$aux[0];
	
	$aux = explode("/",$dtIni);
	$dtIni = $aux[2]."-".$aux[1]."-".$aux[0];
	
	$dtFim 		= strtotime($dtFim);
	$dtIni 		= strtotime($dtIni);
	
	$datediff = $dtFim - $dtIni;
	if($datediff <= 0) return 0;
	
	
	return floor($datediff/(60*60*24));	

}

?>