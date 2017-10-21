
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class HoraAula extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'HoraAula'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

        
        public function __construct($db) 
        {

        	$this->db = $db;
        	
            $this->attribute['TOXCD_Id']['Type'] 				= 'number';
            $this->attribute['TOXCD_Id']['Length'] 				= 15;
            $this->attribute['TOXCD_Id']['NN'] 					= 1;
            $this->attribute['TOXCD_Id']['Label'] 				= 'Disciplinas';

            $this->attribute['Horario_Id']['Type'] 				= 'number';
            $this->attribute['Horario_Id']['Length'] 			= 15;
            $this->attribute['Horario_Id']['NN'] 				= 1;
            $this->attribute['Horario_Id']['Label'] 			= 'Horário';

            $this->attribute['AulaTi_Id']['Type'] 				= 'number';
            $this->attribute['AulaTi_Id']['Length'] 			= 15;
            $this->attribute['AulaTi_Id']['Label'] 				= 'Tipo Aula';

            $this->attribute['DivTurma_Id']['Type'] 			= 'number';
            $this->attribute['DivTurma_Id']['Length'] 			= 15;
            $this->attribute['DivTurma_Id']['Label'] 			= 'Divisão';

            $this->attribute['DivDisc_Id']['Type'] 				= 'number';
            $this->attribute['DivDisc_Id']['Length'] 			= 15;
            $this->attribute['DivDisc_Id']['Label'] 			= 'Sub-Divisão';
            $this->attribute['DivDisc_Id']['Recognize'] 		= '8';

            $this->attribute['WPessoa_Prof1_Id']['Type']		= 'number';
            $this->attribute['WPessoa_Prof1_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Prof1_Id']['Label'] 		= 'Professor 1';

            $this->attribute['WPessoa_Prof2_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Prof2_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Prof2_Id']['Label'] 		= 'Professor 2';

            $this->attribute['WPessoa_Prof3_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Prof3_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Prof3_Id']['Label'] 		= 'Professor 3';

            $this->attribute['WPessoa_Prof4_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Prof4_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Prof4_Id']['Label'] 		= 'Professor 4';

            $this->attribute['AgrupLPresenca']['Type'] 			= 'number';
            $this->attribute['AgrupLPresenca']['Length'] 		= 2;
            $this->attribute['AgrupLPresenca']['Label'] 		= 'Agrupamento Lista de Presença';

            $this->attribute['Sala_Especial_Id']['Type'] 		= 'number';
            $this->attribute['Sala_Especial_Id']['Length'] 		= 15;
            $this->attribute['Sala_Especial_Id']['Label'] 		= 'Sala';

            $this->attribute['AgrupLPresencaAuto']['Type'] 		= 'number';
            $this->attribute['AgrupLPresencaAuto']['Length'] 	= 10;
            $this->attribute['AgrupLPresencaAuto']['Label'] 	= 'Agrupamento Lista de Presença Automático';

            $this->attribute['DtInicio']['Type']	 			= 'date';
            $this->attribute['DtInicio']['NN'] 					= 1;
            $this->attribute['DtInicio']['Label'] 				= 'Início Validade';
            $this->attribute['DtInicio']['Recognize'] 			= '6';

            $this->attribute['DtTermino']['Type'] 				= 'date';
            $this->attribute['DtTermino']['NN'] 				= 1;
            $this->attribute['DtTermino']['Label'] 				= 'Término Validade';
            $this->attribute['DtTermino']['Recognize'] 			= '7';

            $this->attribute['HoraAula_Troca_Id']['Type'] 		= 'number';
            $this->attribute['HoraAula_Troca_Id']['Length'] 	= 15;
            $this->attribute['HoraAula_Troca_Id']['Label'] 		= 'Substituição';

            $this->attribute['Replicar']['Type'] 				= 'varchar2';
            $this->attribute['Replicar']['Length'] 				= 3;
            $this->attribute['Replicar']['Label'] 				= 'Replicar';

            $this->attribute['CustoZero']['Type'] 				= 'varchar2';
            $this->attribute['CustoZero']['Length'] 			= 3;
            $this->attribute['CustoZero']['Label'] 				= 'Aula Paga ?';

            $this->attribute['Digitado']['Type'] 				= 'varchar2';
            $this->attribute['Digitado']['Length']	 			= 3;
            $this->attribute['Digitado']['Label'] 				=	'Digitado';

            $this->recognize['Recognize'] = "Horario_Id,AulaTi_Id,DivTurma_Id,WPessoa_Prof1_Id,WPessoa_Prof2_Id";
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['PLetivo_Id'] = 'HoraAula_qPLetivo';

            //Todas as Queries da classe
            $this->query['qDiaSemana'] 							= 'HoraAula_qDiaSemana';
            $this->query['qProfHoraAula'] 						= 'HoraAula_qProfHoraAula';
            $this->query['qHoraAulaGeral'] 						= 'HoraAula_qHoraAulaGeral';
            $this->query['qProfCursoConjunto'] 					= 'HoraAula_qProfCursoConjunto';
            $this->query['qQtdeLivroPontoPS'] 					= 'HoraAula_qQtdeLivroPontoPS';
            $this->query['qQtdeProfessor'] 						= 'HoraAula_qQtdeProfessor';
            $this->query['qDiscExistPos'] 						= 'HoraAula_qDiscExistPos';
            $this->query['qPreview'] 							= 'HoraAula_qPreview';
            $this->query['qId'] 								= 'HoraAula_qId';
            $this->query['qLivroPontoDetCount'] 				= 'horaaula_qLivroPontoDetCount';
            $this->query['qTurmaCurric'] 						= 'HoraAula_qTurmaCurric';
            $this->query['qDiscEncavalamentoTEsp'] 				= 'HoraAula_qDiscEncavalamentoTEsp';
            $this->query['qDiscEncavalamento'] 					= 'HoraAula_qDiscEncavalamento';
            $this->query['qProfessorHora'] 						= 'HoraAula_qProfessorHora';
            $this->query['qTurmaExiste'] 						= 'HoraAula_qTurmaExiste';
            $this->query['qQtdeProfHorario']		 			= 'HoraAula_qQtdeProfHorario';
            $this->query['qAgrupAula'] 							= 'HoraAula_qAgrupAula';
            $this->query['qDiferencaQtdeAulas'] 				= 'HoraAula_qDiferencaQtdeAulas';
            $this->query['qAulasTurmasE'] 						= 'HoraAula_qAulasTurmasE';
            $this->query['qHorario'] 							= 'HoraAula_qHorario';
            $this->query['qAdapTEsp'] 							= 'HoraAula_qAdapTEsp';
            $this->query['qLPreGeracao']		 				= 'HoraAula_qLPreGeracao';
            $this->query['qAulasCurr'] 							= 'HoraAula_qAulasCurr';
            $this->query['qTOXCDDivTurma'] 						= 'HoraAula_qTOXCDDivTurma';
            $this->query['qQtdTurma'] 							= 'HoraAula_qQtdTurma';
            $this->query['qQtdeAulaProf'] 						= 'HoraAula_qQtdeAulaProf';
            $this->query['qDivisaoDp'] 							= 'HoraAula_qDivisaoDp';
            $this->query['qProfessorPeriodo'] 					= 'HoraAula_qProfessorPeriodo';
            $this->query['qDPProf'] 							= 'HoraAula_qDPProf';
            $this->query['qGeral'] 								= 'HoraAula_qGeral';
            $this->query['qQtdTurmaOfe'] 						= 'HoraAula_qQtdTurmaOfe';
            $this->query['qAgrupLPresencaAuto'] 				= 'HoraAula_qAgrupLPresencaAuto';
            $this->query['qAulaProfCCDP'] 						= 'HoraAula_qAulaProfCCDP';
            $this->query['qTOXCDFilhos'] 						= 'HoraAula_qTOXCDFilhos';
            $this->query['qProfHoraTurma'] 						= 'HoraAula_qProfHoraTurma';
            $this->query['qTOXCDLPre'] 							= 'HoraAula_qTOXCDLPre';
            $this->query['qTOXCDTroca'] 						= 'HoraAula_qTOXCDTroca';
            $this->query['qHoraAulaEtiq'] 						= 'HoraAula_qHoraAulaEtiq';
            $this->query['qDPCurso'] 							= 'HoraAula_qDPCurso';
            $this->query['qQtdeProfUnico'] 						= 'HoraAula_qQtdeProfUnico';
            $this->query['qLivroPontoPS'] 						= 'HoraAula_qLivroPontoPS';
            $this->query['qCODINEP'] 							= 'HoraAula_qCODINEP';
            $this->query['qTOXCDInicio'] 						= 'HoraAula_qTOXCDInicio';
            $this->query['qQtdeLivroPonto'] 					= 'HoraAula_qQtdeLivroPonto';
            $this->query['qProfsCurso'] 						= 'HoraAula_qProfsCurso';
            $this->query['qGrupoProfessorClassificacao'] 		= 'HoraAula_qGrupoProfessorClassificacao';
            $this->query['qAulaEmConjunto'] 					= 'HoraAula_qAulaEmConjunto';
            $this->query['qTOXCD'] 								= 'HoraAula_qTOXCD';
            $this->query['qRetTurmaOfeEsp'] 					= 'HoraAula_qRetTurmaOfeEsp';
            $this->query['qAulaUnica'] 							= 'HoraAula_qAulaUnica';
            $this->query['qAdNoturno'] 							= 'HoraAula_qAdNoturno';
            $this->query['qTurmaEsp'] 							= 'HoraAula_qTurmaEsp';
            $this->query['qAulasDP'] 							= 'HoraAula_qAulasDP';
            $this->query['qSubstituicoes'] 						= 'HoraAula_qSubstituicoes';
            $this->query['qHoraInicio'] 						= 'HoraAula_qHoraInicio';
            $this->query['qHorarioEmConjunto'] 					= 'HoraAula_qHorarioEmConjunto';
            $this->query['qQtdeCursoProfessor'] 				= 'HoraAula_qQtdeCursoProfessor';
            $this->query['qAulaProfessor'] 						= 'HoraAula_qAulaProfessor';
            $this->query['qProfDisc'] 							= 'HoraAula_qProfDisc';
            $this->query['qDiferencaQtdeAulasPlanilha'] 		= 'HoraAula_qDiferencaQtdeAulasPlanilha';
            $this->query['qGrupoProfessorClassificacaoCountT'] 	= 'HoraAula_qGrupoProfessorClassificacaoCountT';
            $this->query['qTurmaSalas'] 						= 'HoraAula_qTurmaSalas';
            $this->query['qPLetivo'] 							= 'HoraAula_qPLetivo';
            $this->query['qAulaTOXCDSemana'] 					= 'HoraAula_qAulaTOXCDSemana';
            $this->query['qAulasCurso'] 						= 'HoraAula_qAulasCurso';
            $this->query['qProfDiaSemana'] 						= 'HoraAula_qProfDiaSemana';
            $this->query['qHoraAula'] 							= 'HoraAula_qHoraAula';
            $this->query['qCursoDiaSerie'] 						= 'HoraAula_qCursoDiaSerie';
            $this->query['qTurmas'] 							= 'HoraAula_qTurmas';
            $this->query['qProfDiaSemanaAbrev'] 				= 'HoraAula_qProfDiaSemanaAbrev';
            $this->query['qQtdCurso'] 							= 'HoraAula_qQtdCurso';
            $this->query['qTOXCDDivTurPos'] 					= 'HoraAula_qTOXCDDivTurPos';
            $this->query['qProfessor'] 							= 'HoraAula_qProfessor';
            $this->query['qLivroPonto'] 						= 'HoraAula_qLivroPonto';
            $this->query['qAlocProf'] 							= 'HoraAula_qAlocProf';
            $this->query['qProfHoraCurso'] 						= 'HoraAula_qProfHoraCurso';
            $this->query['qAluno'] 								= 'HoraAula_qAluno';
            $this->query['qDiscExist'] 							= 'HoraAula_qDiscExist';
            $this->query['qQtdAulaCCusto'] 						= 'HoraAula_qQtdAulaCCusto';
            $this->query['qackup'] 								= 'HoraAula_qHoraAulaGeral_Backup';
            $this->query['qProfCurso'] 							= 'HoraAula_qProfCurso';
            $this->query['qAlunoEncavalamento'] 				= 'HoraAula_qAlunoEncavalamento';
            $this->query['qIdTroca'] 							= 'HoraAula_qIdTroca';
            $this->query['qDPLicen'] 							= 'HoraAula_qDPLicen';
            $this->query['qInicio'] 							= 'HoraAula_qInicio';
            $this->query['qProfessores'] 						= 'HoraAula_qProfessores';
            $this->query['qProfAlunos'] 						= 'HoraAula_qProfAlunos';
            $this->query['qCursoResumo'] 						= 'HoraAula_qCursoResumo';
            $this->query['qEncavalamentoTEsp'] 					= 'HoraAula_qEncavalamentoTEsp';
            $this->query['qHorarios'] 							= 'HoraAula_qHorarios';
            $this->query['qDiscProf'] 							= 'HoraAula_qDiscProf';
            $this->query['qAulaProfCCusto'] 					= 'HoraAula_qAulaProfCCusto';
            $this->query['qTurma'] 								= 'HoraAula_qTurma';
            $this->query['qHoraProf'] 							= 'HoraAula_qHoraProf';
            $this->query['qTOXCDEsp'] 							= 'HoraAula_qTOXCDEsp';
            $this->query['qLivroPontoDet'] 						= 'HoraAula_qLivroPontoDet';
            $this->query['qTurmaPagas'] 						= 'HoraAula_qTurmaPagas';
            $this->query['qEncavalamento'] 						= 'HoraAula_qEncavalamento';
            $this->query['qTOXCDDel'] 							= 'HoraAula_qTOXCDDel';
            $this->query['qProfsTurmasE'] 						= 'HoraAula_qProfsTurmasE';
            $this->query['qProfEncavalamento'] 					= 'HoraAula_qProfEncavalamento';
            $this->query['qQtdAulaCCustoDP'] 					= 'HoraAula_qQtdAulaCCustoDP';
            $this->query['qReplicar'] 							= 'HoraAula_qReplicar';
            $this->query['qUHorario'] 							= 'HoraAula_qUHorario';
            $this->query['qQtdeDedProf'] 						= 'HoraAula_qQtdeDedProf';
            $this->query['qQtdDisc'] 							= 'HoraAula_qQtdDisc';
            $this->query['qProfQuadro'] 						= 'HoraAula_qProfQuadro';
            $this->query['qSalasUsadas'] 						= 'HoraAula_qSalasUsadas';
            $this->query['qUnica'] 								= 'HoraAula_qUnica';
            $this->query['qGrupoProfessorClassificacaoCount']	= 'HoraAula_qGrupoProfessorClassificacaoCount';

        } 
    
} 
?> 
    