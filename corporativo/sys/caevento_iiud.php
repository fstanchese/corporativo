<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Evento - Controle de Atendimento","Cadastro de Evento - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CAEvento.class.php");
	include("../model/Campus.class.php");

	
	$dbOracle 	= new Db ($user);


	$dbData 	= new DbData ($dbOracle);
	
	

	$nav 		= new Navigation($user, $app, $dbData);

	$caEvento 	= new CAEvento($dbOracle);
	$campus 	= new Campus($dbOracle);


	if($_POST[p_O_Option] == "select")
	{		
		$linhaSelected = $caEvento->GetIdInfo($_POST[p_CAEvento_Id]);
	}
	
	//verifica se o evento foi passado por parametro - Paginacao
	if($_GET["p_CAEvento_Id"] != "") $linhaSelected[ID] = $_GET["p_CAEvento_Id"]; 
	
	
	//Quando cria o objeto View пїЅ necessпїЅrio passar o Titulo da PпїЅgina	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$caEvento->IUD($_POST);
	$view->Header($user,$nav);
 

	$form = new Form();

		$form->Fieldset("Evento - Controle de Atendimento");
		
			$form->Input('',		'hidden',			array("name"=>'p_CAEvento_Id',"value"=>$linhaSelected[ID]));
		
			$form->Input('Unidade',
					'select',
					array("name"=>'p_Campus_Id',"required"=>'1',  "value"=>$linhaSelected[CAMPUS_ID], "option"=>$campus->Calculate("Geral")));

			$form->Input('Descriзгo','text',array("required"=>'1',"name"=>'p_Descricao', "value"=>$linhaSelected[DESCRICAO], "class"=>"size70"));
						
			$form->Input('Data de Inнcio','datetime',	array("required"=>'1',"name"=>'p_DtInicio',"value"=>$linhaSelected[DTINICIO]));
			$form->Input('Data de Tйrmino','datetime',	array("name"=>'p_DtTermino',"value"=>$linhaSelected[DTTERMINO]));
			$form->Input('Evento Utiliza Senhas Nominais?','onoff', array("name"=>'p_SenhaNominal',"value"=>$linhaSelected[SENHANOMINAL]));				
		
			$form->Input('Quantidade de linhas que serгo exibidas no monitor','text',array("required"=>'0',"name"=>'p_LinMonitor', "value"=>$linhaSelected[LINMONITOR], "class"=>"size10"));
			$form->Input('Bloqueia chamada caso senha anterior nгo finalizada?','onoff',array("name"=>"p_BloqCham", "value"=>$linhaSelected[BLOQCHAM]));
			$form->Input('Esconde Informaзгo da Mesa no Painel?','onoff',array("name"=>"p_EscondeMesa", "value"=>$linhaSelected[ESCONDEMESA]));
			
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	
	
	
	if($_GET["p_O_Option"] == "search")
	{
	
	

		$dbData->Get($caEvento->Query('qGeral',array("p_Campus_Id"=>$_GET[p_Campus_Id])));
	

		if($dbData->Count () > 0)
		{

			$grid = new DataGrid(array("Unidade","Descriзгo","Dt.Inнcio","Dt.Tйrmino","Qtde Monitor","Bloquear Chamada","Editar","Del"));
			
			while($row = $dbData->Row ())
			{
				
		
				$grid->Content($row[CAMPUS_RECOGNIZE]);
				$grid->Content($row[DESCRICAO]);
				$grid->Content($row[DTINICIO]);
				$grid->Content($row[DTTERMINO]);
				$grid->Content($row[LINMONITOR]);
				$grid->Content($view->OnOff($row[BLOQCHAM]));
				$grid->Content($view->Edit($caEvento,$row[ID]));
				$grid->Content($view->Delete($caEvento,$row[ID]));
			}
		}
		
		unset($grid);
		
	}
	
	unset($caEvento);
	unset($campus);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>