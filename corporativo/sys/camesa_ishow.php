<?

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user 			= new User ();
	$app = new App("Situaчуo das Mesas","Situaчуo das Mesas - Controle de Atendimento",array('ADM','CPD','SAA','SAA_ANALISTA'),$user);
	
	include_once('../engine/Db.class.php');
	include_once('../model/CAMesa.class.php');
	
	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);	
	$camesa		= new CAMesa($dbOracle);
	
	echo $camesa->GetMesaSituacao(199700000000019);
	
	unset($user);
	unset($app);
	
?>