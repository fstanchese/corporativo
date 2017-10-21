<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Tipo de Movimento de Cheque","Cadastro de Tipo de Movimento de Cheque",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/ChequeMovTi.class.php");



	//Conectar o usu�rio ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navega��o da P�gina
	$nav = new Navigation($user, $app);

	//Instanciar a classe que ir� utilizar
	$chequeMovTi = new ChequeMovTi($dbOracle);	
	

	//se o p_O_Option for  == select - ent�o 1 linha foi selecionada 
	if($_POST[p_O_Option] == "select")
	{		
		$chequeMovTi->Get($chequeMovTi->Query("qId",array("p_ChequeMovTi_Id"=>$_POST[p_ChequeMovTi_Id])));
		$linhaSelected = $chequeMovTi->Row();
	}
	
	//verifica se o evento foi passado por parametro - Paginacao
	if($_GET["p_ChequeMovTi_Id"] != "")
	{ 
		$linhaSelected[CHEQUEMOVTI_ID] = $_GET["p_ChequeMovTi_Id"]; 
	}
	
	//Quando cria o objeto View � necess�rio passar o Titulo da P�gina	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	//Chama a IUD	 	
	$chequeMovTi->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);

	//Instanciar formul�rio
	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_ChequeMovTi_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Nome',
					'text',
					array("name"=>'p_Nome', "class"=>"size50", "required"=>'1',"value"=>$linhaSelected[NOME]));
			

		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			// Bot�es de a��o
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	//fecha formul�rio
	unset ($form);
	
	
	//Consultas dever�o ser feitas somente se p_O_Option == 'search'
	
	if($_GET["p_O_Option"] == "search")
	{
	
		//Chamando o m�todo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($chequeMovTi->Query('qGeral'));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Nome","Editar","Del"));
			
			//Obt�m as linhas da execu��o do arquivo .sql
			while($row = $dbData->RowLimit ($_GET[page],25))
			{
				
				$grid->Content($row[NOME],array('align'=>'left'));
				$grid->Content($view->Edit($chequeMovTi,$row[ID]));
				$grid->Content($view->Delete($chequeMovTi,$row[ID]));
								  				
			}
		}
		
		//fecha grid
		unset($grid);
		
		$dbData->Pagination();
	}
	
	unset($view);
	
	unset($chequeMovTi);
	
	unset($nav);	
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($app);
	
	unset($user);

?>