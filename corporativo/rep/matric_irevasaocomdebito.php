<?php

include("../engine/User.class.php");
include("../engine/App.class.php");

$user = new User ();
$app = new App("Relatório de Evasão com Débito","Relatório de Evasão com Débito",array('ADM','CPD'),$user);

include("../engine/Db.class.php");

$dbOracle = new Db ($user);
$dbData = new DbData ($dbOracle);


if($_POST[enviar] == "")
{
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	$view 	= new ViewPage($app->title,$app->description);

	$view->Header($user,$nav);


	$form = new Form();

	$form->Fieldset();

	$form->Input("Data Base dos Boletos","date",array("required"=>"1","name"=>'p_Data',"class"=>"size80"));

	$form->Input("Quantidade de Dias da Solicitação","text",array("required"=>"1","name"=>'p_Qtd',"class"=>"size10"));

	$form->CloseFieldset();

	$form->Fieldset();
		
	$form->Button("submit",array("name"=>"enviar","value"=>"Gerar"));
		
	$form->CloseFieldset();

	unset($form);
	unset($view);

}
else
{

	require_once("../model/Boleto.class.php");
	require_once("../model/Curso.class.php");
	require_once("../model/Bolsa.class.php");
		
	$boleto			= new Boleto($dbOracle);
	$curso			= new Curso($dbOracle);
	$bolsa			= new Bolsa($dbOracle);
	


	$sql = "( select
					wpessoa.id 													as wpessoa_id,
					wpessoa.codigo												as ra,
  					wpessoa.nome							 					as nome,
  					wpessoa.email1     			   								as email,
					decode(wpessoa.foneres,null, '', 'Res.- ' || wpessoa.foneres ) || decode(wpessoa.fonecel,null, '', ' Cel.- ' || wpessoa.fonecel ) || decode(wpessoa.fonecom,null, '', ' Com.- ' || wpessoa.fonecom ) 	as fone,
					campus.nome													as campus_nome,
					curr.curso_id												as curso_id,
					to_date('" . $_POST[p_Data] . "') - to_date(matric.dtstate)	as qtddias,
					to_char(matric.dtstate, 'dd/mm/yyyy')						as evasao
				from
  					campus,
  					matric,
  					turmaofe,
					currofe,
					curr,
  					wpessoa
				where
					not exists (select id from matrictransf where matric.id=matrictransf.matric_id)
				and
					matric.wpessoa_id = wpessoa.id
				and
					currofe.campus_id = campus.id
				and
  					curr.id = currofe.curr_id
  				and
  					currofe.id = turmaofe.currofe_id
				and 
					turmaofe.id = matric.turmaofe_id
				and
					to_date('" . $_POST[p_Data] . "') - to_date(matric.dtstate) <= " . $_POST[p_Qtd] . " 
  				and
					to_date('" . $_POST[p_Data] . "') >= to_date(matric.dtstate)
				and
					matric.matricti_id = 8300000000001
				and 
					matric.state_id = 3000000002005 
  				)
  				order by 2
  				";


	$dbData->Get($sql);

	require_once("../engine/Excel.class.php");
	
	$dInicio = date('d/m/Y', strtotime("-".$_POST[p_Qtd]." days", strtotime(str_replace('/','-',$_POST[p_Data]))));	

	$vDescricao = "Evasao_Com_Debito_Entre_". $dInicio . '_e_' . $_POST[p_Data] ;

	$excel = new Excel($vDescricao);

	$arH[0] = "RA";
	$arH[1] = "Nome do Aluno";
	$arH[2] = "Curso";
	$arH[3] = "Campus";
	$arH[4] = "Telefones";
	$arH[5] = "E-mails";
	$arH[6] = "Evadiu em";
	$arH[7] = "Nº Parc/Mens.";
	$arH[8] = "Nº Parc/Acordo";
	$arH[9] = "Nº Boletos Residuais";
	$arH[10] = "Fies %";
	$arH[11] = "Prouni";
	$arH[12] = "Bolsa %";
	$arH[13] = "Total em R$";
	 
	$excel->Header($arH);

	while ($arAlunos = $dbData->Row())
	{

		$aEmAberto = $boleto->GetBoletoEmAbertoDataGrupo($arAlunos["WPESSOA_ID"],$_POST[p_Data], '', '', 'FISICO');
		
		if (is_array($aEmAberto))
		{

			$nMensalidade = 0;
			$nAcordo = 0;
			$nResiduo = 0;
			$nvlrAluno = 0;
				
			foreach ($aEmAberto as $row)
			{
				if ($row["BOLETOTI_ID"] == 92200000000003 || $row["BOLETOTI_ID"] == 92200000000015)
				{
					$nMensalidade += $row["QTD"];
				}
				if ($row["BOLETOTI_ID"] == 92200000000002 || $row["BOLETOTI_ID"] == 92200000000009 || $row["BOLETOTI_ID"] == 92200000000010 || $row["BOLETOTI_ID"] == 92200000000018)
				{
					$nAcordo += $row["QTD"];
				}
				if ($row["BOLETOTI_ID"] == 92200000000012 || $row["BOLETOTI_ID"] == 92200000000014)
				{
					$nResiduo += $row["QTD"];
				}
				$nvlrAluno += $row["VALOR"];
			}
			
			$aFies      = $bolsa->GetFiesPercentual($arAlunos["WPESSOA_ID"],$_POST[p_Data],'MENSALIDADE');
			$aProuni    = $bolsa->GetProuniPercentual($arAlunos["WPESSOA_ID"],$_POST[p_Data],'MENSALIDADE');				
			$aBolsa     = $bolsa->GetPercentualSemFiesProuni($arAlunos["WPESSOA_ID"],$_POST[p_Data],'MENSALIDADE');
			$nPercBolsa = 0;
			
			$aFies = $aFies[0];
			
			if (is_array($aBolsa))
			{	
				foreach ($aBolsa as $row)
				{
					$nPercBolsa += $row['PERCENTUAL'];
				}
			}
			
			$aCurso	= $curso->GetIdInfo($arAlunos['CURSO_ID']);
			
			$excel->Content($arAlunos['RA']);
			$excel->Content($arAlunos['NOME']);
			$excel->Content($aCurso['NOME']);
			$excel->Content($arAlunos['CAMPUS_NOME']);
			$excel->Content($arAlunos['FONE']);
			$excel->Content($arAlunos['EMAIL']);
			$excel->Content($arAlunos['EVASAO']);
			$excel->Content($nMensalidade);
			$excel->Content($nAcordo);
			$excel->Content($nResiduo);
			$excel->Content(_FormatValor($aFies['PERCENTUAL']));
			$excel->Content(_FormatValor($aProuni['PERCENTUAL']));
			$excel->Content(_FormatValor($nPercBolsa));
			$excel->Content(_FormatValor($nvlrAluno));	

		}
	}

	$excel->EndTable();

	unset($excel);
	unset($bolsa);
	unset($curso);
	unset($boleto);


}

unset($dbData);
unset($dbOracle);
unset($app);
unset($user);
?>