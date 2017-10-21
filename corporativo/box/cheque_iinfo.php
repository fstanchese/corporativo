<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuário
	$user 			= new User ();
	
	//Instanciar a Aplicação
	$app = new App("Informações de Cheques Devolvidos","Informações de Cheques Devolvidos",array('ADM','CPD','CARTACOBRANCA'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");

	include("../model/WPessoa.class.php");
	include("../model/Cheque.class.php");
	include("../model/ChequeMov.class.php");
	
 
	
	//Conectar o usuário ao Banco de Dados
	$dbOracle	= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($dbOracle);
	$dbData1		= new DbData ($dbOracle);
	
	//Instanciar a classe que irá utilizar
	$wpessoa 	= new WPessoa($dbOracle);
	$cheque		= new Cheque($dbOracle);
	$chequeMov	= new ChequeMov($dbOracle);
		
	$row = $wpessoa->GetIdInfo(_Decrypt($_GET[p_WPessoa_Id]));
	
	
	$vp = new ViewBox($app->title,$app->description);
	$vp->Header ();
	$vp->IncludeCSS ("infoPessoa.css");
	
	echo $vp->Div();
	
		echo $vp->H3($row["CODIGO"] ." - " . $row["NOME"]);
		
		// echo $vp->Table(array("border"=>"1","cellpadding"=>"0","cellspacing"=>"0","width"=>"40%"));
		echo $vp->Table(array("class"=>"dataGrid"));
			echo $vp->Tr().
					 $vp->Th("Número") .
					 $vp->Th("Dt.Emissão") .
					 $vp->Th("Valor") .
					 $vp->Th("Emitente") .
					 $vp->Th("Movimentações");
				
			echo $vp->CloseTr();
			
			
			$dbData->Get($cheque->Query("qPessoaEmpresa",array("p_Cheque_WPessoa_Id"=>_Decrypt($_GET[p_WPessoa_Id]))));

		
			while ($linha = $dbData->Row())
			{

				$dbData1->Get($chequeMov->Query("qCheque",array("p_ChequeMov_Cheque_Id"=>$linha["ID"])));
				$vMov = '';
				while ($linhamov = $dbData1->Row())
				{
					$vMov .= $linhamov["DTMOVIMENTO"] . " - " . $linhamov["CHEQUEMOVTI_NOME"] . " - " . $linhamov["ALINEA_NOME"] . "<br>"; 
				}
				
				echo $vp->Tr();
					echo $vp->Td().$linha["NUMERO"].$vp->CloseTd();
					echo $vp->Td().$linha["DTEMISSAO"].$vp->CloseTd();
					echo $vp->Td().$linha["VALOR"].$vp->CloseTd();
					echo $vp->Td().$linha["EMITENTE"].$vp->CloseTd();
					echo $vp->Td().$vMov.$vp->CloseTd();
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