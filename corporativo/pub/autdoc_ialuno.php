<?php 


	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ('aluno','jdfoj8303m3o9');
	
	//$app = new App("Atestado","Atestado",array('ADM','CPD','ALUNOS'),$user);
		
	include("../engine/Db.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/AutDoc.class.php");
	include("../model/AutDocElem.class.php");
	include("../model/WPessoa.class.php");
	include("../model/Matric.class.php");
	include("../model/PLetivo.class.php");
	
	$dbOracle = new Db ($user);
	
	$dbData = new DbData ($dbOracle);
	
	$view = new ViewPage('Atestado de Matrícula','Atestado de Matrícula');
	$view->IncludeCSS('atestados.css');
	
	$view->Header ();

	$autDoc 	= new AutDoc($dbOracle);	
	$autDocElem	= new AutDocElem($dbOracle);
	$wpessoa  	= new WPessoa($dbOracle);
	$matric 	= new Matric($dbOracle);
	$pletivo 	= new PLetivo($dbOracle);
	$form		= new Form();

	//$p_WPessoa_Id = 1610000002722;
		
	$p_WPessoa_Id = urldecode (base64_decode ($_GET[p]));
	
	//$p_WPessoa_Id = 1610000002722;
	
	echo $wpessoa->GetInfoAluno($p_WPessoa_Id,'on');
	
	echo $view->Div(array("class"=>"InfoAtestado"));
	echo '* Prezado(a) aluno(a), caso o modelo desse documento não atenda às suas necessidades, verifique os modelos disponíveis no link Ocorrências SAA<br><br>';
	echo '* Você pode imprimir segunda via de Atestado de Matrícula clicando sobre a data e hora da geração.';
	echo $view->CloseDiv();
	
	
	echo $view->Table(array("class"=>"dataGrid"));
	echo $view->Tr();
	echo $view->Th("Últimos Atestados Gerados",array("colspan"=>"4"));
	echo $view->CloseTr();
	echo $view->Tr();
	echo $view->Th("Curso",array("width"=>"40%"));	
	echo $view->Th("Série",array("width"=>"15%"));
	echo $view->Th("Turma",array("width"=>"15%"));
	echo $view->Th("Data de Geração",array("width"=>"30%"));
	echo $view->CloseTr();
	
	$dbData->Get($autDoc->Query("qAluno",array("p_WPessoa_Id"=>$p_WPessoa_Id,"p_O_QtdeMax"=>10)));
	
	while ($row = $dbData->Row())
	{
		
		echo $view->Tr();
		echo $view->Td() . _NVL($autDocElem->GetValor($row["ID"],"#TOPOCURSO"),$autDocElem->GetValor($row["ID"],"#CURSO")) . $view->CloseTd();
		echo $view->Td(array("align"=>"right")) . $autDocElem->GetValor($row["ID"],"#SERIE") . "&ordf;" . $view->CloseTd();
		echo $view->Td() . $autDocElem->GetValor($row["ID"],"#CODTURMA") . $view->CloseTd();
		echo $view->Td() . $autDoc->Link($row["DT_FORMAT"],array("class"=>"openColorBox","href"=>"atestado.php?p_Hash=".$autDocElem->GetValor($row["ID"],"#CHAVE"))) . $view->CloseTd();
		echo $view->CloseTr();		
	}

	echo $view->CloseTable();

		$aMatric = $matric->GetStateMatricCorrente($p_WPessoa_Id, $pletivo->GetIdAnual() ,'8300000000001','3000000002002');
		
		if (empty($aMatric))
		{
			//Verificar matrícula PRONATEC 
			$aMatric = $matric->GetStateMatricCorrente($p_WPessoa_Id,7200000000102,'8300000000001','3000000002002');
		}
		
		$aDadosMatric = $matric->GetIdInfo($aMatric[0]);
		
		
		$form->Fieldset();
		If (!empty($aMatric))
		{	
			foreach($aMatric as $aResult => $val)
			{	
				$arReturn[_UrlEncrypt($val)] = $matric->GetCurso($val);
			}
		}	
		
		if ($aDadosMatric[STATE_ID] == 3000000002002)
		{

			$form->Input("Selecione o curso","select",array("name"=>"Curso_Id","option"=>$arReturn));
			$form->Button("button",array("value"=>"Imprimir Atestado","class"=>"btGeraAtestado"));
			$form->CloseFieldset();
			
		}
		else
		{
			$view->Dialog('I','Atenção','Aluno(a) não está matriculado, nos cursos de Graduação ou PRONATEC, no corrente período letivo.');
		}
		
	
	unset ($dbOracle);
	unset ($dbData);
	unset ($view);
	unset ($autDoc);
	
	
?>
