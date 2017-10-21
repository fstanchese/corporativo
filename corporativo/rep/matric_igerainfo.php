<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	set_time_limit(5000);
	
	$user = new User ();
	$app = new App("Informações Matrículas Geração","Informações Matrículas Geração",array('ADM','CPD','MARKETINGGER'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData($dbOracle);
	
	//echo $_GET[vtipo]; die();
	
	require_once("../engine/Excel.class.php");
		
	$excel = new Excel($app->title.'_'.$_GET[vtipo]);
		
	if ($_GET[vtipo] == 'total')
		$excel->Header(array("Código","Nome","Curso","Turno","Campus","Dt Rematrícula","FIES","Reprovado 2014","Possui Débito Financeiro 2014?","PROUNI 100%","PROUNI 50%","Outras Bolsas","Percentual","Data Geração","Data Vencimento","Data Pagamento","Matricula Efetivada","Boleto com valor","Aguardando baixa","Boleto Zerado"));
	else
		$excel->Header(array("Código","Nome","Curso","Turno","Campus","Dt Rematrícula","FIES","Reprovado 2014","Possui Débito Financeiro 2014?","PROUNI 100%","PROUNI 50%","Outras Bolsas","Percentual","Data Geração","Data Vencimento","Data Pagamento"));
		
	//$dbData->Get($bolsaSol->query('qTodosIncentivo',array('p_O_Valor2' => 724, 'p_BolsaSol_CESJProcSel_Id' => $_POST["p_CESJProcSel_Id"], 'p_PLetivo_Id' => $_POST["p_PLetivo_Id"],'p_WPleito_Id' => $_POST["p_WPleito_Id"], 'p_Data1' => $_POST["p_Data1"], 'p_Data2' => $_POST["p_Data2"] )))
	
	$vTotal = 0;
	foreach ($_SESSION[$_GET[vtipo]] as $key => $aMatriz)
	{
		$p_WPessoa_Id = $_SESSION[$_GET[vtipo]][$key]['WPESSOA_ID'];

			
		//query outras bolsas
		$sql = "select Bolsati_gsRecognize(BolsaTi_Id) as Bolsati,bolsa_gnPercentual(Id,'01') as PercentualCalc, bolsati_id, percentual from bolsa where state_id in (3000000018001,3000000018003) and to_date('15/01/2015') between dtinicio and dttermino and wpessoa_id=$p_WPessoa_Id";
		$dbData->Get($sql);
		$vBolsaDesc = '';
		$vBolsaPerc = '';

		$vProUni50 = 'Não';
		$vProUni100 = 'Não';
		$vFIES = 'Não';
		
		while ($aBolOutras = $dbData->Row())
		{

			if ($aBolOutras[BOLSATI_ID] == 10600000000049)
			{
				if ($aBolOutras['PERCENTUAL'] == 50)
					$vProUni50 = 'Sim';
				if ($aBolOutras['PERCENTUAL'] == 100)
					$vProUni100 = 'Sim';
				
			}
			else
			{
				if ($aBolOutras[BOLSATI_ID] == 10600000000048 || $aBolOutras[BOLSATI_ID] == 10600000000156 || $aBolOutras[BOLSATI_ID] == 10600000000152 || $aBolOutras[BOLSATI_ID] == 10600000000153 || $aBolOutras[BOLSATI_ID] == 10600000000160)
				{
					$vFIES = 'Sim';						
				}
				else
				{
					$vBolsaDesc .= ' - ' . $aBolOutras['BOLSATI'];
					$vBolsaPerc += $aBolOutras['PERCENTUALCALC'];						
				} 
			}
			
		}
		
		//Aluno com débito
		
		$sql = "select count(id) as count from Boleto where Boleto_gnState(Id,sysdate, 'CONSIDERAR_QUITADO' ) = 3000000000002 and BoletoTi_Id in (92200000000002,92200000000003,92200000000009,92200000000010,92200000000012,92200000000014,92200000000015,92200000000018) and Boleto.Referencia not like '%2015/01%' and WPessoa_Sacado_Id = nvl ( $p_WPessoa_Id ,0 )";
		$aDebito = $dbData->Row($dbData->Get($sql));
		
		$vDebito = 'Não';
		if ($aDebito['COUNT'] > 0)
			$vDebito = 'Sim';
		
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['RA'],array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['NOME'],array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['CURSO'],array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['PERIODO'],array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['CAMPUS'],array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['DATAMAT'],array("class"=>"TEXTO"));
		$excel->Content($vFIES,array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['REPROVADO'],array("class"=>"TEXTO"));
		$excel->Content($vDebito,array("class"=>"TEXTO"));
		$excel->Content($vProUni100,array("class"=>"TEXTO"));
		$excel->Content($vProUni50,array("class"=>"TEXTO"));
		$excel->Content($vBolsaDesc,array("class"=>"TEXTO"));
		$excel->Content($vBolsaPerc,array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['BOLETODT'],array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['DATAVENCTO'],array("class"=>"TEXTO"));
		$excel->Content($_SESSION[$_GET[vtipo]][$key]['DATAPAGTO'],array("class"=>"TEXTO"));

		
		if ($_GET[vtipo] == 'total')
		{
			$excel->Content($_SESSION[$_GET[vtipo]][$key]['MATEFETIVA'],array("class"=>"TEXTO"));
			$excel->Content($_SESSION[$_GET[vtipo]][$key]['BOLVALOR'],array("class"=>"TEXTO"));
			$excel->Content($_SESSION[$_GET[vtipo]][$key]['AGUARDBAIXA'],array("class"=>"TEXTO"));
			$excel->Content($_SESSION[$_GET[vtipo]][$key]['BOLZERADO'],array("class"=>"TEXTO"));
		}

			
	}
		
	$excel->EndTable();

	
	unset ($form);
	unset($view);
	unset($nav);
	unset($dbData);
	unset($dbOracle);
	unset($app);
	unset($user);
	unset($viewReport);
	
?>