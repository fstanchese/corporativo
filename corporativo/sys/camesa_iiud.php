<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Mesa - Controle de Atendimento","Cadastro de Mesa - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../engine/Ajax.class.php");
	
	include("../model/CAEvento.class.php");
	include("../model/CAMesa.class.php");	
	include("../model/Sala.class.php");
	include("../model/Campus.class.php");
	
	
	$dbOracle = new Db ($user);

	$dbData = new DbData ($dbOracle);
	$nav = new Navigation($user, $app, $dbData);
	
	$ajax = new Ajax();

	$caEvento = new CAEvento($dbOracle);
	$caMesa = new CAMesa($dbOracle);
	$sala = new Sala($dbOracle);
	$campus = new Campus($dbOracle);

	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($caMesa->Query("qId",array("p_CAMesa_Id"=>$_POST[p_CAMesa_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	if($_GET["p_CAMesa_Id"] != "") $linhaSelected[ID] = $_GET["p_CAMesa_Id"]; 
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	$caMesa->IUD($_POST);
	
	//Para montar o Header precisa passar o nome do Usuï¿½rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
 

	$form = new Form();

		$form->Fieldset("Mesa - Controle de Atendimento");
		
			$form->Input('',		'hidden',			array("name"=>'p_CAMesa_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Unidade','select', array("name"=>'p_Campus_Id',  "value"=>$linhaSelected[CAMPUS_ID], "option"=>$campus->Calculate("Geral",$dbData)));
			
			$form->Input('Evento', 'select', array("name"=>'p_CAEvento_Id', "option"=>array(""=>"Selecione o Evento")));
			
			$ajax->InputRequired("p_Campus_Id","p_CAEvento_Id","change",$caEvento->query["qGeral"],array("p_Campus_Id"=>"p_Campus_Id"),$linhaSelected[CAEVENTO_ID]);
			
			$form->Input($sala->GetLabel("Nome"), 'autocomplete', array($sala->GetLength("Nome"), "execute"=>"Sala.AutoComplete","name"=>'p_Sala_Id', "class"=>"size20", "required"=>'1',"value"=>$linhaSelected[SALA_ID],"placeholder"=>"Digite a Sala","label"=>$linhaSelected[SALA_RECOGNIZE]));
				
			$form->Input($caMesa->GetLabel("Numero"),'text',array("required"=>'1',"name"=>'p_Numero', "value"=>$linhaSelected[NUMERO], "class"=>"size10","maxlength"=>$caMesa->GetLength("Numero") ));
			
			$form->Input($caMesa->GetLabel("Ativa"),'onoff' , array("name"=>'p_Ativa', "value"=>$linhaSelected[ATIVA]));
		
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	
	
		
	if($_GET["p_O_Option"] == "search")
	{
	
	
	
		$acaMesa = $caMesa->GetInfo();
	
		if(is_array($acaMesa))
		{
	
			$grid = new DataGrid(array("Evento","Sala","N&ordm; da Mesa","Ativa","Editar","Del"));
			
			foreach($acaMesa as $row)
			{
				$grid->Content($row[CAEVENTO_NOME],array('align'=>'left'));
				$grid->Content($row[SALA_NOME],array('align'=>'left'));
				$grid->Content($row[NUMERO],array('align'=>'left'));
				$grid->Content($view->OnOff($row[ATIVA]),array('align'=>'left'));
				$grid->Content($view->Edit($caMesa,$row[ID]));
				$grid->Content($view->Delete($caMesa,$row[ID]));
			}
		}
		else
		{
			echo 'Não existem itens cadastrados';
		}
		unset($grid);
		
	}
	
	unset($caEvento);
	unset($caMesa);
	unset($sala);
	unset($campus);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>

