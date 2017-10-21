<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Consulta de Carta de Cobrança","Consulta de Carta de Cobrança",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/WPessoa.class.php");
	include("../model/State.class.php");
	include("../model/CCobDebito.class.php");

	
	
	$dbOracle = new Db ($user);

	$dbData 	= new DbData ($dbOracle);
	$dbDataAux 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	$view 		= new ViewPage($app->title,$app->description);
	
	
	$wpessoa 	= new WPessoa($dbOracle);
	$state 		= new State($dbOracle);
	$ccobDebito = new CCobDebito($dbOracle);
	
	
	$view->Header($user,$nav);

	
	
	$form = new Form();

		$form->Fieldset("Consultar Carta de Cobrança");
		
			
			$form->Input("Aluno",'autocomplete',array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_Nome', "class"=>"size70"));
			$form->Input("Número da Carta",'text',array("name"=>'p_NumCarta', "value"=>$_POST[p_NumLote] ));
			
			$form->Button('submit',array("name"=>"btProsseguir","value"=>"Consultar"));
			
		$form->CloseFieldset ();
		
	unset ($form);
	
		
		
	if($_POST[btProsseguir] == "Consultar" && (!empty($_POST[p_Nome]) || !empty($_POST[p_NumCarta])))
	{
		
		if($_POST[p_Nome] != "")		$sqlPlus .= " AND wpessoa_id = '".$_POST[p_Nome]."'";
		
		if($_POST[p_NumCarta] != "")	$sqlPlus .= " AND id = '".(208600000000000+$_POST[p_NumCarta])."'";
		
		$vWPessoa = $_POST[p_Nome];
		if (empty($_POST[p_Nome]))
		{
			$aWPessoa = $dbData->Row($dbData->Get("select WPessoa_Id from ccobcarta where id = '".(208600000000000+$_POST[p_NumCarta])."'"));
			$vWPessoa = $aWPessoa[WPESSOA_ID];			
		}
		
		$dbData->Get("SELECT * FROM ccobcarta WHERE 1=1 ".$sqlPlus." ORDER BY id DESC");
		
		echo $wpessoa->GetInfoFinan($vWPessoa);
		echo $view->Br();		
		
		if($dbData->Count () > 0)
		{
		
			$grid = new DataGrid(array("Carta","Aluno","Data Vencto","Situação","Boletos","Data Emissão","Data AR","Follow Up","Alteração","2a.via"));
				
			while($row = $dbData->Row ())
			{
			
				$dadosPessoa 	= $wpessoa->GetIdInfo($row[WPESSOA_ID]);
				$dadosState 	= $state->GetIdInfo($row[STATE_ID]);
				$arBoletos 		= $ccobDebito->GetBoletoReferencia($row[ID]);
				
				if (!is_array($arBoletos))
				{
					$vRef = 'Não informado';
				}
				else
				{
					$vRef = implode(", ",$arBoletos[REFERENCIA]);
				}
				
				$vCorFollow = "#0066CC";
				$aFollow = $dbDataAux->Row($dbDataAux->Get("select count(*) as qtde from ccobfollow where ccobcarta_id=$row[ID]"));
				if ($aFollow[QTDE] > 0)
					$vCorFollow = "#FF0000";
				
				$grid->Content(($row[ID]-208600000000000));
				$grid->Content($dadosPessoa[NOME]);
				$grid->Content($row[DTVENCTO]);
				$grid->Content($dadosState[NOME]);
				$grid->Content($vRef);
				$grid->Content($row[DTEMISSAO]);
				$grid->Content($view->Link(_NVL($row[DTAVISOREC],$view->IconFA("fa-calendar",array("style"=>"color:#0066CC;font-size:20px;"))),array("href"=>"../box/ccobcarta_icadar.php?p_CCobCarta_Id="._UrlEncrypt($row[ID]),"class"=>"openColorBox")));
				$grid->Content($view->Link($view->IconFA("fa-thumbs-o-up",array("style"=>"color:$vCorFollow;font-size:20px;")),array("href"=>"../box/ccobfollow_icad.php?p_CCobCarta_Id="._UrlEncrypt($row[ID]),"class"=>"openColorBox")));
				$grid->Content($view->Link($view->IconFA("fa-pencil",array("style"=>"color:#0066CC;font-size:20px;")),array("href"=>"../box/ccobcarta_ialtera.php?p_CCobCarta_Id="._UrlEncrypt($row[ID]),"class"=>"openColorBox")));
				$grid->Content($view->Link($view->IconFA("fa-print",array("style"=>"color:#0066CC;font-size:20px;")),array("href"=>"../rep/ccobproc_iimpressaocarta.php?p_CCobCarta_Id="._UrlEncrypt($row[ID]),"class"=>"openColorBox")));
				
		
			}
		}
		else 
		{
			$view->Dialog('I','Carta de Cobrança','Aluno(a) não possui cartas de cobrança.');
		}
		
		unset($grid);
		
		
		
		
	}
	else 
	{
		$view->Dialog('I','Carta de Cobrança','Informe pelo menos um campo de consulta');
	}
		


	
	unset($ccobCartaTi);
	unset($ccobCrit);
	unset($state);
	
	unset($dbOracle);
	
	unset($user);

?>