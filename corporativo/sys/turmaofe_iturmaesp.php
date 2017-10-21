<?php 

include("../engine/User.class.php");
include("../engine/App.class.php");

$user = new User ();
$app = new App("Planilha de Equivalência de Turmas Especiais","Planilha de Equivalência de Turmas Especiais",array('ADM','CPD'),$user);

include("../engine/Db.class.php");
include("../engine/Navigation.class.php");
include("../engine/DataGrid.class.php");
include("../engine/ViewPage.class.php");
include("../engine/Form.class.php");
include("../engine/Ajax.class.php");

include("../model/WPessoa.class.php");
include("../model/CurrXDisc.class.php");
include("../model/Semana.class.php");
include("../model/Horario.class.php");

//Conectar o usuário ao Banco de Dados
$dbOracle = new Db ($user);

//Instanciar a DbData
$dbData = new DbData ($dbOracle);

//Instanciar Ajax
$ajax = new Ajax();

//Instanciar a classe que irá utilizar
$wpessoa 	= new WPessoa($dbOracle);
$currXDisc 	= new CurrXDisc($dbOracle);
$semana 	= new Semana($dbOracle);
$horario 	= new Horario($dbOracle);

//Quando cria o objeto View é necessário passar o Titulo da Página
$view = new ViewPage($app->title,$app->description);

$ajax->InputRequired('SemanaId','HorarioId','change',$horario->query["qPeriodoSemana"],array("p_Semana_Id"=>'SemanaId'),$_POST[p_Semana_Id]);

//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
//Opcional $nav
$view->Header($user,$nav);
	
//Instanciar formulário
$form = new Form();

$form->Fieldset("Professor/Aulas");
	$form->Input('','hidden',array("name"=>'p_WPessoa_Id',"value"=>$linhaSelected[ID]));
	$form->Input("Turma Especial",'text',array("class"=>"size5",'name'=>'p_NumeroDP','value'=>$_POST[p_NumeroDP]));
	$form->Input('Professor','isel',array("name"=>"p_WPessoa","href"=>"../box/wpessoa_iselprof.php","submit"=>"true","value"=>$linhaSelected[WPESSOA_ID],"label"=>$linhaSelected[WPESSOA_LABEL]));
	$form->Input("Quantidade de Aulas Semanais",'text',array("class"=>"size2",'name'=>'p_QtdeAulas','value'=>$_POST[p_QtdeAulas]));
	$form->Input("Sala",'text',array("class"=>"size5",'name'=>'p_Sala','value'=>$_POST[p_Sala]));
	$form->Input("Discriminação da Turma",'text',array("class"=>"size20",'name'=>'p_DiscriTurma','value'=>$_POST[p_DiscriTurma]));
$form->CloseFieldset ();

$form->Fieldset("Horário de Aulas");
	$form->Input("Dias da Semana",'select',array('name'=>'p_Semana_Id','id'=>'SemanaId','value'=>$_POST[p_Semana_Id],"option"=>$semana->Calculate("Semana")));
	$form->Input("Horário",'select',array('name'=>'p_Horario_Id','id'=>'HorarioId',"required"=>'1',"option"=>array("--")));
$form->CloseFieldset ();

$form->Fieldset("Disciplinas Equivalentes");
	$form->Input("Currículo",'text',array("class"=>"size10",'name'=>'p_Curr','value'=>$_POST[p_Curr]));
	$form->Input("Disciplina",'select',array('name'=>'p_CurrXDisc_Id',"id"=>"CurrXDiscId","required"=>'1','value'=>$_POST[p_CurrXDisc_Id],"option"=>$currXDisc->Calculate("Disciplina",array("p_Curr_Id"=>$p_Curr_Id))));	
$form->CloseFieldset ();

$form->Fieldset();
	// Botões de ação
	//$form->IUDButtons();
$form->CloseFieldset ();

//fecha formulário
unset($form);

unset($WPessoa);
unset($dbData);
unset($dbOracle);
unset($user);

?>