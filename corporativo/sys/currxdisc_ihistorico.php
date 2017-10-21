<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user = new User ();
	$app = new App("Currículos X Disciplinas - Formatação Histórico Escolar","Currículos X Disciplinas - Formatação Histórico Escolar",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/CurrXDisc.class.php");
	include("../model/Curr.class.php");	
	include("../model/CursoNivel.class.php");
	include("../model/Curso.class.php");
	
	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);

	$dbData = new DbData ($dbOracle);
	
	$ajax = new Ajax();
	
	//Instanciar a Navegação da Página
	$nav = new Navigation($user, $app, $dbData);
	
	// Instanciar a classe que irá utilizar
	$currXDisc		= new CurrXDisc($dbOracle);
	$curr			= new Curr($dbOracle);
	$cursoNivel		= new CursoNivel($dbOracle);
	$curso			= new Curso($dbOracle);
	
	// Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");

	// Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	// Opcional $nav
	$view->Header($user,$nav);
	
	//Instanciar formulário
	$form = new Form();	

		$form->Fieldset();
		// Botões de ação
		$form->Button('button',array('class'=>'search','value'=>'Processar'));
		$form->CloseFieldset ();
	
	//fecha formulário
	unset($form);
	
	$p_PLetivo_Id = 7200000000091;
	
	//Consultas deverão ser feitas somente se p_O_Option == 'search'
	if($_GET["p_O_Option"] == "search")
	{
		
		//Instancia o DataGrid passando as colunas
		$grid = new DataGrid(array("Seq","Série","Currículo","Código Disciplina","Nome da Disciplina"),null,false);
		
		$dbCursoNivel = new DbData ($dbOracle);
		$dbCursoNivel->Get($cursoNivel->Query('qGeral'));
		
		while($rowCursoNivel = $dbCursoNivel->Row())
		{	
			
			if ($rowCursoNivel[ID] == 6200000000001 || $rowCursoNivel[ID] == 6200000000010 || $rowCursoNivel[ID] == 6200000000012)
			{
							
				$p_CursoNivel_Id = $rowCursoNivel[ID];
				
				$dbCurso = new DbData ($dbOracle);
				$dbCurso->Get($curso->Query('qNivel',array("p_CursoNivel_Id"=>$p_CursoNivel_Id)));

				if ($dbCurso->Count() > 0)
				{
				
					while($rowCurso = $dbCurso->Row())
					{
						
						$p_Curso_Id = $rowCurso[ID];

						$dbCurr = new DbData ($dbOracle);
						$dbCurr->Get($curr->Query('qCampus',array("p_PLetivo_Id"=>$p_PLetivo_Id,"p_Curso_Id"=>$p_Curso_Id)));
						$dbCurr->showQuery();		
						if ($dbCurr->Count() > 0)
						{	
							while($rowCurr = $dbCurr->Row())
							{
								$p_Curr_Id = $rowCurr[ID];
																
								$dbCurrXDisc = new DbData ($dbOracle);
								$dbCurrXDisc->Get($currXDisc->Query('qSequencia',array("p_Curr_Id"=>$p_Curr_Id)));
								$v_sequencia = 1;
								
								while($rowCurrXDisc = $dbCurrXDisc->Row())
								{
							
									$grid->Content($rowCurrXDisc[FICHASEQUENCIA],array('align'=>'left','width'=>'5%'));
									$grid->Content($rowCurrXDisc[SERIE],array('align'=>'left','width'=>'5%'));
									$grid->Content($rowCurrXDisc[CODCURR],array('align'=>'left','width'=>'10%'));
									$grid->Content($rowCurrXDisc[CODDISC],array('align'=>'left','width'=>'10%'));
									$grid->Content($rowCurrXDisc[NOMDISC],array('align'=>'left','width'=>'65%'));							
									
								}
								
								unset($dbCurrXDisc);
								
								$grid->Content('---',array('align'=>'left','width'=>'5%'));
								$grid->Content('-------',array('align'=>'left','width'=>'5%'));
								$grid->Content('----------',array('align'=>'left','width'=>'10%'));
								$grid->Content('----------',array('align'=>'left','width'=>'10%'));
								$grid->Content('------------------------------------------------------------',array('align'=>'left','width'=>'65%'));
								
							}					
						}
						
						$grid->Content('---',array('align'=>'left','width'=>'5%'));
						$grid->Content('-------',array('align'=>'left','width'=>'5%'));
						$grid->Content('----------',array('align'=>'left','width'=>'10%'));
						$grid->Content('----------',array('align'=>'left','width'=>'10%'));
						$grid->Content('------------------------------------------------------------',array('align'=>'left','width'=>'65%'));
						unset($dbCurr);
					}		
				}
				unset($dbCurso);
			}
			
		}
		
		unset($dbCursoNivel);		
		unset($grid);		
	}	
			
	unset($currXDisc);
	unset($curr);
	unset($curso);

	unset($dbOracle);
	
	unset($user);
?>	