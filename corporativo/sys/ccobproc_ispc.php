<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Lista de Alunos para Inclusão no SCPC","Lista de Alunos para Inclusão no SCPC",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	
	include("../model/CCobCarta.class.php");
	include("../model/WPessoa.class.php");
	include("../model/CCobDebito.class.php");
	
	
	$dbOracle 	= new Db ($user);

	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	
	$view		 = new ViewPage($app->title,$app->description);
	
	
	$wpessoa 	= new WPessoa($dbOracle);
	$ccobCarta	= new CCobCarta($dbOracle);
	$ccobDebito = new CCobDebito($dbOracle);
	
	

	$view->Header($user,$nav);

	
	$view->IncludeJS("ccobproc.js");
	
	
	$form = new Form();

		$form->Fieldset("Consultar Lote");
		
			$form->Input("Número do Lote",'text',array("name"=>'p_NumLote', "value"=>$_POST[p_NumLote] ));
			
			$form->Button('submit',array("name"=>"btProsseguir","value"=>"Prosseguir"));
			
		$form->CloseFieldset ();
		
	unset ($form);
	
		
		
	if($_POST[btProsseguir] == "Prosseguir")
	{

		$pNumLote = (207900000000000+$_POST[p_NumLote]);
		
		echo $view->Link("Ver Relatório",array("href"=>"../rep/ccobproc_iincspc.php?p_CCobProc_Id="._UrlEncrypt($pNumLote),"target"=>"_blank"));
		
		$form = new Form(array("name"=>"f2","action"=>"../filegen/ccobproc_ifilespc.php","target"=>"_blank"));
		
		
			
			
			//AND ccobcarta.state_id = 3000000047003
			//AND  ccobcarta.id NOT IN ( SELECT ccobcarta_id FROM ccobconseq)
			//AND ccobcarta.id NOT IN ( SELECT ccobcarta_id FROM ccobfollow WHERE dtprevisao > sysdate )
			
			
			$sql = "SELECT	ccobcarta.*
					FROM ccobcarta
					WHERE	CCobCarta.CCobCrit_Id IN ( SELECT id FROM ccobcrit WHERE ccobproc_id = '" . $pNumLote."' )
					 		
					ORDER BY WPessoa_gsRecognize(WPessoa_Id)";
			
			$dbData->Get($sql);
			
			if($dbData->Count () > 0)
			{
			
				$grid = new DataGrid(array("&nbsp;","Dt Vencto","RA","Nome","Dt Nascto","Valor Atual","1a Parc."));
					
				while($row = $dbData->Row ())
				{
					

					$aPessoa = $wpessoa->GetIdInfo($row["WPESSOA_ID"]);
					
					$grid->Content("<input type='checkbox' name='spc[]' value='".$row[ID]."' checked>");
					$grid->Content(($row[DTVENCTO]));
					$grid->Content($aPessoa[CODIGO]);
					$grid->Content($aPessoa[NOME]);
					$grid->Content($aPessoa[DTNASCTO]);
					
					$grid->Content(_FormatValor($ccobDebito->GetValorAtual($row[ID])));
					$grid->Content($ccobDebito->GetMenorVencto($row[ID]));
					
					
					
			
				}
			}
			
			unset($grid);
			
			
			echo $view->Br().$view->Br().$view->Br();
			
			$form->Fieldset("");
			
				$form->Button('submit',array("name"=>"btProsseguir","value"=>"Gerar Arquivo"));
				
			$form->CloseFieldset ();
		
		
		unset ($form);
		
	}
	
	unset($ccobCartaTi);
	unset($ccobCrit);
	unset($state);
	
	unset($dbOracle);
	
	unset($user);

?>