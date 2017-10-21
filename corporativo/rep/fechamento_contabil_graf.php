<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Grбficos Fechamento Contбbil","Grбficos de Fechamento Contбbil",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Chart.class.php");

	
	$dbOracle = new Db ($user);
	
	$dbData = new DbData ($dbOracle);
	
	$view = new ViewPage($app->title,$app->description);
	
	
	$view->Header($user,$nav);
	
	
	if($_POST[enviar] == "")
	{

		include("../engine/Form.class.php");
	
	
		$arMes['01'] = 'JAN';
		$arMes['02'] = 'FEV';
		$arMes['03'] = 'MAR';
		$arMes['04'] = 'ABR';
		$arMes['05'] = 'MAI';
		$arMes['06'] = 'JUN';
		$arMes['07'] = 'JUL';
		$arMes['08'] = 'AGO';
		$arMes['09'] = 'SET';
		$arMes['10'] = 'OUT';
		$arMes['11'] = 'NOV';
		$arMes['12'] = 'DEZ';
	
		$arAno['2013'] = '2013';
		$arAno['2012'] = '2012';
		$arAno['2011'] = '2011';
		$arAno['2010'] = '2010';
		$arAno['2009'] = '2009';
		$arAno['2008'] = '2008';
		$arAno['2007'] = '2007';
	
	
		$form = new Form();
	
		$form->Fieldset();
	
		$form->Input("Mкs",'select',array('name'=>'p_Mes',"required"=>'1',"option"=>$arMes));
		$form->Input("Ano",'select',array('name'=>'p_Ano',"required"=>'1',"option"=>$arAno));
			
		$form->CloseFieldset ();
	
		$form->Fieldset();
			
		$form->Button("submit",array("name"=>"enviar","value"=>"Gerar Relatуrio"));
	
	
		$form->CloseFieldset ();
	
		unset($form);
	}
	else
	{
	
	
	$chart = new Chart();
	
	
	
	
	$sql = "select contabilcur.nome                as curso,
			  replace(sum(boletoitem.valor),',','.') as valor,
			  contabilgru.nome as tipoitem,
				count(boleto.id) as qteBoleto
			from boleto,
			  boletoitem,
			  boletoitemti,
			  contabilcur,
				contabilgru
			where contabilcur.curso_id (+) = boleto.curso_id
			and boletoitem.state_id          = 3000000017001
			and boletoitemti.id = contabilgru.boletoitemti_id (+)
			and boletoitem.BOLETOITEMTI_ID = BOLETOITEMTI.id
			and boleto.id                    = boletoitem.Boleto_id
			and boletoti_id                  = 92200000000003
			and competencia                  ='".$_POST[p_Ano].$_POST[p_Mes]."'
			and boleto.campus_id like '%01'
			and state_base_id not in (3000000000001,3000000000008,3000000000009)
			group by contabilcur.nome,  contabilgru.nome
			order by 1,3";
	
	
	
	$dbData->Get($sql);
	
	while ($abc = $dbData->Row())
	{
			
		$arFech[$abc[CURSO]][$abc[TIPOITEM]] = $abc[VALOR];
			
		if($abc[TIPOITEM] != "FIES" && $abc[TIPOITEM] != "Crйdito Educativo")
			$arFech[$abc[CURSO]][VALORGERADO] += $abc[VALOR];
			
			
			
		$arFech[$abc[CURSO]][QTEBOLETO] = $abc[QTEBOLETO];
			
	
			
			
	}
	
	
	
	$cont = 1;
	
	foreach($arFech as $curso => $dados)
	{
		$uniq = uniqid();
	
	
		echo $view->Div(array("id"=>$uniq,"style"=>"float:left;width:50%;"));
		echo $view->CloseDiv();
		
		
		$arOpt[titulo] 		= $curso;
		$arOpt[sufixo]		= "";
		$arOpt[mostralegenda] = false;
		
		$arData2["Mensalidade"] 	= round($dados['Mensalidade'],2);

		$arData2["Adaptaзгo"] 		= round($dados['Adaptaзгo'],2);
		$arData2["Dependкncia"] 	= round($dados['Dependкncia'],2);
		$arData2["Bolsa"] 			= round(-1*$dados['Bolsa'],2);
		$arData2["FIES"] 			= round(-1*$dados['FIES'],2);
		$arData2["Licenciatura"] 	= round($dados['Licenciatura'],2);
	

		$chart->PieChart("#".$uniq, $arData2, $arOpt);
		
		$cont++;
		
		
		
	}
	
	
	echo $view->Br().$view->Br();
	
	
}
	



?>