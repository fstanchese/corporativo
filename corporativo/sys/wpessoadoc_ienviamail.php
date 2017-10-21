<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Envio de e-mail - Documentos Pendentes por Departamento","Envio de e-mail - Documentos Pendentes por Departamento",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Ajax.class.php");
	
	include("../model/Depart.class.php");
	include("../model/Curso.class.php");
	include("../model/CursoNivel.class.php");
	include("../model/WPessoa.class.php");
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	$dbDataAux 	= new DbData($dbOracle);
	
	$ajax		= new Ajax($dbOracle);

	$depart 	= new Depart($dbOracle);
	$curso		= new Curso($dbOracle);
	$cursoNivel	= new CursoNivel($dbOracle);
	$wpessoa	= new WPessoa($dbOracle);

	
	$nav 		= new Navigation($user, $app,$dbData);
	//$ajax 		= new Ajax();
	
	$view = new ViewPage($app->title,$app->description);
	
	$view->Header($user,$nav);
	
	
	echo $view->JS( "				$('.marcar').click(function() {			
					if ($(this).is(':checked'))
					{
						$('.ccheck').attr('checked','TRUE');
					}
					else
					{
						$('.ccheck').removeAttr('checked');
					}
			
				});");
	

	$ajax->InputRequired("p_CursoNivel_Id","p_Curso_Id","change",$curso->query['qNivel'],array("p_CursoNivel_Id"=>"p_CursoNivel_Id"));
	
	$form = new Form();

	$form->Fieldset();
			
		$form->Input("Departamento",'select',array("name"=>'p_Depart_Id',"option"=>$depart->Calculate("Geral")));
		
		$form->Input('Nível do Curso','select' , array("name"=>'p_CursoNivel_Id',"option"=>$cursoNivel->Calculate()));
		
		$form->Input('Curso','select' , array("name"=>'p_Curso_Id',"option"=>array(""=>"Selecione Nível do Curso ou Faculdade ou Unidade")));
			
		
	$form->CloseFieldset ();
		
	$form->Fieldset();
						
		$form->Button("submit",array("name"=>"consultar","value"=>"Consultar"));
						
	$form->CloseFieldset ();	

	
	if ($_POST["btEnviar"] == "Enviar")
	{
		if (is_array($_POST[chReceb]))
		{
			foreach ($_POST[chReceb] as $linha)
			{
				_SendMail($linha, 'Teste do Sistema', 'Você acaba de receber um TESTE TESTE TESTE TESTE');
				sleep(1);
			}
			$view->Dialog('I', 'Documentos Pendentes', 'e-mails enviados');			
		}
		else
		{
			$view->Dialog('E', 'Documentos Pendentes', 'Não foi selecionado nenhum e-mail.');
		}
		

		
		
	}
	
	if($_POST[p_Depart_Id] != "")
	{
	
		$sql = "SELECT  
					distinct(WPessoaDoc.WPessoa_Id) as WPessoa_Id
				FROM
					WPessoaDoc,
					Matric,
					TurmaOfe,
					CurrOfe,
					Curr
				WHERE
					( '$_POST[p_Curso_Id]' is null or Curr.Curso_Id = '$_POST[p_Curso_Id]' )
				and
					CurrOfe.Curr_Id = Curr.Id
				and
					TurmaOfe.CurrOfe_Id = CurrOfe.Id
				and
					Matric.TurmaOfe_Id = TurmaOfe.Id
				and
					matric.id = (select max(id) from matric where matricti_id = 8300000000001 and wpessoa_Id = WPessoaDoc.WPessoa_Id)
				and
					( '$_POST[p_Depart_Id]' is null or WPessoaDoc.Depart_Id = '$_POST[p_Depart_Id]' )
				"; 

	

		$dbData->Get($sql);
	
		if($dbData->Count () > 0)
		{
	
			$grid = new DataGrid(array($view->CheckBox(array("class"=>"marcar")),"Código","Nome","e-mail","Fone Celular","Fone Residencial"));
	
			while($row = $dbData->Row ())
			{
	
				$aPessoa = $wpessoa->GetIdInfo($row[WPESSOA_ID]);
	
				$grid->Content($view->CheckBox(array("class"=>"ccheck","value"=>$aPessoa[EMAIL1],"name"=>"chReceb[]")));
				$grid->Content($aPessoa["CODIGO"],array('align'=>'left'));
				$grid->Content($aPessoa["NOME"],array('align'=>'left'));
				$grid->Content($aPessoa["EMAIL1"],array('align'=>'right'));
				$grid->Content($aPessoa["FONECEL"],array('align'=>'right'));
				$grid->Content($aPessoa["FONERES"],array('align'=>'right'));				
			}
			unset($grid);
			
			echo $view->Br() . $view->Br();
			$form->Fieldset();
			
			$form->Button("submit",array("name"=>"btEnviar","value"=>"Enviar"));
			
			$form->CloseFieldset ();
		}
		else
		{
			$view->Dialog('E', 'Documentos Pendentes','Não existem alunos com documentos pendentes no referido curso.');
		}
	}
	
	unset ($form);
	
	unset($view);	
	unset($nav);	
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>