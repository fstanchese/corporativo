<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Grade Curricular do Aluno - Consulta Notas","Grade Curricular do Aluno - Consulta Notas",array('ADM','COORDPOS','CARTORIOEXP','PROUNI','TELEATENDIMENTO','DIRETORIAFINANCEIRA','CENTROPESQUISA','COBRANCA','CPA','DIRETORES','SECRETARIASDIRETORES','SAA','SECCOORDENADORIA','SECRETARIAGERAL','COORDENADORES','HORARIOPROVA','CPD','SALAPROFESSORES','REGISTRODIPLOMAS','MATRICULA','SECRETARIAESTAGIOS','COORDESTAGIO','POSGRADUACAO','COORDPOS','BOLSA','ARQHISTORICO','CAAM','PROFESSORES'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/WPessoa.class.php");
	include("../model/Matric.class.php");
	include("../model/GradAlu.class.php");



	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	$ajax = new Ajax();
	
	
	$nav = new Navigation($user, $app,$dbData);

	
	$wp = new WPessoa($dbOracle);
	$gradalu = new GradAlu($dbOracle);
	$matric = new Matric($dbOracle);

		
	$view = new ViewPage($app->title,$app->description);

	
	$view->Header($user,$nav);

	//Chamar JS
	
	$js = "
			var vId = $(this).attr('id');
			var vIdEnc = $(this).attr('idr');
				
			if($('#div_'+vId).html().length > 0)
			{
				if($('#div_'+vId).is(':visible'))
					$('#div_'+vId).hide();
				else
					$('#div_'+vId).show();
			}
			else
			{
				_ShowLoading();
				$('#div_'+vId).load('../ajax/gradalu_ialuno.ajax.php?vTipo=mostraDisc&Matric_Id='+vIdEnc,function(){
					_HideLoading();
					$('#div_'+vId).show(1);
			
				});
			}
			";
			
	
	echo $view->On("click", ".matricCons",$js);
	echo $view->SetCSS(".matricCons {cursor:pointer}; .BoxCenter { width:100%} .BoxCenter div:first-child{margin: 0 auto}");
	
	
	
	//Instanciar formulário
	$form = new Form();

		$form->Fieldset("Consulta da Grade Curricular");
		
			
			$form->Input("Nome",
					'autocomplete',
					array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_Nome', "class"=>"size70", "required"=>'1',"value"=>'1600000001234',"label"=>""));
			
			$form->Button ("submit", array ("name"=>"p_submit", "value"=>"Consultar","id"=>"btnLogin"));
			
		$form->CloseFieldset ();
		
		echo $view->Div(array("class"=>"BoxCenter")). $wp->GetInfoAluno( $_POST['p_Nome'] ).$view->CloseDiv();
		

		$dbData->Get($matric->Query('qWPessoaPLetivo',array("p_WPessoa_Id"=>$_POST['p_Nome'],"p_O_Data"=>date('d/m/Y'))));
			
		while ($row = $dbData->Row())
		{
			if ($row["MATRICTI_ID"] == '8300000000001' && $row["STATE_ID"] > '3000000002001')
			{				
				
				echo $matric->GetStateMatricInfo($row[ID],array("class"=>"matricCons","id"=>$row[ID],"idr"=>_UrlEncrypt($row[ID])),'on');				
				echo $view->Div(array("id"=>"div_".$row[ID],"style"=>"display:none;margin-bottom:5px")).$view->CloseDiv();
								
			}
		}
		
		
	//fecha formulário
	unset ($form);
	
	
	
	unset($wp);
	unset($matric);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>