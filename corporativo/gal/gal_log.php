<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GAL - Log de Atividade","GOS - Log de Atividade",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/DataGrid.class.php");
	
	include("../model/Depart.class.php");
	
	
	
	$dbOracle = new Db ($user);
	$dbDataO = new DbData ($dbOracle);
	
	$dbMySQL = new Db($user,'mysql','mysql.usjt.br|gal|gal@usjt|gal');
	$dbDataM = new DbData ($dbMySQL);
	
	$dados = $dbDataM->Get("SELECT * FROM actions");
	$arAction[''] = " - "; 
	while($linha = $dbDataM->Row())
	{
		
		$arAction[$linha[ID]] = $linha[desc];
		
	}
	
	
	$view = new ViewPage("GAL LOG","GAL");
	
	$view->Header($user);

	//Instanciar formulсrio
	$form = new Form();
	
		$form->Fieldset("Filtrar");

			$form->Input("Aчуo","select",array("name"=>"acao","value"=>$_GET[acao],"option"=>$arAction));
			
			$form->Input("Mсquina","text",array("name"=>"cname","value"=>$_GET[cname]));
			
			$form->Input("CPU","text",array("name"=>"cpu","value"=>$_GET[cpu]));
			
			$form->Input("Descriчуo","text",array("name"=>"descricao","value"=>$_GET[descricao]));
			
			$form->Input("Data","date",array("name"=>"data","value"=>$_GET[data]));
			
			$form->Button("button",array("value"=>"Filtrar","class"=>"search"));
			
		$form->CloseFieldset();
	//fecha formulсrio
	unset ($form);
	
	if($_GET["p_O_Option"] == 'search')
	{
	
		if($_GET[acao] != "") $sqlP .= " AND actionID = '".$_GET[acao]."' ";
		if($_GET[cname] != "") $sqlP .= " AND lower(devices.cname) like '%".strtolower($_GET[cname])."%' ";
		if($_GET[cpu] != "") $sqlP .= " AND lower(cpu) like '%".strtolower($_GET[cpu])."%' ";
		if($_GET[descricao] != "") $sqlP .= " AND lower(value) like '%".strtolower(str_replace(" ","%",$_GET[descricao]))."%' ";
		if($_GET[data] != "")
		{
			$aux = explode("/",$_GET[data]);
			$sqlP .= " AND dt between '".$aux[2]."/".$aux[1]."/".$aux[0]." 00:00:00' AND '".$aux[2]."/".$aux[1]."/".$aux[0]." 23:59:59'";
		}
		
		
		
		
		$dbDataM->Get("SELECT logs.*, devices.cname, actions.desc as acao FROM logs INNER JOIN actions ON actions.ID = logs.actionID INNER JOIN devices ON logs.deviceID = devices.uniqueID WHERE 1=1 ".$sqlP." ORDER BY logs.ID DESC");
		
			//Se a consulta possuir resultados
			if($dbDataM->Count () > 0)
			{
				//Instancia o DataGrid passando as colunas
				$grid = new DataGrid(array("Aчуo","Descriчуo","Data","Mсquina"));
				
				echo $view->H4("Total de Registros: ".$dbDataM->Count());
				
				//Obtъm as linhas da execuчуo do arquivo .sql
				while($row = $dbDataM->Row ())
				{
					
					
					
					$grid->Content($row[acao]);
					$grid->Content(utf8_decode($row[value]));
					$grid->Content($row[dt]);
					$grid->Content($row[cname]);
					
					
				}
			}
			
			//fecha grid
			unset($grid);
			
		//$dbDataM->Pagination();
	
	}
	unset($dbDataM);	
	unset($dbDataO);
	unset($dbOracle);
	unset($dbMySQL);
	
	unset($user);

?>