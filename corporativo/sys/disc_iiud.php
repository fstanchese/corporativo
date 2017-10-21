<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro das Disciplinas","Cadastro das Disciplinas",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Disc.class.php");	

	//Conectar o usu�rio ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navega��o da P�gina
	$nav = new Navigation($user, $app);
	
	//Instanciar a classe que ir� utilizar
	$disc = new Disc($dbOracle);

	//se o p_O_Option for  == select - ent�o 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($disc->Query("qId",array("p_Disc_Id"=>$_POST[p_Disc_Id])));
		$linhaSelected = $dbData->Row();
	}

	//Quando cria o objeto View � necess�rio passar o Titulo da P�gina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	//Chama a IUD
	$disc->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formul�rio
	$form = new Form();	

		$form->Fieldset();	
			$form->Input('','hidden',array("name"=>'p_Disc_Id',"value"=>$linhaSelected[ID]));
	
			$form->Input("C�digo",'text',array('name'=>'p_Codigo',"required"=>'1','value'=>$linhaSelected[CODIGODISC]));
			$form->Input("Descri��o",'text',array('name'=>'p_Nome',"class"=>"size90","required"=>'1','value'=>$linhaSelected[NOMEDISC]));
				
		$form->CloseFieldset ();
	
		$form->Fieldset();
		
			// Bot�es de a��o
			$form->IUDButtons();

		$form->CloseFieldset ();
		
	//fecha formul�rio
	unset($form);
	
	//Consultas dever�o ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search")
	{
	    if ($_GET[p_Codigo] == '' && $_GET[p_Nome] == '')
	    	$dbData->Get($disc->Query("qGeral"));
	    else
	    	$dbData->Get($disc->Query("qSelecaoDisc",array("p_Disc_Codigo"=>$_GET[p_Codigo],"p_Disc_Nome"=>$_GET[p_Nome])));
				
		$grid = new DataGrid(array("Descri��o","Codigo","Editar","Excluir"));
			
		while($row = $dbData->RowLimit($_GET[page]))
		{
			
			$grid->Content($row[NOMEDISC],array('align'=>'left','width'=>'80%'));
			$grid->Content($row[CODIGODISC],array('align'=>'center','width'=>'10%'));
			$grid->Content($view->Edit($disc,$row[ID]),array('width'=>'05%'));
			$grid->Content($view->Delete($disc,$row[ID]),array('width'=>'05%'));
				
		}
		
		unset($grid);
		
		$dbData->Pagination();
				
	}	
	
	unset($disc);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);	
?>	
