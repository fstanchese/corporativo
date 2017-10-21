<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Consulta de Ocorrências por Aluno","Consulta de Ocorrências por Aluno",array("ADM","BIBLIOTECA","OCORRENCIA","GERENCIAADM","SECRETARIAESTAGIOS","SALAPROFESSORES","SECCOORDENADORIA","PROCCOORD","SALAPROFESSORESASS","DIRETORIAFINANCEIRA","SAA","SAA_ANALISTA","SALAPROFESSORESGER","SECRETARIAGERALGER","TELEATENDIMENTO","SECRETARIAGERAL","SECRETARIAESTAGIOS","SECRETARIASDIRETORES","DIRETORES","COMISSAOMATRICULA","CARTORIOEXP","CEPA","POSGRADUACAO","COORDPOS","CPD","COBRANCA"),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/WPessoa.class.php");
	include("../model/Matric.class.php");
	include("../model/WOcorr.class.php");



	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$ajax 		= new Ajax();
	$nav		= new Navigation($user, $app,$dbData);


	$wp 		= new WPessoa($dbOracle);
	$wocorr 	= new WOcorr($dbOracle);
	$matric 	= new Matric($dbOracle);
	$wocorrAux 	= new WOcorr($dbOracle);
	
	$view 		= new ViewPage($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	//
	$view->Header($user,$nav);

	//Chamar JS
	
	$js = "
			var vId = $(this).attr('idr');
				
			if($('#div_'+vId).html().length > 0)
			{
				if($('#div_'+vId).is(':visible'))
					$('#div_'+vId).hide();
				else
					$('#div_'+vId).show();
			}
			else
			{
				$('#div_'+vId).load('../ajax/gradalu_ialuno.ajax.php?vTipo=mostraDisc&Matric_Id='+vId,function(){
					$('#div_'+vId).show(1);
			
				});
			}
			";
			
	
	echo $view->On("click", ".matricCons",$js);
	echo $view->SetCSS(".matricCons {cursor:pointer}; .BoxCenter { width:100%} .BoxCenter div:first-child{margin: 0 auto}");
	
	
	

	$form = new Form();

		$form->Fieldset("Consulta da Ocorrências");
			
			$form->Input("Nome",'autocomplete',	array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_Nome', "class"=>"size70", "required"=>'1',"value"=>'1',"label"=>""));
			$form->Button ("submit", array ("name"=>"p_submit", "value"=>"Consultar","id"=>"btnLogin"));
			
		$form->CloseFieldset ();
		
		echo $view->Div(array("class"=>"BoxCenter")). $wp->GetInfoAluno( $_POST['p_Nome'] ).$view->CloseDiv();

		$dbData->Get($wocorr->Query('qAluno',array("p_WPessoa_Id"=>$_POST['p_Nome'])));

		while ($row = $dbData->Row())
		{
			if ($row[STATE_ID]  != "3000000011008")
			{
				echo $wocorrAux->GetOcorrInfo($row[ID]);
				
				//echo $view->Div(array("id"=>"div_".$row[ID],"style"=>"display:none;margin-bottom:5px")).$view->CloseDiv();				
			}
		}
		
		
	//fecha formulário
	unset ($form);
	
	
	
	unset($wp);
	unset($wocorr);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>