<?php 

    require_once ("../engine/Model.class.php"); 

    class GradAlu extends Model 
    { 

        //Mapeamento da tabela do Banco de Dados 
        public $table = 'GradAlu'; 


        public $attribute     = array(); 
        public $calculate     = array();     
        public $query        = array();
     

        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WPessoa_Id']['Type'] 				= 'number';
            $this->attribute['WPessoa_Id']['Length'] 			= 15;
            $this->attribute['WPessoa_Id']['NN'] 				= 1;
            $this->attribute['WPessoa_Id']['Label'] 			= 'Aluno';

            $this->attribute['TurmaOfe_Id']['Type'] 			= 'number';
            $this->attribute['TurmaOfe_Id']['Length'] 			= 15;
            $this->attribute['TurmaOfe_Id']['Label'] 			= 'Turma';

            $this->attribute['CurrXDisc_Id']['Type'] 			= 'number';
            $this->attribute['CurrXDisc_Id']['Length'] 			= 15;
            $this->attribute['CurrXDisc_Id']['Label'] 			= 'Disciplina';

            $this->attribute['CriAval_Id']['Type'] 				= 'number';
            $this->attribute['CriAval_Id']['Length'] 			= 15;
            $this->attribute['CriAval_Id']['Label'] 			= 'Avaliação';

            $this->attribute['Matric_Id']['Type'] 				= 'number';
            $this->attribute['Matric_Id']['Length'] 			= 15;
            $this->attribute['Matric_Id']['Label'] 				= 'Matrícula';
            $this->attribute['Matric_Id']['NN'] 				= 1;

            $this->attribute['GradAluTi_Id']['Type'] 			= 'number';
            $this->attribute['GradAluTi_Id']['Length'] 			= 15;
            $this->attribute['GradAluTi_Id']['Label'] 			= 'Tipo da Disciplina';

            $this->attribute['State_Id']['Type'] 				= 'number';
            $this->attribute['State_Id']['Length'] 				= 15;
            $this->attribute['State_Id']['Label'] 				= 'Situação';

            $this->attribute['DivTurma_Teoria_Id']['Type'] 		= 'number';
            $this->attribute['DivTurma_Teoria_Id']['Length'] 	= 15;
            $this->attribute['DivTurma_Teoria_Id']['Label'] 	= 'Divisão Teoria';

            $this->attribute['DivTurma_Pratica_Id']['Type'] 	= 'number';
            $this->attribute['DivTurma_Pratica_Id']['Length'] 	= 15;
            $this->attribute['DivTurma_Pratica_Id']['Label'] 	= 'Divisão Prática';

            $this->attribute['DivTurma_Lab_Id']['Type'] 		= 'number';
            $this->attribute['DivTurma_Lab_Id']['Length'] 		= 15;
            $this->attribute['DivTurma_Lab_Id']['Label'] 		= 'Divisão Laboratório';

            $this->attribute['N1']['Type'] 						= 'varchar2';
            $this->attribute['N1']['Length'] 					= 5;
            $this->attribute['N1']['Label'] 					= 'Nota';

            $this->attribute['N2']['Type'] 						= 'varchar2';
            $this->attribute['N2']['Length'] 					= 5;
            $this->attribute['N2']['Label'] 					= 'Nota';

            $this->attribute['N3']['Type'] 						= 'varchar2';
            $this->attribute['N3']['Length'] 					= 5;
            $this->attribute['N3']['Label'] 					= 'Nota';

            $this->attribute['N4']['Type'] 						= 'varchar2';
            $this->attribute['N4']['Length'] 					= 5;
            $this->attribute['N4']['Label'] 					= 'Nota';

            $this->attribute['N5']['Type'] 						= 'varchar2';
            $this->attribute['N5']['Length'] 					= 5;
            $this->attribute['N5']['Label'] 					= 'Nota';

            $this->attribute['N6']['Type'] 						= 'varchar2';
            $this->attribute['N6']['Length'] 					= 5;
            $this->attribute['N6']['Label'] 					= 'Nota';

            $this->attribute['N7']['Type'] 						= 'varchar2';
            $this->attribute['N7']['Length'] 					= 5;
            $this->attribute['N7']['Label'] 					= 'Nota';

            $this->attribute['N8']['Type'] 						= 'varchar2';
            $this->attribute['N8']['Length'] 					= 5;
            $this->attribute['N8']['Label'] 					= 'Nota';

            $this->attribute['N9']['Type'] 						= 'varchar2';
            $this->attribute['N9']['Length'] 					= 5;
            $this->attribute['N9']['Label'] 					= 'Nota';

            $this->attribute['N10']['Type'] 					= 'varchar2';
            $this->attribute['N10']['Length'] 					= 5;
            $this->attribute['N10']['Label'] 					= 'Nota';

            $this->attribute['N11']['Type'] 					= 'varchar2';
            $this->attribute['N11']['Length'] 					= 5;
            $this->attribute['N11']['Label'] 					= 'Nota';

            $this->attribute['N12']['Type'] 					= 'varchar2';
            $this->attribute['N12']['Length'] 					= 5;
            $this->attribute['N12']['Label'] 					= 'Nota';

            $this->attribute['N13']['Type'] 					= 'varchar2';
            $this->attribute['N13']['Length'] 					= 5;
            $this->attribute['N13']['Label'] 					= 'Nota';

            $this->attribute['N14']['Type'] 					= 'varchar2';
            $this->attribute['N14']['Length'] 					= 5;
            $this->attribute['N14']['Label'] 					= 'Nota';

            $this->attribute['N15']['Type'] 					= 'varchar2';
            $this->attribute['N15']['Length'] 					= 5;
            $this->attribute['N15']['Label'] 					= 'Nota';

            $this->attribute['F1']['Type'] 						= 'varchar2';
            $this->attribute['F1']['Length'] 					= 5;
            $this->attribute['F1']['Label'] 					= 'Falta';

            $this->attribute['F2']['Type'] 						= 'varchar2';
            $this->attribute['F2']['Length'] 					= 5;
            $this->attribute['F2']['Label'] 					= 'Falta';

            $this->attribute['F3']['Type'] 						= 'varchar2';
            $this->attribute['F3']['Length'] 					= 5;
            $this->attribute['F3']['Label'] 					= 'Falta';

            $this->attribute['F4']['Type'] 						= 'varchar2';
            $this->attribute['F4']['Length'] 					= 5;
            $this->attribute['F4']['Label'] 					= 'Falta';

            $this->attribute['F5']['Type'] 						= 'varchar2';
            $this->attribute['F5']['Length'] 					= 5;
            $this->attribute['F5']['Label'] 					= 'Falta';

            $this->attribute['F6']['Type'] 						= 'varchar2';
            $this->attribute['F6']['Length'] 					= 5;
            $this->attribute['F6']['Label'] 					= 'Falta';

            $this->attribute['F7']['Type'] 						= 'varchar2';
            $this->attribute['F7']['Length'] 					= 5;
            $this->attribute['F7']['Label'] 					= 'Falta';

            $this->attribute['F8']['Type'] 						= 'varchar2';
            $this->attribute['F8']['Length'] 					= 5;
            $this->attribute['F8']['Label'] 					= 'Falta';

            $this->attribute['F9']['Type'] 						= 'varchar2';
            $this->attribute['F9']['Length'] 					= 5;
            $this->attribute['F9']['Label'] 					= 'Falta';

            $this->attribute['F10']['Type'] 					= 'varchar2';
            $this->attribute['F10']['Length'] 					= 5;
            $this->attribute['F10']['Label'] 					= 'Falta';

            $this->attribute['F11']['Type'] 					= 'varchar2';
            $this->attribute['F11']['Length'] 					= 5;
            $this->attribute['F11']['Label'] 					= 'Falta';

            $this->attribute['F12']['Type'] 					= 'varchar2';
            $this->attribute['F12']['Length'] 					= 5;
            $this->attribute['F12']['Label'] 					= 'Falta';

            $this->attribute['F13']['Type'] 					= 'varchar2';
            $this->attribute['F13']['Length'] 					= 5;
            $this->attribute['F13']['Label'] 					= 'Falta';

            $this->attribute['InscSub']['Type'] 				= 'varchar2';
            $this->attribute['InscSub']['Length'] 				= 3;
            $this->attribute['InscSub']['Label'] 				= 'Inscrição para Substitutiva';

            $this->attribute['InscSubAuto']['Type'] 			= 'varchar2';
            $this->attribute['InscSubAuto']['Length'] 			= 3;
            $this->attribute['InscSubAuto']['Label'] 			= 'Inscrição Automática para Substitutiva';

            $this->attribute['GradAlu_Filho_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_Filho_Id']['Length'] 		= 15;
            $this->attribute['GradAlu_Filho_Id']['Label'] 		= 'Transferência';

            $this->attribute['DtInscSub']['Type'] 				= 'date';
            $this->attribute['DtInscSub']['Label'] 				= 'Data da Inscrição para Substitutiva';

            $this->attribute['HoraProva_Esp_Id']['Type'] 		= 'number';
            $this->attribute['HoraProva_Esp_Id']['Length'] 		= 15;
            $this->attribute['HoraProva_Esp_Id']['Label'] 		= 'Prova Especial';

            $this->attribute['PLetivo_Estagio_Id']['Type'] 		= 'number';
            $this->attribute['PLetivo_Estagio_Id']['Length'] 	= 15;
            $this->attribute['PLetivo_Estagio_Id']['Label'] 	= 'Periodo Letivo';

            $this->attribute['NotaAlt']['Type'] 				= 'number';
            $this->attribute['NotaAlt']['Length'] 				= 1;
            $this->attribute['NotaAlt']['Label'] 				= 'Nota Alterada?';

            $this->recognize['Recognize']	= 'WPessoa_Id, TurmaOfe_Id, CurrXDisc_Id';

            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['DpsDoAluno'] 						= 'GradAlu_qDPsDoAluno';
            $this->calculate['LicenDoAluno'] 					= 'GradAlu_qLicenciatura';

            //Todas as Queries da classe
            $this->query['qPLetivoAprovado'] 					= 'GradAlu_qPLetivoAprovado';
            $this->query['qDispensas'] 							= 'GradAlu_qDispensas';
            $this->query['qIdNet'] 								= 'GradAlu_qIdNet';
            $this->query['qAlterDivTurmaHi'] 					= 'GradAlu_qAlterDivTurmaHi';
            $this->query['qHi'] 								= 'GradAlu_qHi';
            $this->query['qQtdeMatric'] 						= 'GradAlu_qQtdeMatric';
            $this->query['qMatricExiste'] 						= 'GradAlu_qMatricExiste';
            $this->query['qAlterNotaHi'] 						= 'GradAlu_qAlterNotaHi';
            $this->query['qTurmaOfe'] 							= 'GradAlu_qTurmaOfe';
            $this->query['qDPsDoAluno'] 						= 'GradAlu_qDPsDoAluno';
            $this->query['qDiscEstagio'] 						= 'GradAlu_qDiscEstagio';
            $this->query['qAlunoPromocao'] 						= 'GradAlu_qAlunoPromocao';
            $this->query['qMatric'] 							= 'GradAlu_qMatric';
            $this->query['qQtdeMatricE'] 						= 'GradAlu_qQtdeMatricE';
            $this->query['qDiscProvaEsp'] 						= 'GradAlu_qDiscProvaEsp';
            $this->query['qNotaMatric'] 						= 'GradAlu_qNotaMatric';
            $this->query['qAlunoTurmaOfe'] 						= 'GradAlu_qAlunoTurmaOfe';
            $this->query['qLicenciaturaGrade'] 					= 'GradAlu_qLicenciaturaGrade';
            $this->query['qPLetivo'] 							= 'GradAlu_qPLetivo';
            $this->query['qProvaEspCad'] 						= 'GradAlu_qProvaEspCad';
            $this->query['qProfAlunos'] 						= 'GradAlu_qProfAlunos';
            $this->query['qAlunoEstagio'] 						= 'GradAlu_qAlunoEstagio';
            $this->query['qMatricId'] 							= 'GradAlu_qMatricId';
            $this->query['qCurrXDisc'] 							= 'GradAlu_qCurrXDisc';
            $this->query['qGradAlu'] 							= 'GradAlu_qGradAlu';
            $this->query['qMatricSerie'] 						= 'GradAlu_qMatricSerie';
            $this->query['qAprovadas'] 							= 'GradAlu_qAprovadas';
            $this->query['qAlunoNota'] 							= 'GradAlu_qAlunoNota';
            $this->query['qDiscDivTurma'] 						= 'GradAlu_qDiscDivTurma';
            $this->query['qDivisaoTurma'] 						= 'GradAlu_qDivisaoTurma';
            $this->query['qHistorico'] 							= 'GradAlu_qHistorico';
            $this->query['qQtdeMatricSubENota'] 				= 'GradAlu_qQtdeMatricSubENota';
            $this->query['qIdLPre'] 							= 'GradAlu_qIdLPre';
            $this->query['qAlunoMatric'] 						= 'GradAlu_qAlunoMatric';
            $this->query['qAnoIniCurr'] 						= 'GradAlu_qAnoIniCurr';
            $this->query['qAlunoFast'] 							= 'GradAlu_qAlunoFast';
            $this->query['qFacul'] 								= 'GradAlu_qFacul';
            $this->query['qWPessoa'] 							= 'GradAlu_qWPessoa';
            $this->query['qQtdeMatricSubNota'] 					= 'GradAlu_qQtdeMatricSubNota';
            $this->query['qEstatico'] 							= 'GradAlu_qEstatico';
            $this->query['qFaltaAbono'] 						= 'GradAlu_qFaltaAbono';
            $this->query['qGeraBoleto'] 						= 'GradAlu_qGeraBoleto';
            $this->query['qAnoIniRep'] 							= 'GradAlu_qAnoIniRep';
            $this->query['qDireitoEstagio'] 					= 'GradAlu_qDireitoEstagio';
            $this->query['qGeralCursando'] 						= 'GradAlu_qGeralCursando';
            $this->query['qGradAluHi'] 							= 'GradAlu_qGradAluHi';
            $this->query['qAlterNota'] 							= 'GradAlu_qAlterNota';
            $this->query['qMatricPura'] 						= 'GradAlu_qMatricPura';
            $this->query['qEstagio'] 							= 'GradAlu_qEstagio';
            $this->query['qResultadoOficial'] 					= 'GradAlu_qResultadoOficial';
            $this->query['qQtdPLetivo'] 						= 'GradAlu_qQtdPLetivo';
            $this->query['qEstagios'] 							= 'GradAlu_qEstagios';
            $this->query['qQtdeMatricENota'] 					= 'GradAlu_qQtdeMatricENota';
            $this->query['qHoraProva'] 							= 'GradAlu_qHoraProva';
            $this->query['qFichaPos'] 							= 'GradAlu_qFichaPos';
            $this->query['qQtdeMatricNota'] 					= 'GradAlu_qQtdeMatricNota';
            $this->query['qDisciplinas'] 						= 'GradAlu_qDisciplinas';
            $this->query['qQtdProvaEsp'] 						= 'GradAlu_qQtdProvaEsp';
            $this->query['qTOXCD'] 								= 'GradAlu_qTOXCD';
            $this->query['qMediaTOXCD']				 			= 'GradAlu_qMediaTOXCD';
            $this->query['qAlunoCXDPLet'] 						= 'GradAlu_qAlunoCXDPLet';
            $this->query['qDiscAluno'] 							= 'GradAlu_qDiscAluno';
            $this->query['qAlunoCXDPos'] 						= 'GradAlu_qAlunoCXDPos';
            $this->query['qGraficoNotas'] 						= 'GradAlu_qGraficoNotas';
            $this->query['qQtdeMatricSub'] 						= 'GradAlu_qQtdeMatricSub';
            $this->query['qResultadoAluno'] 					= 'GradAlu_qResultadoAluno';
            $this->query['qAlunoCXDEqui'] 						= 'GradAlu_qAlunoCXDEqui';
            $this->query['qAnoInicio'] 							= 'GradAlu_qAnoInicio';
            $this->query['qQtdeMatricSubE'] 					= 'GradAlu_qQtdeMatricSubE';
            $this->query['qLicenciatura'] 						= 'GradAlu_qLicenciatura';
            $this->query['qId'] 								= 'GradAlu_qId';
            $this->query['qEstagCXDPLet'] 						= 'GradAlu_qEstagCXDPLet';
            $this->query['qPromocao'] 							= 'GradAlu_qPromocao';
            $this->query['qDPsDoAlunoQtd'] 						= 'GradAlu_qDPsDoAlunoQtd';
            $this->query['qAlunoCXD'] 							= 'GradAlu_qAlunoCXD';
            $this->query['qTOXCDE'] 							= 'GradAlu_qTOXCDE';
            $this->query['qAlunoPLetivo'] 						= 'GradAlu_qAlunoPLetivo';
            $this->query['qMatricQtde'] 						= 'GradAlu_qMatricQtde';
            $this->query['qGetInfo'] 							= 'GradAlu_qGetInfo'; 
        } 

        public function GetNotaWS($matric_id)
        {
        	
       		$sql = "SELECT
					  	gradalu.*,
					  	currxdisc_gsRetCodDisc(gradalu.currxdisc_id)          as disc,
					  	currxdisc_gsRetDisc(gradalu.currxdisc_id)          	  as discnome,
					  	turmaofe_gsRetCodTurma(gradalu.turmaofe_id)           as turma,
					  	state_gsRecognize(gradalu.state_id)                   as situacao,
       					gradaluti_gsrecognize(gradalu.gradaluti_id)           as gradaluti,
       					divturma_gsrecognize(gradalu.divturma_teoria_id) || ' ' ||  divturma_gsrecognize(gradalu.divturma_pratica_id) || ' ' ||  divturma_gsrecognize(gradalu.divturma_lab_id)  as Div,
       					nvl(CurrXDisc.NotaTi_Id, 12300000000001)               as NotaTi_Id
					FROM
	  					gradalu,
       					CurrXDisc
					WHERE
       					CurrXDisc.Id = GradAlu.CurrXDisc_Id
       				AND
					  	GradAlu.State_Id <> '3000000003002'
					AND
					  	gradalu.matric_id in ( select id from matric start with matric.id = nvl($matric_id ,0) connect by matric.matric_pai_id = prior matric.id ) 
					ORDER BY
					  	matric_id, disc";
       		
       		$dbData = new DbData($this->db);
       		
       		$dbData->Get($sql);
       		
       		while($row = $dbData->Row())
       		{
       			
       			$arReturn['Código'][]		= $row[DISC];
       			$arReturn['Disciplina'][]	= $row[DISCNOME];
       			$arReturn['Tipo'][] 		= $row[GRADALUTI];
       			$arReturn['Turma'][]		= $row[TURMA];
       			$arReturn['Div'][]			= $row[DIV];
       			
       			

       			$dbData2 = new DbData($this->db);
       			$dbData2->Get("SELECT * FROM CriAvalNota WHERE CriAval_Id = '".$row[CRIAVAL_ID]."' and ( '".$row[NOTATI_ID]."' is null or NotaTi_Id = '".$row[NOTATI_ID]."' ) order by Id" );

       			
       			while ($rowCAN = $dbData2->Row())
       			{
       				 
       				if ($row[NOTATI_ID] == '')	$row[$rowCAN[ATRIBUTO]] = '-----';
       			
       				$arReturn[$rowCAN[LABEL].'_'.$rowCAN[ATRIBUTO]][]  		= $row[$rowCAN[ATRIBUTO]];
       			
       			}
       			
       			
       			 
       			$vsubs = '';
       			if ($row[INSCSUB] == 'on' || $row[INSCSUBAUTO] == 'on')
       				$vsubs = 'X';
       			
       			
       			
       			$arReturn['Situação'][] 				= $row[SITUACAO];
       			$arReturn['Subs'][] 					= $vsubs;
       			
       			
       			//print_r($arReturn);
       			
       		}
       		unset($dbData2);
       		
       		return $arReturn;
        	
        	
        }
        
        
        
        public function GetNota($GradAlu_Id,$visible=2)
        {
        	
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get($this->Query("qGetInfo",array("p_GradAlu_Id"=>$GradAlu_Id)));

        	$row = $dbData->Row();
        	
        	if ($row["STATE_ID"] != '3000000003002')
        	{
        		 
        		/*
        		 * INDICE DE EXIBIÇÃO DO ARRAY - Visible
        		 * 
        		 * 0 - NÃO APARECE EM NENHUM LUGAR
        		 * 1 - APARECE NO SISTEMA / SITE / APP
        		 * 2 - APARECE APENAS NO SISTEMA
        		 * 
        		 */
        		
        		if ($visible == 2)
        		{
        			$aFaltas = $this->GetFaltas($GradAlu_Id);
        		}
        		
        		
	        	$arReturn['Disciplina']['Desc']		= $row[DISCIPLINA];
	        	$arReturn['Disciplina']['Visible'] 	= 2;
	        	
	        	$arReturn['Código']['Desc'] 		= $row[DISC];
	        	$arReturn['Código']['Visible'] 		= 1;
	        	
	        	$arReturn['Tipo']['Desc']	 		= $row[GRADALUTI];
	        	$arReturn['Tipo']['Visible'] 		= 2;
	        	
	        	$arReturn['Turma']['Desc'] 			= $row[TURMA];
	        	$arReturn['Turma']['Visible']		= 1;
	        	
	        	$arReturn['Div']['Desc'] 			= $row[DIV];
	        	$arReturn['Div']['Visible'] 		= 1;
	        	
	     	
	        	$dbData->Get("SELECT * FROM CriAvalNota WHERE CriAval_Id = '".$row[CRIAVAL_ID]."' and ( '".$row[NOTATI_ID]."' is null or NotaTi_Id = '".$row[NOTATI_ID]."' ) order by Id" );
	        	 
	        	while ($rowCAN = $dbData->Row())
	        	{
	        		
					if ($row[NOTATI_ID] == '')
						$row[$rowCAN[ATRIBUTO]] = '-----';			
				
	        		$arReturn[$rowCAN[LABEL].'_'.$rowCAN[ATRIBUTO]]['Desc']  		= $row[$rowCAN[ATRIBUTO]];
	        		$arReturn[$rowCAN[LABEL].'_'.$rowCAN[ATRIBUTO]]['Visible']		= 1;
	        	}
				        	        	
	        	if ($row[NOTATI_ID] == 12300000000004 && $row[CRIAVAL_ID] == 8600000002001)
	        	{
	        		$dbData->Get("SELECT * FROM CriAvalNota WHERE CriAval_Id = '".$row[CRIAVAL_ID]."' and notati_id=12300000000001 order by Id" );
	        		while ($rowCAN = $dbData->Row())
	        		{
						if ($arReturn[$rowCAN[LABEL].'_'.$rowCAN[ATRIBUTO]]['Desc'] == '')      				
	        				$arReturn[$rowCAN[LABEL].'_'.$rowCAN[ATRIBUTO]]['Desc']  = '-----';
	        		}
	        		
	        	}
	        	 
	        	$vsubs = '';
	        	if ($row[INSCSUB] == 'on' || $row[INSCSUBAUTO] == 'on')
	        		$vsubs = 'X';
	        	
	        	$arReturn['Faltas']['Desc'] 				= _NVL($aFaltas[QTD],'0');
	        	$arReturn['Faltas']['Visible'] 				= 2;
	        	
	        	$arReturn['Limite']['Desc'] 				= $row[CHLIMITE];
	        	$arReturn['Limite']['Visible'] 				= 2;
	        	
	        	$arReturn['Carga<br>Horária']['Desc']		= $row[CHANUAL];
	        	$arReturn['Carga<br>Horária']['Visible']	= 2;
	        	
	        	$arReturn['Situação']['Desc'] 				= $row[SITUACAO];
	        	$arReturn['Situação']['Visible'] 			= 1;
	        	
	        	$arReturn['Subs']['Desc'] 					= $vsubs;
	        	$arReturn['Subs']['Visible'] 				= 2;
	        	
	        	$arReturn['Programa']['Desc'] 				= '';
	        	$arReturn['Programa']['Visible'] 			= 2;
	        	
	        	$arReturn['FaltasDesc']['Desc'] 			= _NVL($aFaltas['Desc'],'--');
	        	$arReturn['FaltasDesc']['Visible'] 			= 0;
        	}
        	        	
        	unset($dbData);        	
        	return $arReturn;
        }

        
        public function GetAllDisc($Matric_Id,$visible=2)
        {
        	
        	
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get($this->Query("qAlunoMatric",array("p_Matric_Id"=>$Matric_Id)));

        	
        	
        		while ($row = $dbData->Row())
        		{
        			$arReturn[] = $this->GetNota($row[ID],$visible);
        		}
        		
        		
        		$arHead = array();

        		foreach($arReturn as $key => $array)
        		{
        			        				
        			if(count($array) > count($arHead))
        			{
        				
        				foreach($array as $key2 => $array2)
        				{
        					if($array2['Visible'] <= $visible)
        					{
        						
        						$arHead[] = $key2;
        						
        					}
        					
        				}
        				
        				
        			}
        			
        		}
        		
        		
        		        	
        		foreach($arHead as $valor)
        		{
        			foreach($arReturn as $key => $array)
        			{
       					if($array[$valor] != "")
       					{
       						$nAr[$key][$valor]['Desc'] 		= $array[$valor]['Desc'];
       						$nAr[$key][$valor]['Visible'] 	= $array[$valor]['Visible'];
       					}
       					else 
       					{
       						$nAr[$key][$valor]['Desc'] = "";
       						$nAr[$key][$valor]['Desc'] = $visible;
       					}
        			}
        		}
        		
        		
        	unset($dbData);		 
        	return $nAr;
        }
        
        
        public function GetGradAluInfo($Matric_Id,  $GradAlu_Id=NULL, $visible)
        {
        	if($visible == "") $visible = 2;
        	        	
        	$disciplinas = $this->GetAllDisc($Matric_Id,$visible);
           	$nFirst = 1;
        		
        	$html = $this->Table(array("class"=>"dataGrid","cellspacing"=>"1"));

        	foreach($disciplinas as $key => $valor)
        	{
        	
        		if ($nFirst == 1)
        		{	
        			foreach($valor as $titColuna => $notas)
        			{
        				
        				if($notas['Visible'] <= $visible && $notas['Visible'] > 0)	
        					$html .= $this->Th(reset(explode("_",$titColuna)));
        			}       					
	        		$nFirst = 0;
	        		$html = str_replace('Média Anual','Média<br>Anual',$html);
	        		$html = str_replace('Média Final','Média<br>Final',$html);
        		}
        				
        		        				
        		$html .= $this->Tr(array());
       				
        		foreach($valor as $titColuna => $notas)
        		{
        			if($notas['Visible'] <= $visible && $notas['Visible'] > 0)
        				$html .= $this->Td(array("align"=>"left")) . $notas['Desc']. $this->CloseTd();
        		}
        				
        		$html .= $this->CloseTr();
        				
        	}
        	
        
        	return $html;
        	
        }
        
        
        
        
        public function GetFaltas($GradAlu_Id)
        {
        	include_once('../model/LPreFolha.class.php');
        	include_once('../model/Matric.class.php');
        	include_once('../model/TurmaOfe.class.php');
        	include_once('../model/CurrXDisc.class.php');
        	include_once('../model/FaltaAbono.class.php');
        	
        	$lpreFolha 	= new LPreFolha($this->db);
        	$matric 	= new Matric($this->db);
        	$turmaofe 	= new TurmaOfe($this->db);
        	$faltaAbono	= new FaltaAbono($this->db);
        	
        	
        	$dbData = new DbData($this->db);
        	
        	$aGradAlu = $this->GetIdInfo($GradAlu_Id);

        	$vDiscAux = explode(" - ",$aGradAlu['CURRXDISC_NOME']);
        	
        	$vDisc = $vDiscAux[2]." - ".$vDiscAux[3];
        	
        	$aMatric = $matric->GetIdInfo($aGradAlu["MATRIC_ID"]);
			
        	$dtAux 		= explode("/",$aMatric["DTSTATE"]);
        	$dtMatric 	= $dtAux[2].$dtAux[1].$dtAux[0];
        	
        	 
        	$dbData->Get($lpreFolha->Query("qGradAlu",array("p_GradAlu_Id"=>$GradAlu_Id)));
        	
        	$vTurma = $turmaofe->Recognize($aMatric["TURMAOFE_ID"],'RecTurma');
        	
      	
        	
        	$vRet = 0;        	
        	$aDescricao = '';
        	while ($row = $dbData->Row())
        	{
        		
        		$vFalta = 0;
        		if ( empty($dtMatric) )
        		{
        			$vFalta = 1;
        		}
        		else
        		{
        			list($vAux,$vHr) = explode(" ",$row["DATA"]);
        			$vAux = explode("/",$row["DATA"]);
        			
        			//verificar se a falta é dps da data de matricula
        			$vDt = $vAux[2].$vAux[1].$vAux[0];
        			
        			if ( $dtMatric >= $vDt )
        				$vFalta = 1;
        			 					        			
        		}
        		

        
				if ( $vFalta == 1 )
				{
					
					
					
					if ( $row["INDICE"] == 3 )
					{
						if ($row["FALTA"] == 4 || $row["FALTA"] == 5 || $row["FALTA"] == 6 || $row["FALTA"] == 7)
						{
							$bAbono = FALSE;
							if ($faltaAbono->GetDataAbono($aGradAlu["WPESSOA_ID"],substr($row["DATA"],0,10),$aGradAlu["ID"]) == 0)
							{
								$vRet += _NVL($row["QTDAULAS"],0);
							}
							else 
							{
								$bAbono = TRUE;
							}
							$arReturn['Desc'][$row["DATA"]]['TURMA'] 		= $vTurma;
							$arReturn['Desc'][$row["DATA"]]['DISC'] 		= $vDisc;
							$arReturn['Desc'][$row["DATA"]]['QTDFALTAS'] 	= $row["QTDAULAS"];
							$arReturn['Desc'][$row["DATA"]]['ABONO'] 		= $bAbono;
						}
					}
					if ( $row["INDICE"] == 2 )
					{
						if ($row["FALTA"] == 2 || $row["FALTA"] == 3 || $row["FALTA"] == 6 || $row["FALTA"] == 7)
						{
							$bAbono = FALSE;
							if ($faltaAbono->GetDataAbono($aGradAlu["WPESSOA_ID"],substr($row["DATA"],0,10),$aGradAlu["ID"]) == 0)
							{
								$vRet += _NVL($row["QTDAULAS"],0);
							}
							else 
							{
								$bAbono = TRUE;
							}							
							$arReturn['Desc'][$row["DATA"]]['TURMA'] 	= $vTurma;
							$arReturn['Desc'][$row["DATA"]]['DISC'] 	= $vDisc;
							$arReturn['Desc'][$row["DATA"]]['QTDFALTAS'] = $row["QTDAULAS"];
							$arReturn['Desc'][$row["DATA"]]['ABONO'] 		= $bAbono;
						}
					}
					if ( $row["INDICE"] == 1 )
					{
						if ($row["FALTA"] == 1 || $row["FALTA"] == 3 || $row["FALTA"] == 5 || $row["FALTA"] == 7)
						{
							$bAbono = FALSE;
							if ($faltaAbono->GetDataAbono($aGradAlu["WPESSOA_ID"],substr($row["DATA"],0,10),$aGradAlu["ID"]) == 0)
							{
								$vRet += _NVL($row["QTDAULAS"],0);
							}
							else 
							{
								$bAbono = TRUE;
							}							
							$arReturn['Desc'][$row["DATA"]]['TURMA'] 	= $vTurma;
							$arReturn['Desc'][$row["DATA"]]['DISC'] 	= $vDisc;
							$arReturn['Desc'][$row["DATA"]]['QTDFALTAS'] = $row["QTDAULAS"];
							$arReturn['Desc'][$row["DATA"]]['ABONO'] 		= $bAbono;
						}
					}					
				}
				
			
        	}
        	
        	$arReturn['Qtd'] = $vRet;

        	return $arReturn;       	
        	
        }
        
        
        public function GetFaltasFormat($Matric_Id)
        {
        		
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get($this->Query("qAlunoMatric",array("p_Matric_Id"=>$Matric_Id)));
        	
        	$html = $this->Table(array("class"=>"dataGrid","cellspacing"=>"1"));
        	$html .= $this->Th('Código',array());
        	$html .= $this->Th('Turma',array());
        	$html .= $this->Th('Faltas',array());
        	$html .= $this->Th('Limite',array());
        	$html .= $this->Th('Carga Horária',array());
        
        	while ($row = $dbData->Row())
        	{
        		
        		$aFaltas = $this->GetFaltas($row[ID]);


        		
        		echo $this->Div(array("style"=>"display:none"));
        			echo $this->Div(array("id"=>"inline_".$row[DISC],"style"=>"padding:10px; background:#fff;"));
        			echo $this->GetDetFaltasFormat($aFaltas);        			
        			echo $this->CloseDiv();
        		echo $this->CloseDiv();
    		
       			$html .= $this->Tr(array());
       			$html .= $this->Td(array("align"=>"left")) . $row[DISC] . $this->CloseTd();
       			$html .= $this->Td(array()) . $row[TURMA] . $this->CloseTd();
       			$html .= $this->Td(array("align"=>"right"));
       			if ($aFaltas[Qtd] > 0)
       			{
       				$html .= $this->Link($aFaltas[Qtd],array("class"=>"inline","href"=>"#inline_".$row[DISC]));
       			}
       			else
       			{
       				$html .= $aFaltas[Qtd];
       			}
       			$html .= $this->CloseTd();

      			$html .= $this->Td(array("align"=>"right")) . $row[CHLIMITE] . $this->CloseTd();
       			$html .= $this->Td(array("align"=>"right")) . $row[CHANUAL] . $this->CloseTd();
       			$html .= $this->CloseTr();
        	}
        	$html .= $this->CloseTable();
        		
        		
        		
        	return $html ;
        		
        		
        }
        
        
        public function GetDetFaltasFormat($aFaltas)
        {
        	
        	$sRet = $this->Table(array("class"=>"dataGrid","border"=>"1","cellspacing"=>"1"));
        	$sRet .= $this->Tr(array());
        	$sRet .= $this->Th('Turma',array());
        	$sRet .= $this->Th('Data',array());
        	$sRet .= $this->Th('Hora',array());
        	$sRet .= $this->Th('Quantidade',array());
        	$sRet .= $this->Th('Abono',array());
        	$sRet .= $this->CloseTr();
        	foreach($aFaltas as $key => $aArr)
        	{
        		if (is_array($aArr))        		{
        			$first = TRUE;

        			foreach($aArr as $subKey => $aArrSub)
        			{        				
        				if ($first)
        				{
        					$sRet .= $this->Caption($aArrSub["DISC"]); 
        					$first = FALSE;
        				}
        				
        				$aData = explode(" ",$subKey);
        				$sRet .= $this->Tr(array());
        				$sRet .= $this->Td(array()) . $aArrSub["TURMA"] . $this->CloseTd();
        				$sRet .= $this->Td(array("align"=>"center")) . $aData[0] . $this->CloseTd();
        				$sRet .= $this->Td(array("align"=>"right")) . $aData[1] . $this->CloseTd();
        				$sRet .= $this->Td(array("align"=>"right")) . $aArrSub["QTDFALTAS"] . $this->CloseTd();
        				//$vAbono = '';
        				//if ($aArrSub[ABONO])
        				//	$vAbono = 'X';
        				$sRet .= $this->Td(array("align"=>"center")) . $this->OnOff($aArrSub[ABONO]) . $this->CloseTd();
        				
        				$sRet .= $this->CloseTr();
        				
        				
        			}
        		}       		
        	}
        	$sRet .= $this->CloseTable();
        	
        	return $sRet; 
        }
} 
?>