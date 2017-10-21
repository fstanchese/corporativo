<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Documentos Pendentes por Aluno","Documentos Pendentes por Aluno",array('ADM','CPD'),$user);
		
	include("../engine/Db.class.php");
	include("../engine/ViewPortal.class.php");
	include("../engine/Form.class.php");

	include("../model/WPessoaDoc.class.php");
	include("../model/WPessoa.class.php");
	
	$dbOracle = new Db ($user);
	
	$dbData = new DbData ($dbOracle);
	
	$view = new ViewPortal($app->title,$app->description);
	
	$view->Header ();

	$wpessoaDoc	= new WPessoaDoc($dbOracle);
	$wpessoa	= new WPessoa($dbOracle);
	$form		= new Form();

	//$p_WPessoa_Id = 1610000002722;
	//$p_WPessoa_Id = 1600000196611;	
	//$p_WPessoa_Id = 1600000180242;
	$p_WPessoa_Id = 1600000290761;
	
	
	echo $wpessoa->GetInfoAluno($p_WPessoa_Id); 
	echo $view->Table(array("class"=>"dataGrid"));
	echo $view->Tr();
	echo $view->Th("Documentos Pendentes",array("colspan"=>"7"));
	echo $view->CloseTr();
	echo $view->Tr();
	echo $view->Th("Parente",array("width"=>"10%"));	
	echo $view->Th("Tipo de Documento",array("width"=>"30%"));
	echo $view->Th("Motivo",array("width"=>"30%"));
	echo $view->Th("Qtde Vias",array("width"=>"7%"));
	echo $view->Th("Prazo",array("width"=>"7%"));
	echo $view->Th("Obs.",array("width"=>"16%"));
	echo $view->Th("Depto",array("width"=>"16%"));
	echo $view->CloseTr();
	
	$dbData->Get($wpessoaDoc->Query("qAluno",array("p_WPessoa_Id"=>$p_WPessoa_Id)));
	
	while ($row = $dbData->Row())
	{
		
		echo $view->Tr();
		echo $view->Td() . $row["PARENTE"] . $view->CloseTd();
		echo $view->Td(array("align"=>"left")) . $row["DOCTI"] . $view->CloseTd();
		echo $view->Td(array("align"=>"left")) . $row["DOCMOT"] . $view->CloseTd();
		echo $view->Td(array("align"=>"left")) . $row["QTDEVIAS"] . $view->CloseTd();
		echo $view->Td(array("align"=>"left")) . $row["DTENTREGA_DOCSAA"] . $view->CloseTd();
		echo $view->Td(array("align"=>"left")) . $row["MOTIVO"] . $view->CloseTd();
		echo $view->Td(array("align"=>"left")) . $row["DEPART"] . $view->CloseTd();
		echo $view->CloseTr();		
	}

	echo $view->CloseTable();

	unset ($dbOracle);
	unset ($dbData);
	unset ($view);
	unset ($autDoc);
	
	
?>
