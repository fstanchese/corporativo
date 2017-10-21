<?php
/*
 * P�gina para Consulta de Aparelhos Registrados no Google Cloud Messaging.
* Esta p�gina tem como objetivo consultar aparelhos que est�o cadastrados no GCM para envio de mensagens por PUSH.
* 
*/
include("../engine/User.class.php");
include("../engine/App.class.php");

$user = new User ();

//defini o nome da p�gina e roles do banco de dados
$app = new App("PUSH (Google Cloud Messaging)","Google Cloud Messaging", array('CPD'),$user);

include("../engine/Db.class.php");
include("../engine/Navigation.class.php");
include("../engine/DataGrid.class.php");
include("../engine/ViewPage.class.php");
include("../engine/Form.class.php");

include("../model/Push.class.php");
include("../model/WPessoa.class.php");

//inst�ncia os objetos do banco de dados
$dbOracle 	= new Db ($user);
$dbData 	= new DbData ($dbOracle);
$nav 		= new Navigation($user, $app,$dbData);

//inst�ncia o classe que mapeia a tabela que ser� utilizada na p�gina
$push = new Push($dbOracle);

if($_POST[p_O_Option] == "select")
{
	$dbData->Get($push->Query("qId",array("p_Push_Id"=>$_POST[p_Push_Id])));
	$linhaSelected = $dbData->Row();
}

//se a linha seleciona possuir o id da tablea utilizada na p�gina
if($_GET["p_Push_Id"] != "") {

	$linhaSelected[PUSH_ID] = $_GET["p_Push_Id"];	
}

$view = new ViewPage($app->title,$app->description);
$view->Explain ("IUD");

$push->IUD($_POST);

$view->Header($user,$nav);

//cria��o do formul�rio
$form = new Form();

$form->Fieldset();

//adicionando inputs no formul�rio
$form->Input('','hidden', array("name"=>'p_Push_Id',"value"=>$linhaSelected[ID]));

//se realizar uma sele��o de linha
if($_POST[p_O_Option] == "select")
{
	$form->Input('GCM Key','textarea', array("name"=>'p_GcmKey', "style"=>"width:80%;height:60px", "required"=>'1',"value"=>$linhaSelected[GCMKEY]));
	
	$form->Input('Mensagem','text', array("name"=>'p_Mensagem', "class"=>"size50", "required"=>'1'));
	
	$form->Input('','hidden', array("name"=>'p_Push_Submit', "value"=>'1'));	
	
	$form->Button ("submit",
			array ("name"=>"enviar", "value"=>"Enviar"));	
	
	$form->Button ("button",
			array ("name"=>"cancelar", "value"=>"Voltar","class"=>"cancel"));
	
	$form->CloseFieldset ();
	$form->Fieldset();
	
}else{
	
	$form->Input("Aluno",
			'autocomplete',
			array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_WPessoa_Id', "class"=>"size70", "required"=>'0'));
	
	$form->Button("button",
			array ("name"=>"consultar", "value"=>"Consultar","class"=>"search"));
	
	$form->Button ("button",
			array ("name"=>"cancelar", "value"=>"Cancelar","class"=>"cancel"));
	
	$form->CloseFieldset ();
	$form->Fieldset();
}

unset ($form);

//se clicar no bot�o Consultar
if($_GET["p_O_Option"] == "search")
{
	if($_GET["p_WPessoa_Id"] != "") {		
		$dbData->Get($push->Query('qWPessoa',array("p_WPessoa_Id"=>$_GET[p_WPessoa_Id])));
		
	} else{		
		$dbData->Get($push->Query('qGeral'));
	}	

	if($dbData->Count () > 0)
	{			
		//define as colunas do DataGrid
		$grid = new DataGrid(array("Push", "Del", "WPessoa_Id","Data Acesso", "Gcm Key"));

		while($row = $dbData->Row ())
		{
			//adiciona o conte�do da GetInfo() no DataGrid da tela
			$grid->Content($view->Edit($push,$row[ID]),array('align'=>'center'));
			$grid->Content($view->Delete($push,$row[ID]));
			$grid->Content($row[WPESSOA_ID],array('align'=>'center'));
			$grid->Content($row[DTACESSOFORMAT],array('align'=>'center'));
			$grid->Content($row[GCMKEY],array('align'=>'left'));
			
		}
	}	
	unset($grid);	
}

//se clicar no bot�o de Enviar
if($_POST["p_Push_Submit"] == "1")
{
	include_once '../lib/Gcm.php';
	$gcm = new GCM();
	
	$registration_ids = array($_POST["p_GcmKey"]);
	$message = array("price" => $_POST["p_Mensagem"]);
	
	$result = $gcm->notificar($registration_ids, $message);
	
	echo $result;		
	
	//$view->OkMsg("Mensagem Enviada!");
	
}

unset($view);
unset($push);
unset($nav);
unset($dbData);
unset($dbOracle);
unset($app);
unset($user);

?>