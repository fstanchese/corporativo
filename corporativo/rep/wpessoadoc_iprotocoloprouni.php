<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Protocolo de Recebimento de Documentação Pendente - ProUni","Protocolo de Recebimento de Documentação Pendente - ProUni",array('ADM'),$user);
	
	include("../engine/Db.class.php");
	include("../model/WPessoa.class.php");

	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$view 		= new View();
	
	$wpessoa 	= new WPessoa($dbOracle);

	$wpessoa_id = 1600000292588;
	
	if ($wpessoa_id == '')	die();

	
	$sql = "select
		WPessoaDoc.*,
		WPessoa_gsRecognize(WPessoa_Id) as Pessoa,
		WPessoaDocTi_gsRecognize(WPessoaDocTi_Id) as DocTi,
		WPessoaDocMot_gsRecognize(WPessoaDocMot_Id) as DocMot,
		Parentesco_gsRecognize(Parentesco_Id) as Parente
	from
		WPessoaDoc
	where
		depart_id=36000000000193
	and
		WPessoa_Id='$wpessoa_id' order by Parente desc";
	
	$aPessoa = $wpessoa->GetIdInfo($wpessoa_id);
	
	$vTexto  = 'Eu,<strong> '.$user->GetName().'</strong>, declaro que o candidato supracitado compareceu a esta instituição e entregou os documentos pendentes a seguir, para comprovação ';
	$vTexto .= 'das informações prestadas por ocasião de sua inscrição no processo seletivo do ProUni, referente ao ano letivo de 2014.';
	$vTexto .= '<br>Fica o candidato advertido de que a entrega dos referidos documentos não afasta a necessidade de apresentação de quaisquer outros documentos adicionais ';
	$vTexto .= 'eventualmente julgados necessários pelo coordenador ou representante do ProUni.';
	$vTexto .= '<br>Fica ainda advertido de que a apresentação de documentos inidôneos à Instituição ou a prestação de informações falsas por ocasião da inscrição implicarão na ';
	$vTexto .= 'reprovação do candidato pelo coordenador ou representante do ProUni, sujeitando-o às penalidades previstas no art. 299, de 7 de dezembro de 1940(Código Penal).'; 
	
	echo $view->Table(array("border"=>"0","width"=>"690px"));
	echo $view->Tr();
	echo	$view->Td() . $view->Img(array("src"=>"/images/logo_azul.png")) .  $view->CloseTd();
	echo	$view->Td(array("align"=>"right","width"=>"30%")) . $view->Img(array("src"=>"/images/logo_prouni.jpg","width"=>"150px","height"=>"110px")) .  $view->CloseTd();
	echo $view->CloseTr();

	echo $view->Tr();
	echo	$view->Td(array("align"=>"center","colspan"=>"2")) . "<hr size=5px noshade>" .  $view->CloseTd();
	echo $view->CloseTr();
	
	echo $view->Tr();
	echo	$view->Td(array("align"=>"justify","style"=>"font-size:12px;font-family: Tahoma;")) . "Nome Completo" .  $view->CloseTd();
	echo	$view->Td(array("align"=>"justify","style"=>"font-size:12px;font-family: Tahoma;")) . "CPF" .  $view->CloseTd();
	echo $view->CloseTr();
	
	echo $view->Tr();
	echo	$view->Td(array("align"=>"justify","style"=>"font-size:14px;font-family: Tahoma;font-weight: bold;")) . $aPessoa["NOME"] .  $view->CloseTd();
	echo	$view->Td(array("align"=>"justify","style"=>"font-size:14px;font-family: Tahoma;font-weight: bold;")) . _FormataCPF($aPessoa["CPF"]) .  $view->CloseTd();
	echo $view->CloseTr();	

	echo $view->Tr();
	echo	$view->Td(array("align"=>"center","colspan"=>"2")) . "<div style='border:2px solid black'><p style='font-size:1.3em;text-transform:uppercase;line-height:20px;margin:10px 0px 10px 0px;'>Protocolo de recebimento de Documentação Pendente<br>do Processo Seletivo do ProUni</div>" .  $view->CloseTd();
	echo $view->CloseTr();
	
	echo $view->Tr();
	echo	$view->Td(array("align"=>"justify","colspan"=>"2","style"=>"font-size:11px;font-family: Tahoma;")) . $vTexto .  $view->CloseTd();
	echo $view->CloseTr();
	
	echo $view->Tr();
	echo	$view->Td(array("colspan"=>"2"));
		echo $view->Table(array("border"=>"1","width"=>"100%"));
		echo $view->Tr();
			echo	$view->Th("Parentesco");
			echo	$view->Th("Documento Faltante");
			echo	$view->Th("Data de Entrega");
		echo $view->CloseTr();

		$dbData->Get($sql);
		while($row = $dbData->Row())
		{
			if ($row["DTENTREGA"] != '')
			{
				echo $view->Tr();
					echo	$view->Td() . _nvl($row["PARENTE"],"Candidato") . $view->CloseTd();
					echo	$view->Td() . $row["DOCTI"] . $view->CloseTd();
					echo	$view->Td() . _NVL($row["DTENTREGA"],'12/03/2014') . $view->CloseTd();
				echo $view->CloseTr();
			}
		}
		
		
		echo $view->CloseTable();
	echo 	$view->CloseTd();
	echo $view->CloseTr();	
	
	echo $view->Tr();
	echo	$view->Td(array("align"=>"justify","colspan"=>"2")) . "Obs.: Documentos que permaneceram pendentes:" .  $view->CloseTd();
	echo $view->CloseTr();
	
	echo $view->Tr();
	echo	$view->Td(array("colspan"=>"2"));
	echo 	$view->Table(array("border"=>"1","width"=>"685px"));
	echo 	$view->Tr();
	echo		$view->Th("Parentesco");
	echo		$view->Th("Documento Faltante");	
	echo 	$view->CloseTr();
	
	$dbData->Get($sql);
	while($row = $dbData->Row())
	{
		if ($row["DTENTREGA"] == '')
		{
			echo $view->Tr();
			echo	$view->Td() . _nvl($row["PARENTE"],"Candidato") . $view->CloseTd();
			echo	$view->Td() . $row["DOCTI"] . $view->CloseTd();
			echo $view->CloseTr();
		}
	}
	
	
	echo 	$view->CloseTable();
	echo $view->CloseTd();
	echo $view->CloseTr();
	
	
	echo $view->Tr();
	echo	$view->Td(array("align"=>"center","colspan"=>"2")) . _dataExtenso() .  $view->CloseTd();
	echo $view->CloseTr();

	echo $view->Tr(array("style"=>"line-height:60px;"));
	echo	$view->Td() . "&nbsp;" .  $view->CloseTd();
	echo	$view->Td(array("align"=>"right","width"=>"30%")) . "&nbsp;" .  $view->CloseTd();
	echo $view->CloseTr();
	
	echo $view->Tr();
	echo	$view->Td() . "__________________________" .  $view->CloseTd();
	echo	$view->Td(array("align"=>"right","width"=>"30%")) . "__________________________" .  $view->CloseTd();
	echo $view->CloseTr();
	
	echo $view->Tr();
	echo	$view->Td() . "Candidato(a)" .  $view->CloseTd();
	echo	$view->Td(array("align"=>"right","width"=>"30%")) . "Universidade São Judas Tadeu" .  $view->CloseTd();
	echo $view->CloseTr();	
	
	echo $view->CloseTable();
	
	unset($wpessoa);	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>	