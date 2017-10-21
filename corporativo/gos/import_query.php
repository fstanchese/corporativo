<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GOS - Importação de Arquivos QUERY","GOS - Importação de Arquivos QUERY",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//
	
	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewBox($app->title,$app->description);
	
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	//Opcional $nav
	$view->Header($user);
	
	
	
	

	
	
	echo "<h3>".$_GET[file]."</h3>";
	
	$file = file_get_contents("/oracle/system/osystem/sdl/".$_GET[dir]."/".$_GET[file].".sdl");
	
	
	$file = str_replace("select","SELECT",$file);
	$file = str_replace("and","AND",$file);
	$file = str_replace("or","OR",$file);
	$file = str_replace("from","FROM",$file);
	$file = str_replace("order by","ORDER BY",$file);
	$file = str_replace("group by","GROUP BY",$file);
	$file = str_replace("where","WHERE",$file);
	$file = str_replace("as","AS",$file);
	
	
	echo "<textarea style='width:95%;min-height:600px'>".$file."</textarea>";

	
	
	
	unset($view);
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);

?>