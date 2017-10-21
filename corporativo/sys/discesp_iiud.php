<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Disciplinas Especiais","Cadastro de Disciplinas Especiais",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/DiscEsp.class.php");
	include("../model/PLetivo.class.php");
	include("../model/DiscEspTi.class.php");
	include("../model/AreaAcad.class.php");
	
	//Conectar o usuсrio ao Banco de Dados
	$dbOracle = new Db ($user);
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a classe que irс utilizar
	$discEsp = new DiscEsp($dbOracle);
	$pLetivo = new PLetivo($dbOracle);
	$discEspTi = new DiscEspTi($dbOracle);
	$areaAcad = new AreaAcad($dbOracle);
	
	//se o p_O_Option for  == select - entуo 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($discEsp->Query("qId",array("p_DiscEsp_Id"=>$_POST[p_DiscEsp_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	//Quando cria o objeto View щ necessсrio passar o Titulo da Pсgina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	//Chama a IUD
	$discEsp->IUD($_POST,$dbData);
		
	//Para montar o Header precisa passar o nome do Usuсrio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
			
	//Instanciar formulсrio
	$form = new Form();
	
	$form->Fieldset();
		
	$form->Input('','hidden',array("name"=>'p_DiscEsp_Id',"value"=>$linhaSelected[ID]));
	$form->Input("Perэodo Letivo",'select',array('name'=>'p_PLetivo_Id','value'=>$linhaSelected[PLETIVO_ID],"option"=>$pLetivo->Calculate("Geral",$dbData)));
	$form->Input("Tipo da Disciplina",'select',array('name'=>'p_DiscEspTi_Id','value'=>$linhaSelected[DISCESPTI_ID],"option"=>$discEspTi->Calculate("Geral",$dbData)));
	$form->Input("Сrea Acadъmica",'select',array('name'=>'p_AreaAcad_Id','value'=>$linhaSelected[AREAACAD_ID],"option"=>$areaAcad->Calculate("Geral",$dbData)));
	$form->Input("Nome",'text',array("class"=>"size100",'name'=>'p_Nome','value'=>$linhaSelected[NOME]));
	$form->Input("Nome Reduzido",'text',array("class"=>"size8",'name'=>'p_NomeReduz','value'=>$linhaSelected[NOMEREDUZ]));
	$form->Input("Cѓdigo",'text',array("class"=>"size8",'name'=>'p_Codigo','value'=>$linhaSelected[CODIGO]));
	$form->Input("Carga Horсria Semanal",'text',array("class"=>"size8",'name'=>'p_CHSemanal','value'=>$linhaSelected[CHSEMANAL]));
	$form->Input("Carga Horсria Semanal Teoria",'text',array("class"=>"size8",'name'=>'p_CHSemanalTeoria','value'=>$linhaSelected[CHSEMANALTEORIA]));
	$form->Input("Carga Horсria Semanal Prсtica",'text',array("class"=>"size8",'name'=>'p_CHSemanalPratica','value'=>$linhaSelected[CHSEMANALPRATICA]));
	$form->Input("Carga Horсria Semanal Laboratѓrio",'text',array("class"=>"size8",'name'=>'p_CHSemanalLab','value'=>$linhaSelected[CHSEMANALLAB]));
	$form->Input("Carga Horсria Anual",'text',array("class"=>"size8",'name'=>'p_CHAnual','value'=>$linhaSelected[CHANUAL]));
			
    $form->CloseFieldset ();
		
	$form->Fieldset();
		// Botѕes de aчуo
		$form->IUDButtons();
	$form->CloseFieldset ();
	
	//fecha formulсrio
	unset($form);
	
    //Consultas deverуo ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search")
	{	
	
		//Chamando o mщtodo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($discEsp->Query('qPLetivo',array("p_PLetivo_Id"=>$_GET[p_PLetivo_Id])));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
	
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Disciplinas","Editar","Excluir"));
	
			//Obtъm as linhas da execuчуo do arquivo .sql
			while($row = $dbData->RowLimit($_GET[page]))
			{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($discEsp,$row[ID]));
				$grid->Content($view->Delete($discEsp,$row[ID]));
			}
		}

		//fecha grid
		unset($grid);	
		
		$dbData->Pagination();
		
	}
		
	unset($DiscEsp);
	unset($dbData);
	unset($dbOracle);
	unset($user);
?>