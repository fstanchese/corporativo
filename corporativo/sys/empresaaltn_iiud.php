<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user 			= new User ();	
	$app = new App("Alteração da Razão Social de Empresas","Alteração da Razão Social de Empresas",array('ADM','CPD'),$user);
	
	include("../engine/View.class.php");
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	/**
	 * Inclusão da(s) classe(s) que irá trabalhar
	 */
	include("../model/EmpresaAltN.class.php");
	
		
	
	
	//Conectar o usuário ao Banco de Dados
	$dbOracle 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($dbOracle);
	
	//Instanciar a classe que irá utilizar
	$empresaAltN 	= new EmpresaAltN ($dbOracle);
	


	if($_POST[p_O_Option] == "select")
	{
	
		$dbData->Get($empresaAltN->query("qId",array("p_EmpresaAltN_Id"=>$_POST[EmpresaAltN_Id])));
		$dadosSelect = $dbData->Row();
		
	}
	
	
	
	$view = new ViewPage($app->title,$app->description);
	
	$view->Header($user);
	
	
	$empresaAltN->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('',		'hidden',		array("name"=>'EmpresaAltN_Id',"value"=>$dadosSelect[ID]));
	$form->Input('Empresa','isel',			array("name"=>'p_Empresa',"href"=>'../sel/empresa_isel.php','value'=>$dadosSelect[EMPRESA_ID],"label"=>$dadosSelect[EMPRESA]));
	$form->Input('Razao Social','text',		array("name"=>'p_Razao',"placeholder"=>"Nome da Empresa","required"=>'1',"value"=>$dadosSelect[RAZAO],"size"=>50));
	$form->Input('Data de Início','text',	array("name"=>'p_DtInicio',"required"=>'1',"class"=>'data',"value"=>$dadosSelect[DTINICIO],"size"=>10));
	$form->Input('Data de Término','text',	array("name"=>'p_DtTermino',"required"=>'1',"class"=>'data',"value"=>$dadosSelect[DTTERMINO],"size"=>10));
	
	
	
	$form->CloseFieldset();

	$form->Fieldset();
	// Botões de ação
		$form->IUDButtons();
	$form->CloseFieldset ();
	
	unset($form);

	if($_GET[p_O_Option] == "search")
	{
	
		$dbData->Get($empresaAltN->query('qGeral'));
		
		
		echo "Total de linhas: ".$dbData->Count ();
		
		
		
		$grid = new DataGrid(array("Razão","Data de Início","Data de Término","Editar","Excluir"));
		
		while($row = $dbData->RowLimit ($_REQUEST[page])){
			
			    $grid->Detail(array('Razão'=>$row[RAZAO],'Dt.Início'=>$row[DTINICIO],'Dt.Término'=>$row[DTTERMINO]));
				
				$grid->Content($row[RAZAO],array('align'=>'left'));
				$grid->Content($row[DTINICIO],array('align'=>'center'));
				$grid->Content($row[DTTERMINO],array('align'=>'center'));
				$grid->Content($view->Edit($empresaAltN,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($empresaAltN,$row[ID]),array('width'=>'05%'));
				
		}
		unset($grid);
		
		$dbData->Pagination ();
	}
	
	unset($empresaAltN);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>