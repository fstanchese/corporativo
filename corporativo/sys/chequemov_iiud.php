<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Movimenta��o de Cheque","Cadastro de Movimenta��o de Cheque",array('ADM','CPD','COBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/ChequeMov.class.php");
	include("../model/ChequeMovTi.class.php");
	include("../model/Alinea.class.php");

	//Conectar o usu�rio ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navega��o da P�gina
	$nav = new Navigation($user, $app, $dbData);
	
	//Instanciar a classe que ir� utilizar
	$chequeMov   = new ChequeMov($dbOracle);
	$chequeMovTi = new ChequeMovTi($dbOracle);
	$alinea = new Alinea($dbOracle);

	
	//se o p_O_Option for  == select - ent�o 1 linha foi selecionada
	if($_POST[p_O_Option] == "select")
	{
		$dbData->Get($chequeMov->Query("qId",array("p_ChequeMov_Id"=>$_POST[p_ChequeMov_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	// verifica se o evento foi passado por parametro - Paginacao
    if($_GET["p_Cheque_Id"] != "") 
    { 
    	$linhaSelected[CHEQUE_ID] = $_GET["p_Cheque_Id"];
       	$linhaSelected[CHEQUE] = $_GET["p_Cheque_Label"];
    }
	
	//Quando cria o objeto View � necess�rio passar o Titulo da P�gina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	//Chama a IUD
	$chequeMov->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formul�rio
	$form = new Form();
	
		$form->Fieldset();

			$form->Input('','hidden',array("name"=>'p_ChequeMov_Id',"value"=>$linhaSelected[ID]));

			$form->Input('Cheque','isel',	array("name"=>'p_Cheque',"href"=>'../box/cheque_isel.php','value'=>$dadosSelect[CHEQUE_ID],"label"=>$dadosSelect[CHEQUE_ID_R]));
			$form->Input("Alinea",'select',array("name"=>'p_Alinea_Id',"id"=>"AlineaId","value"=>$linhaSelected[ALINEA_ID], "option"=>$alinea->Calculate("Geral",$dbData)));
			$form->Input("Tipo de Movimenta��o",'select',array("name"=>'p_ChequeMovTi_Id',"id"=>"ChequeMovTiId","value"=>$linhaSelected[CHEQUEMOVTI_ID], "option"=>$chequeMovTi->Calculate("Geral",$dbData)));
			$form->Input("Valor Pago",'text',array("class"=>"size30",'name'=>'p_VlrPago','value'=>$linhaSelected[VLRPAGO]));
			$form->Input("Data da Movimenta��o",'text',array("name"=>'p_DtMovimento_Id',"value"=>$linhaSelected[DTMOVIMENTO]));
				
		$form->CloseFieldset ();				
		
		$form->Fieldset();	
		
			// Bot�es de a��o
			$form->IUDButtons();
					
		$form->CloseFieldset ();
	
	//fecha formul�rio
	unset($form);
		
	//Consultas dever�o ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search" || $_GET[p_Cheque_Id] != '')
	{	
	
		//Chamando o m�todo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($chequeMov->Query('qCheque',array("p_Cheque_Id"=>$_GET[p_Cheque_Id])));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
	
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Dt.Movimenta��o","Tipo de Movimenta��o","Cheque","Valor","Editar","Excluir"));
	
			//Obt�m as linhas da execu��o do arquivo .sql
			while($row = $dbData->RowLimit($_GET[page]))
						{
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($row[RECOGNIZE],array('align'=>'left'));
				$grid->Content($view->Edit($curso,$row[ID]));
				$grid->Content($view->Delete($curso,$row[ID]));
			}
		}

		//fecha grid
		unset($grid);	
		
		$dbData->Pagination();
		
	}	


	unset($chequeMov);
	unset($chequeMovTi);
	unset($Alinea);
	
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);
?>