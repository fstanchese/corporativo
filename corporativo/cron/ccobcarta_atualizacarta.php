<?php 

	include("../engine/User.class.php");
	include("../engine/Db.class.php");
	
	include("../model/CCobCarta.class.php");
	
	
	
	if (empty($_SESSION[p_WPessoa_Id]))
		$user 			= new User('usjt',"oracle92");
	
	
	$dbOracle		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);

	
	$ccobCarta 		= new CCobCarta($dbOracle);


	/**
	 * 
	 * ATUALIZAÇÃO DE CARTAS DE COBRANÇA
	 * 
	 * - ATUALIZA PARA O STATUS VENCIDO
	 * 
	 * - SE A CARTA ESTIVER GERADA e 
	 *
	 * - SE A DATA DE VENCTO FOR ANTERIOR À DATA ATUAL
	 *  
	 */



	$dbData->Get("SELECT id FROM ccobcarta WHERE sysdate > dtvencto	AND state_id = 3000000047002");
	while($row = $dbData->Row())
	{
	
		$arUpd["p_O_Option"] 			= "update";
		$arUpd["p_CCobCarta_Id"] 		= $row[ID];
		$arUpd["p_State_Id"] 			= 3000000047003;
			
		//echo 'Mudei para vencido ' . $count++ .  ' ' . $row[ID] . '<br>';
		$ccobCarta->IUD($arUpd);
	
	}
	
	
	
	/**
	 *
	 * ATUALIZAÇÃO DE CARTAS DE COBRANÇA
	 *
	 * - ATUALIZA PARA O STATUS CANCELADO
	 *
	 * - SE A CARTA ESTIVER GERADA OU NÃO FOI IMPRESSA NO PRAZO DE UMA SEMANA
	 *
	 *
	 */
	
	
	
	
	$dbData->Get("SELECT id FROM ccobcarta WHERE (sysdate > dt+7 or sysdate > dtvencto) AND state_id = 3000000047001");
	while($row = $dbData->Row())
	{
		
		$arUpd["p_O_Option"] 			= "update";
		$arUpd["p_CCobCarta_Id"] 		= $row[ID];
		$arUpd["p_State_Id"] 			= 3000000047004;
			
		//echo 'Mudei para cancelado ' . $count++ .  ' ' . $row[ID] . '<br>';
		$ccobCarta->IUD($arUpd);
		
	}
	


	
	
	/**
	 *
	 * ATUALIZAÇÃO DE CARTAS DE COBRANÇA
	 *
	 * - ATUALIZA PARA O STATUS QUITADA
	 *
	 * - SE TODOS OS BOLETOS DESSA COBRANÇA ESTIVEREM QUITADOS
	 *
	 *
	 */
	
	
		
	$dbData2 = new DbData($dbOracle);
	
	$dbData->Get("SELECT id FROM ccobcarta WHERE state_id IN (3000000047002,3000000047003) and exists (Select id from ccobdebito where ccobcarta_id = ccobcarta.id)");
	while($row = $dbData->Row())
	{

		$bolAberto = $dbData2->Row($dbData2->Get("SELECT count(*) as emaberto FROM boleto, ccobdebito WHERE ccobdebito.boleto_id = boleto.id AND ccobdebito.ccobcarta_id = '".$row[ID]."' AND boleto.state_base_id in (3000000000006,3000000000007)"));

		
		if($bolAberto[EMABERTO] == 0)
		{
			$arUpd["p_O_Option"] 			= "update";
			$arUpd["p_CCobCarta_Id"] 		= $row[ID];
			$arUpd["p_State_Id"] 			= 3000000047005;
			
			//echo 'Mudei para quitada ' . $count++ .  ' ' . $row[ID] . '<br>';
			$ccobCarta->IUD($arUpd);
			
		}
		
		
		
	}
	
	unset($dbData2);
	unset($ccobCarta);
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>