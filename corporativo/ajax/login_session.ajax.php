<?php
	
	session_name ("optimizer");
	session_start ();
	
	if($_POST[action] == "logout")
	{
		$_SESSION = array();
		
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}
		
		session_destroy();
		exit(0);
	}
	
	
	//Verifica se a Requisiчуo foi feita para efetuar a troca de Unidade
	if($_POST['p_UnitChosen'] != "")
	{
		$_SESSION[unidade_atual] = $_POST['p_UnitChosen'];
		
		exit(0);
	}
	

	require_once ("../lib/general.php");	
	include ("../engine/User.class.php");
	include ("../engine/Db.class.php");

	//verificar se veio do combo de troca de Depto
	if($_POST[p_user] == "")
	{
		
		$_POST[p_user] 		= $_SESSION[user];
		$_POST[p_pass] 		= $_SESSION[pass];
		$_POST[p_dept] 		= $_REQUEST[p_DeptChosen];
		$_POST[p_ipaddr] 	= $_SESSION[ipaddr];
				
	}
	else 
	{
		$_POST[p_ipaddr]	= _Decrypt ($_POST[p_ipaddr]);
		$_POST[p_user] 		= _Decrypt ($_POST[p_user]);
		$_POST[p_pass] 		= _Decrypt ($_POST[p_pass]);
		$_POST[p_dept] 		= _Decrypt ($_POST[p_dept]);
	}

	
	
	$user		= new User ($_POST[p_user], $_POST[p_pass], $_POST[p_dept]);
	$dbOracle	= new Db ($user);
	
	
	$dbData		= new DbData ($dbOracle);
	
	
	$_SESSION[ipaddr]		= $_POST[p_ipaddr];
	$_SESSION[user]			= $_POST[p_user];	
	$_SESSION[pass]			= $_POST[p_pass];
	$_SESSION[Depart_Id]	= $_POST[p_dept]; 
	
	
	// Carrega as roles utilizando a funчуo oRoles
	
	$dbData->Get ("SELECT oRoles AS GROUPS FROM DUAL");
	$roles = $dbData->Row ();
	
	$_SESSION[groups] = $roles[GROUPS];
	
	
	// Carrega o ID do usuсrio no WPESSOA
	
	$dbData->Get ("SELECT id, nome FROM WPESSOA WHERE UPPER(usuario) = UPPER('$_POST[p_user]')");
	$userId = $dbData->Row ();
	
	$_SESSION[userid]		= $userId[ID];
	$_SESSION[p_WPessoa_Id] = $userId[ID];
	$_SESSION[nome] 		= $userId[NOME];
	
	$_SESSION["theme"] 		= "azul.css";
		

	// Carrega os Departamentos do usuсrio
	
	$dbData->Get ("SELECT wpesxdepart.depart_Id AS depart_id, depart.nome AS depart FROM wpesxdepart, wpessoa, depart WHERE wpesxdepart.dttermino IS NULL AND wpessoa.id=wpesxdepart.wpessoa_id AND UPPER(wpessoa.usuario) = UPPER('$_POST[p_user]') AND depart.id = wpesxdepart.depart_id");
	
	while ($departs = $dbData->Row ())
	{
		$_SESSION[dept][$departs[DEPART_ID]] = $departs[DEPART];
	}
	
	if($_REQUEST[p_DeptChosen] == "")
	{
		
		// Carrega a Unidade padrуo
		
		$dbData->Get ("SELECT campus_id FROM wpacampus WHERE wpessoa_id = $userId[ID]");
		$unidadeAtual = $dbData->Row ();
		
		$_SESSION[unidade_atual] = $unidadeAtual[CAMPUS_ID];
	}
	
	
	// Carrega as Unidades onde presta serviчo
	
	$dbData->Get ("SELECT campus_id, campus_gsrecognize (campus_id) AS unidade FROM wpsxcampus WHERE wpessoa_id = $userId[ID]");		

	while ($unidades = $dbData->Row ())
	{
		$_SESSION[unidades][$unidades[CAMPUS_ID]] = $unidades[UNIDADE];
	}
	
	
	if(trim(_Decrypt($_POST[p_url])) == "") echo "../sys/busca.php"; else echo "../".urldecode(trim(_Decrypt($_POST[p_url])));

?>