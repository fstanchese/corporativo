<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Atestado","Atestado",array('ADM','CPD','SECRETARIAGERAL', 'SAA_ANALISTA'),$user);
		
	include("../engine/Db.class.php");
	require_once("../engine/View.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/AutDoc.class.php");
	include("../model/AutDocElem.class.php");
	include("../model/WPessoa.class.php");
	include("../model/Matric.class.php");
	include("../model/PLetivo.class.php");
	
	$dbOracle = new Db ($user);	
	$dbData = new DbData ($dbOracle);
	
	$view = new ViewPage($app->title,$app->description);	
	$view->Header ($user);
	
	//$view->IncludeCSS('atestados.css');
	
	$autDoc 	= new AutDoc($dbOracle);	
	$autDocElem	= new AutDocElem($dbOracle);
	$wpessoa  	= new WPessoa($dbOracle);
	$matric 	= new Matric($dbOracle);
	$pletivo 	= new PLetivo($dbOracle);
	$form		= new Form();

	$p_WPessoa_Id = $_POST['p_Nome'];
	
	$form->Fieldset('Selecione o aluno');
	
	$form->Input("Nome",
			'autocomplete',
			array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_Nome', "class"=>"size70", "required"=>'1',"value"=>'',"label"=>""));
		
	$form->Button ("submit", array ("name"=>"p_submit", "value"=>"Consultar"));
	
	$form->CloseFieldset();
	
	if ($_POST['p_Nome'] != '')
	{
		
	
		echo $wpessoa->GetInfoAluno($p_WPessoa_Id); 
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
			echo $view->Td() . $autDocElem->GetValor($row["ID"],"#TOPOCURSO") . $view->CloseTd();
			echo $view->Td(array("align"=>"right")) . $autDocElem->GetValor($row["ID"],"#SERIE") . "&ordf;" . $view->CloseTd();
			echo $view->Td() . $autDocElem->GetValor($row["ID"],"#CODTURMA") . $view->CloseTd();
			echo $view->Td() . $autDoc->Link($row["DT_FORMAT"],array("class"=>"openColorBox","href"=>"../pub/atestado.php?p_Hash=".$autDocElem->GetValor($row["ID"],"#CHAVE"))) . $view->CloseTd();
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
			$form->Input("Selecione o curso:","select",array("name"=>"Curso_Id","option"=>$arReturn));
			$form->Button("button",array("value"=>"Gerar","class"=>"btGeraAtestado"));
			$form->CloseFieldset();
		}
		else
		{
			$view->Dialog('I','Atenção','Aluno(a) não está matriculado, nos cursos de Graduação ou PRONATEC, no corrente período letivo.');
		}
	}

	unset ($autDocElem);
	unset ($wpessoa);
	unset ($matric);
	unset ($pletivo);
	unset ($dbOracle);
	unset ($dbData);
	unset ($view);
	unset ($autDoc);
	
	
?>
