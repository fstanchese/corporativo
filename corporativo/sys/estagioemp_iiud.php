<?php
include("../engine/User.class.php");
include("../engine/App.class.php");

$user = new User ();
$app = new App("Cadastro de Empresas Conveniadas com Est�gios USJT","Cadastro de Empresas Conveniadas com Est�gios USJT",array('ADM','SECRETARIAESTAGIOS'),$user);

include("../engine/Db.class.php");
include("../engine/Navigation.class.php");
include("../engine/DataGrid.class.php");
include("../engine/ViewPage.class.php");
include("../engine/Form.class.php");

include("../model/EstagioEmp.class.php");

//Conectar o usu�rio ao Banco de Dados
$dbOracle = new Db ($user);

//Instanciar a DbData
$dbData = new DbData ($dbOracle);

//Instanciar a classe que ir� utilizar
$estagioemp = new EstagioEmp($dbOracle);

//se o p_O_Option for  == select - ent�o 1 linha foi selecionada
if($_POST[p_O_Option] == "select")
{
	$dbData->Get($EstagioEmp->Query("qGeral",array("p_EstagioEmp_Id"=>$_POST[p_EstagioEmp_Id])));
	$linhaSelected = $dbData->Row();
}
	
//Quando cria o objeto View � necess�rio passar o Titulo da P�gina
$view = new ViewPage($app->title,$app->description);
$view->Explain ("IUD");
	
//Chama a IUD
$EstagioEmp->IUD($_POST);

//Para montar o Header precisa passar o nome do Usu�rio e os Departamentos dele
//Opcional $nav
$view->Header($user,$nav);

//Instanciar formul�rio
$form = new Form();

	$form->Fieldset();
	
		$form->Input('','hidden',array("name"=>'p_EstagioEmp_Id',"value"=>$linhaSelected[ID]));
		$form->Input("Raz�o Social",'text',array("class"=>"size100",'name'=>'p_Razao','value'=>$linhaSelected[RAZAO]));
		$form->Input("Nome Fantasia",'text',array("class"=>"size50",'name'=>'p_Fantasia','value'=>$linhaSelected[FANTASIA]));
		$form->Input("CNPJ",'text',array("class"=>"size14",'name'=>'p_CNPJ','value'=>$linhaSelected[CNPJ]));
		$form->Input("Inscri��o Estadual",'text',array("class"=>"size8",'name'=>'p_IE','value'=>$linhaSelected[IE]));

	$form->CloseFieldset ();

	$form->Fieldset();
		// Bot�es de a��o
		$form->IUDButtons();
	$form->CloseFieldset ();

//fecha formul�rio
unset($form);

//Consultas dever�o ser feitas somente se p_O_Option == 'search'
if($_GET["p_O_Option"] == "search")
{

	//Chamando o m�todo Query passando o arquivo .sql para a realizar a consulta.
	$dbData->Get($EstagioEmp->Query('qGeral'));

	//Se a consulta possuir resultados
	if($dbData->Count() > 0)
	{

		//Instancia o DataGrid passando as colunas
		$grid = new DataGrid(array("Nome","Editar","Excluir"));

		//Obt�m as linhas da execu��o do arquivo .sql
		while($row = $dbData->RowLimit($_GET[page]))
		{
			$grid->Content($row[RECOGNIZE],array('align'=>'left'));
			$grid->Content($view->Edit($EstagioEmp,$row[ID]));
			$grid->Content($view->Delete($EstagioEmp,$row[ID]));
		}
	}

	//fecha grid
	unset($grid);

	$dbData->Pagination();

}

unset($EstagioEmp);
unset($dbData);
unset($dbOracle);
unset($user);

?>