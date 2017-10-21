<?php
/*
 * P�gina IIUD padr�o de Cadastro de Avisos.
 * Esta p�gina tem como objetivo ger�nciar avisos que ser�o visualizados em dispositivos m�veis.
 * Funcionalidades da p�gina: cadastro, consulta, altera��o e exclus�o.
 */

include("../engine/User.class.php");
include("../engine/App.class.php");

$user = new User ();

//defini o nome da p�gina e roles do banco de dados
$app = new App("Cadastro de Avisos","Cadastro de Avisos", array('ADM','CPD', 'MKT'),$user);

include("../engine/Db.class.php");
include("../engine/Navigation.class.php");
include("../engine/DataGrid.class.php");
include("../engine/ViewPage.class.php");
include("../engine/Form.class.php");

include("../model/Aviso.class.php");

//inst�ncia os objetos do banco de dados
$dbOracle 	= new Db ($user);
$dbData 	= new DbData ($dbOracle);
$nav 		= new Navigation($user, $app,$dbData);

//inst�ncia o classe que mapeia a tabela que ser� utilizada na p�gina
$aviso = new Aviso($dbOracle);

if($_POST[p_O_Option] == "select")
{
	$dbData->Get($aviso->Query("qId",array("p_Aviso_Id"=>$_POST[p_Aviso_Id])));
	$linhaSelected = $dbData->Row();
}

//se a linha seleciona possuir o id da tablea utilizada na p�gina
if($_GET["p_Aviso_Id"] != "") {

	$linhaSelected[AVISO_ID] = $_GET["p_Aviso_Id"];
}

$view = new ViewPage($app->title,$app->description);
$view->Explain ("IUD");

$aviso->IUD($_POST);

$view->Header($user,$nav);

//cria��o do formul�rio
$form = new Form();

$form->Fieldset();

//adicionando inputs no formul�rio
$form->Input('','hidden', array("name"=>'p_Aviso_Id',"value"=>$linhaSelected[ID]));
$form->Input('T�tulo','text', array("name"=>'p_Titulo', "class"=>"size50", "required"=>'1',"value"=>$linhaSelected[TITULO], "maxlength"=>'40'));
$form->Input('Mensagem','textarea', array("name"=>'p_Mensagem', "style"=>"width:80%;height:60px", "required"=>'1',"value"=>$linhaSelected[MENSAGEM], "maxlength"=>'300'));
$form->Input('Data de In�cio','date', array("name"=>'DtInicio',"value"=>$linhaSelected[DTINICIO]));
$form->Input('Data de T�rmino','date', array("name"=>'DtTermino',"value"=>$linhaSelected[DTTERMINO]));

$form->CloseFieldset ();

$form->Fieldset();

//adiciona os bot�es padr�es de uma IIUD no formul�rio
$form->IUDButtons();

$form->CloseFieldset ();

unset ($form);


if($_GET["p_O_Option"] == "search")
{

	//obt�m todas as colunas da tabela usada na p�gina	
	$dbData->Get($aviso->Query('qGeral'));

	//define as colunas do DataGrid
	$grid = new DataGrid(array("","T�tulo","Mensagem", "Data de In�cio", "Data de T�rmino","Editar","Del"));

	if($dbData->Count () > 0){

		while($row = $dbData->Row())
		{
			//adiciona o conte�do da GetInfo() no DataGrid da tela
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