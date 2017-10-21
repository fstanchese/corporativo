<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Cheque","Cadastro de Cheque",array('ADM','CPD','COBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Cheque.class.php");
	include("../model/Banco.class.php");
	include("../model/WPessoa.class.php");
	include("../model/Empresa.class.php");

	$dbOracle 	= new Db ($user);	
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$cheque   	= new Cheque($dbOracle);
	$banco 		= new Banco($dbOracle);
	$wpessoa 	= new WPessoa($dbOracle);
	$empresa 	= new Empresa($dbOracle);

	
	//
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($cheque->Query("qId",array("p_Cheque_Id"=>$_POST[p_Cheque_Id])));
		$linhaSelected = $dbData->Row();
	}
	
    if($_GET["p_Cheque_Id"] != "") 
    { 
    	$linhaSelected[CHEQUE_ID] = $_GET["p_Cheque_Id"];
       	$linhaSelected[CHEQUE] = $_GET["p_Cheque_Label"];
    }
	
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	$cheque->IUD($_POST,$dbData);
	

	$view->Header($user,$nav);
	
	$form = new Form();
	
		$form->Fieldset();

			$form->Input('','hidden',array("name"=>'p_Cheque_Id',"value"=>$linhaSelected[ID]));

			$form->Input("Aluno",
					'autocomplete',
					array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_Nome', "class"=>"size70", "required"=>'1',"value"=>$linhaSelected[WPESSOA_ID_R],"label"=>""));
			
			$form->Input('Empresa','isel',	array("name"=>'p_Empresa',"href"=>'../box/empresa_isel.php','value'=>$linhaSelected[EMPRESA_ID],"label"=>$linhaSelected[EMPRESA_ID_R]));
			
			$form->Input("Banco",'select',array("name"=>'p_Banco_Id',"id"=>"BancoId","value"=>$linhaSelected[BANCO_ID], "option"=>$banco->calculate("Geral",$dbData)));
			$form->Input("Agência",'text',array("class"=>"size10",'name'=>'p_Agencia','value'=>$linhaSelected[AGENCIA]));
			$form->Input("Número da Conta",'text',array("name"=>'p_Conta',"value"=>$linhaSelected[CONTA]));
			$form->Input("Número do Cheque",'text',array("name"=>'p_Numero',"value"=>$linhaSelected[NUMERO]));
			$form->Input("Data de Emissão",'text',array("name"=>'p_DtEmissao',"value"=>$linhaSelected[DTEMISSAO]));
			$form->Input("Valor",'text',array("name"=>'p_Valor',"value"=>$linhaSelected[VALOR]));
			$form->Input("Outro Emitente",'text',array("name"=>'p_OutroEmitente',"value"=>$linhaSelected[OUTROEMITENTE]));
				
		$form->CloseFieldset ();				
		
		$form->Fieldset();
		
			$form->IUDButtons();
					
		$form->CloseFieldset ();
			
	unset($form);
		
	if($_GET["p_O_Option"] == "search" || $_GET[p_Cheque_Id] != '')
	{	
	
		$dbData->Get($cheque->Query('qGeral'));
	
		if($dbData->Count () > 0)
		{
	
			$grid = new DataGrid(array("Aluno","Outro Emitente","Valor","Nr.Cheque","Agência","Banco","Editar","Excluir"));
	
			while($row = $dbData->RowLimit($_GET[page]))
			{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));				
				$grid->Content($view->Edit($cheque,$row[ID]));
				$grid->Content($view->Delete($cheque,$row[ID]));
			}
		}

		unset($grid);	
		
		$dbData->Pagination();
		
	}	


	unset($cheque);
	unset($wpessoa);
	unset($banco);
	unset($empresa);	
	unset($dbData);	
	unset($dbOracle);
	unset($user);
?>