<?php
	
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user 			= new User ();
	$app = new App("Cadastro de Texto Padrуo aos Assuntos do S.A.A.","Cadastro de Texto Padrуo aos Assuntos do S.A.A.",array('ADM','CPD','SAA_ANALISTA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");	
	include("../engine/Form.class.php");
	
	
	include("../model/WOcorrAssTP.class.php");
	
	
	
	//Conectar o usuсrio ao Banco de Dados
	$dbOracle 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($dbOracle);
	
	//Instanciar a classe que irс utilizar
	$wocorrAssTP 	= new WOcorrAssTP($dbOracle);
	

	
	$nav = new Navigation($user, $app, $dbData);
	

	if($_POST[p_O_Option] == 'select') 
	{
		
		$dbData->Get($wocorrAssTP->Query("qId",array("p_WOcorrAssTP_Id"=>$_POST[WOcorrAssTP_Id])));
		
	
		$dadosSelect = $dbData->Row();
		
	}
	
	$view = new ViewPage($app->title,$app->description);
		
	$view->Explain('IUD');
	
	$view->Header($user,$nav);
	
	
	
	$wocorrAssTP->IUD($_POST);
	
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input('',		'hidden',		array("name"=>"WOcorrAssTP_Id","value"=>$dadosSelect[ID]));
	$form->Input('Assunto','isel',			array("name"=>"p_WOcorrAss","href"=>"../box/wocorrass_isel.php","value"=>$dadosSelect[WOCORRASS_ID],"label"=>$dadosSelect[WOCORRASS_ID_R]));
	$form->Input('Referъncia','text',		array("name"=>"p_Referencia","class"=>"size40","value"=>$dadosSelect[REFERENCIA]));
	$form->Input('Descriчуo','textarea',	array("name"=>"p_Descricao","class"=>"size40","value"=>$dadosSelect[DESCRICAO]));

	$form->CloseFieldset();
	
	$form->Fieldset();
	
		$form->IUDButtons();
	
	$form->CloseFieldset();


	unset($form);


	if ($_GET[p_O_Option] == 'search')
	{
		
		$dbData->Get($wocorrAssTP->Query('qGeral'));

		echo "Total de linhas: ".$dbData->Count ();
		
		
		$grid = new DataGrid(array("Assunto","Referъncia","Editar","Excluir"));
		
		while($row = $dbData->RowLimit($_REQUEST[page],25)){
				
	    
				$grid->Content($row[NOMENET],array('align'=>'left'));
				$grid->Content($row[REFERENCIA],array('align'=>'left'));
				$grid->Content($view->Edit($wocorrAssTP,$row[ID]),array('width'=>'05%'));
				$grid->Content($view->Delete($wocorrAssTP,$row[ID]),array('width'=>'05%'));
							
		}
		unset($grid);
		
		
		$dbData->Pagination();
		
	}	
	
	unset($wocorrAssTP);
	unset($dbData);
	unset($dbOracle);
	unset($user);	

?>