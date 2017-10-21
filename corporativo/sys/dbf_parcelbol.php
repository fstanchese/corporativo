<?php

	set_time_limit(72000);
	ini_set('memory_limit', '12288M');

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user	= new User();
	$app	= new App("Atualizar Tabela Parcelbol", "Atualizar Tabela Parcelbol", array("ADM", "CPD"), $user);
	
	include("../engine/Db.class.php");
	include("../engine/Dbf.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/ParcelBol.class.php");
	include("../model/Boleto.class.php");
	
	
	$view	= new ViewPage($app->title, $app->description);

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	$ParcelBol = new ParcelBol($dbOracle);
	$Boleto = new Boleto($dbOracle);
	
	$view->Explain ("Ajuda");	
	$view->Header($user, $nav);
	
	$form = new Form();
	$form->Fieldset();
	
	$form->Input("Nome do arquivo DBF", "text", array("name"=>"p_DBFName"));
	$form->Button("submit", array("value"=>"Enviar"));
	
	$form->CloseFieldset();
	
	unset($form);	

	if ($_POST[p_DBFName] != "")
	{
		echo  $_POST[p_DBFName];
		
		$dbf = new Dbf('DIVPMS.DBF');
		
		//$aheader = $dbf->GetHeaderNames();
				
		$nCount = 0;
		$nVez = 0;
		
		
echo '<br>YTo Aqui -> ' . $nVez++;
		
/*		while ($row = $dbf->Row())			
		{	

			if ($nVez == 1)
				echo '<br>YTo Aqui -> ' . $nVez++;						
			
				
			if ($row[deleted] == 0)
			{
				
				if ($nCount == 0 || $nCount > 5000)
				{
					echo '<br>YTo Aqui -> ' . $nVez++;
					flush();
					$nCount = 0;
				}
				$nCount++;				
// utimo usado				$p_sql = "update usjt.saldo set curso = " . $row[11] . " where curso = 0 and aluno = " . $row[3] . " and numero = " . $row[0];
//				$p_sql = "update tempboleto set boleto_id = " . $row[0] . " where boleto_id is null and wpessoa_id = " . $row[9] . " and numero = " . $row[4];
				
				$dbData->Set($p_sql);
				$dbData->Commit();						
			}

		}
	}*/
	
						
		/*				
	
		while ($row = $dbf->Row())
		{	
			if ($nVez == 1)
				echo '<br>YTo Aqui -> ' . $nVez++;
			
	
			if ($row[deleted] == 0)
			{
	
				if ($nCount == 0 || $nCount > 5000)
				{
					echo '<br>YTo Aqui -> ' . $nVez++;
					flush();
					$nCount = 0;
				}
				$nCount++;
				$p_sql = "update tempboleto set wpessoa_id = " . $row[1] . " where wpessoa_id is null and aluno = " . $row[13] ;
	
	
				$dbData->Set($p_sql);
				$dbData->Commit();
			}
	
		}
	}*/
	
/*
	
		while ($row = $dbf->Row())
		{
	
			if ($nVez == 1)
				echo '<br>YTo Aqui -> ' . $nVez++;
	
			$campus_id =  6400000000001;
			if ($row[44] == 2)
			{
				$campus_id =  6400000000002;
			}
			
		//print_r($row);
	
			if ($row[deleted] == 0)
			{
				$dbData->Get("Select count(id) as total from tempboleto where nbanco = to_number( " . $row[2] . ")");
				
				$aCount = $dbData->Row();
	
	
				if ($nCount == 0 || $nCount > 5000)
				{
					echo '<br>YTo Aqui -> ' . $nVez++;
					flush();
					$nCount = 0;
				}
				$nCount++;
			}
	
			if ($row[deleted] == 0 && $aCount[TOTAL] < 1)
			{
	
	
				if ($row[5] == ' ')
				{
					$dVencto = 'null';
				}
				else
				{
					$dVencto = "to_Date('" . substr($row[5],6,2) . "/" . substr($row[5],4,2) . "/" . substr($row[5],0,4) . "')";
				}
	
				if ($row[8] == ' ')
				{
					$dGeracao = 'null';
				}
				else
				{
					$dGeracao = "to_Date('" . substr($row[8],6,2) . "/" . substr($row[8],4,2) . "/" . substr($row[8],0,4) . "')";
				}
	
				if ($row[34] >= 1)
				{
					$dPagto = "to_Date('" . substr($row[34],6,2) . "/" . substr($row[34],4,2) . "/" . substr($row[34],0,4) . "')";
				}
				else
				{
					$dPagto = 'null';
				}
	
	
				if ($row[36] >= 1)
				{
					$dBaixa = "to_Date('" . substr($row[36],6,2) . "/" . substr($row[36],4,2) . "/" . substr($row[36],0,4) . "')";
				}
				else
				{
					$dBaixa = 'null';
				}
	
				$p_sql = "insert into tempboleto (NUMERO,NBANCO,ALUNO,PARCELA,VENCTO,VLTOTAL,GERACAO,CURSO,TURMA,VALPAGO,RETORNO,ACRESC,DESCON,DP,ADAP,LICEN,BOLSA,VALMEN,MESTAB,DTPGTO,TIPOBAI,DTBAIXA,ESTAGIO,MONOGRA,TURNOVA,COMPMES,COMPANO,CAMPUS_ID) values
				($row[0], $row[2], $row[3], $row[4],  $dVencto , $row[6], $dGeracao, $row[11], '". $row[12] ."', $row[16], $row[18], $row[22], $row[23], $row[26], $row[27], $row[28], $row[29], $row[30], '". $row[31] . "',
				$dPagto, '" . $row[35] . "', $dBaixa,  $row[39], $row[40], '" . $row[41] . "', $row[42], $row[43], $campus_id )";
	
				$dbData->Set($p_sql);
				$dbData->Commit();
			}
	
		}
	
	}   */
	
		/*
		while ($row = $dbf->Row())
		{
			if ($row[9] > 1 && $row[9] < 201100)
			{
				if ($row[4] == 259 || $row[4] == 260 || $row[4] == 261 || $row[4] == 262 || $row[4] == 347 || $row[4] == 348 || $row[4] == 333)
				{
					$vObrigatoria = 'on';
					if ($row[4] == 333)
					{
						$vObrigatoria = 'off';
					}
					$p_Boleto_Numero = $row[3];
					if ($row[7] == 1)
					{
						$p_sql = "update tempboleto set PUMensalidade =".str_replace(',', '.', $row[6]).", PUObrigatorio = '". $vObrigatoria  ."' where numero=".$row[3];
						echo $p_sql;
						echo '<br>';
					}
					else
					{
						if ($row[7] <> 7)
						{
							$p_sql = "update tempboleto set PUOutros = nvl( PUOutros, 0 ) + ".str_replace(',', '.', $row[6]).", PUObrigatorio = '". $vObrigatoria  ."' where numero=".$row[3];
							echo $p_sql;
							echo '<br>';
						}
					}
					if ($row[7] <> 7 &&	$dbData->Set($p_sql))
					{
						echo $p_sql;
						echo '<br>';
						$dbData->Commit();
					}
				}
			}
		}
	}*/

// aqui esta inserçao das Parcelas geradas

		while ($row = $dbf->Row())
		{

			if ($nVez == 1)
				echo '<br>To Aqui -> ' . $nVez++;

		
			//print_r($row);
		
	        $nId = 104400000000000 + $row[1]; 

			if ($row[deleted] == 0  &&  $row[7] > 1 &&  $row[7] <> '')
			{
				$dbData->Get("Select count(parcel_id) as total from parcelbol where parcel_id = to_number( " . $nId . ") and boleto_id = to_number( " . $row[07] . ")" );

				$aCount = $dbData->Row();


				if ($nCount == 0 || $nCount > 5000)
				{
					echo '<br>To Aqui -> ' . $nVez++;
					flush();
					$nCount = 0;
echo $p_sql;
echo '<br>';
				}
				$nCount++;

				if ( $aCount[TOTAL] < 1 )
				{

//echo $sql;
//				echo '<br>';

					$aBoleto = $Boleto->GetIdInfo($row[7]);
	//			    
		//			$dVencto = "to_date('". $aBoleto[DTVENCTO] ."')";
			//		$nValor = str_replace(',','.',$aBoleto[VALOR]);

				    $dbData->Get("Select count(debcred.id) as total from debcred where matric_origem_id is not null and boleto_destino_id = to_number( " . $row[07] . ")" );
				    
				    $aCount = $dbData->Row();				    
				    
				    $wpessoa_id = $aBoleto[WPESSOA_SACADO_ID];
				    
				    $nBoleto_Id =  $row[07];				    
				    
				    if ( $aCount[TOTAL] < 1  && $aBoleto[BOLETOTI_ID] == 92200000000003 )
				    {
			    	 
				    	$nAno = SubStr($aBoleto[ORDEMREF],0,4);
				    	$wpessoa_id = $aBoleto[WPESSOA_SACADO_ID];
				    	$sql = "Select WPessoa_gnMatricula(". $wpessoa_id . " , " . $nAno .") as matric, wpessoa.id as id from wpessoa where id= ". $wpessoa_id;
				    	
				    	//echo $sql;
				    	//				echo '<br>';
				    	
				    	$dbData->Get($sql);
				    	
				    	$aMatricula = $dbData->Row();
				    		
				    	if (!empty($aMatricula['MATRIC']))
				    	{	
				    		$dPrevisao = "to_Date('08/" . SubStr($aBoleto[ORDEMREF],4,2) . "/" . SubStr($aBoleto[ORDEMREF],0,4) . "')";
				    		
				    		$nMatric_Id = $aMatricula['MATRIC'];
				    		$p_sql = "insert into DEBCRED (
				    		Matric_Origem_Id,
							WPessoa_Id,
					    	BOLETO_DESTINO_ID,
					    	DtPrevisao) values
					    	($nMatric_Id,
					    	$wpessoa_id,
					    	$nBoleto_Id,
					    	$dPrevisao
				    		)";
				    	
				    		
				    		//			echo $p_sql;
				    			//			echo '<br>';
				    	
				    		$dbData->Set($p_sql);
				    	 	$dbData->Commit();
//				    		var_dump($aMatricula);
	//			    		echo $sql;
		//		    		die();
				    	}				    	 
				    	 
				    }
				    
				    //echo $row[0];
				    //echo '<br>';
				    
					$p_sql = "insert into parcelbol (
					Parcel_ID,
					BOLETO_ID) values
					($nId,
					$nBoleto_Id)";

					
				//	echo $p_sql;
					//echo '<br>';
				
					$dbData->Set($p_sql);
					$dbData->Commit();
				}
				
			}

		}
	
	}
	
	unset($view);
	unset($app);
	unset($user);

?>