<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro dos Crit�rio de Avalia��o X Nota","Cadastro dos Crit�rio de Avalia��o X Nota",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/CriAvalNota.class.php");	
	include("../model/CriAval.class.php");
	include("../model/NotaTi.class.php");

	//Conectar o usu�rio ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navega��o da P�gina
	$nav = new Navigation($user, $app);
	
	//Instanciar a classe que ir� utilizar
	$criavalnota = new CriAvalNota($dbOracle);
	$criaval = new CriAval($dbOracle);
	$notati = new NotaTi($dbOracle);

	//se o p_O_Option for  == select - ent�o 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($criavalnota->Query("qId",array("p_CriAvalNota_Id"=>$_POST[p_CriAvalNota_Id])));
		$linhaSelected = $dbData->Row();
		
	}

	//Quando cria o objeto View � necess�rio passar o Titulo da P�gina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	//Chama a IUD
	$criavalnota->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formul�rio
	$form = new Form();	

		$form->Fieldset();	
			$form->Input('','hidden',array("name"=>'p_CriAvalNota_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input($criavalnota->GetLabel('CriAval_Id'),'select',array('name'=>'p_CriAval_Id','value'=>$linhaSelected[CRIAVAL_ID],"option"=>$criaval->Calculate("Geral",$dbData)));
			$form->Input($criavalnota->GetLabel('NotaTi_Id'),'select',array('name'=>'p_NotaTi_Id','value'=>$linhaSelected[NOTATI_ID],"option"=>$notati->Calculate("Geral",$dbData)));
			$form->Input($criavalnota->GetLabel('Atributo'),'text',array('name'=>'p_Atributo',"class"=>"size10","required"=>'1','maxlength'=>$criavalnota->GetLength("Atributo"),'value'=>$linhaSelected[ATRIBUTO]));
			$form->Input($criavalnota->GetLabel('Label'),'text',array('name'=>'p_Label',"class"=>"size50","required"=>'1','maxlength'=>$criavalnota->GetLength("Label") ,'value'=>$linhaSelected[LABEL]));
				
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
    	$dbData->Get($criavalnota->Query("qGeral"));
				
		$grid = new DataGrid(array("Crit�rio","Tipo de Nota","Atributo","Label","Editar","Excluir"));
			
		while($row = $dbData->RowLimit($_GET[page]))
		{
			
			$grid->Content($row[CRIAVAL_RECOGNIZE],array('align'=>'left','width'=>'40%'));
			$grid->Content($row[NOTATI_RECOGNIZE],array('align'=>'center','width'=>'10%'));
			$grid->Content($row[ATRIBUTO],array('align'=>'center','width'=>'40%'));
			$grid->Content($row[LABEL],array('align'=>'center','width'=>'10%'));			
			$grid->Content($view->Edit($criavalnota,$row[ID]),array('width'=>'05%'));
			$grid->Content($view->Delete($criavalnota,$row[ID]),array('width'=>'05%'));
				
		}
		
		unset($grid);
		
		$dbData->Pagination();
				
	}	
	
	unset($criavalnota);	
	unset($criaval);
	unset($notati);
	unset($dbData);	
	unset($dbOracle);	
	unset($user);	
?>	
