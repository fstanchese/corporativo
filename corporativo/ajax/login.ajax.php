<?php
	require_once ("../lib/general.php");
	
	if ($_POST[p_user] != "" && $_POST[p_pass] != "")
	{
		define (DB_HOST, "dbcorp.usjt.br");
		define (DB_PORT, "1521");
		define (DB_SID,  "dbcorp");

		$db = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP) (HOST = " . DB_HOST . ")(PORT = " . DB_PORT . ")) (CONNECT_DATA= (SID = " . DB_SID . ")))";
		
		error_reporting (0);

		if (!$cn = ocinlogon ($_POST[p_user], $_POST[p_pass], $db)) 		
		{
			$html = "<div style='width:100%;height:auto;'><div class='titleMsg'>Erro no Login</div></div><div class='msgBoxImage'><img src='../images/error.png'></div><div class='msgBoxContent'><p>Login e/ou Senha Inválidos.</p></div></div>";
			echo json_encode (array ("login"=>"0", "html"=> utf8_encode($html)));
		}
		else
		{
			// Carrega a lista de departamentos
			
			
			$cDepartWP = "SELECT depart_Id FROM wpessoa WHERE upper(usuario) = UPPER('$_POST[p_user]')";
			$_DepartWP = oci_parse ($cn, $cDepartWP);
			oci_execute ($_DepartWP);
			$DepartWP = oci_fetch_array ($_DepartWP);
			

			$cDepart = "SELECT wpesxdepart.depart_Id AS depart_id, depart.nome AS depart FROM wpesxdepart, wpessoa, depart WHERE wpesxdepart.dttermino IS NULL AND wpessoa.id=wpesxdepart.wpessoa_id AND UPPER(wpessoa.usuario) = UPPER('$_POST[p_user]') AND depart.id = wpesxdepart.depart_id";
			$_Depart = oci_parse ($cn, $cDepart);
			oci_execute ($_Depart);
			
			$select = "<div style='width:500;height:120px'>
							<form method='POST' name='flogin' id='flogin'>
							<input type='hidden' name='p_ipaddr' value='" . _Encrypt ($_POST[p_ipaddr]) . "'>
							<input type='hidden' name='p_url' value='" . _Encrypt ($_POST[p_url]) . "'>
							<input type='hidden' name='p_user' value='" . _Encrypt ($_POST[p_user]) . "'>
							<input type='hidden' name='p_pass' value='" . _Encrypt ($_POST[p_pass]) . "'>
							<label>Selecione o departamento:</label><br/><br/><select name='p_dept'>";
			
			while ($Depart = oci_fetch_array ($_Depart)) 
			{
				$select .= "<option value='" . _Encrypt ($Depart[DEPART_ID]) . "'";
				
				if($DepartWP[DEPART_ID] == $Depart[DEPART_ID]) $select .= " selected ";
				
				$select .= " >$Depart[DEPART]</option>";
			}
			
			$select .= "</select><br/><br/><input type='button' value='ENTRAR' class='btnSelDept'></form></div>";
	
			
			$ret = array ("login"=>"1", "html"=> utf8_encode($select));
			echo json_encode ($ret);
		}
	}
?>