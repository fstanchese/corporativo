<?php

	set_time_limit(3600);
	
	include("../engine/User.class.php");
	include("../engine/Db.class.php");
	include("../engine/App.class.php");	
	include("../model/Ano.class.php");
	include("../model/Campus.class.php");
		
	$user	= new User();
	$app 	= new App("Fechamento Contábil - Guardar Boletos","Fechamento Contábil - Guardar Boletos",array('ADM','CPD'),$user);
	$dbOracle 	= new Db ($user);	
	$ano		= new Ano($dbOracle);
	$campus		= new Campus($dbOracle);	

	if($_POST[enviar] == "")
	{
		include("../engine/ViewPage.class.php");
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
	
		$arAno['2014'] = '2014';
		$arAno['2013'] = '2013';
		$arAno['2012'] = '2012';
		$arAno['2011'] = '2011';
		$arAno['2010'] = '2010';
		$arAno['2009'] = '2009';
		$arAno['2008'] = '2008';
		$arAno['2007'] = '2007';
	
	
		$view 	= new ViewPage($app->title,$app->description);
	
		$view->Header($user,$nav);
	
	
		$form = new Form();
	
		$form->Fieldset();
	
		$form->Input("Mês",'select',array('name'=>'p_Mes',"required"=>'1',"option"=>$arMes));
		$form->Input("Ano",'select',array('name'=>'p_Ano',"required"=>'1',"option"=>$ano->Calculate('','','Ano Desc')));
		$form->Input("Data Base","date",array("required"=>"1","name"=>'p_Data',"class"=>"size80"));
		$form->Input("Unidade",'select',array("required"=>"1","name"=>'p_Campus_Id',"option"=>$campus->Calculate()));
	
		$form->CloseFieldset ();
	
		$form->Fieldset();
			
		$form->Button("submit",array("name"=>"enviar","value"=>"Inserir Informações"));
	
	
		$form->CloseFieldset ();
	
	
		unset($form);
		unset($view);
	
	}
	else
	{	

		
		include("../model/ContabilBol.class.php");
		include("../model/ContabilFech.class.php");
		include("../model/Boleto.class.php");
		include("../model/BoletoItem.class.php");
		include("../model/RateioBol.class.php");
		
		
		$dbData 		= new DbData ($dbOracle);				
		$contabilbol	= new ContabilBol($dbOracle);	
		$contabilfech	= new ContabilFech($dbOracle);
		$boleto			= new Boleto($dbOracle);
		$boletoitem		= new BoletoItem($dbOracle);
		$rateiobol		= new RateioBol($dbOracle);
		
		/*$aMatricula = $boleto->GetMatric(85000003464836, $_POST[p_Data]);
		echo 'aqui';
		print_r($aMatricula);

		
		echo 'aqui';		
		$aItens = $boletoitem->GetItensData( 85000003464836 , $_POST['p_Data'], 'BOLETOITEMTI_ID');
		print_r($aItens);
		die();*/
		
		
		$aAno = $ano->GetIdInfo($_POST[p_Ano]);	 
	
		$sql = $contabilfech->Query('qBoletos', array('p_O_Data'=>$_POST[p_Data], 'p_Boleto_Competencia'=>$aAno['ANO'].$_POST[p_Mes], 'p_Campus_Id'=>$_POST[p_Campus_Id]));
	
		$dbData->Get($sql);

		While ($adados = $dbData->Row())
		{
			$aBoleto = $contabilbol->GetBoleto($adados['BOLETO_ID']);
			
			if (!is_array($aBoleto))
			{
				
				if ($adados['CURSO'] == '')
					echo 'Sem Curso ' . $adados['BOLETO_ID'] . '<br>';
				
				$aItens = '';
				$vState = $boleto->GetStateData($adados['BOLETO_ID'], $_POST['p_Data']);
				
				if ($vState <> 3000000000008 && $vState <> 3000000000009)
				{
					if ($adados['BOLETOTI_ID'] == 92200000000008)
					{
						// o que fazer com reserva de vaga ????? $aItens['Reserva de Vaga'] = $adados['VALOR'];
					}
					else
					{
						$aItens = $boletoitem->GetItensData( $adados['BOLETO_ID'] , $_POST['p_Data'], 'BOLETOITEMTI_ID');
						/*print_r ($aItens);
						die();*/
					}
					if (is_array($aItens))
					{
						$aInsert = '';
						foreach ($aItens as $key => $value)
						{
							$aInsert[$key] += $value;
						}
						if (is_array($aInsert))
						{
							$aMatricula = $boleto->GetMatric($adados['BOLETO_ID'], $_POST[p_Data]);
							if (is_array($aMatricula))
							{
								foreach ($aInsert as $key => $value)
								{
									$aItens = array('p_O_Option' => 'insert', 'Boleto_Id' => $adados["BOLETO_ID"], 'BoletoItemTi_Id' => $key, 'TurmaOfe_Id' => $aMatricula["TURMAOFE_ID"], 'Competencia' => $aAno["ANO"].$_POST["p_Mes"],'Valor' => $value, 'Matric_Id' => $aMatricula["ID"] );
								/*echo 'estoy aqui <br>';
								print_r($aItens);
								die();*/	
									$contabilbol->IUD($aItens);
								}
							}							
							else
							{
								echo 'sem matricula ' . $adados['BOLETO_ID'] . '<br>';
								print_r($aMatricula);								
							}
						}							
						else
						{
							echo 'nao tem nada a inserir' . $adados['BOLETO_ID'] . '<br>';
							print_r($aInsert);								
						}
					}
					else
					{
						if ($adados['BOLETOTI_ID'] <> 92200000000008)
						{
						  echo 'nao trouxe itens' . $adados['BOLETO_ID'] . '<br>';
						}						
					}				
				}
			else
				if ($vState <> 3000000000008 && $vState <> 3000000000009)
				{
				  echo 'contabilbol já tem ' . $adados['BOLETO_ID'] . '<br>';
				  print_r( $aBoleto );
			    }  					
			}									
		}					
	}

?>