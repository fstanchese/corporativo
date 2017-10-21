<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuсrio
	$user 			= new User ();
	
	//Instanciar a Aplicaчуo
	$app = new App("Informaчѕes de Restriчуo de Cobranчa","Informaчѕes de Restriчуo de Cobranчa",array('ADM','CPD','CARTACOBRANCA'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");

	include("../model/WPessoa.class.php");
 
	
	//Conectar o usuсrio ao Banco de Dados
	$dbOracle	= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($dbOracle);
	
	//Instanciar a classe que irс utilizar
	$wpessoa = new WPessoa($dbOracle);
	
	$row = $wpessoa->GetIdInfo(_Decrypt($_GET[p_WPessoa_Id]));
	
	
	$vp = new ViewBox($app->title,$app->description);
	$vp->Header ();
	$vp->IncludeCSS ("infoPessoa.css");
	
	echo $vp->Div();
	
		echo $vp->H3($row["CODIGO"] ." - " . $row["NOME"]);
		
		// echo $vp->Table(array("border"=>"1","cellpadding"=>"0","cellspacing"=>"0","width"=>"40%"));
		echo $vp->Table(array("class"=>"dataGrid"));
			echo $vp->Tr().
					 $vp->Th("Dt.Inэcio") .
					 $vp->Th("Dt.Tщrmino") .
					 $vp->Th("Motivo") .
					 $vp->Th("Aчуo");
				
			echo $vp->CloseTr();
			
			
			$dbData->Get("select WPesCobRest.DtInicio,WPesCobRest.DtTermino,CobRestMot.Nome as Nome_Motivo, CobRestAcao.Nome as Nome_Acao
							from wpescrxcra, wpescobrest,cobrestacao, cobrestmot
							where
  							WPesCobRest.CobRestMot_Id = CobRestMot.Id
							and
							WPesCRXCRA.CobRestAcao_Id = CobRestAcao.Id
							and
  							WPesCobRest.Id = WPesCRXCRA.WPesCobRest_Id
							and
  							WPesCobRest.WPessoa_Id = '"._Decrypt($_GET[p_WPessoa_Id])."' order by WPesCobRest.DtInicio");
			
			while ($linha = $dbData->Row())
			{			
				echo $vp->Tr();
					echo $vp->Td().$linha["DTINICIO"].$vp->CloseTd();
					echo $vp->Td().$linha["DTTERMINO"].$vp->CloseTd();
					echo $vp->Td().$linha["NOME_MOTIVO"].$vp->CloseTd();
					echo $vp->Td().$linha["NOME_ACAO"].$vp->CloseTd();
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