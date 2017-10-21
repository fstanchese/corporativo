<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GAL - Devices","GOS - Devices",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");

	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/DataGrid.class.php");

	include("../model/Depart.class.php");


	
	$dbOracle = new Db ($user);
	$dbDataO = new DbData ($dbOracle);

	$dbMySQL = new Db($user,'mysql','mysql.usjt.br|gal|gal@usjt|gal');
	$dbDataM = new DbData ($dbMySQL);

	$depart = new Depart($dbOracle);


	$view = new ViewPage("GAL DEVICES","GAL");

	$view->Header($user);

	//Instanciar formul?rio
	$form = new Form(array("method"=>"GET"));

		$form->Fieldset("Filtrar");

			$form->Input("Depto","select",array("name"=>"depto_id","value"=>$_GET[depto_id],"option"=>$depart->Calculate("Geral",$dbDataO)));

			$form->Input("Sistema","text",array("name"=>"sistema","value"=>$_GET[sistema]));

			$form->Input("CPU","text",array("name"=>"cpu","value"=>$_GET[cpu]));
			
			$form->Input("IP","text",array("name"=>"ip","value"=>$_GET[ip]));

			$form->Button("submit",array("value"=>"Filtrar"));

		$form->CloseFieldset();
	//fecha formul?rio
	unset ($form);



	if($_GET[depto_id] != "") $sqlP .= " AND unitID = '".$_GET[depto_id]."' ";
	if($_GET[system] != "") $sqlP .= " AND lower(system) like '%".strtolower($_GET[system])."%' ";
	if($_GET[cpu] != "") $sqlP .= " AND lower(cpu) like '%".strtolower($_GET[cpu])."%' ";
	if($_GET[ip] != "") $sqlP .= " AND lower(ipaddr) like '%".strtolower($_GET[ip])."%' ";


	$dbDataM->Get("SELECT * FROM devices WHERE 1=1 ".$sqlP." ORDER BY uniqueID");

		//Se a consulta possuir resultados
		if($dbDataM->Count () > 0)
		{
			//Instancia o DataGrid passando as colunas
			$grid = new DataGrid(array("MAC ADDR","IP","Local","Sub Local","Depto","Registro","Sistema", "Nome Máquina", "CPU","RAM","OBS"));

			echo $view->H4("Total de Registros: ".$dbDataM->Count());

			//Obtém as linhas da execu??o do arquivo .sql
			while($row = $dbDataM->Row ())
			{


				$grid->Content("<a href='device_detail.php?device=".$row[uniqueID]."' class='openColorBox'>".$row[macaddr]."</a>");
				$grid->Content($row[ipaddr]);
				$grid->Content($row[locationID]);
				$grid->Content($row[subunitID]);

				$dbDataO->Get("SELECT nomereduz as nome FROM depart WHERE id = '".$row["unitID"]."'");
				$linha = $dbDataO->Row();


				$grid->Content($linha[NOME]);
				$grid->Content(utf8_decode($row[registryName]));
				$grid->Content($row[system]);
				$grid->Content($row[cname]);
				$grid->Content($row[cpu]);
				$grid->Content($row[ram]);
				$grid->Content($row[obs]);


			}
		}

		//fecha grid
		unset($grid);

	//$dbDataM->Pagination();


	unset($dbDataM);
	unset($dbDataO);
	unset($dbOracle);
	unset($dbMySQL);

	unset($user);

?>