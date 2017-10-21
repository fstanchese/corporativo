<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ('aluno','jdfoj8303m3o9');
	//$user = new User ();
	//$app = new App("Impressão de Atestados","Impressão de Atestados",array('ADM','CPD','SECRETARIAGERAL','SAA_ANALISTA'),$user);
		
	include("../engine/Db.class.php");
	include("../engine/ViewPortal.class.php");
	include("../engine/Form.class.php");
	

	include("../model/WPessoa.class.php");
	include("../model/AutDocTi.class.php");
	include("../model/Matric.class.php");
	include("../model/AutDocLElem.class.php");
	include("../model/AutDoc.class.php");
	include("../model/AutDocL.class.php");
	
	$dbOracle = new Db ($user);
	
	$dbData = new DbData ($dbOracle);
	
	$view = new ViewPortal($app->title,$app->description);
	$view->IncludeCSS('atestados.css');

	$wpessoa 	= new WPessoa($dbOracle);
	$autDocTi 	= new AutDocTi($dbOracle);
	$matric 	= new Matric($dbOracle); 
	
	$autDoc 	= new AutDoc($dbOracle);
	$autDocL	= new AutDocL($dbOracle);
	

//	$view->Header($user);

	$code = "$('.logoOficial').append('<img src=\"../images/logo_usjt_oficial.png\">');";
	$code .= "$('.rodape').append('<img src=\"../images/rodape_oficial.png\" width=\"300px\">');";
	echo $view->JS($code);
	
	$Matric_Id = _Decrypt($_GET['p_Matric_Id']);

	$vCursoNivel_Id = $matric->GetCursoNivel($Matric_Id);
	
	$arMatric = $matric->GetAtestado($Matric_Id);

	if (($vCursoNivel_Id == 6200000000001 || $vCursoNivel_Id == 6200000000012 || $vCursoNivel_Id == 6200000000010 || $vCursoNivel_Id == 6200000000015) && $arMatric["STATE_ID"] == 3000000002002)
	{
		
		$dbData->Get("select id,documento,hash,to_char(dt,'dd/mm/yyyy hh24:mi:ss') as dt from autdoc where trunc(dt) = trunc(sysdate) and matric_id='$arMatric[ID]'");
		$row = $dbData->Row();

		
		
		if ($row["ID"] == '')		
		{

			echo $autDocL->GetDocumento($vCursoNivel_Id,$arMatric);
			
			echo $view->BtImprimir();
				
		}
		else
		{
			
			$sDocumento = $autDoc->GetDocumento($row["HASH"]);

			if ($sDocumento != '')
			{
				echo $sDocumento ; 
				echo $view->BtImprimir();
			}	
				
		}	
	}	
	else
	{
		$dbData->Get("select AutDocL.Id as AutDocL_Id,AutDocL.Layout from AutDocL,AutDocTi where AutDocTi.Id = AutDocL.AutDocTi_Id and sysdate between AutDocL.DtInicio and AutDocL.DtTermino and AutDocTi.CursoNivel_Id='$vCursoNivel_Id'");
		$aReturn = $dbData->Row();
		
		print $aReturn["LAYOUT"]->load();
		//echo "Disponível apenas para alunos matriculados nos cursos da Graduação.";
	}
	

	unset ($dbOracle);
	unset ($dbData);
	unset ($view);
	unset ($wpessoa);
	unset ($matric);
	unset ($autDocTi);
	
	
?>
