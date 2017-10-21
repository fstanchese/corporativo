<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Leitura de Arquivo de Retorno do SPC","Leitura de Arquivo de Retorno do SPC",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	
	include("../model/CCobConseq.class.php");

	
	
	
	$dbOracle 	= new Db ($user);

	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$view		= new ViewPage($app->title,$app->description);
	
	
	$ccobConseq = new CCobConseq($dbOracle);
	
	
	$view->Header($user,$nav);

	
	$view->IncludeJS("ccobproc.js");
	
	
	$form = new Form();

		$form->Fieldset("Retorno Arquivo");
		
			$form->Input("Arquivo",'file',array("name"=>'p_Arquivo'));
			
			$form->Button('submit',array("name"=>"btProsseguir","value"=>"Prosseguir"));
			
		$form->CloseFieldset ();
		
	unset ($form);
	
		
		
	if($_POST[btProsseguir] == "Prosseguir")
	{
		
		$handle = fopen($_FILES[p_Arquivo][tmp_name], "r");
		
		$cont = 0;
		
		$arIns[p_O_Option] = "insert";
		
		$grid = new DataGrid(array("Carta","RA","Nome"," "),"Retorno do Arquivo");
		
		while (($line = fgets($handle)) !== false) 
		{
			
			if($cont == 3)
			{
				
				$arIns[p_DtInclusao] = "";
				
				$idCarta = explode("/",trim($line));
				$idCarta = end(explode("OJ",$idCarta[0]));
				
				$codRet = substr(trim($line),-2);
				
				
				
				if($codRet == "00")	$arIns[p_DtInclusao] = date("d/m/Y");
				
				$arIns[p_CCobCarta_Id] 		= ($idCarta+208600000000000);
				$arIns[p_CCobConseqTi_Id] 	= 208300000000001;
				$arIns[p_Retorno]			= $codRet;
				
				$cont = 0;
				
				$ccobConseq->IUD($arIns);
				
				$dadosPessoa = $dbData->Row($dbData->Get("SELECT wpessoa.nome, wpessoa.codigo, ccobcarta.id FROM ccobcarta, wpessoa WHERE wpessoa.id = ccobcarta.wpessoa_id WHERE ccobcarta_id = '".$arIns[p_CCobCarta_Id]."'"));
				
				if($codRet == "00") $flag = 'on'; else $flag = 'off';
				
				
				$grid->Content($idCarta);
				$grid->Content($dadosPessoa[CODIGO]);
				$grid->Content($dadosPessoa[NOME]);
				$grid->Content($view->OnOff($flag));
				
				
			}
			
			$cont++;
			
		}
		
		unset($grid);

		
	}
	
	unset($state);
	
	unset($dbOracle);
	
	unset($user);

?>