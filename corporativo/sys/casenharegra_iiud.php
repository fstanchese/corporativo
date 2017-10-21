<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Regra de Senha - Controle de Atendimento","Cadastro de Regra de Senha - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CASenhaRegra.class.php");
	include("../model/CASenhaTi.class.php");	

	
	//Conectar o usuï¿½rio ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
 	//Instanciar a Navegaï¿½ï¿½o da Pï¿½gina
	$nav = new Navigation($user, $app, $dbData);
	
	//Instanciar a classe que irï¿½ utilizar
	$caSenhaRegra = new CASenhaRegra($dbOracle);
	$caSenhaTi = new CASenhaTi($dbOracle);


	//se o p_O_Option for  == select - entï¿½o 1 linha foi selecionada 
	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($caSenhaRegra->Query("qId",array("p_CASenhaRegra_Id"=>$_POST[p_CASenhaRegra_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	//verifica se o evento foi passado por parametro - Paginacao
	if($_GET["p_CASenhaRegra_Id"] != "") $linhaSelected[ID] = $_GET["p_CASenhaRegra_Id"]; 
	
	
	//Quando cria o objeto View ï¿½ necessï¿½rio passar o Titulo da Pï¿½gina	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
		
	//Chama a IUD
	if($_POST[p_Sequencia] != "") $_POST[p_Sequencia] = strtr($_POST[p_Sequencia],".",',');

	$caSenhaRegra->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usuï¿½rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
 

	$form = new Form();

		$form->Fieldset("Regra de Senha - Controle de Atendimento");
		
			$form->Input('',		'hidden',			array("name"=>'p_CASenhaRegra_Id',"value"=>$linhaSelected[ID]));
		
			$form->Input($caSenhaRegra->GetLabel("CASenhaTi_Id"),
					'select',
					array("name"=>'p_CASenhaTi_Id',  "value"=>$linhaSelected[CASENHATI_ID], "option"=>$caSenhaTi->Calculate()));

			
			$form->Input($caSenhaRegra->GetLabel("Sigla"),'text',array("required"=>'1',"name"=>'p_Sigla', "value"=>$linhaSelected[SIGLA],"class"=>"size20","maxlength"=>$caSenhaRegra->GetLength("Sigla")));
			
			$form->Input($caSenhaRegra->GetLabel("Sequencia"),	'range' , array("name"=>'p_Sequencia', "value"=>strtr($linhaSelected[SEQUENCIA],',','.'),"max"=>6,"min"=>1,"step"=>"0.1"));
			
			$form->Input($caSenhaRegra->GetLabel("Preferencial"),'onoff',array("name"=>'p_Preferencial', "value"=>$linhaSelected[PREFERENCIAL]));
			
			$form->Input($caSenhaRegra->GetLabel("Retorno"),'onoff',array("name"=>'p_Retorno', "value"=>$linhaSelected[RETORNO]));
		
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	
	
	//Consultas deverão ser feitas somente se p_O_Option == 'search'
	
	if($_GET["p_O_Option"] == "search")
	{
	
	
		//Chamando o mï¿½todo Query passando o arquivo .sql para a realizar a consulta.				
		$dbData->Get($caSenhaRegra->Query('qGeral',array("p_CASenhaTi_Id"=>$_GET["p_CASenhaTi_Id"])));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Tipo de Senha","Sigla","Sequência","Preferencial","Retorno","Editar","Del"));
			
			//Obtï¿½m as linhas da execuï¿½ï¿½o do arquivo .sql
			while($row = $dbData->RowLimit ($_GET[page]))
			{
				
		
				$grid->Content($row[CASENHATI_RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[SIGLA],array('align'=>'left'));
				$grid->Content($row[SEQUENCIA],array('align'=>'left'));
				$grid->Content($view->OnOff($row[PREFERENCIAL]),array('align'=>'left'));
				$grid->Content($view->OnOff($row[RETORNO]),array('align'=>'left'));
				$grid->Content($view->Edit($caSenhaRegra,$row[ID]));
				$grid->Content($view->Delete($caSenhaRegra,$row[ID]));
			}
		}
		
		unset($grid);
		
	}
	
	unset($caSenhaRegra);
	unset($caSenhaTi);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>