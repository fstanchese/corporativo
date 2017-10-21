<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usuário
	$user 			= new User ();
	
	//Instanciar a Aplicação
	$app = new App("Seleção de Professor","Seleção de Professor",array('ADM','HORARIOAULA','COORDPOS','CARTORIOEXP','PROUNI','TELEATENDIMENTO','DIRETORIAFINANCEIRA','CENTROPESQUISA','COBRANCA','CPA','DIRETORES','SECRETARIASDIRETORES','SAA','SECCOORDENADORIA','SECRETARIAGERAL','COORDENADORES','HORARIOPROVA','CPD','SALAPROFESSORES','REGISTRODIPLOMAS','MATRICULA','SECRETARIAESTAGIOS','COORDESTAGIO','POSGRADUACAO','DP','DOCENTE','POSGRADUACAOGER','SECRETARIAGERALGER','POSGRADUACAOGERG','SECRETARIAGERALCANCL','AUDIOVISUAL','CAAM','AVALIACAOINST','RH'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");

	include("../model/WPessoa.class.php");
 
	
	//Conectar o usuário ao Banco de Dados
	$db 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($db);
	
	//Instanciar a classe que irá utilizar
	$wpessoa = new WPessoa($db);
	
	
	$ajax = new Ajax();
	
	
	/**
	 * Quando cria o objeto View  necessário passar o Titulo da Página
	 */
	
	$vp = new ViewBox($app->title,$app->description);
	


	$vp->Header ();
	
	
	$form = new Form();
	
	$form->Fieldset();
	
	$form->Input("RG/RNE ou CODIGO",'text',array('class'=>'size10','name'=>'p_WPessoa_RGRNE','value'=>$_POST[p_WPessoa_RGRNE]));
	$form->Input("Nome",'text',array('class'=>'size60','name'=>'p_WPessoa_Nome','value'=>$_POST[p_WPessoa_Nome]));
		
	
	$ajax->GridRequired($wpessoa->query["qSelecaoProf"],array("NOME"=>"Nome","CODIGOFUNC"=>"Cod Func","RGRNE"=>"RG/RNE","CPF"=>"CPF"),array("p_WPessoa_RGRNE"=>'p_WPessoa_RGRNE',"p_WPessoa_Nome"=>'p_WPessoa_Nome'));
	
		
	$form->Button("button",array('name'=>'p_buscar','value'=>'Procurar',"id"=>"searchISel"));
	
	$form->CloseFieldset();
	
	unset($form);

	unset($dbData);
	unset($db);
	unset($vp);

	unset($wpessoa);
	unset($user);
	unset($app);
			
?>
						
