<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user 			= new User ();
	$app = new App("Atendimento - Controle de Atendimento","Atendimento - Controle de Atendimento",array('ADM','CPD','SAA'),$user);
	
	include("../engine/View.class.php");
	include("../engine/Db.class.php");
	

	include("../engine/ViewPage.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/Form.class.php");	
	include("../model/WPessoa.class.php");
	include("../model/CAMesa.class.php");
	include("../model/CAAtendente.class.php");
	include("../model/State.class.php");
	include("../model/CAPausaTi.class.php");
	
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	$wpessoa 		= new WPessoa($dbOracle);
	$camesa			= new CAMesa($dbOracle);
	$caAtendente 	= new CAAtendente($dbOracle);
	$state			= new State($dbOracle);
	$caPausaTi		= new CAPausaTi($dbOracle);

	
	$caAtendente->SetAtendente($_SESSION["p_WPessoa_Id"], $_COOKIE[p_CAMesa_Id], $_POST["p_CAPausaTi_Id"]);
	
	
	$view = new ViewPage($app->title,$app->description);
	$view->Header($user);
	
	$view->IncludeCSS("casenha.css");
	
	echo $view->JS("

			$(document).on('click','.boxItem2',function()
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
			
			window.setInterval(
		
					function()
					{
						$('#listaMesa').load('camesa_ishow.php');
		
					},70000);			
			

	");
	
	echo "
			<style>
				.boxItem { float:left;height:450px;position:relative; border: 0px solid black; }
				.boxItem:hover { opacity:1}
			
			.boxItem em { position:absolute;top:10px;font-size:50px;width:100%;text-align:center;z-index:1;color:#444 }
			.boxItem strong { position:absolute;top:65px;width:100%;z-index:2;text-align:center;color:#222}
			
			.titulo { color: #bbb;text-shadow: 0px 2px 3px #666;width:100%;padding:450px 0;background:#474747;text-align:center;margin:1%;font-size:37px;text-transform:uppercase}
			</style>
		";	
		

	//Verificar se a existe senha iniciada
	/*
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
	
	*/

	$form = new Form();
	
	$dbData->Get("select numero from camesa where id='$_COOKIE[p_CAMesa_Id]'");
	$vMesa = $dbData->Row();
	
	//Primeiro quadro com as informações pessoais e de situação da mesa
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;background:#FFF;width:20%")).

		$view->Div(array("style"=>"height:150px;text-align:center;")).
			$view->P($wpessoa->GetFoto($_SESSION['p_WPessoa_Id'],array("width"=>"110px")),array("style"=>"text-align:center")).
		$view->CloseDiv().

		$view->Div(array("style"=>"height:18px")).
		$view->P('MESA',array("width"=>"100%","style"=>"font-size:16px;font-weight:bold;color:#3352B7")).
		$view->CloseDiv().
	
	
		$view->Div(array("style"=>"border: 1px solid black; height:40px; margin:10px 0;text-align:right;border-radius:03px;width:100%")).
			$view->P(str_pad($vMesa[NUMERO],'2', '0',STR_PAD_LEFT),array("style"=>"text-align:right;margin-top:4px;margin-right:20px; font-size:25px")).
		$view->CloseDiv().

		$view->Div(array("style"=>"height:25px")).
		$view->P('STATUS DA MESA',array("width"=>"100%","style"=>"margin:30px 0 10px 0; font-size:16px;font-weight:bold;color:#3352B7")).
		$view->CloseDiv().

		$view->Div(array("style"=>"border: 1px solid black; height:50px; margin: 0; text-align:center;border-radius:03px;"));
		$form->MultipleInput('','select',array("style"=>"margin-top:12px;","name"=>"p_CAPausaTi_Id","option" => $caPausaTi->Calculate(),"onChange"=>"document.f1.submit();","value"=>$_POST[p_CAPausaTi_Id]));
		
		echo $view->CloseDiv().

	$view->CloseDiv();
	//Fim do primeiro quadro
	
	//Segundo quadro com opções de chamada de senha
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;width:35%")).

		$view->Div(array("style"=>"cursor:pointer; border: 1px solid #FF8532;background-color:#FF8532; height:90px; margin: 0 50px 10px 50px; text-align:center;border-radius:07px;line-height:90px")).
		$view->P('Chamar Senha',array("style"=>"text-align:center;font-size:23px;color:#FFFFFF;")).
		$view->CloseDiv().

		$view->Div(array("style"=>"cursor:pointer; border: 1px solid #69ABEC;background-color:#69ABEC; height:60px; margin: 20px 50px 10px 50px; text-align:center;border-radius:07px;line-height:60px")).
		$view->P('Iniciar Atendimento',array("style"=>"text-align:center; font-size:19px;color:#FFFFFF;")).
		$view->CloseDiv().
		
		$view->Div(array("style"=>"cursor:pointer; border: 1px solid #3352B7;background-color:#3352B7; height:60px; margin: 20px 50px 10px 50px; text-align:center;border-radius:07px;line-height:60px")).
		$view->P('Finalizar Atendimento',array("style"=>"font-size:18px;color:#FFFFFF;text-align:center")).
		$view->CloseDiv().
		
		$view->Div(array("style"=>"cursor:pointer; border: 1px solid #D80404;background-color:#D80404; height:45px; margin: 90px 70px 10px 70px; text-align:center;border-radius:07px;line-height:45px")).
		$view->P('Cancelar Senha',array("style"=>"text-align:center;font-size:21px;color:#FFFFFF;")).
		$view->CloseDiv().
		
	
	$view->CloseDiv();
	//Fim do segundo quadro
	
	//Terceiro quadro com informações das senhas 
	echo $view->Div(array("class"=>"boxItem","style"=>"margin:1%;width:38%")).

		$view->Div(array("style"=>"border: 1px solid black; height:80px; margin: 0 30px 10px 30px; text-align:center;border-radius:03px;")).
		$view->Table(array("style"=>"margin-top:4px","width"=>"100%","border"=>"0")).
		$view->Tr().
			$view->Td(array("width"=>"45%","align"=>"left")).'Última Senha'.
			$view->P('P001',array("style"=>"margin-left:8px;margin-top:4px; font-size:20px")).
			$view->CloseTd().
			$view->Td(array("width"=>"20%","align"=>"center")).
			$view->P($view->IconFA('fa-angle-double-right',array("style"=>"font-size:70px;color:#3352B7"))).
			$view->CloseTd().
			$view->Td(array("width"=>"35%")).
			'Fulano de Tal'.
			$view->CloseTd().				
		$view->CloseTable().
		$view->CloseDiv().
		
		$view->Div(array("style"=>"border: 1px solid #E1E1E1; height:40px; margin: 30px 30px 10px 30px; text-align:center;border-radius:03px;background-color:#E1E1E1")).
		$view->P('SENHAS NORMAIS EM ESPERA:<b> 00</b>',array("style"=>"margin-left:8px;margin-top:4px; font-size:10px")).
		$view->P('SENHAS PREFERENCIAIS EM ESPERA:<b> 00</b>',array("style"=>"margin-left:8px;margin-top:4px; font-size:10px")).
		$view->CloseDiv().
		
		$view->Div(array("style"=>"cursor:pointer; border: 1px solid #3352B7;background-color:#3352B7; height:40px; margin: 45px 30px 10px 30px; text-align:center;border-radius:07px;line-height:40px")).
		$view->P('Minhas Senhas',array("style"=>"text-align:center;font-size:16px;color:#FFFFFF")).
		$view->CloseDiv().
		
		$view->Div(array("style"=>"cursor:pointer; border: 1px solid #3352B7;background-color:#3352B7; height:40px; margin: 20px 30px 10px 30px; text-align:center;border-radius:07px;line-height:40px")).
		$view->P('Minhas Ocorrências',array("style"=>"text-align:center;font-size:16px;color:#FFFFFF")).
		$view->CloseDiv().
		
		$view->Div(array("style"=>"cursor:pointer; border: 1px solid #D80404;background-color:#D80404; height:40px; margin: 40px 30px 10px 150px; text-align:center;border-radius:07px;line-height:40px")).
		$view->P('Sair',array("style"=>"text-align:center;font-size:16px;color:#FFFFFF")).
		$view->CloseDiv().		
	
	$view->CloseDiv();
	//Fim do terceiro quadro
	
	//Informações dos atendente
	echo $view->Div(array("class"=>"boxItem","id"=>"listaMesa","style"=>"margin:1%;background:#E1E1E1;width:95%;height:auto;padding:5px")).
		$camesa->GetMesaSituacao(199700000000019).	
		$view->Br().
		$view->CloseDiv();
	
	$form->CloseForm();
	
	
	unset($wpessoa);
	unset($camesa);
	unset($caAtendente);
	unset($state);
	unset($caPausaTi);
	unset($user);
	unset($app);
	
?>