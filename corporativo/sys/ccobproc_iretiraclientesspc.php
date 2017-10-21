<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Alunos / Clientes que precisam ser retirados do SPC","Alunos / Clientes que precisam ser retirados do SPC",array('ADM','CPD','CARTACOBRANCA'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../model/Parcel.class.php");

	
	
	$dbOracle = new Db ($user);

	$dbData 	= new DbData ($dbOracle);
	$dbDataAux	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app, $dbData);
	
	$parcel 	= new Parcel($dbOracle);
	
	
	$view = new ViewPage($app->title,$app->description);
	
	

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
		
		
		$dbData->Get("SELECT ccobcarta.id, ccobcarta.wpessoa_id, parcel_id, wpessoa.nome as pessoa FROM ccobcarta, wpessoa WHERE wpessoa.id = ccobcarta.wpessoa_id AND ccobcrit_id IN ( SELECT id FROM ccobcrit WHERE ccobproc_id = '".(207900000000000+$_POST[p_NumLote])."' ) AND state_id IN (3000000047003,3000000047004) AND EXISTS ( SELECT id FROM ccobconseq WHERE ccobcarta_id = ccobcarta.id AND dtexclusao IS NULL) ORDER BY pessoa");
		
		if($dbData->Count () > 0)
		{
		
			$grid = new DataGrid(array("Aluno","Carta","Avalista","Confessor"),"",TRUE,array(2=>"desc",0=>"asc"));
				
			while($row = $dbData->Row ())
			{
				
				unset($aParcel);
				
				if($row[PARCEL_ID] != "")
				{
					
					$aParcel = $parcel->GetIdInfo($row[PARCEL_ID]);
					
				}
				
				
				
				
				$grid->Content($row[PESSOA]);
				$grid->Content(($row[ID]-208600000000000),array("align"=>"right"));
				$grid->Content($aParcel[WPESSOA_AVALISTA_NOME]);
				$grid->Content($aParcel[WPESSOA_CONFESSOR_NOME]);
				
				
				
		
			}
		}
		
		unset($grid);
		
		
		
		
	}
		


	
	unset($ccobCartaTi);
	unset($ccobCrit);
	unset($state);
	
	unset($dbOracle);
	
	unset($user);

?>