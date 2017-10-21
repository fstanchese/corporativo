<?php 
 

include("../engine/User.class.php");
include("../engine/Db.class.php");


$user 		= new User ();
$dbOracle 	= new Db ($user);

$dbData = new DbData ($dbOracle);




if($_POST[p_Action] == "setCriterio")
{
	
	
	require_once("../model/CCobCrit.class.php");
	
	
	$ccobCrit = new CCobCrit($dbOracle);
	
	
	$ccobCrit->SetCriterioSession($_POST);

	unset($ccobCrit);
	
	die();	

}


if($_POST[p_Action] == "getCriterioSession")
{
	
	
	require_once("../engine/View.class.php");
	
	
	require_once("../model/CCobCrit.class.php");
	require_once("../model/StateGru.class.php");
	require_once("../model/CCobCartaTi.class.php");
	require_once("../model/Curso.class.php");
	require_once("../model/BoletoTi.class.php");

	
	$view = new View();
	
	
	$ccobCrit 		= new CCobCrit($dbOracle);
	$state			= new StateGru($dbOracle);
	$ccobCartaTi 	= new CCobCartaTi($dbOracle);
	$curso 			= new Curso($dbOracle);
	$boletoTi 		= new BoletoTi($dbOracle);
	
	
	
	
	$arCritSession = $ccobCrit->GetCriterioSession($_POST[p_DtInicio]."_".$_POST[p_DtTermino]);

	if(count($arCritSession) > 0)
	{
	
		foreach($arCritSession as $key => $criterio)
		{
		
			echo $view->Table(array("style"=>"border: 1px solid;width: 99%;"));
			
			echo $view->Tr(array("style"=>"border: 1px solid;text-align:left;"));
			echo $view->Th("",array("width"=>"3%"));
			echo $view->Th("Situação Acadêmica",array("width"=>"10%"));
			echo $view->Th("Tipo de Carta",array("width"=>"7%"));
			echo $view->Th("Mín. de Boletos",array("width"=>"8%"));
			echo $view->Th("Vencimento",array("width"=>"7%"));
			echo $view->Th("Ignorar Conseq.",array("width"=>"7%"));
			echo $view->Th("Curso",array("width"=>"25%"));
			echo $view->Th("Qtde Cartas",array("width"=>"7%"));
			echo $view->Th("Qtde Boletos",array("width"=>"7%"));
			echo $view->Th("Valor Total",array("width"=>"8%"));

			
			
			echo $view->CloseTr();
			
			
			echo $view->Tr(array("style"=>"border: 1px solid"));
			echo $view->Td() . $view->Link($view->IconFA("fa-times-circle-o", array("style"=>"font-size:17px;color:red")),array("href"=>'#',"class"=>"delCrit", "critSession"=>$_POST[p_DtInicio]."_".$_POST[p_DtTermino], "key"=>$key, "title"=>"Excluir")) . $view->CloseTd();
			echo $view->Td() . $state->Recognize($criterio[CRITERIO][SITACADEMICA]) . $view->CloseTd();
			echo $view->Td() . $ccobCartaTi->Recognize($criterio[CRITERIO][TIPOCARTA]) . $view->CloseTd();
			echo $view->Td() . $criterio[CRITERIO][BOLETOABERTO] . $view->CloseTd();
			echo $view->Td() . $criterio[CRITERIO][DTVENCTO] . $view->CloseTd();
			echo $view->Td() . $view->OnOff($criterio[CRITERIO][IGNORASCPC]) . $view->CloseTd();
			echo $view->Td() . _NVL($curso->Recognize($criterio[CRITERIO][CURSO])) . $view->CloseTd();
			echo $view->Td() . $criterio[RESUMO][WPESSOA] . $view->CloseTd();
			echo $view->Td() . $criterio[RESUMO][BOLETO] . $view->CloseTd();
			echo $view->Td() . _FormatValor($criterio[RESUMO][VALOR]) . $view->CloseTd();
			//echo $view->Td() . $key . $view->CloseTd();
			
			echo $view->CloseTr().$view->CloseTable();
			
			echo $view->Br();
		}
		
		
		echo $view->Div(array("style"=>"width:100%;text-align:center")).$view->Button("button",array("name"=>"enviar","value"=>"Gerar Processo","id"=>"btnGerarProcesso","critSession"=>$_POST[p_DtInicio]."_".$_POST[p_DtTermino])).$view->CloseDiv();
	
	}
	

	unset($ccobCrit);
	unset($state);
	unset($ccobCartaTi);
	unset($curso);
	unset($boletoTi);
	
	
	die();
	
	
}


if($_POST[p_Action] == "delCriterioSession")
{
	
	unset($_SESSION[CCOB][$_POST[p_Proc]][$_POST[p_Key]]);
	die();
	
}


if($_POST[p_Action] == "setProcessoOracle")
{
	
	require_once "../model/CCobProc.class.php";
	require_once "../model/CCobCrit.class.php";
	require_once "../model/CCobCarta.class.php";
	require_once "../model/CCobDebito.class.php";
	require_once "../model/Boleto.class.php";
	
	
	$ccobProc  	= new CCobProc($dbOracle);
	$ccobCrit  	= new CCobCrit($dbOracle);
	$ccobCarta 	= new CCobCarta($dbOracle);
	$ccobDebito = new CCobDebito($dbOracle);
	
	
	$boleto = new Boleto($dbOracle);
	
	
	list($dtInicio,$dtTermino) = explode("_",$_POST[p_Proc]);
	
	$arIns["p_O_Option"] 	= "insert";
	$arIns["p_DtInicio"] 	= "01/".$dtInicio;
	
	$aux = explode("/",$dtTermino);
	
	$arIns["p_DtTermino"] 	= date('t',mktime(0,0,0,$aux[0],1,$aux[1]))."/".$dtTermino;
	
	
	
	if(!$ccobProc->IUD($arIns))
	{
		echo 'Ocorreu um erro. Tente novamente.';
		die();
	}
	
	$arIns[p_CCobProc_Id] = $dbData->GetInsertedId("ccobproc_id");
	

	foreach($_SESSION[CCOB][$_POST[p_Proc]] as $criterio)
	{
		
		$arIns["p_CCobCartaTi_Id"] 	= $criterio[CRITERIO][TIPOCARTA];
		$arIns["p_BoletoTi_Id"] 	= $criterio[CRITERIO][TIPOBOLETO];
		$arIns["p_State_Matric_Id"] = $criterio[CRITERIO][SITACADEMICA];
		$arIns["p_Curso_Id"] 		= str_replace("-","",trim($criterio[CRITERIO][CURSO]));
		$arIns["p_CursoNivel_Id"] 	= str_replace("-","",trim($criterio[CRITERIO][NIVELCURSO]));
		$arIns["p_Qtde"] 			= $criterio[CRITERIO][BOLETOABERTO];
		$arIns["p_DtVencto"]		= $criterio[CRITERIO][DTVENCTO];
		$arIns["p_SCPC"] 			= $criterio[CRITERIO][IGNORASCPC];
		$arIns["p_QtdeBoleto"] 		= $criterio[RESUMO][BOLETO];
		$arIns["p_QtdeAluno"] 		= $criterio[RESUMO][WPESSOA];
		$arIns["p_ValorTotal"] 		= str_replace(',','.', $criterio[RESUMO][VALOR]);
		$arIns["p_DtInicio"] 		= $dtInicio;
		$arIns["p_DtTermino"] 		= $dtTermino;

		
		if(!$ccobCrit->IUD($arIns))
		{
			echo 'Ocorreu um erro. Tente novamente.';
			die(1);
		}
			
		
		$arIns['p_CCobCrit_Id'] = $dbData->GetInsertedId("ccobcrit_id");
		
		$arIns["p_State_Id"] 	= 3000000047001;
		
		$listaDevedores = $ccobCarta->GetDevedores($arIns);
	
		$auxWPessoa = "";
		
		
		foreach($listaDevedores as $wpessoa => $matricArray)
		{
			if($auxWPessoa != $wpessoa)
			{
				$arIns[p_WPessoa_Id] = $wpessoa;
			
				$auxMatric = "";
				foreach($matricArray as $matric => $parcArray)
				{
					
					if($auxMatric !== $matric || $matric == 0)
					{
					
						if ($matric != 0)
							$arIns[p_Matric_Id] = $matric;
						else 
							$arIns[p_Matric_Id] = '';
					
						$auxParc = "";
						
						foreach($parcArray as $parcel => $boletoArray)
						{
							
							if($auxParc !== $parcel)
							{
							
								$arIns[p_Parcel_Id] = $parcel;
								if($arIns[p_Parcel_Id] == 0) $arIns[p_Parcel_Id] = "";
								

								$ccobCarta->IUD($arIns);
								$arIns['p_CCobCarta_Id'] = $dbData->GetInsertedId("ccobcarta_id");
						
								
						
								foreach($boletoArray as $bol => $valor)
								{
									$arIns["p_Boleto_Id"] 		= $bol;
									
									if(!$ccobDebito->IUD($arIns))
									{
										echo 'Ocorreu um erro. Tente novamente.';
										die();
										
									}
										
								}
							}
							
							$auxParc = $parcel;
						}
							
					}
					$auxWMatric = $matric;
				}
				
				$auxWPessoa = $arIns[p_WPessoa_Id];
				
			}
		
			
		
		}
		
	
	}
	
	echo 'Cartas geradas com sucesso. Lote No <b>'.($arIns[p_CCobProc_Id]-207900000000000)."</b>";
	
	
	unset($_SESSION[CCOB]);
	
	unset($ccobProc);
	unset($ccobCrit);
	unset($ccobCarta);
	unset($boleto);
		
	
	die();
	
}	

if ($_POST[p_Action] == "cancelProc")
{
	unset($_SESSION[CCOB]);
	die();
	
}

if ($_POST[p_Action] == "showDetCarta")
{
	require_once("../model/CCobCarta.class.php");

	$ccobCarta = new CCobCarta($dbOracle);
	
	echo $ccobCarta->GetCartaInfo($_POST["vPar"]);
	die();
}


if ($_POST[p_Action] == "showDetCartaTi")
{
	require_once("../model/CCobTiXBolTi.class.php");
	
	$ccobTiXBolTi = new CCobTiXBolTi($dbOracle);
		
	echo implode(' / ',$ccobTiXBolTi->GetBoletoTi($_POST["vPar"],TRUE));
	
}


unset($user);
unset($dbOracle);
unset($dbData);
die();


?>