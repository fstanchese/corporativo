<?php
/*
 * Página IIUD padrão de Cadastro de Avisos.
 * Esta página tem como objetivo gerênciar avisos que serão visualizados em dispositivos móveis.
 * Funcionalidades da página: cadastro, consulta, alteração e exclusão.
 */

include("../engine/User.class.php");
include("../engine/App.class.php");

$user = new User ();

//defini o nome da página e roles do banco de dados
$app = new App("Cadastro de Avisos","Cadastro de Avisos", array('ADM','CPD', 'MKT'),$user);

include("../engine/Db.class.php");
include("../engine/Navigation.class.php");
include("../engine/DataGrid.class.php");
include("../engine/ViewPage.class.php");
include("../engine/Form.class.php");

include("../model/Aviso.class.php");

//instância os objetos do banco de dados
$dbOracle 	= new Db ($user);
$dbData 	= new DbData ($dbOracle);
$nav 		= new Navigation($user, $app,$dbData);

//instância o classe que mapeia a tabela que será utilizada na página
$aviso = new Aviso($dbOracle);

if($_POST[p_O_Option] == "select")
{
	$dbData->Get($aviso->Query("qId",array("p_Aviso_Id"=>$_POST[p_Aviso_Id])));
	$linhaSelected = $dbData->Row();
}

//se a linha seleciona possuir o id da tablea utilizada na página
if($_GET["p_Aviso_Id"] != "") {

	$linhaSelected[AVISO_ID] = $_GET["p_Aviso_Id"];
}

$view = new ViewPage($app->title,$app->description);
$view->Explain ("IUD");

$aviso->IUD($_POST);

$view->Header($user,$nav);

//criação do formulário
$form = new Form();

$form->Fieldset();

//adicionando inputs no formulário
$form->Input('','hidden', array("name"=>'p_Aviso_Id',"value"=>$linhaSelected[ID]));
$form->Input('Título','text', array("name"=>'p_Titulo', "class"=>"size50", "required"=>'1',"value"=>$linhaSelected[TITULO], "maxlength"=>'40'));
$form->Input('Mensagem','textarea', array("name"=>'p_Mensagem', "style"=>"width:80%;height:60px", "required"=>'1',"value"=>$linhaSelected[MENSAGEM], "maxlength"=>'300'));
$form->Input('Data de Início','date', array("name"=>'DtInicio',"value"=>$linhaSelected[DTINICIO]));
$form->Input('Data de Término','date', array("name"=>'DtTermino',"value"=>$linhaSelected[DTTERMINO]));

$form->CloseFieldset ();

$form->Fieldset();

//adiciona os botôes padrões de uma IIUD no formulário
$form->IUDButtons();

$form->CloseFieldset ();

unset ($form);


if($_GET["p_O_Option"] == "search")
{

	//obtêm todas as colunas da tabela usada na página	
	$dbData->Get($aviso->Query('qGeral'));

	//define as colunas do DataGrid
	$grid = new DataGrid(array("","Título","Mensagem", "Data de Início", "Data de Término","Editar","Del"));

	if($dbData->Count () > 0){

		while($row = $dbData->Row())
		{
			//adiciona o conteúdo da GetInfo() no DataGrid da tela
			$grid->Content($row[ID],array('style'=>'display: none;'));
			$grid->Content($row[TITULO],array('align'=>'left'));
			$grid->Content($row[MENSAGEM],array('align'=>'left'));
			$grid->Content($row[DTINICIO],array('align'=>'center'));
			$grid->Content($row[DTTERMINO],array('align'=>'center'));
			$grid->Content($view->Edit($aviso,$row[ID]));
			$grid->Content($view->Delete($aviso,$row[ID]));

		}
	}

	unset($grid);
}

unset($view);
unset($aviso);
unset($nav);
unset($dbData);
unset($dbOracle);
unset($app);
unset($user);


?>