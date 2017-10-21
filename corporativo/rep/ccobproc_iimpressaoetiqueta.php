<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Impressão de Etiqueta de Carta de Cobrança","Impressão de Etiqueta de Carta de Cobrança",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/EtqPimaco.class.php");
	
	
	include("../model/WPessoa.class.php");
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$view 		= new View();
	
	$wpessoa 	= new WPessoa($dbOracle);
	
	$etq = new EtqPimaco(6180);
		
	
	if ($_GET["p_CCobCarta_Id"] != '')  $sqlPiece = " AND CCobCarta.Id = " . _Decrypt($_GET["p_CCobCarta_Id"]);
	if ($_GET["p_CCobCrit_Id"] != '')	$sqlPiece = " AND CCobCarta.CCobCrit_Id = " . _Decrypt($_GET["p_CCobCrit_Id"]);
	if ($_GET["p_CCobProc_Id"] != '')	$sqlPiece = " AND CCobCarta.CCobCrit_Id IN ( SELECT id FROM ccobcrit WHERE ccobproc_id = '" . _Decrypt($_GET["p_CCobProc_Id"])."' )";
	
	
	
	if ($sqlPiece == '')	die();
	
	$sql = "(
			SELECT 
				1 as Seq,
				ccobcarta.wpessoa_id,
				lograd.CEP				
			FROM 
				ccobcarta, wpessoa, lograd
			WHERE 
				ccobcarta.wpessoa_id = wpessoa.id and wpessoa.lograd_id = lograd.id 
			$sqlPiece 
			)
			union all
			(
			SELECT 
    			2 as  Seq,
		 		parcel.WPessoa_Avalista_Id,
    			Lograd.CEP
			FROM 
				ccobcarta, ccobcrit, ccobcartati, wpessoa, lograd, parcel, wpessoa PessoaAvalista
			WHERE 
				ccobcarta.ccobcrit_id = ccobcrit.id
      			AND PessoaAvalista.lograd_id = lograd.id
      			AND PessoaAvalista.Id (+) = Parcel.WPessoa_Avalista_Id      
      			AND parcel.id = ccobcarta.parcel_id
				AND ccobcrit.ccobcartati_id = ccobcartati.id
				AND wpessoa.id = ccobcarta.wpessoa_id
				$sqlPiece
			) 
			ORDER BY seq, cep";
	
	$dbData->Get($sql);
	
	
	while($row = $dbData->Row())
	{
		
		$etq->setConteudo($wpessoa->GetEndereco($row[WPESSOA_ID]));
		
	}
	
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);	
?>