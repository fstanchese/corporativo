<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");	

	$user = new User ();
	$app = new App("Convocação às Cerimônias","Convocação às Cerimônias",array('ADM','CPD','COLACAOGRAU'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/ColacaoGrau.class.php");
	include("../model/ColacaoGrauTi.class.php");	
	include("../model/Curso.class.php");
	include("../model/Campus.class.php");
	include("../model/PLetivo.class.php");
	include("../model/CurrOfe.class.php");
	include("../model/TurmaOfe.class.php");
	
	
	$dbOracle 	= new Db ($user);
	
	$dbData 	= new DbData ($dbOracle);

	$ajax = new Ajax();
	
	$nav 		= new Navigation($user, $app, $dbData);
		
	$colacaoGrau 	= new ColacaoGrau($dbOracle);
	$colacaoGrauTi	= new ColacaoGrauTi($dbOracle);
	$curso 			= new Curso($dbOracle);
	$campus 		= new Campus($dbOracle);
	$cursoNivel 	= new Curso($dbOracle);
	$pLetivo 		= new PLetivo($dbOracle);
	$currOfe		= new CurrOfe($dbOracle);
	$turmaOfe		= new TurmaOfe($dbOracle);
	
	$view = new ViewPage($app->title,$app->description);

	$ajax->InputRequired('DtColacaoId','TurmaId','change',$colacaoGrau->query["qDataColacao"],array('p_DtColacao'=>"DtColacaoId"),$_POST[p_Turma_Id]);
	
	$view->Header($user,$nav);	
	
	
	$js = "
		var \$botao  = $(this);			
		$.Zebra_Dialog( 'Confirma Convocação ?', 
		{
    	'type': 'question',
    	'title': '',
		'keyboard' : false,
		'overlay_close' : false,
		'show_close_button' : false,			
    	'buttons': 
		[
                   { caption:'Sim', callback:function() 
                   							{ 
												$.ajax 
												(
													{
			  											type: 'POST',
														url: '../ajax/colacaograu.ajax.php',
			  											data:'p_DiplProc_Id='+\$botao.attr('IdProc'),
			  											beforeSend:_ShowLoading,
			  											success: function(msg) { _HideLoading(); \$botao.attr('disabled','true'); \$botao.closest('tr').css('background','#BEF781'); }
 													}  
												);
											}
					},
                    { caption: 'Não', callback: function() { \$botao.attr('checked',false) } }
    	] 
	   } 
	);";	
	
	echo $view->On('click','.DiplProc',$js);
			
	$form = new Form();
	
	$form->Fieldset();

		$form->Input('Data da Colação','date',array("class"=>"size10",'name'=>'p_DtColacao',"id"=>"DtColacaoId","required"=>'1','value'=>$_POST[p_DtColacao]));	
		$form->Input('Turma','select',array("name"=>'p_Turma_Id','style'=>'width:20%',"id"=>"TurmaId","option"=>array("--")));
		
	$form->CloseFieldset ();	

	$form->Fieldset();
		$form->Button('submit');
	$form->CloseFieldset ();
	
	
	if ($_POST[p_Turma_Id] != '')
	{

		$p_Turma_Id = $_POST[p_Turma_Id]; 
		$dbData->Get($colacaoGrau->Query('qConvocacao',array("p_Turma_Id"=>$p_Turma_Id,"p_DtColacao"=>$_POST[p_DtColacao])));
				
		if($dbData->Count() > 0)
		{
	
			$grid = new DataGrid(array("Ano de <br>Conclusão","Nº Processo","Modalidade","RA","Nome","Situação","Convocar"),null,false);				
			
			while($row = $dbData->Row ())
			{
				$v_disabled = '';
				$v_color = "";
				$v_checked = '';
				if ($row[DTCONVOCACAO] == '')
				{
					$v_disabled = '';
					$v_color = "background:#FA5858";
					$v_checked = '';
				}				
				if ($row[DTCONVOCACAO] != '')
				{
					$v_disabled = 'disabled';
					$v_color = "background:#BEF781";
					$v_checked = 'on';
				}
				if ($row[DTCONVOCACAO] != '' && $row[DTCONSULTA] != '')
				{
					$v_disabled = 'disabled';
					$v_color = "background:#5882FA";
					$v_checked = 'on';
				}
				
				
				$grid->Content($row[CONCLUSAO],array('align'=>'left','style'=>$v_color));
				$grid->Content($row[NUMPROC],array('align'=>'left','style'=>$v_color));
				$grid->Content($row[MODALIDADE],array('align'=>'left','style'=>$v_color));
				$grid->Content($row[RA],array('align'=>'left','style'=>$v_color));
				$grid->Content($row[NOME],array('align'=>'left','style'=>$v_color));
				$grid->Content($row[SITUACAO],array('align'=>'left','style'=>$v_color));				
				$grid->Content($view->CheckBox(array('checked'=>$v_checked,'disabled'=>$v_disabled,'class'=>'DiplProc','IdProc'=>$row[ID])),array('align'=>'left','style'=>$v_color));
				
			}
		}
	
		unset($grid);
						
	}	
		
	
	unset($colacaoGrau);
	unset($colacaoGrauTi);
	unset($curso);
	unset($campus);
	unset($cursoNivel);
	unset($pLetivo);
	unset($currOfe);
	unset($turmaOfe);
	
	?>
			