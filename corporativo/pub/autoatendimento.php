<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	//$user = new User();
	
	$user = new User('aluno',"jdfoj8303m3o9");
	
	//$app = new App("Auto Atendimento","Auto Atendimento",array('ADM','CPD', 'ALUNOS'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/ViewKiosk.class.php");
	include("../engine/Form.class.php");

	

	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	//$view			= new ViewKiosk($app->title,$app->description);
	$view			= new ViewKiosk('Auto Atendimento','Auto Atendimento');
	$view->Header();
	
	echo $view->IncludeCSS("autoatendimento.css");


	echo $view->JS("
			
				$('.btnSair').click( function () {
					$.post('../ajax/autoatendimento.ajax.php?p_Action=GetLogout',function(ret){
						window.setTimeout('location.href=\"autoatendimento.php\"', 800);
					});			
				});
			
		
			");
	
	if ($_POST[Prosseguir] == 'prosseguir')
	{

		$ch = curl_init() or die(curl_error());
		curl_setopt($ch, CURLOPT_URL,"http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetLogin&codigo=".$_POST[p_Codigo]."&senha=".$_POST[p_Senha]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$retorno = json_decode(curl_exec($ch));
		curl_close($ch);

		if ($retorno->DADOSALUNO->retorno == '1')
		{
			
			$_SESSION[Id] = $retorno->DADOSALUNO->id ;		
			$arCor 			= array('#63b6fc','#5edb76','#54b467','#1a8beb','#7ba7cb');
			
			echo $view->Div(array("class"=>"nav")).
			$view->Div(array("class"=>"infoAluno"));
				
			echo $view->Div(array("class"=>"dados")).
				$view->Img(array("src"=>$retorno->DADOSALUNO->photo)).$view->Br().
				"Código: ".$retorno->DADOSALUNO->ra.$view->Br().
				"Nome: ".utf8_decode($retorno->DADOSALUNO->nome).$view->Br().
				"Turma: ".$retorno->DADOSALUNO->turma.$view->Br().
				"Sala: ".$retorno->DADOSALUNO->sala.$view->Br().
				"Situação: ".utf8_decode($retorno->DADOSALUNO->situacao).$view->Br();

			
			echo $view->CloseDiv().
				
			$view->CloseDiv().$view->Br().
				
			$view->Div(array("class"=>"docsPendentes")).$view->H3("Documentos Pendentes");
				
			$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetDocPendente&id=".$_SESSION[Id]);
			$retDoc = json_decode($json,true);
				
			//print_r($retDoc[DOC]);
				
			foreach ($retDoc[DOC] as $row)
			{
				print utf8_decode($row[Documento]) . '<br>';
			}
				
			echo $view->CloseDiv().
				
				
			$view->CloseDiv() .
			
			
			
			$view->Div(array("class"=>"menuArea"));
			
			$dbData->Get("select * from AutoAtend order by id");
			
			while ($row = $dbData->Row())
			{
			
				$rand = rand(0,4);
			
				echo
				$view->Link($view->Div(array("id"=>$row[ACAO],"class"=>"boxItem","style"=>"background:".$arCor[$rand])).
						$view->Strong($view->IconFA($row[ICONE]),array("style"=>"color:".$arCorTexto[$rand])). '&nbsp;&nbsp;' .
						$view->Strong($row[NOME],array("style"=>"color:".$arCorTexto[$rand])). $view->Br().
						$view->P($view->Italic($row[DESCRICAO],array("class"=>"txtDesc")),array("style"=>"text-align:right;margin-right:10px")) .
						$view->CloseDiv(), array("class"=>"openColorBox","href"=>"../ajax/autoatendimento.ajax.php?p_Action=".$row[ACAO]) );
			
			}
			
			echo $view->Div(array("class"=>"boxItem btnSair","style"=>"background:#890000","align:center;")) .
			$view->Strong($view->IconFA("fa-long-arrow-right"),array("style"=>"color:white")). '&nbsp;&nbsp;' .
			$view->Strong('Sair',array("style"=>"color:white")). $view->Br(). $view->Br() .
			$view->CloseDiv();
			
			echo $view->CloseDiv();
		}
		else
		{
			$view->Dialog('E','Login','Atenção, código e senha inválidos.');
			//Header('Location: '.$_SERVER['PHP_SELF']);
			echo "<script language='javaScript'>window.setTimeout('location.reload()', 1200)</script>";
		}
				
	}
	
	else
	{
		$form = new Form();
		$form->Fieldset('Digite o RA e senha');
		$form->Input('RA','text',array("name"=>"p_Codigo","style"=>"font-size:20px"));
		$form->Input('Senha','password',array("name"=>"p_Senha","style"=>"font-size:20px"));
	
		$form->Button('submit',array("name"=>"Prosseguir","value"=>"prosseguir","id"=>"btProsseguir"));
		$form->CloseFieldset();
		unset($form);
	
		die();
	}
	

	unset($view);	
	
	unset($dbData);	
	unset($dbOracle);	
	unset($app);	
	unset($user);

?>