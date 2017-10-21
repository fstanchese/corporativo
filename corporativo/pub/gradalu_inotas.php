<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Grade Curricular do Aluno - Consulta Notas - Portal","Grade Curricular do Aluno - Consulta Notas - Portal",array('ADM'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPortal.class.php");
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

	
	$wp = new WPessoa($dbOracle);
	$gradalu = new GradAlu($dbOracle);
	$matric = new Matric($dbOracle);
	$matricAux = clone $matric;
	

	$p_WPessoa_Id = 1600000158374;
			
	$view = new ViewPortal($app->title,$app->description);
	$view->Explain ("IUD");	
	
	
	$view->Header($user,$nav);

	//Chamar JS
	
	$js = "
			var vIdEnc = $(this).attr('idr');
			var vId    = $(this).attr('id');
			
				
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
				$('#div_'+vId).load('../ajax/gradalu_ialuno.ajax.php?vTipo=mostraDisc&vVisib=1&Matric_Id='+vIdEnc,function(){
					_HideLoading();
					$('#div_'+vId).show(1);
			
				});
			}
			";
			
	
	echo $view->On("click", ".matricCons",$js);
	echo $view->SetCSS(".matricCons {cursor:pointer}; .BoxCenter { width:100%; align:center;} .BoxCenter div:first-child{margin: 0 auto}");
	
	//echo $wp->GetInfoAluno($p_WPessoa_Id);
	
	echo $view->Div(array("class"=>"BoxCenter")) . $wp->GetInfoAluno( $p_WPessoa_Id ) . $view->CloseDiv();
		

	$dbData->Get($matric->Query('qWPessoaPLetivo',array("p_WPessoa_Id"=>$p_WPessoa_Id,"p_O_Data"=>date('d/m/Y'))));
			
	while ($row = $dbData->Row())
	{
		if ($row["MATRICTI_ID"] == '8300000000001' && $row["STATE_ID"] > '3000000002001')
		{				
			echo $matricAux->GetStateMatricInfo($row[ID],array("class"=>"matricCons", "id"=>$row[ID],"idr"=>_UrlEncrypt($row[ID])));				
			echo $view->Div(array("id"=>"div_".$row[ID],"style"=>"display:none;margin-bottom:5px")).$view->CloseDiv();
						
		}
	}
		
		
	unset($wp);
	unset($matric);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>