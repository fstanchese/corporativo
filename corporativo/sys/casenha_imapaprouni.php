<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user 			= new User ();
	$app = new App("Mapa do ProUni","Mapa do ProUni",array('ADM','CPD','CASENHAGER','CASENHA'),$user);
	
	include("../engine/View.class.php");
	include("../engine/Db.class.php");
	

	include("../engine/ViewPage.class.php");
	include("../engine/Navigation.class.php");
	

	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	

	$view = new ViewPage($app->title,$app->description);
	$view->Header($user);
	
	echo $view->JS("

			$(document).on('click','.boxItem',function()
			{
			
				if($(this).attr('isColoBox') == '1')
				{
					
					if($(this).attr('link').indexOf('?') > 0)
						var compl = '&switchPageToBox=1';
					else
						var compl = '?switchPageToBox=1';
			
					$.colorbox({
						iframe:true, 
						width:'80%', 
						height:'80%',
						href:$(this).attr('link')+compl,
						onClosed: function(){parent.location.reload(); }			
					})
				}
				else
				{
					window.open($(this).attr('link'));
				}
			});

	");
	
	
	 
	
		
	echo "
			<style>
				.boxItem { cursor:pointer;float:left;height:120px!important;position:relative}
				.boxItem:hover { opacity:0.85}
			
			.boxItem em { position:absolute;top:10px;font-size:50px;width:100%;text-align:center;z-index:1;color:#444 }
			.boxItem strong { position:absolute;top:65px;width:100%;z-index:2;text-align:center;color:#222}
			
			.titulo { color: #bbb;text-shadow: 0px 2px 3px #666;width:98%;padding:20px 0;background:#474747;text-align:center;margin:1%;font-size:37px;text-transform:uppercase}
			</style>
		";	
		

	echo $view->Div(array("style"=>"width:90%;margin:0 auto;")).
			$view->Div(array("class"=>"titulo")).'ProUni'.$view->CloseDiv();

	
	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#fe6204;width:98%","isColoBox"=>"1","title"=>"../sys/casenha_ichamada.php","link"=>"../sys/casenha_ichamada.php")).
	$view->Italic("",array("class"=>"fa fa-bullhorn","style"=>"color:#FFFFFF")).
	$view->Strong("Chamar Senha",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
	
	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#186e32;width:45%","isColoBox"=>"1","title"=>"../sys/casenha_itriagem.php","link"=>"../sys/casenha_itriagem.php")).
	$view->Italic("",array("class"=>"fa fa-play","style"=>"color:#FFFFFF")).
	$view->Strong("Início do Atendimento",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#006295;width:35%","isColoBox"=>"1","title"=>"../sys/casenha_isaida.php","link"=>"../sys/casenha_isaida.php")).
	$view->Italic("",array("class"=>"fa fa-eject","style"=>"color:#FFFFFF")).
	$view->Strong("Término do Atendimento",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
	

	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#7a04fe;width:14%","isColoBox"=>"1","title"=>"../sys/casenha_isenhamanual.php","link"=>"../sys/casenha_isenhamanual.php")).
	$view->Italic("",array("class"=>"fa fa-comment-o","style"=>"color:#FFFFFF")).
	$view->Strong("Chamar Senha Manualmente",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();	
		

	
	
	
		
	
	
	
	echo $view->Br().$view->CloseDiv();
	
?>