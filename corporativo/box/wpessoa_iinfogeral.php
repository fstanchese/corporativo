<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	//Instanciar o Usu�rio
	$user 			= new User ();
	
	//Instanciar a Aplica��o
	$app = new App("Informa��es Gerais da Pessoa","Informa��es Gerais da Pessoa",array('ADM','CPD','CARTACOBRANCA'), $user);
	
	
	include("../engine/Db.class.php");	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewBox.class.php");
	include("../engine/Form.class.php");
	

	include("../model/WPessoa.class.php");
	include("../model/Matric.class.php");
	include("../model/WOcorr.class.php");
	include("../model/Lograd.class.php");
 
	
	//Conectar o usu�rio ao Banco de Dados
	$dbOracle	= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($dbOracle);
	
	//Instanciar a classe que ir� utilizar
	$wpessoa = new WPessoa($dbOracle);
	$matric  = new Matric($dbOracle);
	$wocorr  = new WOcorr($dbOracle);
	$lograd  = new Lograd($dbOracle);
	
	$row = $wpessoa->GetIdInfo(_Decrypt($_GET[p_WPessoa_Id]));
	
	
	if($row[CODIGO] != "") $aluno = 'on'; else $aluno = 'off';
	
	$vp = new ViewBox($app->title,$app->description);
	$vp->Header ();
	$vp->IncludeCSS ("infoPessoa.css");
	

	
	echo $vp->Div(array("class"=>"boxInfoPessoa"));
	
		echo $vp->H3("Informa��es Pessoais");
		
		echo $vp->Table(array("class"=>"infoPessoa","border"=>"0","cellpadding"=>"0","cellspacing"=>"0","width"=>"100%"));
			echo $vp->Tr();
				echo $vp->Td()."C�digo: ".$vp->CloseTd();
				echo $vp->Td().$row[CODIGO].$vp->CloseTd();
				
				echo $vp->Td()."Nome: ".$vp->CloseTd();
				echo $vp->Td().$row[NOME].$vp->CloseTd();
			echo $vp->CloseTr();
			
			echo $vp->Tr();
				echo $vp->Td()."Apelido: ".$vp->CloseTd();
				echo $vp->Td().$row[APELIDO].$vp->CloseTd();
			
				echo $vp->Td()."Nascimento: ".$vp->CloseTd();
				echo $vp->Td().$row[DTNASCTO].$vp->CloseTd();
			echo $vp->CloseTr();
			
			echo $vp->Tr();
				echo $vp->Td()."Nacionalidade: ".$vp->CloseTd();
				echo $vp->Td().$row[APELIDO].$vp->CloseTd();
			
				echo $vp->Td()."Naturalidade: ".$vp->CloseTd();
				echo $vp->Td().$row[CIDADE_NATURAL_ID_R].$vp->CloseTd();
			echo $vp->CloseTr();
			
			echo $vp->Tr();
				echo $vp->Td()."Estado Civil: ".$vp->CloseTd();
				echo $vp->Td().$row[CIVIL_NOME].$vp->CloseTd();
			
				echo $vp->Td()."Sexo: ".$vp->CloseTd();
				echo $vp->Td().$row[SEXO_NOME].$vp->CloseTd();
			echo $vp->CloseTr();
			
			echo $vp->Tr();
				echo $vp->Td()."Escrita: ".$vp->CloseTd();
				echo $vp->Td(array("colspan"=>"3")).$row[ESCRITA_NOME].$vp->CloseTd();
			echo $vp->CloseTr();
			
			echo $vp->Tr();
				echo $vp->Td()."Aluno/Ex: ".$vp->CloseTd();
				echo $vp->Td().$vp->OnOff($aluno).$vp->CloseTd();
					
				echo $vp->Td()."Funcion�rio: ".$vp->CloseTd();
				echo $vp->Td().$vp->OnOff($row[FUNCIONARIO]).$vp->CloseTd();
			echo $vp->CloseTr();
			
			echo $vp->Tr();
				echo $vp->Td()."Docente: ".$vp->CloseTd();
				echo $vp->Td().$vp->OnOff($row[DOCENTE]).$vp->CloseTd();
				
				echo $vp->Td()."Terceiro: ".$vp->CloseTd();
				echo $vp->Td().$vp->OnOff($row[PRESTADOR]).$vp->CloseTd();
			echo $vp->CloseTr();

		echo $vp->CloseTable();
		
		echo $vp->Br();
		
		echo $vp->H3("Contato");
		
		echo $vp->Table(array("class"=>"infoPessoa","border"=>"0","cellpadding"=>"0","cellspacing"=>"0","width"=>"100%"));
			echo $vp->Tr();
				echo $vp->Td()."e-mail: ".$vp->CloseTd();
				echo $vp->Td(array("colspan"=>"3")).$row[EMAIL1].$vp->CloseTd();
			echo $vp->CloseTr();

			echo $vp->Tr();
				echo $vp->Td()."Fone Residencial: ".$vp->CloseTd();
				echo $vp->Td().$row[FONERES].$vp->CloseTd();
				
				echo $vp->Td()."Fone Celular: ".$vp->CloseTd();
				echo $vp->Td().$row[FONECEL].$vp->CloseTd();
			echo $vp->CloseTr();
				
			echo $vp->Tr();
				echo $vp->Td()."Fone Comecial: ".$vp->CloseTd();
				echo $vp->Td().$row[FONECOM].$vp->CloseTd();
				
				echo $vp->Td()."Fax: ".$vp->CloseTd();
				echo $vp->Td().$row[FONEFAX].$vp->CloseTd();
			echo $vp->CloseTr();
				
			
		echo $vp->CloseTable();
		
		echo $vp->Br();
		
		echo $vp->H3("Fam�lia");
		
		echo $vp->Table(array("class"=>"infoPessoa","border"=>"0","cellpadding"=>"0","cellspacing"=>"0","width"=>"100%"));
			
			echo $vp->Tr();
				echo $vp->Td()."Pai: ".$vp->CloseTd();
				echo $vp->Td().$row[PAI].$vp->CloseTd();
				
				echo $vp->Td()."Dt.Nascto do Pai".$vp->CloseTd();
				echo $vp->Td().$row[DTNASCTOPAI].$vp->CloseTd();
			echo $vp->CloseTr();
				
			echo $vp->Tr();
				echo $vp->Td()."M�e: ".$vp->CloseTd();
				echo $vp->Td().$row[MAE].$vp->CloseTd();
			
				echo $vp->Td()."Dt.Nascto da M�e".$vp->CloseTd();
				echo $vp->Td().$row[DTNASCTOMAE].$vp->CloseTd();
			echo $vp->CloseTr();
		echo $vp->CloseTable();
		
		echo $vp->Br();
		
		echo $vp->H3("Documenta��o");
		
		echo $vp->Table(array("class"=>"infoPessoa","border"=>"0","cellpadding"=>"0","cellspacing"=>"0","width"=>"100%"));
		
			echo $vp->Tr();
				echo $vp->Td()."RG/RNE: ".$vp->CloseTd();
				echo $vp->Td()._NVL($row[RGRNEFORMATADO],$row[RGRNE])." ". $row[RGRNEEMISSOR] . "/" . $row[ESTADO] .$vp->CloseTd();
				
			
				echo $vp->Td()."Data de Emiss�o".$vp->CloseTd();
				echo $vp->Td().$row[RGRNEDT].$vp->CloseTd();
			echo $vp->CloseTr();

			
			echo $vp->Tr();
				echo $vp->Td()."CPF: ".$vp->CloseTd();
				echo $vp->Td().$row[CPF].$vp->CloseTd();
			
				echo $vp->Td()."PIS".$vp->CloseTd();
				echo $vp->Td().$row[PIS].$vp->CloseTd();
			echo $vp->CloseTr();

			echo $vp->Tr();
				echo $vp->Td()."Reservista: ".$vp->CloseTd();
				echo $vp->Td(array("colspan"=>"3")).$row[MILITARNUM]. " S�rie ". $row[MILITARSERIE] . " Regi�o " . $row[MILITARREGIAO] .$vp->CloseTd();
				
			echo $vp->CloseTr();
				
			echo $vp->Tr();
				echo $vp->Td()."T�tulo de Eleitor: ".$vp->CloseTd();
				echo $vp->Td(array("colspan"=>"3")).$row[TELENUM] . " Zona " . $row[TELEZONA] . " Se��o " . $row[TELESECAO] .$vp->CloseTd();
				
			echo $vp->CloseTr();

		echo $vp->CloseTable();
		
		echo $vp->Br();
		
		echo $vp->H3("Forma��o Acad�mica");
		
		echo $vp->Table(array("class"=>"infoPessoa","border"=>"0","cellpadding"=>"0","cellspacing"=>"0","width"=>"100%"));
			
				
			echo $vp->Tr();
				echo $vp->Td()."Ensino M�dio: ".$vp->CloseTd();
				echo $vp->Td().$row[ENSMEDIO] .$vp->CloseTd();
			
				echo $vp->Td()."Ano Conclus�o".$vp->CloseTd();
				echo $vp->Td().$row[ANO_ENSMEDIO].$vp->CloseTd();
			echo $vp->CloseTr();

		echo $vp->CloseTable();
		
		echo $vp->Br();
		
		echo $vp->H3("Endere�os");
		
		echo $vp->Table(array("class"=>"infoPessoa","border"=>"0","cellpadding"=>"0","cellspacing"=>"0","width"=>"100%"));
		
			
			echo $vp->Tr();
				echo $vp->Td()."Residencial: ".$vp->CloseTd();
				echo $vp->Td(). $lograd->Recognize($row[LOGRAD_ID],'RecNome') . ', ' . $row[ENDERNUM] .$vp->CloseTd();
				echo $vp->Td()."CEP:".$vp->CloseTd();
				echo $vp->Td(). $lograd->Recognize($row[LOGRAD_ID],'RecCEP') .$vp->CloseTd();
			echo $vp->CloseTr();
				
			echo $vp->Tr();
				echo $vp->Td()."Correspond�ncia: ".$vp->CloseTd();
				echo $vp->Td(). $lograd->Recognize($row[LOGRAD_ENTREG_ID],'RecNome') . $vp->CloseTd();
				echo $vp->Td()."CEP:".$vp->CloseTd();
				echo $vp->Td(). $lograd->Recognize($row[LOGRAD_ENTREG_ID],'RecCEP') . $vp->CloseTd();
			echo $vp->CloseTr();
				
		echo $vp->CloseTable();
		
		echo $vp->Br();
		
		echo $vp->H3("Profissional");
		
		echo $vp->Table(array("class"=>"infoPessoa","border"=>"0","cellpadding"=>"0","cellspacing"=>"0","width"=>"100%"));
		
				
			echo $vp->Tr();
				echo $vp->Td()."Empresa: ".$vp->CloseTd();
				echo $vp->Td(array("colspan"=>"3")).$row[EMPRESA] .$vp->CloseTd();
			echo $vp->CloseTr();
			
			echo $vp->Tr();
				echo $vp->Td()."Cargo: ".$vp->CloseTd();
				echo $vp->Td().$row[CARGO] .$vp->CloseTd();
			
				echo $vp->Td()."Admiss�o: ".$vp->CloseTd();
				echo $vp->Td().$row[DTADMISSAO] .$vp->CloseTd();				
			echo $vp->CloseTr();
			
			echo $vp->Tr();
			echo $vp->Td()."Endere�o: ".$vp->CloseTd();
			echo $vp->Td(). $lograd->Recognize($row[LOGRAD_COM_ID],'RecNome') . ', ' . $row[ENDERNUMCOM] . $vp->CloseTd();
			echo $vp->Td()."CEP:".$vp->CloseTd();
			echo $vp->Td(). $lograd->Recognize($row[LOGRAD_COM_ID],'RecCEP') . $vp->CloseTd();
			echo $vp->CloseTr();			
				
		echo $vp->CloseTable();
			
		echo $vp->Br();
			
		echo $vp->H3("Sa�de");
			
		echo $vp->Table(array("class"=>"infoPessoa","border"=>"0","cellpadding"=>"0","cellspacing"=>"0","width"=>"100%"));
			
			echo $vp->Tr();
				echo $vp->Td()."Tipo Sangu�neo: ".$vp->CloseTd();
				echo $vp->Td().$row[SANGUE_NOME] .$vp->CloseTd();
				
				echo $vp->Td()."�bito: ".$vp->CloseTd();
				echo $vp->Td().$row[DTOBITO] .$vp->CloseTd();
			echo $vp->CloseTr();
			
		echo $vp->CloseTable();
	echo $vp->CloseDiv();
	
	
	echo $vp->Div(array("class"=>"boxInfoPessoa"));
	
		echo $vp->H3("Matr�culas");
	
		
		echo $matric->GetStateMatriculas(_Decrypt($_GET[p_WPessoa_Id]));
	
		
	echo $vp->CloseDiv();
		
	echo $vp->Br();
	
	
	unset($dbData);
	unset($dbOracle);
	unset($vp);

	unset($wpessoa);
	unset($matric);
	unset($wocorr);
	unset($lograd); 
	unset($user);
	unset($app);
			
?>
						