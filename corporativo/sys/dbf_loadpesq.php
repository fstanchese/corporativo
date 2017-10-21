<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user	= new User();
	$app	= new App("Carregar Conteúdo da Leitora Avaliação/Pesquisa/Simulado", "Carregar Conteúdo da Leitora Avaliação/Pesquisa/Simulado", array("ADM", "CPD"), $user);
	
	include("../engine/Db.class.php");
	include("../engine/Dbf.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/PesqFolha.class.php");
	
	$view	= new ViewPage($app->title, $app->description);

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	$pesqFolha = new PesqFolha($dbOracle);
	
	$view->Explain ("Ajuda");	
	$view->Header($user, $nav);
	
	$form = new Form();
	$form->Fieldset();
	
	$form->Input("Nome do arquivo DBF", "text", array("name"=>"p_DBFName"));
	$form->Button("submit", array("value"=>"Enviar"));
	
	$form->CloseFieldset();
	
	unset($form);

	if ($_POST[p_DBFName] != "")
	{
		echo  $_POST[p_DBFName];
		
		$dbf = new Dbf($_POST[p_DBFName]);		
		
		$info = $dbf->GetHeaderInfo();	
		
		while ($row = $dbf->Row())			
		{
			$p_PesqFolha_Id 		= $row[0];
			$p_PesqFolha_Conteudo 	= $row[1];
			
			$p_sql = "update pesqfolha set conteudo='".$p_PesqFolha_Conteudo."' where id=".$p_PesqFolha_Id;
			if ($dbData->Set($p_sql))
				{
					echo $p_sql;
					echo '<br>'; 					
					$dbData->Commit();				
				}
		}
	}	
	
	
	unset($view);
	unset($app);
	unset($user);

?>