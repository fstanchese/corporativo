<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Protocolos utilizados pelo S.A.A.","Cadastro de Protocolos utilizados pelo S.A.A.",array('ADM','SAA','SAA_ANALISTA'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/ProtMsg.class.php");
	
	$dbOracle = new Db ($user);


	$dbData = new DbData ($dbOracle);
	
	$nav = new Navigation($user, $app);

	
	$protMsg = new ProtMsg($dbOracle);	
	
	
	
	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($protMsg->Query("qId",array("p_ProtMsg_Id"=>$_POST[p_ProtMsg_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	
	if($_GET["p_ProtMsg_Id"] != "")
	{ 
		$linhaSelected[ID] = $_GET["p_ProtMsg_Id"]; 
	}
	
		
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
		 	
	$protMsg->IUD($_POST);
	
	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset();
		
			$form->Input('',		'hidden',			array("name"=>'p_ProtMsg_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Mensagem do Protocolo',
					'textarea',
					array("name"=>'p_Protocolo', "class"=>"size50", "required"=>'1',"value"=>$linhaSelected[PROTOCOLO]));
			
		$form->CloseFieldset ();
		
		$form->Fieldset();
						
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	
	unset ($form);
	
	
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$dbData->Get($protMsg->Query('qGeral'));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Protocolo","Editar","Del"));
			
			//Obtъm as linhas da execuчуo do arquivo .sql
			while($row = $dbData->RowLimit ($_GET[page],40))
			{
				
				$grid->Content($row[PROTOCOLO],array('align'=>'left'));
				$grid->Content($view->Edit($protMsg,$row[ID]));
				$grid->Content($view->Delete($protMsg,$row[ID]));
								  				
			}
		}
		
		//fecha grid
		unset($grid);
		
		$dbData->Pagination();
	}
	
	unset($view);
	
	unset($protMsg);
	
	unset($nav);	
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($app);
	
	unset($user);

?>