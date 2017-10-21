<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Movimentaчуo de Cheque","Cadastro de Movimentaчуo de Cheque",array('ADM','CPD','COBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/ChequeMov.class.php");
	include("../model/ChequeMovTi.class.php");
	include("../model/Alinea.class.php");

	//Conectar o usuсrio ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navegaчуo da Pсgina
	$nav = new Navigation($user, $app, $dbData);
	
	//Instanciar a classe que irс utilizar
	$chequeMov   = new ChequeMov($dbOracle);
	$chequeMovTi = new ChequeMovTi($dbOracle);
	$alinea = new Alinea($dbOracle);

	
	//se o p_O_Option for  == select - entуo 1 linha foi selecionada
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
	
	//Quando cria o objeto View щ necessсrio passar o Titulo da Pсgina
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");
	
	//Chama a IUD
	$chequeMov->IUD($_POST,$dbData);
	
	//Para montar o Header precisa passar o nome do Usuсrio e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formulсrio
	$form = new Form();
	
		$form->Fieldset();

			$form->Input('','hidden',array("name"=>'p_ChequeMov_Id',"value"=>$linhaSelected[ID]));

			$form->Input('Cheque','isel',	array("name"=>'p_Cheque',"href"=>'../box/cheque_isel.php','value'=>$dadosSelect[CHEQUE_ID],"label"=>$dadosSelect[CHEQUE_ID_R]));
			$form->Input("Alinea",'select',array("name"=>'p_Alinea_Id',"id"=>"AlineaId","value"=>$linhaSelected[ALINEA_ID], "option"=>$alinea->Calculate("Geral",$dbData)));
			$form->Input("Tipo de Movimentaчуo",'select',array("name"=>'p_ChequeMovTi_Id',"id"=>"ChequeMovTiId","value"=>$linhaSelected[CHEQUEMOVTI_ID], "option"=>$chequeMovTi->Calculate("Geral",$dbData)));
			$form->Input("Valor Pago",'text',array("class"=>"size30",'name'=>'p_VlrPago','value'=>$linhaSelected[VLRPAGO]));
			$form->Input("Data da Movimentaчуo",'text',array("name"=>'p_DtMovimento_Id',"value"=>$linhaSelected[DTMOVIMENTO]));
				
		$form->CloseFieldset ();				
		
		$form->Fieldset();	
		
			// Botѕes de aчуo
			$form->IUDButtons();
					
		$form->CloseFieldset ();
	
	//fecha formulсrio
	unset($form);
		
	//Consultas deverуo ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search" || $_GET[p_Cheque_Id] != '')
	{	
	
		//Chamando o mщtodo Query passando o arquivo .sql para a realizar a consulta.
		$dbData->Get($chequeMov->Query('qCheque',array("p_Cheque_Id"=>$_GET[p_Cheque_Id])));
	
		//Se a consulta possuir resultados
		if($dbData->Count () > 0)
		{
	
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("Dt.Movimentaчуo","Tipo de Movimentaчуo","Cheque","Valor","Editar","Excluir"));
	
			//Obtъm as linhas da execuчуo do arquivo .sql
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