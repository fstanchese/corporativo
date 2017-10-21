<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Status das Mesas - Controle de Atendimento","Status das Mesas - Controle de Atendimento",array('ADM','CASENHAGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/CASenhaRegra.class.php");
	include("../model/CASenha.class.php");
	include("../model/CAMesa.class.php");
	include("../model/CAEvento.class.php");
	
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);
	$view 			= new ViewPage($app->title,$app->description);
	
	$caMesa 		= new CAMesa($dbOracle);
	$caEvento 		= new CAEvento($dbOracle); 
	$caSenhaRegra 	= new CASenhaRegra($dbOracle);
	$caSenha		= new CASenha($dbOracle);	
	
	$view->Header($user);
	$view->IncludeCSS("casenha.css");
	
	

	echo $view->JS("
				
				
			$('.listMesaSit li').bind('click',function(){
				
				$.colorbox(
				{
					href:'../ajax/casenha.ajax.php?vTipo=GetAtendimentosMesa&vMesa='+$(this).attr('idr'),
					width:'80%',
					height:'70%',
					overlayClose:false,
					onClosed:function() { location.href='camesa_isituacao.php'; }
				});
				
			});
				
	");
	
					
			

	
	if (isset($_COOKIE["p_CAEvento_Id"]))
	{
		
		$acaEvento = $caEvento->GetIdInfo($_COOKIE["p_CAEvento_Id"]);
		
		//Instanciar formulário
		$form = new Form();
	
			$form->Fieldset($caEvento->Recognize($_COOKIE["p_CAEvento_Id"],"RecReduz"));
				
			
			echo $caMesa->GetListMesaSituacao($_COOKIE["p_CAEvento_Id"]);

				
			$form->CloseFieldset ();
	
			
		//fecha formulário
		unset ($form);
		
	}
	else
	{
		$view->Dialog('E', 'Evento Não Encontrado.', 'O evento precisa ser selecionado nas configurações para essa página funcionar corretamente', false, false, false, false);
	}	
	
	
	unset($caEvento);
	unset($caMesa);
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>


