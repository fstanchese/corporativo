<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class TurmaOfe extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'TurmaOfe'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 5000;


            $this->attribute['CurrOfe_Id']['Type'] 			= 'number';
            $this->attribute['CurrOfe_Id']['Length'] 		= 15;
            $this->attribute['CurrOfe_Id']['Label'] 		= 'Oferecimento de Currнculo';

            $this->attribute['Turma_Id']['Type'] 			= 'number';
            $this->attribute['Turma_Id']['Length'] 			= 25;
            $this->attribute['Turma_Id']['NN'] 				= 1;
            $this->attribute['Turma_Id']['Label'] 			= 'Turma';

            $this->attribute['Sala_Id']['Type'] 			= 'number';
            $this->attribute['Sala_Id']['Length'] 			= 15;
            $this->attribute['Sala_Id']['Label'] 			= 'Sala';

            $this->attribute['DiscEsp_Id']['Type'] 			= 'number';
            $this->attribute['DiscEsp_Id']['Length'] 		= 15;
            $this->attribute['DiscEsp_Id']['Label'] 		= 'Disciplina Especial';

            $this->attribute['WPessoa_Rep_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Rep_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Rep_Id']['Label'] 	= 'Nome';

            $this->attribute['WPessoa_Sup1_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_Sup1_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Sup1_Id']['Label'] 	= 'Nome';

            $this->attribute['WPessoa_Sup2_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_Sup2_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Sup2_Id']['Label'] 	= 'Nome';

            $this->attribute['DtEntrega_DocSAA']['Type'] 	= 'date';
            $this->attribute['DtEntrega_DocSAA']['Null'] 	= '';
            $this->attribute['DtEntrega_DocSAA']['Label'] 	= 'Data de Entrega Turma';

            $this->attribute['Reprovado']['Type'] 			= 'varchar2';
            $this->attribute['Reprovado']['Length'] 		= 3;
            $this->attribute['Reprovado']['Label'] 			= 'Reprovado ?';

            $this->recognize['Recognize']	= 'CurrOfe_Id, TurmaOfe_Id, Sala_Id';
            $this->recognize['RecTurma']	= 'Turma_Id';
            $this->recognize['RecSala']		= 'Sala_Id';
            
            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Pesquisa_Id'] 		= 'TurmaOfe_qPesquisa';
            $this->calculate['Curso_Id'] 			= 'TurmaOfe_qCurso';
            $this->calculate['Selecao_Id'] 			= 'TurmaOfe_qSelecao';
            $this->calculate['Colacao_Id'] 			= 'TurmaOfe_qColacao';
            $this->calculate['Formandos_Id'] 		= 'TurmaOfe_qUltimoAno';
            $this->calculate['CursoFacul_Id'] 		= 'TurmaOfe_qCursoFacul';
            $this->calculate['TurmaRel_Id'] 		= 'TurmaOfe_qCurrOfeIn';
            $this->calculate['TurmaSel_Id'] 		= 'TurmaOfe_qPLetivo';
            $this->calculate['TurmaEsp_Id'] 		= 'TurmaOfe_qEspecial';
            $this->calculate['TurmaSelOrigem_Id'] 	= 'TurmaOfe_qPLetivoSemDiscEsp';
            $this->calculate['TurmaSelDestino_Id'] 	= 'TurmaOfe_qPLetivoCurrOfe';
            $this->calculate['TurmaCurr_Id'] 		= 'TurmaOfe_qCurr';
            $this->calculate['TurmaTransf_Id'] 		= 'TurmaOfe_qTransf';
            $this->calculate['CurrOfeId'] 			= 'TurmaOfe_qCurrOfeIn';


            //Recognizes
            $this->recognize['Recognize'] 	= 'Turma_Id,Sala_Id';
            $this->recognize['RecTurma'] 	= 'Turma_Id';
            $this->recognize['RecSala'] 	= 'Sala_Id';

            //Нndices
            $this->index['currdiscturma']['Cols'] 	= "CurrOfe_Id DiscEsp_Id Turma_Id";
            $this->index["currdiscturma"]["Unique"]	= 1;

            $this->index['CurrOfe']['Cols'] 	= "CurrOfe_Id ";
            $this->index['Turma']['Cols'] 		= "Turma_Id ";
            $this->index['Sala']['Cols'] 		= "Sala_Id ";
            $this->index['DiscEsp']['Cols'] 	= "DiscEsp_Id ";

            //Todas as Queries da classe
            $this->query['qDivTurma'] 				= 'TurmaOfe_qDivTurma';
            $this->query['qCursoResumo'] 			= 'TurmaOfe_qCursoResumo';
            $this->query['qDisposicaoTurma'] 		= 'TurmaOfe_qDisposicaoTurma';
            $this->query['qNormal'] 				= 'TurmaOfe_qNormal';
            $this->query['qCoordPos'] 				= 'TurmaOfe_qCoordPos';
            $this->query['qPLetivoCurrOfe'] 		= 'TurmaOfe_qPLetivoCurrOfe';
            $this->query['qCurrOfeIn'] 				= 'TurmaOfe_qCurrOfeIn';
            $this->query['qCurrOfe'] 				= 'TurmaOfe_qCurrOfe';
            $this->query['qRetSerie'] 				= 'TurmaOfe_qRetSerie';
            $this->query['qSelecao'] 				= 'TurmaOfe_qSelecao';
            $this->query['qPLetivo'] 				= 'TurmaOfe_qPLetivo';
            $this->query['qAlunosMatriculados'] 	= 'TurmaOfe_qAlunosMatriculados';
            $this->query['qUltimoAno'] 				= 'TurmaOfe_qUltimoAno';
            $this->query['qEtqListaPresenca'] 		= 'TurmaOfe_qEtqListaPresenca';
            $this->query['qCurr'] 					= 'TurmaOfe_qCurr';
            $this->query['qPLetivoTurmaId'] 		= 'TurmaOfe_qPLetivoTurmaId';
            $this->query['qPLetivoSemDiscEsp'] 		= 'TurmaOfe_qPLetivoSemDiscEsp';
            $this->query['qSalaHist'] 				= 'TurmaOfe_qSalaHist';
            $this->query['qRetCursosTurmaEsp'] 		= 'TurmaOfe_qRetCursosTurmaEsp';
            $this->query['qPLetivoCursoNivel'] 		= 'TurmaOfe_qPLetivoCursoNivel';
            $this->query['qTurmaExist'] 			= 'TurmaOfe_qTurmaExist';
            $this->query['qTurma'] 					= 'TurmaOfe_qTurma';
            $this->query['qCurrOfeInSerie'] 		= 'TurmaOfe_qCurrOfeInSerie';
            $this->query['qEspecial'] 				= 'TurmaOfe_qEspecial';
            $this->query['qCurso'] 					= 'TurmaOfe_qCurso';
            $this->query['qCursoPeriodo'] 			= 'TurmaOfe_qCursoPeriodo';
            $this->query['qDiscEspIn'] 				= 'TurmaOfe_qDiscEspIn';
            $this->query['qCurrOfeSerie'] 			= 'TurmaOfe_qCurrOfeSerie';
            $this->query['qMecXCurso'] 				= 'TurmaOfe_qMecXCurso';
            $this->query['qTransf'] 				= 'TurmaOfe_qTransf';
            $this->query['qGradAlu'] 				= 'TurmaOfe_qGradAlu';
            $this->query['qPLetProvao'] 			= 'TurmaOfe_qPLetProvao';
            $this->query['qId'] 					= 'TurmaOfe_qId';
            $this->query['qRetCursosTurmaEspCount']	= 'TurmaOfe_qRetCursosTurmaEspCount';
            $this->query['qCursoFacul'] 			= 'TurmaOfe_qCursoFacul';
            $this->query['qColacao'] 				= 'TurmaOfe_qColacao';
            $this->query['qDivisaoTurma'] 			= 'TurmaOfe_qDivisaoTurma';
            $this->query['qPesquisa'] 				= 'TurmaOfe_qPesquisa';
            $this->query['qDiscEsp'] 				= 'TurmaOfe_qDiscEsp';
            $this->query['qDtEntregaDoc'] 			= 'TurmaOfe_qDtEntregaDoc';
            $this->query['qIdPura'] 				= 'TurmaOfe_qIdPura';
            $this->query['qGeral'] 					= 'TurmaOfe_qGeral';
            $this->query['qRetPLetivo'] 			= 'TurmaOfe_qRetPLetivo';

                 
        } 
        
        public function GetPLetivo($TurmaOfe_Id)
        {
        	
        	if(!is_numeric($TurmaOfe_Id)) return false;
        	
        	require_once('../model/CurrOfe.class.php');
        	
        	$currOfe = new CurrOfe($this->db);
        	
        	$aAux = $this->GetIdInfo($TurmaOfe_Id);

			return $currOfe->Recognize($aAux["CURROFE_ID"],"RecPLetivo");  
        }
} 

?>