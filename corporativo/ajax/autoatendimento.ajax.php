<?php

require_once("../engine/User.class.php");
require_once("../engine/Db.class.php");
require_once("../engine/View.class.php");
require_once("../engine/Form.class.php");


$user = new User('aluno',"jdfoj8303m3o9");

$dbOracle 	= new Db ($user);

$dbData = new DbData ($dbOracle);

$view = new View();
$form = new Form();


if ($_GET[p_Action] == 'GetDetFaltas')
{
	//Carregar as disciplinas da matrícula
	$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetFaltas&id=". _UrlEncrypt($_GET[p_Id]));
	$retDisc = json_decode($json,true);

	echo $view->Div(array("style"=>"display:inline;")) .
	$view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"100%")) .
	$view->Th('Disciplina') . $view->Th('Faltas');
	foreach ($retDisc[FALTAS] as $rowDisc)
	{
		if (is_array($rowDisc))
		{

			foreach ($rowDisc as $key => $rowFalta)
			{
				echo $view->Tr().$view->Td() . $key . $view->CloseTd();
				if (is_array($rowFalta))
				{
					echo $view->Td() ;
					foreach ($rowFalta as $rowDet)
					{
						if ($rowDet[quantidade] > 0)
							echo $rowDet[quantidade] . ' em ' . $rowDet[data] . '<br>';
					}
					echo $view->CloseTd();
				}
			}
		}
	}

	echo $view->CloseTd().$view->CloseTr().$view->CloseTable().$view->CloseDiv();
	die();
}



$view->IncludeCSS('default.css');
$view->IncludeJS('jquery.js');

echo $view->JS(
			"$(document).on('click','.matricula', function() {
		      	var vQtd = $(this).attr('qtde');
				$('#ConsNota'+vQtd).toggle();				
			});
		
			$(document).on('click','.ocorrencia', function() {
				$(this).next('tr').toggle();				
			});

			$(document).on('click','.matricFaltas', function() {

				var vId = $(this).attr('id');
				var vQt = $(this).attr('qtde');

				
				if($('#ShowDisc'+vQt).html().length > 0)
				{
					if($('#ShowDisc'+vQt).is(':visible'))
						$('#ShowDisc'+vQt).hide();
					else
						$('#ShowDisc'+vQt).show();
				}
				else
				{
					_ShowLoading();
					$.post('../ajax/autoatendimento.ajax.php?p_Action=GetDetFaltas&p_Id='+vId,function(ret){
						
						$('#ShowDisc'+vQt).html(ret);
						_HideLoading();
						
					});
					
				}
				
			}); "
		
		);

echo $view->JSFunction("
			function fBoleto(n)
			{
				var vOk = 0;
				var vData = '';
				for(i=0; i < document.f1.dtVenctoNovo.length; i++ ) {
					if (document.f1.dtVenctoNovo[i].checked == true) 
					{
				    	vOk = 1;
				    	vData = document.f1.dtVenctoNovo[i].value;
					}
				}  
		
 				document.location = 'http://www.usjt.br/servicos_alunos/boleto_i2via.php?p='+n+'&pValor='+vData;
			}
		");

if ($_GET[p_Action] == 'GetLogin')
{

	$ch = curl_init() or die(curl_error()); 
	curl_setopt($ch, CURLOPT_URL,"http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetLogin&codigo=".$_SESSION[p_Codigo]."&senha=".$_SESSION[p_Senha]); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$retorno = json_decode(curl_exec($ch));
	curl_close($ch);
	
	if ($retorno->DADOSALUNO->retorno == '1')
	{
		
		echo 
				$view->Img(array("src"=>$retorno->DADOSALUNO->photo)).$view->Br().
				"Código: ".$retorno->DADOSALUNO->ra.$view->Br().
				"Nome: ".utf8_decode($retorno->DADOSALUNO->nome).$view->Br().
				"Turma: ".$retorno->DADOSALUNO->turma.$view->Br().
				"Sala: ".$retorno->DADOSALUNO->sala.$view->Br().
				"Situação: ".utf8_decode($retorno->DADOSALUNO->situacao).$view->Br();
				$_SESSION[Id] = $retorno->DADOSALUNO->id ;
	 
		die();
	 
		
		
	}
	else 
	{
		$view->Dialog('E','Login','Atenção, código e senha inválidos.');
		echo "";
	}

}


if ($_GET[p_Action] == 'GetHoraAula')
{
	include_once ('../engine/ViewBox.class.php');	
	$viewAjax = new ViewBox('Horário de Aula', 'Horário de Aula');	
	$viewAjax->Header();
	
	$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetHoraAula&id=".$_SESSION[Id]);
	$retorno = json_decode($json,true);
	
	if (!empty($retorno['HORARIOAULA'][0][VAZIO]))
	{
		$view->Dialog('I', 'Atenção', utf8_decode($retorno['HORARIOAULA'][0][VAZIO]));
		die();
	}
		
	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));
	echo $view->Th('Horário').$view->Th('Turma').$view->Th('Disciplina').$view->Th('Sala').$view->Th('Divisão');
		
	foreach ($retorno['HORARIOAULA'] as $key => $horario)
	{
		foreach($horario as $key2 => $semana)
		{
			echo $view->Tr().$view->Th(utf8_decode($key2),array("colspan"=>"5","style"=>"font-weight:bold;text-align:left;padding: 5px;")) . $view->CloseTr();
			foreach ($semana as $row)
			{
				echo $view->Tr().
				$view->Td(array("align"=>"right")). $row[horario] . $view->CloseTd() . 
				$view->Td(array("align"=>"right")). $row[turma] . $view->CloseTd() . 
				$view->Td(array("align"=>"right")). $row[coddisc] . $view->CloseTd() . 
				$view->Td(array("align"=>"right")). $row[sala] . $view->CloseTd() . 
				$view->Td(array("align"=>"right")). $row[div] . $view->CloseTd();
			}
		}
	}
	echo $view->CloseTable();
	echo $view->P('A coordenação do curso ainda está realizando ajustes nos horários, portanto os mesmos podem sofrer alterações.',array('style'=>'text-align:center')) . $view->Br();
	echo $view->P(trim(_DataAtualExtenso()).'.',array('style'=>'text-align:center'));
	
	unset($viewAjax);
}

if ($_GET[p_Action] == 'GetHoraProva')
{
	
	include_once ('../engine/ViewBox.class.php');	
	$viewAjax = new ViewBox('Horário de Prova', 'Horário de Prova');
	$viewAjax->Header();
	
	$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetHoraProva&id=".$_SESSION[Id]);
	$retorno = json_decode($json,true);

	if (!empty($retorno['HORARIOPROVA'][0][VAZIO]))
	{
		$view->Dialog('I', 'Atenção', utf8_decode($retorno['HORARIOPROVA'][0][VAZIO]));
		die();
	}
	
	echo $view->Br().$view->Br();
	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));	
	echo $view->Tr(). $view->Th('Data').$view->Th('Horário').$view->Th('Sala').$view->Th('Turma').$view->Th('Disciplina').$view->Th('Divisão');
	
	
	foreach ($retorno[HORARIOPROVA] as $prova)
	{
		foreach ($prova as $key => $dia)
		{
			foreach ($dia as $row)
			{
				echo $view->Tr().
				$view->Td(array("align"=>"right")). $key . $view->CloseTd() . 
				$view->Td(array("align"=>"right")). $row[hora] . $view->CloseTd() . 
				$view->Td(array("align"=>"right")). $row[sala] . $view->CloseTd() . 
				$view->Td(array("align"=>"right")). $row[turma] . $view->CloseTd() . 
				$view->Td(). $row[disciplina] . $view->CloseTd() . 
				$view->Td(). utf8_decode($row[divisao]) . $view->CloseTd();
			}
		}
	}
	echo $view->P('Se o seu RA estiver cadastrado errado entre em contato urgente com o SAA.',array('style'=>'text-align:center'));
	echo $view->CloseTable();
	echo $view->P('Este é o seu horário de provas informado ao sistema até o presente momento.',array('style'=>'text-align:center;color:red')).$view->Br();
	echo $view->P(trim(_DataAtualExtenso()).'.',array('style'=>'text-align:center'));
	
	unset($viewAjax);
	
}

if ($_GET[p_Action] == 'GetEventosMes')
{

	include_once ('../engine/ViewBox.class.php');
	
	setlocale(LC_ALL, "pt_BR", "ptb");
	$viewAjax = new ViewBox('Eventos do Mês (' . ucfirst(strftime("%B", strtotime('now')) .')'), 'Eventos do Mês (' . ucfirst(strftime("%B", strtotime('now')) .')'));
	$viewAjax->Header();

	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));

	echo $view->Th('Início').$view->Th('Término').$view->Th('Evento').$view->Th('Local');
	$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetEventosMes");
	$retorno = json_decode($json,true);
	
	if (!empty($retorno[EVENTO][0][VAZIO]))
	{	
		$view->Dialog('I', 'Atenção', utf8_decode($retorno[EVENTO][0][VAZIO]));
		die();		
	}
	foreach ($retorno[EVENTO] as $evento)
	{
		foreach($evento as $key => $dia)
		{
			echo $view->Tr().$view->Th(utf8_decode($key),array("colspan"=>"4","style"=>"font-weight:bold;text-align:left;padding: 5px;")) . $view->CloseTr();			
			foreach ($dia as $row)
			{
				echo $view->Tr().
					$view->Td().utf8_decode($row[HRINICIO]).$view->CloseTd().
					$view->Td().utf8_decode($row[HRFIM]).$view->CloseTd().
					$view->Td().utf8_decode($row[DESCRICAO]).$view->CloseTd().
					$view->Td().utf8_decode($row[LOCAL]).$view->CloseTd().
					$view->CloseTr();				
			}
		}
	}
	echo $view->P('O que acontece se eu colocar um texto aleatório qualquer aqui?????',array('style'=>'text-align:center'));
	
	unset($viewAjax);
}

if ($_GET[p_Action] == 'GetSaa')
{
	include_once ('../engine/ViewBox.class.php');
	$viewAjax = new ViewBox('Ocorrências','Ocorrências');
	$viewAjax->Header();
	
	$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetSaa&id=".$_SESSION[Id]);
	$retorno = json_decode($json,true);
	
	if (!empty($retorno['SAA'][0][VAZIO]))
	{
		$view->Dialog('I', 'Atenção', utf8_decode($retorno['SAA'][0][VAZIO]));
		die();
	}
	
	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));
	echo $view->Th('').$view->Th('Número').$view->Th('Data').$view->Th('Assunto').$view->Th('Situação');
	
	//print_r($retorno[SAA]);
	
	foreach ($retorno[SAA] as $row)
	{
		echo $view->Tr(array("class"=>"ocorrencia")).
			$view->Td(array("align"=>"center")).$view->IconFA('fa-sort-desc',array('style'=>'color:blue;font-size:20px')).$view->CloseTd().
			$view->Td(array("align"=>"right")).utf8_decode($row[utf8_encode(Número)]).$view->CloseTd().
			$view->Td(array("align"=>"center")).utf8_decode($row[Data]).$view->CloseTd().
			$view->Td().utf8_decode($row[Assunto]).$view->CloseTd().
			$view->Td().utf8_decode($row[utf8_encode(Situação)]).$view->CloseTd().
			$view->CloseTr();				

		
		echo $view->Tr(array("style"=>"display:none")).
				$view->Td(array("colspan"=>"5"));		
				
		if (is_array($row[Fluxo]))
		{

			foreach ($row[Fluxo] as $rowResp)
			{
				echo utf8_decode($rowResp[Resposta]). ' <strong>Deferido:</strong> ' . utf8_decode($rowResp[Deferido]). $view->Br();
			}
		}
		echo $view->CloseTd().
		$view->CloseTr();
	}
	echo $view->P('Clique sobre a ocorrência para visualizar a resposta.',array('style'=>'text-align:center'));
	echo $view->CloseTable();
	
	echo $view->P('Para maiores esclarecimentos, dirija-se ao Setor de Atendimento ao Aluno - SAA',array('style'=>'text-align:center;color:red;')).$view->Br();
	echo $view->P(trim(_DataAtualExtenso()).'.',array('style'=>'text-align:center'));

	unset($viewAjax);
}



if ($_GET[p_Action] == 'GetDisc')
{
	include_once ('../engine/ViewBox.class.php');
	$viewAjax = new ViewBox('Consulta de Notas','Consulta de Notas');
	$viewAjax->Header();
	
	$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetMatric&id=".$_SESSION[Id]);
	$retorno = json_decode($json,true);
	
	if (!is_array($retorno))
	{
		$view->Dialog('I', 'Atenção', 'Não existem informações cadastradas para consulta.');
		die();
	}
	
	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));
	echo $view->Th('',array("width"=>"5%")).$view->Th('Período Letivo',array("width"=>"15%")).$view->Th('Curso',array("width"=>"60%")).$view->Th('Situação',array("width"=>"20%"));
	echo $view->CloseTable();
	
	echo $view->P('Selecione o período letivo para visualizar suas notas.',array('style'=>'text-align:center'));

	foreach ($retorno[MATRICULA] as $row)
	{
		
		//Carregar as disciplinas da matrícula
		$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetDisc&id=".$row[ID]);
		$retDisc = json_decode($json,true);

		if (is_array($retDisc))
		{
		
			echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%")).
				$view->Tr(array("class"=>"matricula","qtde"=>++$qtdeN)).
			    $view->Td(array("align"=>"center","width"=>"5%")).$view->IconFA('fa-sort-desc',array('style'=>'color:blue;font-size:20px')).$view->CloseTd().
				$view->Td(array("align"=>"left","width"=>"15%")).utf8_decode($row[PLETIVO]).$view->CloseTd().
				$view->Td(array("align"=>"left","width"=>"60%")).utf8_decode($row[CURSO]).$view->CloseTd().
				$view->Td(array("align"=>"left","width"=>"20%")).utf8_decode($row[SITUACAO]).$view->CloseTd().
				$view->CloseTr().$view->CloseTable();
		
			
			echo $view->Div(array("style"=>"display:none;","id"=>"ConsNota".$qtdeN));			
			echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));
			$vFirst = 1;
				
			foreach ($retDisc[DISCIPLINA] as $linha)
			{
	
				if ($vFirst == 1)
				{
					foreach (array_keys($linha) as $row)
					{
						echo $view->Th(reset(explode('_',utf8_decode($row))));
					}
				}
				$vFirst = 0; 
				echo $view->Tr(array("style"=>"font-size:11px"));
				foreach ($linha as $key => $rowDisc)
				{
					echo $view->Td(array("align"=>"left")). utf8_decode($rowDisc) .$view->CloseTd();
				}
				
			}
			echo $view->CloseTd().$view->CloseTr().$view->CloseTable().$view->CloseDiv();
		}
	}

	echo $view->P('(N/C - Não Compareceu, S/N - Sem Nota Processada)',array('style'=>'text-align:center;color:red'));
	echo $view->P('Extrato para simples conferência. Sujeito a alteração - Documento não oficial.',array('style'=>'text-align:center;color:red')) . $view->Br();
	
	echo $view->P(trim(_DataAtualExtenso()).'.',array('style'=>'text-align:center'));
	
	unset($viewAjax);
}


if ($_GET[p_Action] == 'GetFaltas')
{

	include_once ('../engine/ViewBox.class.php');
	$viewAjax = new ViewBox('Consulta de Faltas','Consulta de Faltas');
	$viewAjax->Header();
	
	$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetMatric&id=".$_SESSION[Id]);
	$retorno = json_decode($json,true);
	
	if (!is_array($retorno))
	{
		$view->Dialog('I', 'Atenção', 'Não existem informações cadastradas para consulta.');
		die();
	}
	
	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));
	echo $view->Th('',array("width"=>"5%")).$view->Th('Período Letivo',array("width"=>"15%")).$view->Th('Curso',array("width"=>"60%")).$view->Th('Situação',array("width"=>"20%"));
	echo $view->CloseTable();
	
	foreach ($retorno[MATRICULA] as $row)
	{
		echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));
		echo $view->Tr(array("class"=>"matricFaltas","id"=>_UrlDecrypt($row[ID]),"qtde"=>++$vcount)).
		$view->Td(array("align"=>"center","width"=>"5%")).$view->IconFA('fa-sort-desc',array('style'=>'color:blue;font-size:20px')).$view->CloseTd().
		$view->Td(array("align"=>"left","width"=>"15%")).utf8_decode($row[PLETIVO]).$view->CloseTd().
		$view->Td(array("align"=>"left","width"=>"60%")).utf8_decode($row[CURSO]).$view->CloseTd().
		$view->Td(array("align"=>"left","width"=>"20%")).utf8_decode($row[SITUACAO]).$view->CloseTd().
		$view->CloseTr() . $view->CloseTable().
		
		$view->Div(array("id"=>"ShowDisc".$vcount)).$view->CloseDiv();


	}
	echo $view->P('Selecione o período letivo para visualizar suas faltas',array('style'=>'text-align:center'));

	echo $view->CloseTable();	
	echo $view->P('Extrato para simples conferência. Sujeito a alteração - Documento não oficial.',array('style'=>'text-align:center;color:red')) . $view->Br();
	echo $view->P(trim(_DataAtualExtenso()).'.',array('style'=>'text-align:center'));
	
	unset($viewAjax);
}


if ($_GET[p_Action] == 'GetBancoFolha')
{

	include_once ('../engine/ViewBox.class.php');
	$viewAjax = new ViewBox('Banco de Folhas Laboratório de Informática','Banco de Folhas Laboratório de Informática');
	$viewAjax->Header();
	
	$json = file_get_contents("http://dbnet.usjt.br/gm/ws/aplicativo.php?action=GetBancoFolha_2&id=".$_SESSION[Id]);
	$retorno = json_decode($json,true);

	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));
		
	foreach ($retorno[BANCOFOLHA] as $row)
	{
		if (!empty($row[VAZIO]))
		{
			$view->Dialog('I', 'Atenção', 'Opção exclusiva para alunos que fazem uso do Banco de Folhas.');
			die();
		}
		if ($row[Papel] != 'Total')
		{
			echo $view->Tr().$view->Th('Papel '.$row[Papel]).
			$view->Tr().$view->Td().'Papel: '.$row[Papel].$view->CloseTd().
			$view->Tr().$view->Td().'Impressas no Ano: '.$row['Impressas no Ano'].$view->CloseTd().
			$view->Tr().$view->Td().'Faces A4 Descontadas: '.$row['Faces A4 Descontadas'].$view->CloseTd().
			$view->Tr().$view->Td().'Armazenadas: '.$row['Armazenadas'].$view->CloseTd();				
		}
		else
		{
			echo $view->Tr().$view->Th($row[Papel]).
			$view->Tr().$view->Td().'Faces A4 Limite no Ano: '.$row['Faces A4 Limite no Ano'].$view->CloseTd().
			$view->Tr().$view->Td().'Faces A4 Impressas no Ano: '.$row['Faces A4 Impressas no Ano'].$view->CloseTd();
		}

	}
	
	unset($viewAjax);
}



if ($_GET[p_Action] == 'GetLogout')
{
	unset($_SESSION[Id]);
}


if ($_GET[p_Action] == 'GetBoletos')
{
	include_once ('../engine/ViewBox.class.php');
	include_once ('../model/Boleto.class.php');
	
	$boleto = new Boleto($dbOracle);
	
	$viewAjax = new ViewBox('Impressão de Boletos','Impressão de Boletos');
	$viewAjax->Header();
	
	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%")) .
	     $view->Th('Parcela').$view->Th('Vencimento').$view->Th('Validade').$view->Th('Valor').$view->Th('Situação');


	$dbData->Get($boleto->Query('qPessoa',array('p_WPessoa_Id'=>_UrlDecrypt($_SESSION[Id]))));
	
	while ($row = $dbData->Row())
	{
		if ($row[STATE_BASE_ID] == 3000000000006 && $row[IMPRIMIR] == 'on')
		{
			echo $view->Tr().
					$view->Td(array("style"=>"text-decoration:underline;")).$view->Link($row[REFERENCIA],array('href'=>'javascript:fBoleto('.$row[ENCID].')')).$view->CloseTd().
					$view->Td().$row[DTVENCTOFORMAT].$view->CloseTd().
					$view->Td()._NVL($row[DTVALIDADE],'&nbsp;').$view->CloseTd().
					$view->Td().$row[VALOR].$view->CloseTd().
					$view->Td().$row[ESTADO].$view->CloseTd();
		}
	}
	echo $view->CloseTable();
	echo $view->Table(array("class"=>"dataGrid","cellspacing"=>"1","width"=>"90%"));
	echo $view->Tr().$view->Td(array("width"=>"50%")).'Selecione uma data caso queira imprimir o boleto com valores atualizados'.$view->CloseTd().$view->Td();
	
	$form->Form();
	
	while ($vQtde <= 2)
	{
		if (date("D",mktime(0,0,0, date("m"), date("d")+$vConta, date("y"))) != 'Sat' && date("D",mktime(0,0,0, date("m"), date("d")+$vConta, date("y"))) != 'Sun')
		{
			print '&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name=dtVenctoNovo value=\''.base64_encode(date("d/m/Y", mktime(0,0,0, date("m"), date("d")+$vConta, date("y")))).'\'>&nbsp;';
			print date("d/m/Y", mktime(0,0,0, date("m"), date("d")+$vConta, date("y")));
			print '</input>';
			$vQtde++;
		}
		$vConta++;
	}
	$form->CloseForm();
	echo $view->CloseTd().$view->CloseTr();		
	echo $view->CloseTable();	
	
	echo $view->P('Atenção: As parcelas que tiverem a letra "D" no final, são referentes a boletos de diferença.',array('style'=>'text-align:center')) . $view->Br();
	echo $view->P('Esta é a sua posição até o presente momento.',array('style'=>'text-align:center'));
		
	unset($viewAjax);
}


?>