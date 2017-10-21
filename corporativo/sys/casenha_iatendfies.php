<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user 			= new User ();
	$app = new App("Mapa do Atendimento FIES","Mapa do Atendimento FIES",array('ADM','CPD','BOLSA'),$user);
	
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
						href:$(this).attr('link')+compl			
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
			$view->Div(array("class"=>"titulo")).'Atendimento FIES 2015'.$view->CloseDiv();


	//Verificar se a existe senha iniciada
	$sql = "select id
			from casenha
			where camesa_id= $_COOKIE[p_CAMesa_Id]
			AND trunc(dt) = '".date('d/m/Y',mktime(date('H')-5,date('i'),date('s'),date('m'),date('d'),date('Y')))."'
				and dtsaida is null
				and dttriagem is not null
				and dtcancelado is null
				order by dtchamada
		";
	
	
	$dbData->Get($sql);
	$aSenha = $dbData->Row();
	
	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#006295;width:23.5%","isColoBox"=>"1","title"=>"","link"=>"")).
	$view->Italic("",array("class"=>"fa fa-times","style"=>"color:#FFFFFF")).
	$view->Strong("Cancelar Senha",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
		
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#EC1414;width:47%","isColoBox"=>"1","title"=>"../sys/casenha_ichamada.php","link"=>"../sys/casenha_ichamadadir.php")).
	$view->Italic("",array("class"=>"fa fa-bullhorn","style"=>"color:#FFFFFF")).
	$view->Strong("Chamar Senha",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#006295;width:23.5%","isColoBox"=>"1","title"=>"../sys/casenha_isenhamanual.php","link"=>"../sys/casenha_isenhamanual.php")).
	$view->Italic("",array("class"=>"fa fa-comment-o","style"=>"color:#FFFFFF")).
	$view->Strong("Chamar Senha Manualmente",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();	
		
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#006295;width:23.5%","isColoBox"=>"1","title"=>"../sys/casenha_itriagem.php","link"=>"../sys/casenha_itriagem.php")).
	$view->Italic("",array("class"=>"fa fa-play","style"=>"color:#FFFFFF")).
	$view->Strong("Início do Atendimento",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();

	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#006295;width:23.5%","isColoBox"=>"1","title"=>"../sys/casenha_isaida.php","link"=>"../sys/casenha_isaida.php")).
	$view->Italic("",array("class"=>"fa fa-eject","style"=>"color:#FFFFFF")).
	$view->Strong("Término do Atendimento",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#449ee9;width:47%","isColoBox"=>"0","title"=>"../../private/boleto_iconsulta.php","link"=>"../../private/boleto_iconsulta.php")).
	$view->Italic("",array("class"=>"fa fa-money","style"=>"color:#FFFFFF")).
	$view->Strong("Consulta de Boletos",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();

	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#449ee9;width:49%","isColoBox"=>"1","title"=>"../../private/boleto_irecalculomatric.php","link"=>"../../private/boleto_irecalculomatric.php")).
	$view->Italic("",array("class"=>"fa fa-barcode","style"=>"color:#FFFFFF")).
	$view->Strong("Recálculo de Boleto",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#006295;width:47%","isColoBox"=>"1","title"=>"../../private/wpescobrest_iiud.php","link"=>"../../private/wpescobrest_iiud.php")).
	$view->Italic("",array("class"=>"fa fa-hand-o-right","style"=>"color:#FFFFFF")).
	$view->Strong("Cadastro de Restrição",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();

	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#0a73cb;width:49%","isColoBox"=>"0","title"=>"http://sisfies.mec.gov.br","link"=>"http://sisfies.mec.gov.br")).
	$view->Italic("",array("class"=>"fa fa-spinner","style"=>"color:#FFFFFF")).
	$view->Strong("sisfies.mec.gov.br",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
	
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#0a73cb;width:47%","isColoBox"=>"0","title"=>"http://sisfiesportal.mec.gov.br","link"=>"http://sisfiesportal.mec.gov.br")).
	$view->Italic("",array("class"=>"fa fa-cogs","style"=>"color:#FFFFFF")).
	$view->Strong("sisfiesportal.mec.gov.br",array("style"=>"color:#FFFFFF")).
	$view->CloseDiv();
	
	echo $view->Br().$view->CloseDiv();
	
?>