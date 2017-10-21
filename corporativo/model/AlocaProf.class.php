
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AlocaProf extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AlocaProf'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 30000;


            $this->attribute['PLetivo_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Id']['Length'] = 15;
            $this->attribute['PLetivo_Id']['NN'] = 1;
            $this->attribute['PLetivo_Id']['Label'] = 'Início Letivo';

            $this->attribute['Turma_Id']['Type'] = 'number';
            $this->attribute['Turma_Id']['Length'] = 25;
            $this->attribute['Turma_Id']['NN'] = 1;
            $this->attribute['Turma_Id']['Label'] = 'Turma';

            $this->attribute['CurrXDisc_Id']['Type'] = 'number';
            $this->attribute['CurrXDisc_Id']['Length'] = 15;
            $this->attribute['CurrXDisc_Id']['NN'] = 1;
            $this->attribute['CurrXDisc_Id']['Label'] = 'Disciplina';

            $this->attribute['AulaTi_Id']['Type'] = 'number';
            $this->attribute['AulaTi_Id']['Length'] = 15;
            $this->attribute['AulaTi_Id']['NN'] = 1;
            $this->attribute['AulaTi_Id']['Label'] = 'Tipo Aula';

            $this->attribute['DivTurma_Id']['Type'] = 'number';
            $this->attribute['DivTurma_Id']['Length'] = 15;
            $this->attribute['DivTurma_Id']['Label'] = 'Divisão';

            $this->attribute['Professor_01_Id']['Type'] = 'number';
            $this->attribute['Professor_01_Id']['Length'] = 15;
            $this->attribute['Professor_01_Id']['Label'] = 'Professor 1';

            $this->attribute['Professor_02_Id']['Type'] = 'number';
            $this->attribute['Professor_02_Id']['Length'] = 15;
            $this->attribute['Professor_02_Id']['Label'] = 'Professor 2';

            $this->attribute['Professor_03_Id']['Type'] = 'number';
            $this->attribute['Professor_03_Id']['Length'] = 15;
            $this->attribute['Professor_03_Id']['Label'] = 'Professor 3';

            $this->attribute['Professor_04_Id']['Type'] = 'number';
            $this->attribute['Professor_04_Id']['Length'] = 15;
            $this->attribute['Professor_04_Id']['Label'] = 'Professor 4';

            $this->attribute['Professor_05_Id']['Type'] = 'number';
            $this->attribute['Professor_05_Id']['Length'] = 15;
            $this->attribute['Professor_05_Id']['Label'] = 'Professor 5';

            $this->attribute['Professor_06_Id']['Type'] = 'number';
            $this->attribute['Professor_06_Id']['Length'] = 15;
            $this->attribute['Professor_06_Id']['Label'] = 'Professor 6';

            $this->attribute['State_Id']['NN'] = 1;
            $this->attribute['State_Id']['Type'] = 'number';
            $this->attribute['State_Id']['Length'] = 15;
            $this->attribute['State_Id']['Label'] = 'Situação';

            $this->attribute['CHS']['Type'] = 'number';
            $this->attribute['CHS']['Length'] = 2;
            $this->attribute['CHS']['Label'] = 'ChS';

            $this->attribute['CHS1']['Type'] = 'number';
            $this->attribute['CHS1']['Length'] = 2;
            $this->attribute['CHS1']['Label'] = 'ChS';

            $this->attribute['CHS2']['Type'] = 'number';
            $this->attribute['CHS2']['Length'] = 2;
            $this->attribute['CHS2']['Label'] = 'ChS';

            $this->attribute['CHS3']['Type'] = 'number';
            $this->attribute['CHS3']['Length'] = 2;
            $this->attribute['CHS3']['Label'] = 'ChS';

            $this->attribute['CHS4']['Type'] = 'number';
            $this->attribute['CHS4']['Length'] = 2;
            $this->attribute['CHS4']['Label'] = 'ChS';

            $this->attribute['CHS5']['Type'] = 'number';
            $this->attribute['CHS5']['Length'] = 2;
            $this->attribute['CHS5']['Label'] = 'ChS';

            $this->attribute['CHS6']['Type'] = 'number';
            $this->attribute['CHS6']['Length'] = 2;
            $this->attribute['CHS6']['Label'] = 'ChS';

            $this->attribute['Fator']['Type'] = 'number';
            $this->attribute['Fator']['Length'] = 1;
            $this->attribute['Fator']['Label'] = 'Indice';

            $this->attribute['Sala_Id']['Type'] = 'number';
            $this->attribute['Sala_Id']['Length'] = 15;
            $this->attribute['Sala_Id']['Label'] = 'Sala';

            $this->attribute['Turma_Junto_Id']['Type'] = 'number';
            $this->attribute['Turma_Junto_Id']['Length'] = 25;
            $this->attribute['Turma_Junto_Id']['Label'] = 'Turma';

            $this->attribute['EmConjunto1']['Type'] = 'varchar2';
            $this->attribute['EmConjunto1']['Length'] = 3;
            $this->attribute['EmConjunto1']['Label'] = 'Em Conjunto';

            $this->attribute['EmConjunto2']['Type'] = 'varchar2';
            $this->attribute['EmConjunto2']['Length'] = 3;
            $this->attribute['EmConjunto2']['Label'] = 'Em Conjunto';

            $this->attribute['EmConjunto3']['Type'] = 'varchar2';
            $this->attribute['EmConjunto3']['Length'] = 3;
            $this->attribute['EmConjunto3']['Label'] = 'Em Conjunto';

            $this->attribute['EmConjunto4']['Type'] = 'varchar2';
            $this->attribute['EmConjunto4']['Length'] = 3;
            $this->attribute['EmConjunto4']['Label'] = 'Em Conjunto';

            $this->attribute['EmConjunto5']['Type'] = 'varchar2';
            $this->attribute['EmConjunto5']['Length'] = 3;
            $this->attribute['EmConjunto5']['Label'] = 'Em Conjunto';

            $this->attribute['EmConjunto6']['Type'] = 'varchar2';
            $this->attribute['EmConjunto6']['Length'] = 3;
            $this->attribute['EmConjunto6']['Label'] = 'Em Conjunto';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Serie_Id'] = 'AlocaProf_qSerie';
            $this->calculate['Situacao_Id'] = 'AlocaProf_qSituacao';
            $this->calculate['Curric_Id'] = 'AlocaProf_qCurric';
            $this->calculate['Discip_Id'] = 'AlocaProf_qDiscip';
            $this->calculate['PLetivo_Sel_Id'] = 'AlocaProf_qPLetivo';


            //Recognizes

            //Índices

            //Todas as Queries da classe
            $this->query['qHoraAula'] = 'AlocaProf_qHoraAula';
            $this->query['qTOXCD'] = 'AlocaProf_qTOXCD';
            $this->query['qAulasPra'] = 'AlocaProf_qAulasPra';
            $this->query['qProfResumoAtiv'] = 'AlocaProf_qProfResumoAtiv';
            $this->query['qQtdCurr'] = 'AlocaProf_qQtdCurr';
            $this->query['qDiscip'] = 'AlocaProf_qDiscip';
            $this->query['qDivisao'] = 'AlocaProf_qDivisao';
            $this->query['qSala'] = 'AlocaProf_qSala';
            $this->query['qQtdeProf'] = 'AlocaProf_qQtdeProf';
            $this->query['qExiste'] = 'AlocaProf_qExiste';
            $this->query['qQtdCurric'] = 'AlocaProf_qQtdCurric';
            $this->query['qTurmaQuadro'] = 'AlocaProf_qTurmaQuadro';
            $this->query['qProfQuadro'] = 'AlocaProf_qProfQuadro';
            $this->query['qLivroPontoDet'] = 'AlocaProf_qLivroPontoDet';
            $this->query['qDivTurma'] = 'AlocaProf_qDivTurma';
            $this->query['qSerie'] = 'AlocaProf_qSerie';
            $this->query['qHorario'] = 'AlocaProf_qHorario';
            $this->query['qAtualizar'] = 'AlocaProf_qAtualizar';
            $this->query['qEtiqueta'] = 'AlocaProf_qEtiqueta';
            $this->query['qLivroPontoPS'] = 'AlocaProf_qLivroPontoPS';
            $this->query['qQtdeTurma'] = 'AlocaProf_qQtdeTurma';
            $this->query['qTurmas'] = 'AlocaProf_qTurmas';
            $this->query['qState'] = 'AlocaProf_qState';
            $this->query['qHoraTurma'] = 'AlocaProf_qHoraTurma';
            $this->query['qResProf'] = 'AlocaProf_qResProf';
            $this->query['qSalaEsp'] = 'AlocaProf_qSalaEsp';
            $this->query['qId'] = 'AlocaProf_qId';
            $this->query['qLivroPonto'] = 'AlocaProf_qLivroPonto';
            $this->query['qAulasPraticas'] = 'AlocaProf_qAulasPraticas';
            $this->query['qCurric'] = 'AlocaProf_qCurric';
            $this->query['qJunto'] = 'AlocaProf_qJunto';
            $this->query['qCurrXDisc'] = 'AlocaProf_qCurrXDisc';
            $this->query['qProfessores'] = 'AlocaProf_qProfessores';
            $this->query['qQtdeCurso'] = 'AlocaProf_qQtdeCurso';
            $this->query['qAlteracoes'] = 'AlocaProf_qAlteracoes';
            $this->query['qHoras'] = 'AlocaProf_qHoras';
            $this->query['qSincronia'] = 'AlocaProf_qSincronia';
            $this->query['qCursoDiaSerie'] = 'AlocaProf_qCursoDiaSerie';
            $this->query['qCurr'] = 'AlocaProf_qCurr';
            $this->query['qConjunto'] = 'AlocaProf_qConjunto';
            $this->query['qHistorico'] = 'AlocaProf_qHistorico';
            $this->query['qSituacao'] = 'AlocaProf_qSituacao';
            $this->query['qTurmaDiv'] = 'AlocaProf_qTurmaDiv';
            $this->query['qHoraProf'] = 'AlocaProf_qHoraProf';
            $this->query['qTurmaOfe'] = 'AlocaProf_qTurmaOfe';
            $this->query['qListaProf'] = 'AlocaProf_qListaProf';
            $this->query['qPLetivo'] = 'AlocaProf_qPLetivo';

                 
        } 
} 