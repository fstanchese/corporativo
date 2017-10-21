<?php

	require_once '../engine/User.class.php';
	require_once '../engine/App.class.php';
	
	$user = new User();
	$app = new App("Importaηγo Planilha FIES","Importaηγo Planilha FIES",array('ADM','CPD'),$user);
	
	require_once '../engine/Db.class.php';
	require_once '../engine/View.class.php';
	
	$view = new View();
	
	$db = new Db($user);
	
	$dbData = new DbData($db);


	$unidade = '';
	$curso = '';
	$habilitacao = '';
	$turno = '';
	$tipo_bolsa = '';
	$bolsa = '';


	$lista = false;

	
	$fd = fopen ("extrato_fies.csv", "r");

	echo $view->Table(array("style"=>"border:2px solid black;padding:3px 7px;margin:10px 0;border-width:0px 1px 1px 0px;"));
	echo $view->Th("Aluno Ok");
	echo $view->Th("FIES Ok");
	echo $view->Th("Adit.FIES Ok");
	echo $view->Th("RA");
	echo $view->Th("CPF");
	echo $view->Th("Nome");
	echo $view->Th("F. Garantidor");
	echo $view->Th("Valor Contratado");
	echo $view->Th("Percentual");
	echo $view->Th("Repasses ->");
	echo $view->Th("Jul/13");
	echo $view->Th("Ago/13");
	echo $view->Th("Set/13");
	echo $view->Th("Out/13");
	echo $view->Th("Nov/13");
	echo $view->Th("Dez/13");

	while (!feof ($fd)) {
		$buffer = fgets($fd);
		
	
			if(eregi('UNIVERSIDADE SΓO JUDAS TADEU',$buffer)){
	
				$aDados = explode(";",$buffer);
				$vCPF = str_replace('-','',str_replace('.','',$aDados[2]));
				
				$aPessoa = array();
				$aPessoa = $dbData->Row($dbData->Get("select id,codigo from wpessoa where cpf=$vCPF"));

				$vTotalFIES++;
				$vPessoa = ' ';
				if ($aPessoa["CODIGO"] != '')
				{
					$vPessoa = 'Ok';
					$aFIES = $dbData->Row($dbData->Get("select id from FIES where wpessoa_Id=$aPessoa[ID]"));
					$vFIES = '';

					if ($aFIES[ID] != '')
					{
						$vFIES = 'Ok';
						$vQtdFIES += 1; 
					}
						
				}
					
				
				if ($aDados[6] == 'Sim')
					$vQtdFG++;
				
				if ($vCor == '#CCC')
				{
					$vCor = "#FFF";
				}
				else
				{
					$vCor = "#CCC";
				}
				
				echo $view->Tr(array("bgcolor"=>$vCor));
				echo $view->Td() . $vPessoa . $view->CloseTd();
				echo $view->Td() . $vFIES   . $view->CloseTd();
				echo $view->Td() . $vFIESAd . $view->CloseTd();
				echo $view->Td() . $aPessoa["CODIGO"] . $view->CloseTd();
				echo $view->Td() . $aDados[2] . $view->CloseTd();
				echo $view->Td() . $aDados[3] . $view->CloseTd();
				echo $view->Td() . $aDados[6] . $view->CloseTd();
				echo $view->Td(array("align"=>"right")) . $aDados[8] . $view->CloseTd();
				echo $view->Td(array("align"=>"right")) . $aDados[9] . $view->CloseTd();
				echo $view->Td() .  $view->CloseTd();
				echo $view->Td(array("align"=>"right")) . $aDados[16] . $view->CloseTd();
				echo $view->Td(array("align"=>"right")) . $aDados[17] . $view->CloseTd();
				echo $view->Td(array("align"=>"right")) . $aDados[18] . $view->CloseTd();
				echo $view->Td(array("align"=>"right")) . $aDados[19] . $view->CloseTd();
				echo $view->Td(array("align"=>"right")) . $aDados[20] . $view->CloseTd();
				echo $view->Td(array("align"=>"right")) . $aDados[21] . $view->CloseTd();
				echo $view->CloseTr();		
				
			}
		
	}

	echo $view->CloseTable();

	echo $view->Br();
	
	echo $view->Table();
	echo $view->Tr(). $view->Td() . 'Quantidade de Alunos: ' . $vTotalFIES . $view->CloseTd() . $view->CloseTr();
	echo $view->Tr(). $view->Td() . 'Quantidade Cadastrada: ' . $vQtdFIES . $view->CloseTd() . $view->CloseTr();
	echo $view->Tr(). $view->Td() . 'Quantidade Sem Cadastro: ' . ($vTotalFIES-$vQtdFIES) . $view->CloseTd() . $view->CloseTr();
	echo $view->Tr(). $view->Td() . 'Fundo Garantidor: ' . $vQtdFG . $view->CloseTd() . $view->CloseTr();
	
	echo $view->CloseTable();
	
	
	$dbData->Commit();
	
	fclose ($fd);
	
	unset($view);

?>