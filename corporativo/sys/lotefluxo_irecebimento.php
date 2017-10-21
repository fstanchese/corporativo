<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Recebimento de Lote","Recebimento de Lote",array('ADM','CPD','CASENHAGER'),$user);
	

	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/DataGrid.class.php");
		
	include("../model/LoteFluxo.class.php");
	include("../model/LoteProc.class.php");
	include("../model/CAEvXWPes.class.php");
	include("../model/CAWPesDet.class.php");
	include("../model/CASenha.class.php");
	include("../model/Depart.class.php");
	include("../model/Campus.class.php");	
	include("../model/Sala.class.php");
	

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);

	

	$loteFluxo	= new LoteFluxo($dbOracle);
	$loteProc	= new LoteProc($dbOracle);
	$caEvXWPes	= new CAEvXWPes($dbOracle);
	$caWPesDet	= new CAWPesDet($dbOracle);
	$caSenha	= new CASenha($dbOracle);
	$depart		= new Depart($dbOracle);
	$campus		= new Campus($dbOracle);
	$sala		= new Sala($dbOracle);
		
	$view 		= new ViewPage($app->title,$app->description);
	
	
	if($_POST["btReceber"] == 'Receber')
	{
					
		
		
		foreach ($_POST[chReceb] as $linha)
		{
			$aUpd = array("p_O_Option"=> 'update',"p_DtRecebimento"=>date('d/m/Y H:i:s'),"p_WPessoa_Rec_Id"=>$user->GetId(),"p_LoteFluxo_Id"=>$linha);
			$loteFluxo->IUD($aUpd);
			//$dbData->Set("update lotefluxo set dtRecebimento=sysdate,WPessoa_Rec_Id= ".$user->GetId()." where id=".$linha);			
		}
			
	}
	
	
	$view->Header($user);
	
	
	echo $view->JS(	"
			
				$('.btCancelar').click( function() {
					$('.divItens').html('');
				});
			
				$(document).on('click','.delSenha',function(){
			
					$.post('../ajax/lote.ajax.php?vTipo=ExcluiSenha&vSenha='+$(this).attr('idr'),function(retorno){
						$('.btIncluir').trigger('click');
					});
			
				});
			
				$('.btIncluir').trigger('click');
			
				$('.marcar').click(function() {			
					if ($(this).is(':checked'))
					{
						$('.ccheck').attr('checked','TRUE');
					}
					else
					{
						$('.ccheck').removeAttr('checked');
					}
			
				});
			"
		);
	

	$form = new Form();

		$form->Fieldset("Número do Lote");
			
			$form->Input("Lote",'text',	array("name"=>'p_NumeroLote', "class"=>"size10"));
		
			$form->Button ("submit", array ("value"=>"Selecionar"));
		
		$form->CloseFieldset ();
		
	if($_POST[p_NumeroLote] != "")
	{
		


		$primeiraLinha = $dbData->Row($dbData->Get("SELECT * FROM lotefluxo WHERE numero = '".($_POST[p_NumeroLote])."'"));
		
		
		$form->Fieldset("Informações do Lote");
			$form->Input('Número do Lote','label', $primeiraLinha[NUMERO]);
			$form->Input('Processo','label', $loteProc->Recognize($primeiraLinha[LOTEPROC_ID]));
			$form->Input('Departamento','label',$depart->Recognize($primeiraLinha[DEPART_ID]));
			$form->Input('Sala','label',$sala->Recognize($primeiraLinha[SALA_ID]));
			$form->Input('Unidade','label',$campus->Recognize($primeiraLinha[CAMPUS_ID]));
		$form->CloseFieldset ();
		
		$dbData->Get("SELECT * FROM lotefluxo WHERE dtrecebimento is null and lotefluxo.numero = '".$_POST[p_NumeroLote]."' ");		
		
		if($dbData->Count () > 0)
		{
				
			$grid = new DataGrid(array("Senha","Pessoa","CPF",$view->CheckBox(array("class"=>"marcar"))));
				
			while($row = $dbData->Row ())
			{
		
				$aPessoa = $caWPesDet->GetWPesInfo($row[CAEVXWPES_ID]);
				
				$grid->Content($caSenha->GetSenha($row[CASENHA_ID]),array('align'=>'left'));
				$grid->Content($aPessoa[NOME],array('align'=>'left'));
				$grid->Content($aPessoa[CPF],array('align'=>'right'));
				$grid->Content($view->CheckBox(array("class"=>"ccheck","value"=>$row[ID],"name"=>"chReceb[]")));
			}
		}
		else
		{
			echo $view->JS("
			
					$.Zebra_Dialog( 'Não existem documentos a serem recebidos desse lote',
					{
						'type': 'error',
						'title': 'Lote de Documentos',
						'keyboard' : true,
						'overlay_close' : false,
						'show_close_button' : true,
				    	'buttons': true
					}
			
					);
					");
		}
		
		unset($grid);
		
	
		echo $view->Br() . $view->Br();
		if($dbData->Count () > 0)
		{		
			$form->Fieldset();
				$form->Button ("submit", array ("value"=>"Receber","name"=>"btReceber"));
			$form->CloseFieldset ();
		}	
	}
	
	
	
	unset($form);
	
	
	
	unset($loteFluxo);
	unset($loteProc);
	unset($caEvXWPes);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>