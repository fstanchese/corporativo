<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuário
	$user 			= new User ();
	
	//Instanciar a Aplicação
	$app = new App("Fluxo de Ocorrências","Fluxo de Ocorrências",array('ADM','CPD'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/WOcorrFluxo.class.php");
	include("../model/Campus.class.php");
	include("../model/WOcorrAss.class.php");
	
	
	//Conectar o usuário ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que irá utilizar
	$wocorrFluxo = new WOcorrFluxo($db);
	$campus = new Campus($db);
	$wocorrAss = new WOcorrAss($db);
	
	
	$vp = new ViewPage($app->title,$app->description);
	
	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
		$form->Input("Unidade",'select',array("name"=>"p_Campus_Id","id"=>"CampusId", "value"=>$_POST[p_Campus_Id], "option"=>$campus->Calculate("Geral")));
		$form->Input("Assunto",'select',array("name"=>"p_WOcorrAss_Id",'value'=>$_POST[p_WOcorrAss_Id], "option"=>$wocorrAss->Calculate("IdSelecao") ));
		
		$form->Button("button",array('name'=>'p_buscar','value'=>'Prosseguir',"class"=>"search"));
	
	$form->CloseFieldset();
	
	unset($form);
	
	if($_GET[p_O_Option] == 'search')
	{
		
		$dbData->Get($wocorrFluxo->Query("qDepart",array("p_Depart_Id"=>$user->GetCurrDept(),"p_Campus_Id"=>$_GET[p_Campus_Id],"p_WOcorrAss_Id"=>$_GET[p_WOcorrAss_Id])));

		echo "Total de linhas: ".$dbData->Count();
			
			
		$grid = new DataGrid(array("Rel","Enc","Mail","Número","Unidade","Código","Nome","Assunto","Data","Dt.Enc","Vencto","Usuário","Últ.Depto","Turma"));
			
		while($row = $dbData->RowLimit($_GET[page]))
		{
			
			$grid->Content(" ");
			$grid->Content(" ");
			$grid->Content(" ");
			$grid->Content($row[NUMERO]);
			$grid->Content($row[CAMPUS]);
			$grid->Content($row[RA]);
			$grid->Content($row[ALUNO]);
			$grid->Content($row[ASSUNTO]);
			$grid->Content($row[DATA]);
			$grid->Content($row[DTENCAMINHA]);
			$grid->Content($row[VENCIMENTO]);
			$grid->Content($row[USINICIAL]);
			$grid->Content("");
			$grid->Content($row[TURMA]);
		}
		
		unset($grid);
		
		$dbData->Pagination();		

	}

	unset($dbData);
	unset($db);
	unset($vp);

	unset($wocorrFluxo);
	unset($campus);
	unset($wocorrAss);
	
	
	
?>