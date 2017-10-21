<?php
	include("../engine/User.class.php");
		
	$user = new User ();
		
	include("../engine/Db.class.php");
	include("../engine/FileGen.class.php");
	
	
	include("../model/CCobCarta.class.php");
	include("../model/WPessoa.class.php");
	include("../model/Lograd.class.php");
	include("../model/CCobDebito.class.php");
	
		
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$fileGen 	= new FileGen("teste.txt");

	
	$wpessoa 	= new WPessoa($dbOracle);
	$lograd 	= new Lograd($dbOracle);
	$ccobCarta	= new CCobCarta($dbOracle);
	$ccobDebito = new CCobDebito($dbOracle);
	
	
	
	$dbData->Get("SELECT wpessoa_id, matric_id, id, (id-208600000000000) as idCarta FROM ccobcarta WHERE ccobcarta.id IN ( ".implode(",",$_POST[spc]).")");
	
	
	
	//header
	
	$fileGen->Info(146192, 8 ,0, "L");
	$fileGen->Info('0000000000');
	$fileGen->Info(date('dmy'));
	$fileGen->Info("REMESSA");
	$fileGen->Info("UNIVERSIDADE SAO JUDAS TADEU", 55 ," ", "R");
	$fileGen->Info("CONTR01",8," ","R");
	$fileGen->Info(" ",8," ","R");
	$fileGen->Info("01");
	$fileGen->Info(" ",146," ","R");
	
	$fileGen->NextLine();
	
	
	$cont = 1;
	
	while($row = $dbData->Row())
	{
		
		$aPessoa = $wpessoa->GetIdInfo($row[WPESSOA_ID]);
		
		$dtNascto = explode("/",$aPessoa[DTNASCTO]);
		$dtNascto = $dtNascto[0].$dtNascto[1].substr($dtNascto[2],1,2);
		
		$endereco = $lograd->GetEndereco($aPessoa[LOGRAD_ID]);
	
		$dtOcorr = explode("/",$ccobDebito->GetMenorVencto($row[ID]));
		
		$anoOcorr = substr($dtOcorr[2],1,2);
		
		$dtOcorr = $dtOcorr[0].$dtOcorr[1].substr($dtOcorr[2],1,2);
		
	
		
		$valor = str_replace(",","",str_replace(".","",$ccobDebito->GetValorAtual($row[ID])));
		

		$fileGen->Info(146192, 8 ,0, "L");
		$fileGen->Info(1);
		$fileGen->Info($cont, 5 ,0, "L");
		$fileGen->Info("1A10");
		$fileGen->Info("CPF".$aPessoa[CPF],20," ","R");
		$fileGen->Info("RG".$aPessoa[RGRNE],20," ","R");
		$fileGen->Info(" ",20," ","R");
		$fileGen->Info(substr($aPessoa[NOME],0,48),56," ","R");
		$fileGen->Info($dtNascto);
		$fileGen->Info(" ",56," ","R");
		$fileGen->Info(0, 6 ,0, "L");
		$fileGen->Info("BRASILEIRA", 20 ," ", "R");
		$fileGen->Info("SP");
		$fileGen->Info(" ",26," ","R");
		
		$fileGen->NextLine();
		
		
		$fileGen->Info(146192, 8 ,0, "L");
		$fileGen->Info(1);
		$fileGen->Info($cont, 5 ,0, "L");
		$fileGen->Info("1B10");
		$fileGen->Info("CPF".$aPessoa[CPF],20," ","R");
		$fileGen->Info("1");
		$fileGen->Info(substr($endereco[ENDERECO],0,48),50," ","R");
		$fileGen->Info(substr($endereco[BAIRRO],0,18),20," ","R");
		$fileGen->Info($endereco[CEP],8,"0","L");
		$fileGen->Info(substr($endereco[CIDADE],0,48),20," ","R");
		$fileGen->Info($endereco[UF]);
		$fileGen->Info($aPessoa[FONERES],20," ","R");
		$fileGen->Info(" ",91," ","R");
		
		
		$fileGen->NextLine();
		
		
		$fileGen->Info(146192, 8 ,0, "L");
		$fileGen->Info(1);
		$fileGen->Info($cont, 5 ,0, "L");
		$fileGen->Info("1110");
		$fileGen->Info("CPF".$aPessoa[CPF],20," ","R");
		$fileGen->Info($dtOcorr);
		$fileGen->Info("OJ");

		$fileGen->Info($row[IDCARTA]."/".$anoOcorr,16," ","L");
		
		
		$fileGen->Info(" ",20," ","R");
		$fileGen->Info($valor,11,"0","L");
		$fileGen->Info(" ",25," ","R");
		$fileGen->Info("N00");
		$fileGen->Info(" ",129," ","R");
	
	
		$fileGen->NextLine();
		
		$cont++;
	}
	
	
	
	//footer
	$fileGen->Info(146192, 8 ,0, "L");
	$fileGen->Info(9, 10 ,9, "L");
	$fileGen->Info(date('dmy'));
	$fileGen->Info(" ",226," ","R");
	
	
	
	unset($fileGen);
	unset($dbData);
	unset($dbOracle);
	
	
	

?>