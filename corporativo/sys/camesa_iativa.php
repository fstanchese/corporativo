<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Ativar Mesa - Controle de Atendimento","Ativar Mesa - Controle de Atendimento",array('ADM','CPD','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CAEvento.class.php");
	include("../model/CAMesa.class.php");

	
	$dbOracle 	= new Db ($user);

	$view 	 	= new ViewPage($app->title,$app->description);

	$dbData 	= new DbData ($dbOracle);
	
	$p_CAEvento_Id 	= $_POST["p_CAEvento_Id"];

	$nav 		= new Navigation($user, $app, $dbData);

	$caEvento 	= new CAEvento($dbOracle);
	$caMesa 	= new CAMesa($dbOracle);


	$view->Header($user,$nav);
 	$view->IncludeCSS("casenha.css");
 	
 	echo $view->JS("
 
 				$('li.listMesaOff, li.listMesaOn').bind('click', function(){
 					vId = $(this).attr('idr'); 					 					
 					if ($(this).attr('class') == 'listMesaOff')
 					{
 						$(this).removeClass('listMesaOff').addClass('listMesaOn');
 						vAtiva = 'on'; 						
					}
 			 		else
 					{
 						$(this).removeClass('listMesaOn').addClass('listMesaOff');
 						vAtiva = 'off';
 					}
 			
 			
 					$.ajax ({
						type: 'POST',
 						beforeSend: _ShowLoading(),
						url: '../ajax/casenha.ajax.php',
 						data: 'vTipo=Ativa&vAtiva='+vAtiva+'&vId='+vId,
 						success: _HideLoading()
					});
		
 				});
 			
 			
			");

 	
 	if (isset($_COOKIE["p_CAEvento_Id"]))
 	{
		//Instanciar formulário
		$form = new Form();
	
			$form->Fieldset($caEvento->Recognize($_COOKIE["p_CAEvento_Id"],"RecReduz"));
			
				$form->Input("","hidden",array("name"=>"p_Mesa_Id","id"=>"p_Mesa_Id"));
				
				$form->Input("Mesa","label",$caMesa->GetListMesa($_COOKIE["p_CAEvento_Id"]));
				
			$form->CloseFieldset ();
	
			
		//fecha formulário
		unset ($form);
 	}	
 	else 
 	{
 		echo $view->Div(array("class"=>"msgPageError")) . 'Não existe Evento pré-definido nesse computador.' . $view->CloseDiv();
 	}

	unset($caEvento);
	unset($campus);
	unset($dbData);
	
	unset($dbOracle);
	
	unset($user);

?>