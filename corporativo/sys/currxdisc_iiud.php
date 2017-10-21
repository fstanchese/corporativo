<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user = new User ();
	$app = new App("Cadastro dos Currículos X Disciplinas","Cadastro dos Currículos X Disciplinas",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/CurrXDisc.class.php");
	include("../model/Curr.class.php");
	include("../model/DiscCat.class.php");
	include("../model/Disc.class.php");
	include("../model/Curso.class.php");
	include("../model/DuracXCi.class.php");
	include("../model/CurrNivel.class.php");
	include("../model/CargaHoraTi.class.php");
	include("../model/NotaTi.class.php");
	
	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	$ajax = new Ajax();
	
	//Instanciar a Navegação da Página
	$nav = new Navigation($user, $app, $dbData);
	
	//Instanciar a classe que irá utilizar
	$currXDisc		= new CurrXDisc($dbOracle);
	$curr			= new Curr($dbOracle);
	$discCat		= new DiscCat($dbOracle);
	$disc			= new Disc($dbOracle);
	$curso			= new Curso($dbOracle);
	$duracXCi		= new DuracXCi($dbOracle);
	$currNivel		= new CurrNivel($dbOracle);
	$cargaHoraTi	= new CargaHoraTi($dbOracle);
	$notaTi			= new NotaTi($dbOracle);
	
	if($_GET["p_Curr_Id"] != "") $linhaSelected[CURR_ID] = $_GET["p_Curr_Id"];
	if($_GET["p_Curr_Label"] != "") $linhaSelected[CODIGOCURR] = $_GET["p_Curr_Label"];

	if($_POST["p_Curr_Id"] != "") $linhaSelected[CURR_ID] = $_POST["p_Curr_Id"];
	
	//se o p_O_Option for  == select - então 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($currXDisc->Query("qId",array("p_CurrXDisc_Id"=>$_POST[p_CurrXDisc_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$view->On("change","#DiscCatId", "$('#ChTotal').hide();if ($(this).val() > 5900000000002)$('#ChTotal').show();");
	
	//Chama a IUD
	$currXDisc->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formulário
	$form = new Form();
	
		$form->Fieldset();

			$form->Input('','hidden',array("name"=>'p_CurrXDisc_Id',"value"=>$linhaSelected[ID]));
			$form->Input('Currículo','isel',array("name"=>"p_Curr","href"=>"../box/curr_isel.php","submit"=>"true","value"=>$linhaSelected[CURR_ID],"label"=>$linhaSelected[CODIGOCURR]));
			
		$form->CloseFieldset ();
		

		$form->Fieldset();
		
			$form->Input("Disciplina",'autocomplete',array("execute"=>"Disc.AutoComplete","name"=>'p_Disc', "class"=>"size70", "required"=>'1',"value"=>$linhaSelected[DISC_ID],"label"=>$linhaSelected[DISC_ID_R]));		
			$form->Input("Série",'select',array('name'=>'p_DuracXCi_Id','value'=>$linhaSelected[DURACXCI_ID],"option"=>$duracXCi->Calculate("Curr",array('p_Curr_Id'=>$linhaSelected[CURR_ID]))));
			$form->Input('Obrigatória','checkbox', array("name"=>'p_Obrig',"checked"=>$linhaSelected[OBRIG],"value"=>'on'));
			$form->Input("Carga Horária Semanal (CHS)",'text',array("class"=>"size20",'name'=>'p_CHSemanal','value'=>$linhaSelected[CHSEMANAL]));
			$form->Input("CHS Teoria",'text',array("class"=>"size20",'name'=>'p_CHSemanalTeoria','value'=>$linhaSelected[CHSEMANALTEORIA]));
			$form->Input("CHS Prática",'text',array("class"=>"size20",'name'=>'p_CHSemanalPratica','value'=>$linhaSelected[CHSEMANALPRATICA]));
			$form->Input("CHS Laboratorio",'text',array("class"=>"size20",'name'=>'p_CHSemanalLab','value'=>$linhaSelected[CHSEMANALLAB]));
			$form->Input("CHS Exercicio",'text',array("class"=>"size20",'name'=>'p_CHSemanalExerc','value'=>$linhaSelected[CHSEMANALEXERC]));
			$form->Input("Categoria",'select',array('name'=>'p_DiscCat_Id','id'=>'DiscCatId','value'=>$linhaSelected[DISCCAT_ID],"option"=>$discCat->Calculate("Geral")));
				
			$display="none";		
			if ($linhaSelected[DISCCAT_ID] > 5900000000002)
			{
				$display = "block";
			}			
			echo "<div id='ChTotal' style='display:".$display."'>";
				$form->Input("CH Total",'text',array('size'=>'5','name'=>'p_CHTotal','value'=>$linhaSelected[CHTOTAL]));
			echo "</div>";
				
			$form->Input("Tipo da Carga Horária ",'select',array('name'=>'p_CargaHoraTi_Id','value'=>$linhaSelected[CARGAHORATI_ID],"option"=>$cargaHoraTi->Calculate("Geral")));
			$form->Input('Sem Substitutiva?','checkbox', array("name"=>'p_SemSubs',"checked"=>$linhaSelected[SEMSUBS],"value"=>'off'));
			$form->Input('Sem Prova?','checkbox', array("name"=>'p_SemProva',"checked"=>$linhaSelected[SEMPROVA],"value"=>'off'));
			$form->Input("Tipo de Nota ",'select',array('name'=>'p_NotaTi_Id','value'=>$linhaSelected[NOTATI_ID],"option"=>$notaTi->Calculate("Geral")));
				
		$form->CloseFieldset ();
		
		$form->Fieldset();			
			// Botões de ação
			$form->IUDButtons();
		$form->CloseFieldset ();
	
	//fecha formulário
	unset($form);
	
	//Consultas deverão ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search" || $_GET[p_Curr_Id] != '')
	{
		//Chamando o método Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($currXDisc->Query('qCurr',array("p_Curr_Id"=>$_GET[p_Curr_Id])));
		
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
		
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Série","Categoria","Nome da Disciplina","Editar","Excluir"),null,false);
		
			//Obtêm as linhas da execução do arquivo .sql
			while($row = $dbData->Row())
			{
				$grid->Content($row[SERIE],array('align'=>'left','width'=>'5%'));
				$grid->Content($row[CATEGORIA],array('align'=>'left','width'=>'10%'));
				$grid->Content($row[DISC],array('align'=>'left','width'=>'65%'));
				$grid->Content($view->Edit($currXDisc,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($currXDisc,$row[ID]),array('width'=>'05%'));
			}
		}
		
		//fecha grid
		unset($grid);
		
	}
	
	
	unset($currXDisc);
	unset($curr);
	unset($discCat);
	unset($disc);
	unset($curso);
	unset($duracXCi);
	unset($currNivel);
	unset($cargaHoraTi);
	unset($notaTi);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);
?>	