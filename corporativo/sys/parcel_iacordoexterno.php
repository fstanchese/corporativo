<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Parcelamento Externo - Cadastro de Acordo","Parcelamento Externo - Cadastro de Acordo",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Ajax.class.php");
	
	include("../model/WPessoa.class.php");
	include("../model/Boleto.class.php");


	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	$ajax = new Ajax();
	
	
	$nav = new Navigation($user, $app,$dbData);

	
	$wp 		= new WPessoa($dbOracle);
	$boleto 	= new Boleto($dbOracle);
	
		
	$view 		= new ViewPage($app->title,$app->description);

	
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
	
	echo $view->JS("
					$('.marcar').click(function() {			
					if ($(this).is(':checked'))
					{
						$('.ccheck').attr('checked','TRUE');
					}
					else
					{
						$('.ccheck').removeAttr('checked');
					}
			
				});");
	
	//Instanciar formulário
	$form = new Form();

		$form->Fieldset("Seleção do Aluno");
		
			
			$form->Input("Nome",
					'autocomplete',
					array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_Nome', "class"=>"size70", "required"=>'1',"value"=>'1600000001234',"label"=>""));
			
			$form->Input("Data do Acordo","date",array("name"=>"p_DtAcordo","required"=>"1", "value"=>$_POST[p_DtAcordo]));
			
			$form->Button ("submit", array ("name"=>"p_submit", "value"=>"Consultar","id"=>"btnLogin"));
			
		$form->CloseFieldset ();
		
		echo $view->Div(array("class"=>"BoxCenter")). $wp->GetInfoAluno( $_POST['p_Nome'] ).$view->CloseDiv();
		

		/* $dbData->Get($matric->Query('qWPessoaPLetivo',array("p_WPessoa_Id"=>$_POST['p_Nome'],"p_O_Data"=>date('d/m/Y'))));
			
		while ($row = $dbData->Row())
		{
			if ($row["MATRICTI_ID"] == '8300000000001' && $row["STATE_ID"] > '3000000002001')
			{				
				
				echo $matric->GetStateMatricInfo($row[ID],array("class"=>"matricCons","id"=>$row[ID],"idr"=>_UrlEncrypt($row[ID])),'on');				
				echo $view->Div(array("id"=>"div_".$row[ID],"style"=>"display:none;margin-bottom:5px")).$view->CloseDiv();
								
			}
		}
		*/
		
		$form->Fieldset("Boletos em Cobrança Externa");
		$aBoleto = $boleto->GetBoletoCobExt($_POST[p_Nome], $_POST[dtAcordo]);
		
		if(is_array($aBoleto))
		{
		
			$grid = new DataGrid(array("Referência","Tipo","Vencto","Valor","Multa","Mora","Valor Corrigido","Unidade","Escritório",$view->CheckBox(array("class"=>"marcar"))));
		
			foreach ($aBoleto as $row)
			{
		
				$grid->Content($row[REFERENCIA],array('align'=>'left'));
				$grid->Content($row[BOLETOTI],array('align'=>'left'));
				$grid->Content($row[DTVENCTO],array('align'=>'right'));
				$grid->Content($row[VALOR_FORMAT],array('align'=>'right'));
				$grid->Content($row[MULTA_FORMAT],array('align'=>'right'));
				$grid->Content($row[MORA_FORMAT],array('align'=>'right'));
				$grid->Content($row[VALORTOTAL_FORMAT],array('align'=>'right'));
				$grid->Content($row[UNIDADE],array('align'=>'left'));
				$grid->Content("",array('align'=>'left'));
				$grid->Content($view->CheckBox(array("class"=>"ccheck","value"=>$row[ID],"name"=>"chReceb[]")));
			}
		}
		
		
		

		
		$form->CloseFieldset();
	//fecha formulário
	unset ($form);
	
	
	
	unset($wp);
	unset($matric);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>