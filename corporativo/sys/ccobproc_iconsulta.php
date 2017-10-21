<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Consulta de Lote de Cobrança","Consulta de Lote de Cobrança",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	
	
	$dbOracle = new Db ($user);

	$dbData 	= new DbData ($dbOracle);
	$dbDataAux	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	
	$view = new ViewPage($app->title,$app->description);
	
	

	$view->Header($user,$nav);

	
	$view->IncludeJS("ccobproc.js");
	
	
	
	
	$form = new Form();

		$form->Fieldset("Consultar Lote");
		
			$form->Input("Início do Período",'text',array("name"=>'p_DtInicio', "class"=>"competencia dtinicio", "value"=>$_POST[p_DtInicio] ));
			$form->Input("Término do Período",'text',array("name"=>'p_DtTermino', "class"=>"competencia dttermino", "value"=>$_POST[p_DtTermino] ));
			
			$form->Input("Número do Lote",'text',array("name"=>'p_NumLote', "value"=>$_POST[p_NumLote] ));
			
			$form->Button('submit',array("name"=>"btConsultar","value"=>"Consultar"));
			$form->Button('reset',array("name"=>"cancelar", "value"=>"Cancelar","class"=>"cancel"));
			
		$form->CloseFieldset ();
		
	unset ($form);
	
		
		
	if($_POST[btConsultar] == "Consultar")
	{
		
		$sqlPlus = '';
		if($_POST[p_DtTermino] != "")
		{
			$ultimo_dia = date("t", mktime(0,0,0,substr($_POST[p_DtTermino], 0, 2),'01',substr($_POST[p_DtTermino], 3, 4))) . '/' . $_POST[p_DtTermino];
		}
		else
		{
			$ultimo_dia = date('d/m/Y');
		}
		
		if($_POST[p_NumLote] != "")		$sqlPlus .= " AND id = '".(207900000000000+$_POST[p_NumLote])."'";
		
		if($_POST[p_DtInicio] != "")	$sqlPlus .= " AND dtInicio between '01/".$_POST[p_DtInicio]."' and '".$ultimo_dia."'";
		
		//if($_POST[p_DtTermino] != "")	$sqlPlus .= " AND dtTermino = '30/".$_POST[p_DtTermino]."'";
			
		
		
		
		$dbData->Get("SELECT * FROM ccobproc WHERE 1=1 ".$sqlPlus." order by id desc");
		
		if($dbData->Count () > 0)
		{
		
			$grid = new DataGrid(array("Lote","Inicio do Período","Fim do Período","Qtde Boletos","Qtde Cartas","Valor","Critérios","Cartas","Imprimir Carta","Imprimir Etiqueta","Indivíduos SPC"),'',TRUE,array(0 => "DESC"));
				
			while($row = $dbData->Row ())
			{

				$dbDataAux->Get("select sum(qtdealuno) as qtdealuno,sum(qtdeboleto) as qtdeboleto,to_char(sum(valortotal),'999G999G990D99') as valor from ccobcrit where ccobproc_id = $row[ID]");
				
				$rowAux = $dbDataAux->Row();
				
				$grid->Content(($row[ID]-207900000000000),array("align"=>"right"));
				$grid->Content($row[DTINICIO],array("align"=>"center"));
				$grid->Content($row[DTTERMINO],array("align"=>"center"));
				$grid->Content($rowAux[QTDEBOLETO],array("align"=>"right"));
				$grid->Content($rowAux[QTDEALUNO],array("align"=>"right"));
				$grid->Content($rowAux[VALOR],array("align"=>"right"));
				$grid->Content($view->Link($view->IconFA("fa-eye",array("style"=>"color:#0066FF;font-size: 17px;")),array("class"=>"openColorBox","href"=>"../box/ccobproc_icriterioporproc.php?p_CCobProc_Id="._UrlEncrypt($row[ID]))));
				$grid->Content($view->Link($view->IconFA("fa-user",array("style"=>"color:#0066FF;font-size: 17px;")),array("class"=>"openColorBox","href"=>"../box/ccobproc_ipreviewcriterio.php?p_CCobProc_Id="._UrlEncrypt($row[ID]))) . ' ' .
				     		   $view->Link($view->IconFA("fa-list-alt",array("style"=>"color:#0066FF;font-size: 17px;")),array("target"=>"_blank","href"=>"../rep/ccobproc_ircartaslote.php?p_CCobProc_Id="._UrlEncrypt($row[ID])))						
				);
				
				$grid->Content($view->Link($view->IconFA("fa-print",array("style"=>"color:#0066FF;font-size: 17px;")),array("class"=>"btnPrintCarta","href"=>"#","link"=>"../rep/ccobproc_iimpressaocarta.php?p_CCobProc_Id="._UrlEncrypt($row[ID]))));
				
				
				$grid->Content($view->Link($view->IconFA("fa-tags",array("style"=>"color:#0066FF;font-size: 17px;")),array("target"=>"_blank","href"=>"../rep/ccobproc_iimpressaoetiqueta.php?p_CCobProc_Id="._UrlEncrypt($row[ID]))));
				
				$grid->Content($view->Link($view->IconFA("fa-credit-card",array("style"=>"color:#0066FF;font-size: 17px;")),array("target"=>"_blank","href"=>"../rep/ccobproc_iincspc.php?p_CCobProc_Id="._UrlEncrypt($row[ID]))));
				
		
			}
		}
		else
		{
			$view->Dialog("A", "Carta de Cobrança", "Não existem lotes de carta de cobrança para os critérios selecionados.");			
		}
		unset($grid);
		
		
		
		
	}
		


	
	unset($ccobCartaTi);
	unset($ccobCrit);
	unset($state);
	
	unset($dbOracle);
	
	unset($user);

?>