<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Impressão da Ata de Prova - Foto","Impressão da Ata de Prova - Foto",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");	
	
	include("../model/PLetivo.class.php");
	include("../model/CriAvalPDt.class.php");
	include("../model/Campus.class.php");
	include("../model/CursoNivel.class.php");
	include("../model/Curso.class.php");
	include("../model/Periodo.class.php");
	include("../model/AreaAcad.class.php");
	include("../model/TurmaOfe.class.php");
	include("../model/TOXCD.class.php");
	include("../model/DivTurma.class.php");
	include("../model/HoraProva.class.php");
	include("../model/CriAvalP.class.php");
	include("../model/WPessoa.class.php");
	
	$dbOracle = new Db ($user);
	$dbData = new DbData ($dbOracle);
	$ajax = new Ajax();
	
	$pLetivo 	= new PLetivo($dbOracle);
	$criAvalPDt = new CriAvalPDt($dbOracle);
	$campus		= new Campus($dbOracle);
	$cursoNivel	= new CursoNivel($dbOracle);
	$curso		= new Curso($dbOracle);
	$periodo	= new Periodo($dbOracle);
	$areaAcad	= new AreaAcad($dbOracle);
	$turmaOfe	= new TurmaOfe($dbOracle);
	$TOXCD		= new TOXCD($dbOracle);
	$divTurma	= new DivTurma($dbOracle);
	$horaProva	= new HoraProva($dbOracle);
	$criAvalP	= new CriAvalP($dbOracle);
	$wPessoa	= new WPessoa($dbOracle);
	
	$view = new ViewPage($app->title,$app->description);

	$css = '.cell { width:50%;
      				float:left;
      				text-align:left;
    			  }
    		.cell table td 
    			  {
      				font: 10px verdana;
      				line-height: 20px;
    			  }
    		.cell img 
    			  {
      				border:1px solid #111;
    			  }';
	
	echo $view->SetCSS($css);
	
	if ($_POST[p_PLetivo_Id] == '' || $_POST[p_CriAvalPDt_Id] == '' || $_POST[p_Campus_Id] == '')
	{	 
		echo $view->On("change","#CursoId", "$('#faculdadeId').hide();if ($(this).val() == 5700000000069) $('#faculdadeId').show();");
		echo $view->On("change","#CursoNivelId", "$('#faculdadeId').hide();if ($(this).val() == 5700000000069) $('#faculdadeId').show();");
		echo $view->On("change","#UnidadeId", "$('#faculdadeId').hide();if ($(this).val() == 5700000000069) $('#faculdadeId').show();");
		echo $view->On("change","#PLetivoId", "$('#faculdadeId').hide();if ($(this).val() == 5700000000069) $('#faculdadeId').show();");
	
	
		$ajax->InputRequired('PLetivoId'   ,'ProvaId','change',$criAvalPDt->query["qPLetivo"],array("p_PLetivo_Id"=>'PLetivoId'),$_POST[p_CriAvalPDt_Id]);
		$ajax->InputRequired('PLetivoId'   ,'CursoId','change',$curso->query["qCampus"]      ,array("p_Campus_Id"=>'UnidadeId',"p_CursoNivel_Id"=>'CursoNivelId',"p_PLetivo_Id"=>'PLetivoId',"p_Periodo_Id"=>'PeriodoId'),$_POST[p_PLetivo_Id]);
		$ajax->InputRequired('UnidadeId'   ,'CursoId','change',$curso->query["qCampus"]      ,array("p_Campus_Id"=>'UnidadeId',"p_CursoNivel_Id"=>'CursoNivelId',"p_PLetivo_Id"=>'PLetivoId',"p_Periodo_Id"=>'PeriodoId'),$_POST[p_Campus_Id]);
		$ajax->InputRequired('CursoNivelId','CursoId','change',$curso->query["qCampus"]      ,array("p_Campus_Id"=>'UnidadeId',"p_CursoNivel_Id"=>'CursoNivelId',"p_PLetivo_Id"=>'PLetivoId',"p_Periodo_Id"=>'PeriodoId'),$_POST[p_CursoNivel_Id]);
		$ajax->InputRequired('PeriodoId'   ,'CursoId','change',$curso->query["qCampus"]      ,array("p_Campus_Id"=>'UnidadeId',"p_CursoNivel_Id"=>'CursoNivelId',"p_PLetivo_Id"=>'PLetivoId',"p_Periodo_Id"=>'PeriodoId'),$_POST[p_Periodo_Id]);
		$ajax->InputRequired('CursoId'     ,'TurmaId','change',$turmaOfe->query["qCurso"]    ,array("p_CursoNivel_Id"=>'CursoNivelId',"p_Campus_Id"=>'UnidadeId',"p_Periodo_Id"=>'PeriodoId',"p_Curso_Id"=>'CursoId',"p_PLetivo_Id"=>'PLetivoId',"p_AreaAcad_Id"=>'AreaAcadId'),$_POST[p_Curso_Id]);
		$ajax->InputRequired('AreaAcadId'  ,'TurmaId','change',$turmaOfe->query["qCurso"]    ,array("p_CursoNivel_Id"=>'CursoNivelId',"p_Campus_Id"=>'UnidadeId',"p_Periodo_Id"=>'PeriodoId',"p_Curso_Id"=>'CursoId',"p_PLetivo_Id"=>'PLetivoId',"p_AreaAcad_Id"=>'AreaAcadId'),$_POST[p_AreaAcad_Id]);
		$ajax->InputRequired('TurmaId'     ,'TOXCDId','change',$TOXCD->query["qTurmaOfe"]    ,array("p_TurmaOfe_Id"=>'TurmaId'),$_POST[p_TurmaOfe_Id]);
	
		$view->Header($user,$nav);
	
		$p_Ciclo_Id = 5400000000001;
		
		$form = new Form();
	
			$form->Fieldset();
	
				$form->Input("Periodo Letivo",'select',array('name'=>'p_PLetivo_Id',"id"=>"PLetivoId","required"=>'1','value'=>$_POST[p_PLetivo_Id],"option"=>$pLetivo->Calculate("CriAvalAp",array("p_Ciclo_Id"=>$p_Ciclo_Id))));
				$form->Input("Prova",'select',array('name'=>'p_CriAvalPDt_Id',"id"=>"ProvaId","required"=>'1',"option"=>array("--")));
				$form->Input("Unidade",'select',array('name'=>'p_Campus_Id',"id"=>"UnidadeId","required"=>'1','value'=>$_POST[p_Campus_Id],"option"=>$campus->Calculate("Geral")));
				$form->Input("Curso Nivel",'select',array('name'=>'p_CursoNivel_Id',"id"=>"CursoNivelId",'value'=>$_POST[p_CursoNivel_Id],"option"=>$cursoNivel->Calculate("Geral")));
				$form->Input("Período",'select',array('name'=>'p_Periodo_Id',"id"=>"PeriodoId",'value'=>$_POST[p_Periodo_Id],"option"=>$periodo->Calculate("Geral")));
				$form->Input("Curso",'select',array('name'=>'p_Curso_Id',"id"=>"CursoId","option"=>array("--")));

				$display = "none";
				if ($_POST[p_Curso_Id] == 5700000000069)						{
					$display = "block";
				}
				echo "<div id='faculdadeId' style='display:".$display."'>";
					$form->Input("Faculdade",'select',array('name'=>'p_AreaAcad_Id',"id"=>"AreaAcadId",'value'=>$_POST[p_AreaAcad_Id],"option"=>$areaAcad->Calculate("Geral")));				
				echo "</div>";
				$form->Input("Turma",'select',array('name'=>'p_TurmaOfe_Id',"id"=>"TurmaId","option"=>array("--")));
				$form->Input("Disciplina",'select',array('name'=>'p_TOXCD_Id',"id"=>"TOXCDId","option"=>array("--")));
				$form->Input("Divisão",'select',array('name'=>'p_DivTurma_Id',"id"=>"DivTurmaId",'value'=>$_POST[p_DivTurma_Id],"option"=>$divTurma->Calculate("Prova")));
				$form->Input('Início Validade','date',array("class"=>"size10",'name'=>'p_HoraAula_DtInicio','value'=>$_POST[p_HoraAula_DtInicio]));
				$form->Input('Término Validade','date',array("class"=>"size10",'name'=>'p_HoraAula_DtTermino','value'=>$_POST[p_HoraAula_DtTermino]));				
			
			$form->CloseFieldset ();
	
			$form->Fieldset();
				$form->Button('submit');
			$form->CloseFieldset ();
		//fecha formulário
		unset($form);		
	}
	else
	{
		
		$p_PLetivo_Id			= $_POST[p_PLetivo_Id];
		$p_CriAvalPDt_Id		= $_POST[p_CriAvalPDt_Id];
		$p_CursoNivel_Id		= $_POST[p_CursoNivel_Id];
		$p_Campus_Id			= $_POST[p_Campus_Id];
		$p_Periodo_Id			= $_POST[p_Periodo_Id];
		$p_Curso_Id 			= $_POST[p_Curso_Id];
		$p_TurmaOfe_Id			= $_POST[p_TurmaOfe_Id];
		$p_TOXCD_Id				= $_POST[p_TOXCD_Id];
		$p_DivTurma_Id			= $_POST[p_DivTurma_Id];
		$p_HoraAula_DtInicio	= $_POST[p_HoraAula_DtInicio];
		$p_HoraAula_DtTermino	= $_POST[p_HoraAula_DTermino];

		$v_lin   = 1;
		$v_pag   = 1;
		$v_first = 1;

		$rowPLetivo		= $pLetivo->GetIdInfo($p_PLetivo_Id);
		$rowCriAvalPDt 	= $criAvalPDt->GetIdInfo($p_CriAvalPDt_Id);
		$p_CriAvalP_Id 	= $rowCriAvalPDt[CRIAVALP_ID];
		
		$rowCriAvalP 	= $criAvalP->GetIdInfo($p_CriAvalP_Id);
		$vSubs 			= $rowCriAvalP[SUBSTITUTIVA];
		$nameQuery 		= 'qAtaAlunos';
		if ($vSubs==1)
			$nameQuery	= 'qAtaAlunosSub';
				
		$dbAtaProva = new DbData ($dbOracle);						
		$dbAtaProva->Get($horaProva->Query('qAtaProva',array("p_CriAvalPDt_Id"=>$p_CriAvalPDt_Id,"p_HoraAula_DtInicio"=>$p_HoraAula_DtTermino,"p_HoraAula_DtTermino"=>$p_HoraAula_DtTermino,"p_Curso_Id"=>$p_Curso_Id,"p_TOXCD_Id"=>$p_TOXCD_Id,"p_Periodo_Id"=>$p_Periodo_Id,"p_DivTurma_Id"=>$p_DivTurma_Id,"p_TurmaOfe_Id"=>$p_TurmaOfe_Id,"p_Campus_Id"=>$p_Campus_Id,"p_AreaAcad_Id"=>$p_AreaAcad_Id)));

	
		//Se a consulta possuir resultados
		if($dbAtaProva->Count () > 0)
		{

			require_once("../engine/ViewReport.class.php");
			$viewReport = new ViewReport($app->title,'Ata de Prova / ' . $rowCriAvalPDt[RECOGNIZE]. ' de ' . $rowPLetivo[NOME],array("col 1","col 2","col 3","col 4"),"retrato",13);
			$first = 0;
							
			//Obtêm as linhas da execução do arquivo .sql
			while($row = $dbAtaProva->Row())
			{
        		$v_first2  = 1; 
        		$v_lin     = 1; 
        		$v_pag     = 1; 
        		$v_contador = 0;  
								
				$p_DivTurma_Id 	= $row[DIVTURMA_ID];
				$p_TOXCD_Id    	= $row[TOXCD_ID];
				$p_TurmaTi_Id  	= $row[TURMATI_ID];
				$p_TurmaOfe_Id  = $row[TURMAOFE_ID];				

				$dbAtaAluno = new DbData ($dbOracle);
				$dbAtaAluno->Get($horaProva->Query( $nameQuery ,array("p_TOXCD_Id"=>$p_TOXCD_Id,"p_TurmaTi_Id"=>$p_TurmaTi_Id,"p_Campus_Id"=>$p_Campus_Id,"p_DivTurma_Id"=>$p_DivTurma_Id)));

				$v_contador = $dbAtaAluno->Count();
				if ($v_contador % 28 == 0)
					$v_qtdpag = round(($v_contador/26),0);
				else
					$v_qtdpag = round(($v_contador/26)+0.5,0);			

				$viewReport->SetTotalPag($v_qtdpag);
				$vseq = 0;
				
				$html = '<table border=1 cellpadding=1 cellspacing=1 width=750>';
				$html .= '<tr bgcolor=#DDDDDD style="font-family:verdana,arial;font-size:7pt">';
				$html .= '<td align=left height=1 width=9%> Curso</td>';
				$html .= '<td align=left height=1 width=50%>'. $row[CURSO] .'</td>';
				$html .= '<td align=left height=1 width=25%>&nbsp;'.'Turma: ' . $row[TURMA]. ' / ' . $row[DIVTURMA].'</td>';
				$html .= '<td align=left height=1 width=24%>Qtd Alunos : '.$v_contador.'</td>';
				$html .= '</tr>';
				$html .= '<tr bgcolor=#DDDDDD style="font-family:verdana,arial;font-size:7pt">';
				$html .= '<td align=left height=1 width=9%> Disciplina</td>';
				$html .= '<td align=left height=1 width=50%>'. $row[CODDISC] .'&nbsp;&nbsp;&nbsp;/ '. $row[NOMEDISC] .'</td>';
				$html .= '<td align=left colspan=2 height=1 width=41%>&nbsp;Data: '.$row[DIA].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Horário: '.$row[HORA].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sala: '.$row[SALA].' </td>';
				$html .= '</tr>';
				$html .= '</table>';
				
				if ($first==0)
				{
						
					$viewReport->Header(array("Foto","Dados Pessoais","Foto","Dados Pessoais"),$html);					
					$first=1;					
				}
				else
				{
					$viewReport->Footer();
					$viewReport->reiniciarPaginacao();
					$viewReport->Header(null,$html);						
				}						
					
				if ($dbAtaAluno->Count() > 0)
				{
				
					//Obtêm as linhas da execução do arquivo .sql
					while($row2 = $dbAtaAluno->Row())
					{
						$vseq++;
						$viewReport->Content($wPessoa->GetFoto($row2[WPESSOA_ID],array("width"=>'50')));					
						$vcab = 'Seq: '.$vseq.'<br>RA: '.$row2[CODIGO].'<br>Nome: '.substr($row2[ALUNO],0,20).'<br><br>Assinatura: __________________________________';						
						$viewReport->Content($vcab);
						
					}
					
					$pagina = $viewReport->page;
					if ($pagina % 2 == 0)
					{
						$viewReport->Footer();
						$viewReport->reiniciarPaginacao();
					}
					
				}
											
		
			}
			
			//fecha relatorio
			unset ($viewReport);
				
		}		
		
	}
	
	unset($user);
	unset($app);	
	unset($dbData);	
	unset($dbOracle);	
	unset($ajax);
	unset($view);
	
	unset($pLetivo);
	unset($criAvalPDt);
	unset($campus);
	unset($cursoNivel);
	unset($curso);
	unset($periodo);
	unset($areaAcad);
	unset($turmaOfe);
	unset($TOXCD);
	unset($divTurma);
	unset($horaProva);
	unset($criAvalP);
	unset($wPessoa);
	
?>
