<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Consulta de Processo por Aluno","Consulta de Processo por Aluno",array('ADM','CPD','CASENHAGER','TELEATENDIMENTO','TEMPTELE'),$user);
	

	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/DataGrid.class.php");
	
	include("../model/CASenha.class.php");
		
	

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);


	$caSenha 	= new CASenha($dbOracle);	
	
	
	$view 		= new ViewPage($app->title,$app->description);
	
	
	
	$view->Header($user);
	
	
	

	$form = new Form();

		$form->Fieldset("Aluno / Candidato");
			
			$form->Input("Aluno / Candidato",'autocomplete',array("execute"=>"WPessoa.AutoCompleteAlunoEx","name"=>'p_WPessoa_Id', "class"=>"size70", "required"=>'1'));
		
			$form->Button ("submit", array ("value"=>"Selecionar"));
		
		$form->CloseFieldset ();
		

	unset($form);
		
	
	
	
	if($_POST[p_WPessoa_Id] != "")
	{
		
		$sql = 	"
			select 
			  caevento.descricao as evento,
			  casenha.id as casenha_id,
			  loteproc.nome as processo,
			  lotefluxo.numero as lote,
			  lotefluxo.dt as dt,
			  lotefluxo.dtrecebimento as dtrec
			FROM
			  casenha, lotefluxo, casenharegra, casenhati, caassunto, caevento, loteproc
			WHERE 
			  casenha.id = lotefluxo.casenha_id
			AND
			  casenha.casenharegra_id = casenharegra.id
			AND
			  casenharegra.casenhati_id = casenhati.id
			AND
			  casenhati.caassunto_id = caassunto.id
			AND
			  caassunto.caevento_id = caevento.id
			
			AND
			  casenha.wpessoa_id = '".$_POST[p_WPessoa_Id]."'
			AND
			  lotefluxo.loteproc_id = loteproc.id
			ORDER BY evento asc, lotefluxo.id desc   
			";
		
		
		
		$dbData->Get($sql);
		
		while($row = $dbData->Row())
		{
			$arItens[$row[EVENTO]][$row[CASENHA_ID]]["PROCESSO"][] 	= $row[PROCESSO];
			$arItens[$row[EVENTO]][$row[CASENHA_ID]]["LOTE"][] 		= $row[LOTE];
			$arItens[$row[EVENTO]][$row[CASENHA_ID]]["DT"][] 		= $row[DT];
			$arItens[$row[EVENTO]][$row[CASENHA_ID]]["DTREC"][] 	= $row[DTREC];
			
		}
		
		if (is_array($arItens))
		{

			
			foreach($arItens as $evento => $arSenha)
			{
				
				echo $view->H3($evento).$view->Br();
				
				
				foreach($arSenha as $senha => $itensSenha)
				{
					
					
					echo $view->Div(array("style"=>"float:left;margin-right:5%;width:350px;background:#f6f7c6"));
					
						echo $caSenha->GetLayoutSenha($senha);
						
						echo $view->Link("Imprimir",array("style"=>"margin-left:130px","class"=>"openColorBox","href"=>"casenha_isenha.php?via2=1&casenha_id="._UrlEncrypt($senha)));
					
					echo $view->CloseDiv();
					
					
					
					echo $view->Div(array("style"=>"float:left;width:55%"));
						$grid = new DataGrid(array("Processo","Lote","Data Geraчуo","Data Recebido"),"Senha ".$caSenha->GetSenha($senha),FALSE);
						
						
						foreach($itensSenha[PROCESSO] as $key => $valor)
						{
						
						
							$grid->Content($valor,array('align'=>'left'));
							$grid->Content($itensSenha[LOTE][$key],array('align'=>'right'));
							$grid->Content($itensSenha[DT][$key],array('align'=>'right'));
							$grid->Content($itensSenha[DTREC][$key],array('align'=>'right'));
						}
						
						unset ($grid);
					}
					
					echo $view->Br();
					
				}
				
			}
			else
			{
				$view->Dialog('I', "Lote", "Candidato(a) nуo possui processo em lote.");
			}				
	
		}	

	
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>