<?php

    require_once ("../engine/Model.class.php");

    class Matric extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'Matric'; 


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
            $this->attribute['WPessoa_Id']['Recognize'] 		= '1';

            $this->attribute['TurmaOfe_Id']['Type'] 			= 'number';
            $this->attribute['TurmaOfe_Id']['Length'] 			= 15;
            $this->attribute['TurmaOfe_Id']['NN'] 				= 1;
            $this->attribute['TurmaOfe_Id']['Label'] 			= 'Turma Oferecida';
            $this->attribute['TurmaOfe_Id']['Recognize'] 		= '2';

            $this->attribute['State_Id']['Type'] 				= 'number';
            $this->attribute['State_Id']['Length'] 				= 15;
            $this->attribute['State_Id']['NN'] 					= 1;
            $this->attribute['State_Id']['Label'] 				= 'Estado';

            $this->attribute['Matric_Pai_Id']['Type'] 			= 'number';
            $this->attribute['Matric_Pai_Id']['Length'] 		= 15;
            $this->attribute['Matric_Pai_Id']['Label'] 			= 'Matrícula Pai';

            $this->attribute['MatricTi_Id']['Type'] 			= 'number';
            $this->attribute['MatricTi_Id']['Length'] 			= 15;
            $this->attribute['MatricTi_Id']['Label'] 			= 'Matrícula Tipo';
            $this->attribute['MatricTi_Id']['Recognize'] 		= '3';

            $this->attribute['CriProm_Id']['Type'] 				= 'number';
            $this->attribute['CriProm_Id']['Length'] 			= 15;
            $this->attribute['CriProm_Id']['Label'] 			= 'Critério de Promoção';

            $this->attribute['Data']['Type'] 					= 'date';
            $this->attribute['Data']['Label'] 					= 'Data da Matrícula';

            $this->attribute['FormaPag_Id']['Type'] 			= 'number';
            $this->attribute['FormaPag_Id']['Length'] 			= 15;
            $this->attribute['FormaPag_Id']['Label'] 			= 'Forma de Pagamento';

            $this->attribute['CarteirinhaVia']['Type'] 			= 'number';
            $this->attribute['CarteirinhaVia']['Length'] 		= 2;
            $this->attribute['CarteirinhaVia']['Label'] 		= 'Via de Impressão da Carteirinha';

            $this->attribute['Rematricula']['Type'] 			= 'date';
            $this->attribute['Rematricula']['Label'] 			= 'Rematrícula';

            $this->attribute['DtReserva']['Type'] 				= 'date';
            $this->attribute['DtReserva']['Label'] 				= 'Reserva de Vaga';

            $this->attribute['Pagto_Id']['Type'] 				= 'number';
            $this->attribute['Pagto_Id']['Length'] 				= 15;
            $this->attribute['Pagto_Id']['Label'] 				= 'Forma de Pagamento';

            $this->attribute['DtState']['Type'] 				= 'date';
            $this->attribute['DtState']['Label'] 				= 'data';

            $this->attribute['WPessoa_Contrat_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Contrat_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Contrat_Id']['Label'] 	= 'Contratante';

            $this->attribute['WPessoa_Resp_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Resp_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Resp_Id']['Label'] 		= 'Responsável';

            $this->attribute['ImpReserva']['Type'] 				= 'varchar2';
            $this->attribute['ImpReserva']['Length'] 			= 3;
            $this->attribute['ImpReserva']['Label'] 			= 'Impressão da Reserva de Vaga';

            $this->attribute['Atualizar']['Type'] 				= 'date';
            $this->attribute['Atualizar']['Label'] 				= 'Atualizar';

            $this->attribute['IP']['Type'] 						= 'varchar2';
            $this->attribute['IP']['Length'] 					= 19;
            $this->attribute['IP']['Label'] 					= 'IP';

            $this->attribute['Matric_Ante_Id']['Type'] 			= 'number';
            $this->attribute['Matric_Ante_Id']['Length'] 		= 15;
            $this->attribute['Matric_Ante_Id']['Label'] 		= 'Matrícula Anterior';

            $this->attribute['PagamentoIsento']['Type'] 		= 'varchar2';
            $this->attribute['PagamentoIsento']['Length'] 		= 3;
            $this->attribute['PagamentoIsento']['Label'] 		= 'Matrícula Isenta de Pagamento';

            $this->recognize['Recognize']	= 'WPessoa_id, TurmaOfe_Id, MatricTi_Id';
            $this->recognize['State_Id']	= 'State_Id';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Aluno_Id'] 			= 'Matric_qMatriculaVet';
            $this->calculate['AlunoVest_Id'] 		= 'Matric_qMatriculaVest';
            $this->calculate['WPessoaSel_Id'] 		= 'Matric_qTurmaOfe';
            $this->calculate['FichaHisto_Id'] 		= 'Matric_qFichaHisto';
            $this->calculate['GradAlu_Id'] 			= 'Matric_qGradAlu';
            $this->calculate['AtivComp_Id'] 		= 'Matric_qAtivComp';
            $this->calculate['Certificado_Id'] 		= 'Matric_qCertificado';
            $this->calculate['Colacao_Id'] 			= 'Matric_qColacao';
            $this->calculate['Curso_Id'] 			= 'Matric_qAlunoCurso';
            $this->calculate['Curr_Id'] 			= 'Matric_qAlunoCurr';
            $this->calculate['MatricAllState_Id'] 	= 'Matric_qWPessoaAllState';
            $this->calculate['Origem_Id'] 			= 'Matric_qAlunoOrigem';
            $this->calculate['Destino_Id'] 			= 'Matric_qAlunoDestino';
            $this->calculate['Pos_Id'] 				= 'Matric_qAlunoPos';
            $this->calculate['MatricBol_Id'] 		= 'Matric_qMatricBol';
            $this->calculate['WPessoaPLetivo'] 		= 'Matric_qWPessoaPLetivo';

            //Todas as Queries da classe
            $this->query['qPessoaCampus'] 				= 'Matric_qPessoaCampus';
            $this->query['qAlunosLicen'] 				= 'Matric_qAlunosLicen';
            $this->query['qVeteranoPROUNISit'] 			= 'Matric_qVeteranoPROUNISit';
            $this->query['qMatricAnterior'] 			= 'Matric_qMatricAnterior';
            $this->query['qPessoaLicen'] 				= 'Matric_qPessoaLicen';
            $this->query['qFichaPLetivo'] 				= 'Matric_qFichaPLetivo';
            $this->query['qHiState'] 					= 'Matric_qHiState';
            $this->query['qSituacao'] 					= 'Matric_qSituacao';
            $this->query['qWPessoaProvao'] 				= 'Matric_qWPessoaProvao';
            $this->query['qQtdStatePerSexo'] 			= 'Matric_qQtdStatePerSexo';
            $this->query['qReservada'] 					= 'Matric_qReservada';
            $this->query['qMatricExiste'] 				= 'Matric_qMatricExiste';
            $this->query['qCountState'] 				= 'Matric_qCountState';
            $this->query['qWPessoaRemat'] 				= 'Matric_qWPessoaRemat';
            $this->query['qAlunosSemFies'] 				= 'Matric_qAlunosSemFies';
            $this->query['qNaoReservada'] 				= 'Matric_qNaoReservada';
            $this->query['qGeraVestibulando'] 			= 'Matric_qGeraVestibulando';
            $this->query['qAlunosCursos'] 				= 'Matric_qAlunosCursos';
            $this->query['qTodos'] 						= 'Matric_qTodos';
            $this->query['qAlunoCurr'] 					= 'Matric_qAlunoCurr';
            $this->query['qWPessoaAll'] 				= 'Matric_qWPessoaAll';
            $this->query['qUltimaCurr'] 				= 'Matric_qUltimaCurr';
            $this->query['qCoordPr'] 					= 'Matric_qCoordPr';
            $this->query['qQtdeDtMatric'] 				= 'Matric_qQtdeDtMatric';
            $this->query['qVeteranoGer'] 				= 'Matric_qVeteranoGer';
            $this->query['qCarteirinha'] 				= 'Matric_qCarteirinha';
            $this->query['qSituacaoCurso'] 				= 'Matric_qSituacaoCurso';
            $this->query['qSoLicenPessoa'] 				= 'Matric_qSoLicenPessoa';
            $this->query['qLicPendente'] 				= 'Matric_qLicPendente';
            $this->query['qWPessoaCenso'] 				= 'Matric_qWPessoaCenso';
            $this->query['qMatriculado'] 				= 'Matric_qMatriculado';
            $this->query['qAlunoSelecao'] 				= 'Matric_qAlunoSelecao';
            $this->query['qCartPos'] 					= 'Matric_qCartPos';
            $this->query['qOrgArquivo'] 				= 'Matric_qOrgArquivo';
            $this->query['qCursoSerie'] 				= 'Matric_qCursoSerie';
            $this->query['qIngressantes'] 				= 'Matric_qIngressantes';
            $this->query['qQtdeAlunosBloco'] 			= 'Matric_qQtdeAlunosBloco';
            $this->query['qRematriculado'] 				= 'Matric_qRematriculado';
            $this->query['qGradeAluno'] 				= 'Matric_qGradeAluno';
            $this->query['qData'] 						= 'Matric_qData';
            $this->query['qReserva'] 					= 'Matric_qReserva';
            $this->query['qWPessoa'] 					= 'Matric_qWPessoa';
            $this->query['qAlunoTOXCD'] 				= 'Matric_qAlunoTOXCD';
            $this->query['qListaoProUni'] 				= 'Matric_qListaoProUni';
            $this->query['qCarteirinhaMatriculado'] 	= 'Matric_qCarteirinhaMatriculado';
            $this->query['qCursoProuni'] 				= 'Matric_qCursoProuni';
            $this->query['qQtdeVeterano'] 				= 'Matric_qQtdeVeterano';
            $this->query['qWPessoaRet'] 				= 'Matric_qWPessoaRet';
            $this->query['qWPleitoIdade'] 				= 'Matric_qWPleitoIdade';
            $this->query['qCountVest'] 					= 'Matric_qCountVest';
            $this->query['qRetCurso'] 					= 'Matric_qRetCurso';
            $this->query['qPLetivo'] 					= 'Matric_qPLetivo';
            $this->query['qWPleitoGerada'] 				= 'Matric_qWPleitoGerada';
            $this->query['qCursoTrienal'] 				= 'Matric_qCursoTrienal';
            $this->query['qMatricTurma'] 				= 'Matric_qMatricTurma';
            $this->query['qAlunos'] 					= 'Matric_qAlunos';
            $this->query['qMatricPai'] 					= 'Matric_qMatricPai';
            $this->query['qPLetColacao'] 				= 'Matric_qPLetColacao';
            $this->query['qEVestibulando'] 				= 'Matric_qEVestibulando';
            $this->query['qAnoConclusao'] 				= 'Matric_qAnoConclusao';
            $this->query['qCampus'] 					= 'Matric_qCampus';
            $this->query['qAlunosLicenGrade'] 			= 'Matric_qAlunosLicenGrade';
            $this->query['qDispAlunoTurmaLato'] 		= 'Matric_qDispAlunoTurmaLato';
            $this->query['qId'] 						= 'Matric_qId';
            $this->query['qGradAlu'] 					= 'Matric_qGradAlu';
            $this->query['qEtqMatriculado'] 			= 'Matric_qEtqMatriculado';
            $this->query['qImpReservaVaga'] 			= 'Matric_qImpReservaVaga';
            $this->query['qEstagioAluno'] 				= 'Matric_qEstagioAluno';
            $this->query['qQtdeVestibulando'] 			= 'Matric_qQtdeVestibulando';
            $this->query['qPLetivoLato'] 				= 'Matric_qPLetivoLato';
            $this->query['qExecGeral'] 					= 'Matric_qExecGeral';
            $this->query['qAlunoPos'] 					= 'Matric_qAlunoPos';
            $this->query['qEtqPosGrad'] 				= 'Matric_qEtqPosGrad';
            $this->query['qVestMatriculado'] 			= 'Matric_qVestMatriculado';
            $this->query['qFichaHisto'] 				= 'Matric_qFichaHisto';
            $this->query['qCAAM'] 						= 'Matric_qCAAM';
            $this->query['qAluno'] 						= 'Matric_qAluno';
            $this->query['qReqPosGradTodos'] 			= 'Matric_qReqPosGradTodos';
            $this->query['qProvaoTurmaOfe'] 			= 'Matric_qProvaoTurmaOfe';
            $this->query['qPrevisao'] 					= 'Matric_qPrevisao';
            $this->query['qQtdeAlunosPos'] 				= 'Matric_qQtdeAlunosPos';
            $this->query['qAlunoOrigem'] 				= 'Matric_qAlunoOrigem';
            $this->query['qSemFormIngCad'] 				= 'Matric_qSemFormIngCad';
            $this->query['qQtdAluCenso'] 				= 'Matric_qQtdAluCenso';
            $this->query['qEtqCursoPeriodo'] 			= 'Matric_qEtqCursoPeriodo';
            $this->query['qVeteranoPROUNI'] 			= 'Matric_qVeteranoPROUNI';
            $this->query['qTitMonog'] 					= 'Matric_qTitMonog';
            $this->query['qQtdCurso'] 					= 'Matric_qQtdCurso';
            $this->query['qWPessoaCurso'] 				= 'Matric_qWPessoaCurso';
            $this->query['qQtdCursoSerie'] 				= 'Matric_qQtdCursoSerie';
            $this->query['qCursoProuniCurso'] 			= 'Matric_qCursoProuniCurso';
            $this->query['qConcluido'] 					= 'Matric_qConcluido';
            $this->query['qAprovado'] 					= 'Matric_qAprovado';
            $this->query['qNaoMatrProxPLetivoCurso'] 	= 'Matric_qNaoMatrProxPLetivoCurso';
            $this->query['qAlunoSituacao'] 				= 'Matric_qAlunoSituacao';
            $this->query['qUltimaCurso'] 				= 'Matric_qUltimaCurso';
            $this->query['qQtdPeriodoSexo'] 			= 'Matric_qQtdPeriodoSexo';
            $this->query['qWPessoaAllState'] 			= 'Matric_qWPessoaAllState';
            $this->query['qCertificado'] 				= 'Matric_qCertificado';
            $this->query['qProUniTransfTur'] 			= 'Matric_qProUniTransfTur';
            $this->query['qMatriculaVet'] 				= 'Matric_qMatriculaVet';
            $this->query['qQtdeDtState'] 				= 'Matric_qQtdeDtState';
            $this->query['qStateHi'] 					= 'Matric_qStateHi';
            $this->query['qGradMatriculado'] 			= 'Matric_qGradMatriculado';
            $this->query['qVeteranoGerCamp'] 			= 'Matric_qVeteranoGerCamp';
            $this->query['qGeracao'] 					= 'Matric_qGeracao';
            $this->query['qIdPadrao'] 					= 'Matric_qIdPadrao';
            $this->query['qWPessoaPLetivosId'] 			= 'Matric_qWPessoaPLetivos_Id';
            $this->query['qQtdeAlunosLic'] 				= 'Matric_qQtdeAlunosLic';
            $this->query['qIngressante'] 				= 'Matric_qIngressante';
            $this->query['qTurmaOfeState'] 				= 'Matric_qTurmaOfeState';
            $this->query['qQtdePROUNI']					= 'Matric_qQtdePROUNI';
            $this->query['qVestibulandoPROUNIUSJT'] 	= 'Matric_qVestibulandoPROUNIUSJT';
            $this->query['qPrevisaoBolsasIniciante'] 	= 'Matric_qPrevisaoBolsasIniciante';
            $this->query['qUltimoAnoDp'] 				= 'Matric_qUltimoAnoDp';
            $this->query['qAlunoPLetivo'] 				= 'Matric_qAlunoPLetivo';
            $this->query['qEtqFormado'] 				= 'Matric_qEtqFormado';
            $this->query['qAlunoCurso'] 				= 'Matric_qAlunoCurso';
            $this->query['qMatriculados'] 				= 'Matric_qMatriculados';
            $this->query['qTCobPessoa'] 				= 'Matric_qTCobPessoa';
            $this->query['qMatricBol'] 					= 'Matric_qMatricBol';
            $this->query['qWPleitoCurr'] 				= 'Matric_qWPleitoCurr';
            $this->query['qAuditoria'] 					= 'Matric_qAuditoria';
            $this->query['qQtdePrevisaoDP'] 			= 'Matric_qQtdePrevisaoDP';
            $this->query['qAlunosEvasao'] 				= 'Matric_qAlunosEvasao';
            $this->query['qQtdeVestibulandoPROUNI'] 	= 'Matric_qQtdeVestibulandoPROUNI';
            $this->query['qLicenciatura'] 				= 'Matric_qLicenciatura';
            $this->query['qPrimeira'] 					= 'Matric_qPrimeira';
            $this->query['qIdPai'] 						= 'Matric_qIdPai';
            $this->query['qIngState'] 					= 'Matric_qIngState';
            $this->query['qCountMatric'] 				= 'Matric_qCountMatric';
            $this->query['qMelhoresAlunos'] 			= 'Matric_qMelhoresAlunos';
            $this->query['qPLetivoState'] 				= 'Matric_qPLetivoState';
            $this->query['qCenso'] 						= 'Matric_qCenso';
            $this->query['qGerada'] 					= 'Matric_qGerada';
            $this->query['qQtdeDtMatric2'] 				= 'Matric_qQtdeDtMatric2';
            $this->query['qQtdUltimoAno'] 				= 'Matric_qQtdUltimoAno';
            $this->query['qDiplomas'] 					= 'Matric_qDiplomas';
            $this->query['qEtqUltimo'] 					= 'Matric_qEtqUltimo';
            $this->query['qAlocacao'] 					= 'Matric_qAlocacao';
            $this->query['qLicTurma'] 					= 'Matric_qLicTurma';
            $this->query['qWPleitoCurrOld'] 			= 'Matric_qWPleitoCurrOld';
            $this->query['qMatriculaVest'] 				= 'Matric_qMatriculaVest';
            $this->query['qRetUltima'] 					= 'Matric_qRetUltima';
            $this->query['qAlunoCenso'] 				= 'Matric_qAlunoCenso';
            $this->query['qCursoPeriodo'] 				= 'Matric_qCursoPeriodo';
            $this->query['qExiste'] 					= 'Matric_qExiste';
            $this->query['qAlunoLato'] 					= 'Matric_qAlunoLato';
            $this->query['qHi'] 						= 'Matric_qHi';
            $this->query['qDisposicaoAlunoTurma'] 		= 'Matric_qDisposicaoAlunoTurma';
            $this->query['qPromocao'] 					= 'Matric_qPromocao';
            $this->query['qRematricula'] 				= 'Matric_qRematricula';
            $this->query['qVeteranoConf'] 				= 'Matric_qVeteranoConf';
            $this->query['qConsultaCountNome'] 			= 'Matric_qConsultaCountNome';
            $this->query['qCurrSerie'] 					= 'Matric_qCurrSerie';
            $this->query['qQtdeVestibulandoPROUNISJ'] 	= 'Matric_qQtdeVestibulandoPROUNISJ';
            $this->query['qWPleitoReservada'] 			= 'Matric_qWPleitoReservada';
            $this->query['qCountEstudando'] 			= 'Matric_qCountEstudando';
            $this->query['qConsultaNome'] 				= 'Matric_qConsultaNome';
            $this->query['qWPleito'] 					= 'Matric_qWPleito';
            $this->query['qRetUltimaState'] 			= 'Matric_qRetUltimaState';
            $this->query['qTurmaOfe'] 					= 'Matric_qTurmaOfe';
            $this->query['qDiplProc'] 					= 'Matric_qDiplProc';
            $this->query['qVestibulandoPROUNI'] 		= 'Matric_qVestibulandoPROUNI';
            $this->query['qAlunosIdadeDebito'] 			= 'Matric_qAlunosIdadeDebito';
            $this->query['qPLetivoAll'] 				= 'Matric_qPLetivoAll';
            $this->query['qDisposicaoCurso'] 			= 'Matric_qDisposicaoCurso';
            $this->query['qWPleitoPUSJ'] 				= 'Matric_qWPleitoPUSJ';
            $this->query['qAlunoCAAM'] 					= 'Matric_qAlunoCAAM';
            $this->query['qAlunoMatu'] 					= 'Matric_qAlunoMatu';
            $this->query['qAtivComp'] 					= 'Matric_qAtivComp';
            $this->query['qAlunosPrevisaoDP'] 			= 'Matric_qAlunosPrevisaoDP';
            $this->query['qVeteranoGerInt'] 			= 'Matric_qVeteranoGerInt';
            $this->query['qPosPLetivoTurma'] 			= 'Matric_qPosPLetivoTurma';
            $this->query['qPLetivoLite'] 				= 'Matric_qPLetivoLite';
            $this->query['qCursoColacao'] 				= 'Matric_qCursoColacao';
            $this->query['qTrancamento'] 				= 'Matric_qTrancamento';
            $this->query['qPosMatriculado'] 			= 'Matric_qPosMatriculado';
            $this->query['qEstagio'] 					= 'Matric_qEstagio';
            $this->query['qPrevisaoDP'] 				= 'Matric_qPrevisaoDP';
            $this->query['qWPessoaId'] 					= 'Matric_qWPessoa_Id';
            $this->query['qQtdPorIdade'] 				= 'Matric_qQtdPorIdade';
            $this->query['qGeraReservaVaga'] 			= 'Matric_qGeraReservaVaga';
            $this->query['qAltTurmaHi'] 				= 'Matric_qAltTurmaHi';
            $this->query['qAlunoDestino'] 				= 'Matric_qAlunoDestino';
            $this->query['qWPessoaAnoUnica'] 			= 'Matric_qWPessoaAnoUnica';
            $this->query['qWPessoaPLetivo'] 			= 'Matric_qWPessoaPLetivo';
            $this->query['qColacao'] 					= 'Matric_qColacao';
            $this->query['qInfoPes'] 					= 'Matric_qInfoPes';
            $this->query['qPrimeiraMatric'] 			= 'Matric_qPrimeiraMatric';
            $this->query['qMatuMatriculado'] 			= 'Matric_qMatuMatriculado';
            $this->query['qWPleitoPROUNI'] 				= 'Matric_qWPleitoPROUNI';
            $this->query['qBolsas'] 					= 'Matric_qBolsas';
            $this->query['qWPessoaAno'] 				= 'Matric_qWPessoaAno';
            $this->query['qVestMatriculadoCurso'] 		= 'Matric_qVestMatriculadoCurso';
            $this->query['qPLetivoIdade'] 				= 'Matric_qPLetivoIdade';
            $this->query['qTotIngressantes'] 			= 'Matric_qTotIngressantes';
            $this->query['qWPessoaUltima'] 				= 'Matric_qWPessoaUltima';
            $this->query['qEtqCursoPos'] 				= 'Matric_qEtqCursoPos';
            $this->query['qTrancamentoProuni'] 			= 'Matric_qTrancamentoProuni';
            $this->query['qTurmaOfeTranc'] 				= 'Matric_qTurmaOfeTranc';
            $this->query['qAlunoIngressante'] 			= 'Matric_qAlunoIngressante';
            $this->query['qHiStateFuncProcedure'] 		= 'Matric_qHiStateFuncProcedure';
            $this->query['qAlunoLP'] 					= 'Matric_qAlunoLP';
            $this->query['qGeraPROUNI'] 				= 'Matric_qGeraPROUNI';
            $this->query['qEtqPosGradFormado'] 			= 'Matric_qEtqPosGradFormado';
            $this->query['qMatriculaData'] 				= 'Matric_qMatriculaData';
            $this->query['qReqVeterano'] 				= 'Matric_qReqVeterano';
            $this->query['qAlunosMatriculados'] 		= 'Matric_qAlunosMatriculados';
			$this->query['qAlunoUltima']				= 'Matric_qAlunoUltima';
                            
        }
        
        
        public function GetStateMatricInfo($Matric_Id,$param="",$p_Options="")
        {

        	$dbData = new DbData($this->db);
        	
        	if($param["class"] != "") $param['class'] .= " dataGrid"; else $param["class"] = "dataGrid";
        	
        	$param["cellspacing"] = 1;
        	
        	
        	$dbData->Get($this->Query("qIdPadrao",array("p_Matric_Id"=>$Matric_Id)));
        		
        	$row = $dbData->Row();
        	
        	
        	$html  = $this->Table(array($param)).$this->Tr();
        	$html .= $this->Td(array("class"=>"pequeno")) . 'Ano: <strong>' . $row[PLETIVO] . '</strong>'.$this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . 'Turma: <strong>'  . $row[TURMA] . '</strong>'.$this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . 'Dt.Matric: <strong>' .  $row[DATA] . '</strong>'.$this->CloseTd();
        	$html .= $this->Td(array("class"=>"grande")) . 'Curso: <strong>' . $row[CURSO_NOME] . '</strong>'.$this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . 'Situação: <strong>' . $row[SITUACAO] . '</strong>'.$this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . 'Unid.: <strong>' . $row[CAMPUS_RECOGNIZE] . '</strong>'.$this->CloseTd();
        	if (!empty($p_Options))
        	{        	 
        		$html .= $this->Td(array("class"=>"pequeno")) . $this->Link('<img src=../images/papel.png>',array("class"=>"openColorBox","href"=>"../pub/autdoc_iatestado.php?p_Matric_Id="._UrlEncrypt($row[ID]))) .$this->CloseTd();
        	}        	 
        	$html .= $this->CloseTr().$this->CloseTable();
        	
        	return $html;
        		
        }
        

		public function GetStateMatriculas($WPessoa_Id,$trazDP=TRUE)
		{
			
			$dbData = new DbData($this->db);
			
			$dbData->Get($this->Query('qWPessoaPLetivo',array("p_WPessoa_Id"=>$WPessoa_Id,"p_O_Data"=>date('d/m/Y'))));
			
			$html = $this->Table(array("class"=>"dataGrid","cellspacing"=>"1"));
			$html .= $this->Th('Ano',array());
			$html .= $this->Th('Turma',array());
			$html .= $this->Th('Data Matrícula',array());
			$html .= $this->Th('Curso',array());
			$html .= $this->Th('Situação',array());
			$html .= $this->Th('Unidade',array());

			while ($row = $dbData->Row())
			{
				if (($row[MATRICTI_ID] == 8300000000002 && $trazDP) || $row[MATRICTI_ID] == 8300000000001)
				{
					$html .= $this->Tr(array());
					$html .= $this->Td(array("align"=>"center","class"=>"tbDetail","tdDetails"=>"dsad sad sad sad asd as")) . $row[PLETIVO] . $this->CloseTd(); 
					$html .= $this->Td(array()) . $row[TURMA] . $this->CloseTd();
					$html .= $this->Td(array("align"=>"center")) . $row[DATA] . $this->CloseTd();
					$html .= $this->Td(array()) . $row[CURSOABREV] . $this->CloseTd();
					$html .= $this->Td(array()) . $row[SITUACAO] . $this->CloseTd();
					$html .= $this->Td(array()) . $row[CAMPUS_RECOGNIZE] . $this->CloseTd();
					$html .= $this->CloseTr();
				}
			}
			$html .= $this->CloseTable();
			
			
			
			return $html ;
			
			
		}        
        
        
		public function GetCurso($Matric_Id)
		{
			 
			if(!is_numeric($Matric_Id)) return false;
			 
			require_once('../model/TurmaOfe.class.php');
			require_once('../model/CurrOfe.class.php');
			require_once('../model/Curr.class.php');
			
			$turmaOfe = new TurmaOfe($this->db);
			$currOfe = new CurrOfe($this->db);
			$curr = new Curr($this->db);
				
			$aAux = $this->GetIdInfo($Matric_Id);
				
			if($aAux[MATRICTI_ID] == 8300000000002 && $aAux[MATRIC_PAI_ID] != '')
			{
				$aAux = $this->GetIdInfo($aAux[MATRIC_PAI_ID]);				
			} 
			 
			$aAux = $turmaOfe->GetIdInfo($aAux["TURMAOFE_ID"]);
			 
			$aAux = $currOfe->GetIdInfo($aAux["CURROFE_ID"]);			
		
			return $curr->Recognize($aAux["CURR_ID"],"RecCurso");
		}		
		
		
		public function GetAtestado($Matric_Id)
		{
			
			require_once ('../model/WPessoa.class.php');
			require_once ('../model/TurmaOfe.class.php');
			require_once ('../model/CurrOfe.class.php');
			require_once ('../model/RecCurso.class.php');
			require_once ('../model/Curr.class.php');
			
			
			$dbData 	= new DbData($this->db);
			$dbDta		= new DbData($this->db);
			$wpessoa 	= new WPessoa($this->db);
			$turmaofe 	= new TurmaOfe($this->db);
			$currofe 	= new CurrOfe($this->db);
			$reccurso 	= new RecCurso($this->db);
			$curr 		= new Curr($this->db);
			
			$arMatric 		= $this->GetIdInfo($Matric_Id);
			$vNivelCurso 	= $this->GetCursoNivel($Matric_Id);
			
					
			$arTurmaOfe 	= $turmaofe->GetIdInfo($arMatric[TURMAOFE_ID]);
			$arCurrOfe 		= $currofe->GetIdInfo($arTurmaOfe[CURROFE_ID]);			
			$arCurr			= $curr->GetIdInfo($arCurrOfe[CURR_ID]);
			
			$arPessoa = $wpessoa->GetIdInfo($arMatric["WPESSOA_ID"]);
			
			if ($arPessoa[SEXO_ID] == 500000000001)
			{
				$arReturn['SEXO'] = 'a';
			}
			else
			{
				$arReturn['SEXO'] = 'o';
			}
			
			$vAux = '<b>';
			
			
			if ($vNivelCurso == 6200000000001 || $vNivelCurso == 6200000000012 || $vNivelCurso == 6200000000010)
			{
				
				$arRecCurso		= $reccurso->GetIdInfo($arCurrOfe["RECCURSO_ID"]);
				if (strtoupper(substr($arRecCurso["NOMEATESTADO"],0,5)) != 'CURSO')
				{
					$vAux = 'do curso de <b class=uppercase>';
				}
				else 
				{
					$vAux = 'do <b class=uppercase>'; 
				}
				
				$aReconhecimento = $reccurso->GetReconhecimentoCurso($arCurrOfe["RECCURSO_ID"]);
							
				if (!is_array($arRecCurso))
				{
					$arRecCurso["NOMEATESTADO"] 	= $arCurr["CURSO_NOME"];
					$aReconhecimento["PORTARIA"]	= $arCurr["CURSO_NOME"] . "<br>PORTARIA Nº 264, DE 04-05-1989, D.O.U. DE 05-05-1989";
				}
			}
			
			if ($vNivelCurso == 6200000000015)
			{				
				$dbDta->Get("select curso.nome as nome from matric,turmaofe,currofe,curr,curso where curso.id = curr.curso_id and curr.id = currofe.curr_id and currofe.id = turmaofe.currofe_id and turmaofe.id = matric.turmaofe_id and matric.id ='".$Matric_Id."'");
				$aCurso = $dbDta->Row();

				$aReconhecimento["PORTARIA"] 	= $aCurso["NOME"] . "<br>Autorizado pelo Conselho de Ensino Pesquisa e Extensão<br>CEPE nº 08/2014, de 13-08-2014";
				$aReconhecimento["CURSO"]		= $aCurso["NOME"];
			}

			$arReturn["PERIODICIDADE"]	= 'anos';
			if ($arCurr["PLETIVO_INICIAL_ID"] == 7200000000100)
			{
				$arReturn["PERIODICIDADE"]	= 'semestres';
			}
			
			$dbData->Get("select Curr_gnRetDuracao('$arCurrOfe[CURR_ID]') as Duracao from dual");
			$aDuracao = $dbData->Row();
						
			
			$arReturn["WPESSOA_ID"]		= $arMatric["WPESSOA_ID"];
			$arReturn["NOME"] 			= $arMatric["WPESSOA_NOME"];
			$arReturn["TOPOCURSO"]		= $arRecCurso["NOMEATESTADO"];
			$arReturn["CURSO"]			= $vAux . $aReconhecimento["CURSO"];
			$arReturn["RA"]				= $arPessoa["CODIGO"];
			$arReturn["SERIE"]			= substr($arMatric["TURMAOFE_NOME"],0,1);
			$arReturn["CODTURMA"]		= substr(reset(explode(' ',$arMatric["TURMAOFE_NOME"])),1);
			$arReturn["UNIDADE"]		= $arCurrOfe["CAMPUS_NOME"];
			$arReturn["PERIODO"]		= strtolower($arCurrOfe["PERIODO_NOME"]);
			$arReturn["DURACAO"]		= $aDuracao["DURACAO"];
			$arReturn["PORTARIA"]		= $aReconhecimento["PORTARIA"];
			$arReturn["STATE_ID"]		= $arMatric["STATE_ID"];
			$arReturn["ID"]				= $arMatric["ID"];	
			$arReturn["FORMACAOESP"]	= $curr->GetFormacaoEspecifica($arCurrOfe[CURR_ID]);
			$arReturn["ANO"]			= $arCurrOfe["PLETIVO_NOME"];
			

			return $arReturn;
						
		}
		
		
		function GetCursoNivel($Matric_Id,$vTexto=FALSE)
		{
			require_once ('../model/TurmaOfe.class.php');
			require_once ('../model/CurrOfe.class.php');
			require_once ('../model/Curr.class.php');
			require_once ('../model/Curso.class.php');
			
			$turmaofe	= new TurmaOfe($this->db);
			$currofe	= new CurrOfe($this->db);
			$curr 		= new Curr($this->db);
			$curso		= new Curso($this->db);
			
			$arMatric 	= $this->GetIdInfo($Matric_Id);
			$arTurmaOfe = $turmaofe->GetIdInfo($arMatric["TURMAOFE_ID"]);
			$arCurrOfe 	= $currofe->GetIdInfo($arTurmaOfe["CURROFE_ID"]);
			$arCurr   	= $curr->GetIdInfo($arCurrOfe["CURR_ID"]);
			$arCurso 	= $curso->GetIdInfo($arCurr["CURSO_ID"]); 
			
			if ($vTexto)
			{
				return $arCurso["CURSONIVEL_NOME"];
			}
			else
			{
				return $arCurso["CURSONIVEL_ID"];
			}		
				
		}
		
		//Retorna um array com as matrículas do aluno em determinado Período Letivo.
		function GetStateMatricCorrente($WPessoa_Id,$PLetivo_Id,$MatricTi_Id,$State_Id)
		{
			$dbData = new DbData($this->db);
			
			$aReturn = array();
			$dbData->Get($this->Query("qAlunoPLetivo",array("p_WPessoa_Id"=>$WPessoa_Id,"p_PLetivo_Id"=>$PLetivo_Id,"p_State_Id"=>$State_Id)));
			while ($row = $dbData->Row())
			{
				if ($row["MATRICTI_ID"] == $MatricTi_Id)
				{
					$aReturn[] = $row["ID"];
				}
			}
			
			return $aReturn;
		}
		
        
	}
?>