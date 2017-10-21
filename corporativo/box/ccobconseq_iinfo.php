<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuário
	$user 			= new User ();
	
	//Instanciar a Aplicação
	$app = new App("Informações SCPC","Informações SCPC",array('ADM','CPD','CARTACOBRANCA'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	

	include("../model/WPessoa.class.php");
	include("../model/CCobConseq.class.php");
 
	
	//Conectar o usuário ao Banco de Dados
	$dbOracle	= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($dbOracle);
	
	//Instanciar a classe que irá utilizar
	$wpessoa = new WPessoa($dbOracle);
	$ccobConseq = new CCobConseq($dbOracle);
	
	$row = $wpessoa->GetIdInfo(_Decrypt($_GET[p_WPessoa_Id]));
	
	
	$vp = new ViewBox($app->title,$app->description);
	$vp->Header ();
	$vp->IncludeCSS ("infoPessoa.css");
	
	echo $vp->Div();
	
		echo $vp->H3($row["CODIGO"] ." - " . $row["NOME"]);
		
		// echo $vp->Table(array("border"=>"1","cellpadding"=>"0","cellspacing"=>"0","width"=>"40%"));
		echo $vp->Table(array("class"=>"dataGrid"));
			echo $vp->Tr();
				echo $vp->Th("Num.Carta") .
					 $vp->Th("Dt.Vencto") .
					 $vp->Th("Dt.Emissão") .
					 $vp->Th("Dt.Aviso Rec.") .
					 $vp->Th("Situação") .
					 $vp->Th("Dt.Inclusão") .
					 $vp->Th("Dt.Exclusão ") .
					 $vp->Th("Conseq.");
				
			echo $vp->CloseTr();
			
			
			$dbData->Get("select (ccobcarta.Id-208600000000000) as numcarta, 
							ccobcarta.dtvencto,
							ccobcarta.dtemissao,
							ccobcarta.dtavisorec,
							state_gsRecognize(state_id) as carta_state,
							ccobconseq.DtInclusao,
							ccobconseq.dtexclusao, 
							ccobconseqti_gsRecognize(ccobconseqti_Id) as conseqti 
							from 
							ccobcarta,
							ccobconseq
							where 
							ccobcarta.id = ccobconseq.ccobcarta_id 
							and 
							ccobcarta.wpessoa_id='"._Decrypt($_GET[p_WPessoa_Id])."' order by ccobconseq.id");
			
			while ($linha = $dbData->Row())
			{			
				echo $vp->Tr();
					echo $vp->Td().$linha["NUMCARTA"].$vp->CloseTd();
					echo $vp->Td().$linha["DTVENCTO"].$vp->CloseTd();
					echo $vp->Td().$linha["DTEMISSAO"].$vp->CloseTd();
					echo $vp->Td().$linha["DTAVISOREC"].$vp->CloseTd();
					echo $vp->Td().$linha["CARTA_STATE"].$vp->CloseTd();
					echo $vp->Td().$linha["DTINCLUSAO"].$vp->CloseTd();
					echo $vp->Td().$linha["DTEXCLUSAO"].$vp->CloseTd();
					echo $vp->Td().$linha["CONSEQTI"].$vp->CloseTd();
				echo $vp->CloseTr();
			}

		echo $vp->CloseTable();
		
		
	echo $vp->Br();
	
	
	unset($dbData);
	unset($dbOracle);
	unset($vp);

	unset($wpessoa);
	unset($matric);
	unset($wocorr);
	unset($lograd); 
	unset($user);
	unset($app);
			
?>