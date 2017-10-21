<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Atendente por Mesa - Controle de Atendimento","Atendente por Mesa - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Ajax.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/WPessoa.class.php");
	include("../model/CAMesa.class.php");
	include("../model/CAAtendente.class.php");
	include("../model/CAEvento.class.php");
	include("../model/Campus.class.php");


	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	$ajax		= new Ajax($dbOracle);
	
	$wpessoa 	= new WPessoa($dbOracle);
	$caMesa 	= new CAMesa($dbOracle);
	$caAtend 	= new CAAtendente($dbOracle);
	$caEvento	= new CAEvento($dbOracle);
	$campus		= new Campus($dbOracle);
	


	if($_POST[p_O_Option] == "select")
	{		
		
		$dbData->Get($caAtend->Query("qId",array("p_CAAtendente_Id"=>$_POST[p_CAAtendente_Id])));
		$linhaSelected = $dbData->Row();
		
	}
	
	

	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	 	
	$caAtend->IUD($_POST,$dbData);
	
	$view->Header($user,$nav);


	$form = new Form();

		$form->Fieldset("Atendente por Mesa - Controle de Atendimento");
		
			$form->Input('',	'hidden',			array("name"=>'p_CAAtendente_Id',"value"=>$linhaSelected[ID]));
			
			$form->Input('Unidade','select', array("name"=>'p_Campus_Id',  "value"=>$linhaSelected[CAMPUS_ID], "option"=>$campus->Calculate("Geral",$dbData)));
				
			$form->Input('Evento', 'select', array("name"=>'p_CAEvento_Id', "option"=>array(""=>"Selecione o Evento")));
				
			$ajax->InputRequired("p_Campus_Id","p_CAEvento_Id","change",$caEvento->query["qGeral"],array("p_Campus_Id"=>"p_Campus_Id"),$linhaSelected[CAEVENTO_ID]);

			$form->Input('Mesa', 'select', array("name"=>'p_CAMesa_Id', "option"=>array(""=>"Selecione o Evento")));
			$ajax->InputRequired("p_CAEvento_Id","p_CAMesa_Id","change",$caMesa->query["qGeral"],array("p_CAEvento_Id"=>"p_CAEvento_Id"),$linhaSelected[CAMESA_ID]);
			
			//$form->Input($caAtend->GetLabel("CAMesa_Id"),'select',array("required"=>'1',"name"=>"p_CAMesa_Id","option"=>$caMesa->Calculate("Geral",$dbData),"value"=>$linhaSelected[CAMESA_ID]));
			$form->Input($caAtend->GetLabel("WPessoa_Id"),'autocomplete',array("execute"=>"WPessoa.AutoCompleteFunc","name"=>'p_WPessoa_Id', "class"=>"size70", "required"=>'1',"value"=>$linhaSelected[WPESSOA_ID],"label"=>$linhaSelected[WPESSOA_NOME]));
			$form->Input($caAtend->GetLabel("DtInicio"),'datetime',	array("name"=>'p_DtInicio',"value"=>$linhaSelected[DTINICIO_FORMAT]));
			$form->Input($caAtend->GetLabel("DtTermino"),'datetime',array("name"=>'p_DtTermino',"value"=>$linhaSelected[DTTERMINO_FORMAT]));
			
			$form->IUDButtons();
						
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	if($_GET["p_O_Option"] == "search")
	{
	    $acaAtend = $caAtend->GetInfo();

		if(is_array($acaAtend))
		{
			
			$grid = new DataGrid(array("Mesa","Funcionário","Editar","Del"));

			foreach($acaAtend as $row)
			{
				$grid->Content($row[CAMESA_NOME]);
				$grid->Content($row[WPESSOA_NOME]);
				$grid->Content($view->Edit($caAtend,$row[ID]));
				$grid->Content($view->Delete($caAtend,$row[ID]));
			}
		}
		else
		{
			echo 'Não existem itens cadastrados';
		}
		
		unset($grid);
		
	}
	
	unset($caAtend);
	unset($caMesa);
	unset($wpessoa);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>