<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user	= new User();
	$app	= new App("Carregar DBF para Oracle", "Carregar DBF para Oracle", array("ADM", "CPD"), $user);
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	
	include("../engine/Dbf.class.php");
	
	include("../model/ORegistr.class.php");
	include("../model/OProces.class.php");
	include("../model/HeadTex.class.php");
	include("../model/DTexto.class.php");
	include("../model/Matric.class.php");
	include("../model/Titulo.class.php");
	include("../model/Carimbo.class.php");
	include("../model/DiplReg.class.php");
	include("../model/DiplProc.class.php");
	include("../model/Diploma.class.php");
	include("../model/Apostila.class.php");
	include("../model/WPessoa.class.php");
	
	$view	= new ViewPage($app->title, $app->description);

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);

	$oRegistr = new ORegistr($dbOracle);
	$oProces = new OProces($dbOracle);
	$dTexto = new dTexto($dbOracle);
	$headTex = new HeadTex($dbOracle);
	$matric = new Matric($dbOracle);
	$titulo = new Titulo($dbOracle);
	$carimbo = new Carimbo($dbOracle);
	$diplReg = new DiplReg($dbOracle);
	$diplProc = new DiplProc($dbOracle);
	$diploma = new Diploma($dbOracle);
	$apostila = new Apostila($dbOracle);
	$wPessoa = new WPessoa($dbOracle);
	
	$view->Explain ("Ajuda");		
	$view->Header($user, $nav);
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);	
	$dbData->Get($oRegistr->Query('qGeral'));

	while($rowRegistr = $dbData->Row())
	{
		$p_Processo_Id		= $rowRegistr[IDPROCESSO];
		$p_Registro_Id		= $rowRegistr[IDREGISTRO];
		$p_WPessoa_Id		= $rowRegistr[WPESSOAID];

		$dbData2 = new DbData ($dbOracle);
		$dbData2->Get($wPessoa->Query('qId',array("p_WPessoa_Id"=>$p_WPessoa_Id)));
		$rowPessoa = $dbData2->Row();
		unset($dbData2);
		
		if ($v_Registro_Id != $rowRegistr[NUMREGIST])
		{
			$p_Matric_Id	= $rowRegistr[MATRICID];
			
			$dbData2 = new DbData ($dbOracle);						
			$dbData2->Get($matric->Query('qId',array("p_Matric_Id"=>$p_Matric_Id)));
			$rowMatric = $dbData2->Row();
			unset($dbData2);
			
			$p_Curr_Id = $rowRegistr[CURR_ID]; 						 	
			$p_TempTitulo_Id = $rowRegistr[TEMPTITULO_ID];			
			$v_Registro_Id = $rowRegistr[NUMREGIST];
			
			$p_Titulo_Nome = $rowRegistr[TITULO];
			
			$dbData2 = new DbData ($dbOracle);
			$dbData2->Get($titulo->Query('qNome',array("p_Titulo_Nome"=>$p_Titulo_Nome)));
			$rowTitulo = $dbData2->Row();
			unset($dbData2);

			$p_Carimbo_Assina1_Id = '';
			$p_Carimbo_Assina2_Id = '';
				
			if (trim($rowRegistr[REGIPOR])=='EMERSON')
			{
				$p_Carimbo_Assina1_Id = 122700000000011; 
			}
			if (trim($rowRegistr[REGIPOR])=='MIRIAN')
			{
				$p_Carimbo_Assina1_Id = 122700000000017;
			}				
			if (trim($rowRegistr[REGIPOR])=='ELIANE')
			{
				$p_Carimbo_Assina1_Id = 122700000000015;
			}			
			if (trim($rowRegistr[REGIPOR])=='KELLI')
			{
				$p_Carimbo_Assina2_Id = 122700000000019;
			}
				
			
			if (trim($rowRegistr[CONFPOR])=='CAROLINA')
			{
				$p_Carimbo_Assina2_Id = 122700000000021;
			}		
			if (trim($rowRegistr[CONFPOR])=='ELIANE')
			{
				$p_Carimbo_Assina2_Id = 122700000000034;
			}			
			if (trim($rowRegistr[CONFPOR])=='EMERSON')
			{
				$p_Carimbo_Assina2_Id = 122700000000022;
			}
			if (trim($rowRegistr[CONFPOR])=='KELLI')
			{
				$p_Carimbo_Assina2_Id = 122700000000019;
			}		
			if (trim($rowRegistr[CONFPOR])=='MIRIAN')
			{
				$p_Carimbo_Assina2_Id = 122700000000027;
			}
				
			
			$dbData2 = new DbData ($dbOracle);
			$dbData2->Get($carimbo->Query('qId',array("p_Carimbo_Id"=>$p_Carimbo_Assina1_Id)));
			$rowCarimbo1 = $dbData2->Row();
			unset($dbData2);

			$dbData2 = new DbData ($dbOracle);
			$dbData2->Get($carimbo->Query('qId',array("p_Carimbo_Id"=>$p_Carimbo_Assina2_Id)));
			$rowCarimbo2 = $dbData2->Row();
			unset($dbData2);				
			
			$p_Titulo_Id = $rowTitulo[ID];

			$dbData2 = new DbData ($dbOracle);
			$dbData2->Get($diplReg->Query('qRegistro',array("p_DiplReg_Registro"=>$rowRegistr[NUMREGIST])));
			$rowDiplReg = $dbData2->Row();
			$p_DiplReg_Id = $rowDiplReg[ID]; 
			unset($dbData2);
				
	    	echo "<br>";
			echo "==============================================================================================";
	    	echo "<br>";
	    	echo "Matric Id ".$rowRegistr[MATRICID];
			echo "<br>";
			echo ' Registro Nº '.$rowRegistr[NUMREGIST].' - Registro ID '.$rowRegistr[IDREGISTRO].' DiplReg Id '.$p_DiplReg_Id;
	    	echo "<br>";
	    	echo 'Data de Registro : '.$rowRegistr[DATAREGIS];
			echo "<br>";
	    	echo 'RA do Aluno : '.$rowRegistr[RAALUNO];
			echo "<br>";
	    	echo 'Nome do Aluno : '.$rowRegistr[NOMEALU];
	    	echo "<br>";
			echo 'Nome do Curso : '.$rowRegistr[NOMECURSO];
	    	echo "<br>";
			echo 'Nome da Titulacao : '.$rowRegistr[TITULO].' Titulo ID '.$rowTitulo[ID];
	    	echo "<br>";
			echo 'Ano de Conclusao : '.$rowRegistr[ANOCONCL];
	    	echo "<br>";
	    	echo 'Data de Colação : '.$rowRegistr[DTCOLACAO];
	    	echo "<br>";
			echo 'Data de Expedição : '.$rowRegistr[DTEXPEDIC];
	    	echo "<br>";
	    	echo 'Registrado por : '.$rowRegistr[REGIPOR].' - '.$rowCarimbo1[WPESSOA_RECOGNIZE].' - '.$rowCarimbo1[DESCRICAO];
	    	echo "<br>";
			echo 'Conferido por : '.$rowRegistr[CONFPOR].' - '.$rowCarimbo2[WPESSOA_RECOGNIZE].' - '.$rowCarimbo2[DESCRICAO];
	    	echo "<br>";
	    	echo 'Diretor : '.$rowRegistr[DIRETOR];
	    	echo "<br>";
	    	echo 'Diretor DRA: '.$rowRegistr[DIRETORDRA];
	    	echo "<br>";
	    	echo 'Reitor : '.$rowRegistr[REITOR];
	    	echo "<br>";
	    	$p_Processo_Pai_Id = 0;
		}
		
		
		$dbData3 = new DbData ($dbOracle);						
		$dbData3->Get($oProces->Query('qProcesso',array("p_Processo_Id"=>$p_Processo_Id)));
		$rowProces = $dbData3->Row();
		unset($dbData3);
		
		$p_NrProcesso 		= $rowProces[NRPROCESSO];
		$p_DiplProcTi_Id 	= $rowProces[DIPLPROCTI];		
			 
    	echo "<br>";
		echo ' Processo Nº '.$p_NrProcesso.' - Processo ID '.$rowProces[IDPROCESSO].' Processo Pai '.$p_Processo_Pai_Id;
    	echo "<br>";
    	echo ' Tipo Processo '.$p_DiplProcTi_Id;
    	echo "<br>";
    	echo "<br>";

    	$p_DiplProc_DiplProc_Pai_Id = '';
    	
    	if ($p_Processo_Pai_Id != 0)
    	{
    		$dbData5 = new DbData ($dbOracle);
    		$dbData5->Get($diplProc->Query('qNrProcesso',array("p_DiplProc_NrProcesso"=>$p_Processo_Pai_Id)));
    		$rowDiplProcPai = $dbData5->Row();
    		$p_DiplProc_DiplProc_Pai_Id = $rowDiplProcPai[ID];
    		unset($dbData5);
    	}
    	 
    	$p_Processo_Pai_Id = $rowProces[NRPROCESSO];
    	 
    	if ($p_Matric_Id == 0) $p_Matric_Id = '';
    	if ($p_TempTitulo_Id == 0) $p_TempTitulo_Id = '';
    	if ($p_Curr_Id == 0) $p_Curr_Id = '';    	

		// vamos criar o processo
		// verificar se existe
		$dbData5 = new DbData ($dbOracle);
		$dbData5->Get($diplProc->Query('qNrProcesso',array("p_DiplProc_NrProcesso"=>$p_NrProcesso)));
		$rowDiplProc = $dbData5->Row();
		unset($dbData5);
		
		if ($rowDiplProc[ID]=='')
		{
			$p_O_Option='insert'; $p_DiplProc_Id = '';	
		}	
		else
		{
			$p_O_Option=''; 
			$p_DiplProc_Id = $rowDiplProc[ID];				
		}
				
		$data['p_Depart_Id'] = 36000000000066;
		$data['p_DiplProc_Id'] = $p_DiplProc_Id;
		$data['p_O_Option'] = $p_O_Option;
		$data['p_NrProcesso'] = $p_NrProcesso;
		$data['p_WPessoa_Id'] = $p_WPessoa_Id;
		$data['p_DiplProcTi_Id'] = $p_DiplProcTi_Id;
		$data['p_DiplProc_Pai_Id'] = $p_DiplProc_DiplProc_Pai_Id;
		$data['State_Id'] = 3000000026010;
		$data['Matric_Id'] = $p_Matric_Id;
		$data['Curr_Id'] = $p_Curr_Id;
		$data['TempTitulo_Id'] = $p_TempTitulo_Id;
								
		$dbDiplProc = new DbData ($dbOracle);
		//$diplProc->IUD($data, $dbDiplProc);
		$dbDiplProc->Commit();
		if ($p_O_Option=='insert')
		{
			//$p_DiplProc_Id = $dbDiplProc->GetInsertedId('DiplProc_Id');
		}
		
		echo 'DiplProc_Id '.$p_DiplProc_Id;
		echo "<br>";
		
		$dbDiplProc->Commit();
		
		unset($dbDiplProc);
		unset($data);
		
		$p_Apostila_Texto = '';
		
		$dbData4 = new DbData ($dbOracle);
		$dbData4->Get($headTex->Query('qProcesso',array("p_Processo_Id"=>$p_Processo_Id)));
		while($rowHeadTex = $dbData4->Row())
		{
			$p_Texto_Id = $rowHeadTex[IDTEXTO];
			echo 'IDTEXTO '.$p_Texto_Id;
			echo "<br>";
			$dbData3 = new DbData ($dbOracle);
			$dbData3->Get($dTexto->Query('qTexto',array("p_Texto_Id"=>$p_Texto_Id)));
			while($rowTexto = $dbData3->Row())
			{
				echo $rowTexto[DS_TEXTO];
				$p_Apostila_Texto .= $rowTexto[DS_TEXTO];
				echo "<br>";
			}
			unset($dbData3);
		}
		unset($dbData4);
		
		// vamos gerar Apostila
		if ($p_Apostila_Texto != '')
		{

			// verificar se existe
			$dbData5 = new DbData ($dbOracle);
			$dbData5->Get($apostila->Query('qApostila',array("p_DiplProc_Id"=>$p_DiplProc_Id)));
			$rowApostila = $dbData5->Row();
			unset($dbData5);
			
			if ($rowApostila[ID]=='')
			{
				$p_O_Option='insert'; $p_Apostila_Id = '';
			}
			else
			{
				$p_O_Option=''; 
				$p_Apostila_Id = $rowApostila[ID];
			}
				
			$data['p_Apostila_Id'] = $p_Apostila_Id;
			$data['p_O_Option'] = $p_O_Option;
			$data['p_DtApostila'] = $rowRegistr[DTEXPEDIC];
			$data['p_DtAnotacao'] = $rowRegistr[DTEXPEDIC];
			if ($p_DiplProcTi_Id == 118900000000003)
			{
				$data['p_DtApostila'] = $rowRegistr[DATAREGIS];
				$data['p_DtAnotacao'] = $rowRegistr[DATAREGIS];				
			}
			
			$data['p_Texto'] = $p_Apostila_Texto;
			$data['p_DiplProc_Id'] = $p_DiplProc_Id;
			$data['p_DiplReg_Id'] = $p_DiplReg_Id;
			if ($p_DiplProcTi_Id == 118900000000003)
				$data['p_DiplReg_Id'] = '';
				
			$data['p_WPessoa_Diretor_Id'] = $rowRegistr[DIRETORID];
			$data['p_Carimbo_Assina1_Id'] = $p_Carimbo_Assina1_Id;
			$data['p_Carimbo_Assina2_Id'] = $p_Carimbo_Assina2_Id;

			$dbApostila = new DbData ($dbOracle);
			//$apostila->IUD($data, $dbApostila);
			$dbApostila->Commit();
			
			if ($p_O_Option=='insert')
			{
				//$p_Apostila_Id = $dbApostila->GetInsertedId('Apostila_Id');
			}
			unset($dbApostila);
			unset($data);
			echo 'Apostila_Id '.$p_Apostila_Id;
			echo "<br>";				
				
		}
		
		// vamos gerar o diploma
		if ($p_DiplProcTi_Id <= 118900000000002)
		{	
		
			// verificar se JA existe
			$dbData5 = new DbData ($dbOracle);
			$dbData5->Get($diploma->Query('qRegistro',array("p_DiplProc_Id"=>$p_DiplProc_Id)));			
			$rowDiploma = $dbData5->Row();			
			unset($dbData5);
		
			$p_O_Option = '';
			if ($rowDiploma[ID]=='')
			{
				$p_O_Option='insert'; $p_Diploma_Id = '';	
			}	
			else
			{
				$p_O_Option='update'; 
				$p_Diploma_Id = $rowDiploma[ID];				
			}			
			
							
			$data['p_Diploma_Id'] = $p_Diploma_Id;
			$data['p_O_Option'] = $p_O_Option;
			$data['p_DtExpedicao'] = $rowRegistr[DTEXPEDIC];  
			$data['p_DtColacao'] = $rowRegistr[DTCOLACAO];
			$data['p_DiplProc_Id'] = $p_DiplProc_Id;
			$data['p_DiplReg_Id'] = $p_DiplReg_Id;
			$data['p_Vias'] = 1;
			if ($p_DiplProcTi_Id == 118900000000002)
				$data['p_Vias'] = 2;
				
			$data['p_WPessoa_Reitor_Id'] = $rowRegistr[REITORID];
			$data['p_WPessoa_Diretor_Id'] = $rowRegistr[DIRETORID];
			$data['p_WPessoa_DRA_Id'] = $rowRegistr[DRAID];
			$data['p_NomeAluno'] = $rowRegistr[NOMEALU];
			$data['p_Nacionalidade'] = $rowRegistr[NACIONAL];		
			$data['p_Natural'] = $rowRegistr[ESTADO];
			$data['p_Nascimento'] = $rowRegistr[NASCIMENTO];
			$data['p_Documento'] = 'R.G. n.º '.$rowRegistr[NUMDOC].' - '.$rowRegistr[UFRG];
			if ($rowRegistr[TIPODOCUM] == '2')
			{
				$data['p_Documento'] = 'R.N.E. n.º '.$rowRegistr[NUMDOC]; 
			}	
			
			$data['p_CursoNome1'] = 'Curso de '.$rowRegistr[NOMECURSO];
			$data['p_CursoNome2'] = 'Curso de <br>'.$rowRegistr[NOMECURSO2];
			if ($rowRegistr[NOMECURSO]=='Curso Superior de Tecnologia em Processamento de Dados')
			{
				$data['p_CursoNome1'] = 'Curso Superior de Tecnologia em Processamento de Dados';
				$data['p_CursoNome2'] = 'Curso Superior de <br>TECNOLOGIA EM PROCESSAMENTO DE DADOS';				
			}
			if ($rowRegistr[NOMECURSO]=='Curso Superior de Formação Específica em Gestão de Recursos Humanos')
			{
				$data['p_CursoNome1'] = 'Curso Superior de Formação Específica em Gestão de Recursos Humanos';
				$data['p_CursoNome2'] = 'Curso Superior de <br>FORMAÇÃO ESPECÍFICA EM GESTÃO DE RECURSOS HUMANOS';				
			}
			$data['p_Carimbo_Assina1_Id'] = $p_Carimbo_Assina1_Id;
			$data['p_Carimbo_Assina2_Id'] = $p_Carimbo_Assina2_Id;
			$data['p_PeriodoLetivo'] = $rowRegistr[ANOCONCL];
			$data['p_RaAluno'] = $rowRegistr[RAALUNO];
			$data['p_Titulo_Id'] = $p_Titulo_Id;		
			
			$dbDiploma = new DbData ($dbOracle);
			$diploma->IUD($data, $dbDiploma);
			$dbDiploma->Commit();
				
			if ($p_O_Option=='insert')
			{
				$p_Diploma_Id = $dbDiploma->GetInsertedId('Diploma_Id');
			}			
			echo 'Diploma_Id '.$p_Diploma_Id . ' p_O_Option '.$p_O_Option;
			echo "<br>";
				
			unset($dbDiploma);
			
			$dbRegistro = new DbData ($dbOracle);
			$p_sql = 'update oregistr set diplomaid='.$p_Diploma_Id.' where NUMREGIST='.$v_Registro_Id;
			//$dbRegistro->Set($p_sql);
			$dbRegistro->Commit();
			unset($dbRegistro);
			
			//die();
		}
	}
	
	unset($oRegistr);
	unset($oProces);
	unset($dTexto);
	unset($headTex);
	unset($matric);
	unset($titulo);
	unset($carimbo);
	unset($diplReg);
	unset($diplProc);
	unset($diploma);
	unset($apostila);
		
	unset($view);
	unset($app);
	unset($user);

?>