<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Vest extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Vest'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 30000;


            $this->attribute['WPleito_Id']['Type'] = 'number';
            $this->attribute['WPleito_Id']['Length'] = 15;
            $this->attribute['WPleito_Id']['NN'] = 1;
            $this->attribute['WPleito_Id']['Label'] = 'Pleito';

            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['NN'] = 1;
            $this->attribute['WPessoa_Id']['Label'] = 'Pessoa';

            $this->attribute['IP']['Type'] = 'varchar2';
            $this->attribute['IP']['Length'] = 19;
            $this->attribute['IP']['NN'] = 1;
            $this->attribute['IP']['Label'] = 'IP';

            $this->attribute['Treineiro']['Type'] = 'varchar2';
            $this->attribute['Treineiro']['Length'] = 3;
            $this->attribute['Treineiro']['NN'] = 1;
            $this->attribute['Treineiro']['Label'] = 'Treineiro';

            $this->attribute['Sala_Id']['Type'] = 'number';
            $this->attribute['Sala_Id']['Length'] = 15;
            $this->attribute['Sala_Id']['Label'] = 'Sala';

            $this->attribute['Inscricao']['Type'] = 'number';
            $this->attribute['Inscricao']['Length'] = 6;
            $this->attribute['Inscricao']['Label'] = 'Inscricao';

            $this->attribute['State_Id']['Type'] = 'number';
            $this->attribute['State_Id']['Length'] = 15;
            $this->attribute['State_Id']['Label'] = 'Situação';

            $this->attribute['Respostas']['Type'] = 'varchar2';
            $this->attribute['Respostas']['Length'] = 100;
            $this->attribute['Respostas']['Label'] = 'Respostas';

            $this->attribute['Redacao']['Type'] = 'number';
            $this->attribute['Redacao']['Length'] = 4.2;
            $this->attribute['Redacao']['Label'] = 'Redacao';

            $this->attribute['AusenteLP']['Type'] = 'varchar2';
            $this->attribute['AusenteLP']['Length'] = 3;
            $this->attribute['AusenteLP']['Label'] = 'Ausente';

            $this->attribute['AusenteLOProva']['Type'] = 'varchar2';
            $this->attribute['AusenteLOProva']['Length'] = 3;
            $this->attribute['AusenteLOProva']['Label'] = 'Ausente';

            $this->attribute['AusenteLORedacao']['Type'] = 'varchar2';
            $this->attribute['AusenteLORedacao']['Length'] = 3;
            $this->attribute['AusenteLORedacao']['Label'] = 'Ausente';

            $this->attribute['PSTemaRedacao_Id']['Type'] = 'number';
            $this->attribute['PSTemaRedacao_Id']['Length'] = 15;
            $this->attribute['PSTemaRedacao_Id']['Label'] = 'Tema da Redação';

            $this->attribute['PSConteudoRedacao']['Type'] = 'number';
            $this->attribute['PSConteudoRedacao']['Length'] = 6.2;
            $this->attribute['PSConteudoRedacao']['Label'] = 'Conteúdo Redacao';

            $this->attribute['PSCoesaoRedacao']['Type'] = 'number';
            $this->attribute['PSCoesaoRedacao']['Length'] = 6.2;
            $this->attribute['PSCoesaoRedacao']['Label'] = 'Coesao Redacao';

            $this->attribute['PSGramaticaRedacao']['Type'] = 'number';
            $this->attribute['PSGramaticaRedacao']['Length'] = 6.2;
            $this->attribute['PSGramaticaRedacao']['Label'] = 'Gramática Redacao';

            $this->attribute['PSConteudoENEM']['Type'] = 'number';
            $this->attribute['PSConteudoENEM']['Length'] = 6.2;
            $this->attribute['PSConteudoENEM']['Label'] = 'Conteúdo ENEM';

            $this->attribute['PSCoesaoENEM']['Type'] = 'number';
            $this->attribute['PSCoesaoENEM']['Length'] = 6.2;
            $this->attribute['PSCoesaoENEM']['Label'] = 'Coesao ENEM';

            $this->attribute['PSGramaticaENEM']['Type'] = 'number';
            $this->attribute['PSGramaticaENEM']['Length'] = 6.2;
            $this->attribute['PSGramaticaENEM']['Label'] = 'Gramática ENEM';

            $this->attribute['PSAvaliacao']['Type'] = 'number';
            $this->attribute['PSAvaliacao']['Length'] = 1;
            $this->attribute['PSAvaliacao']['Label'] = 'Avaliação do Processo Seletivo';
            $this->attribute['PSAvaliacao']['Mask'] = '9';

            $this->attribute['PSMediaRedacao']['Type'] = 'number';
            $this->attribute['PSMediaRedacao']['Length'] = 6.2;
            $this->attribute['PSMediaRedacao']['Label'] = 'Média Redacao';

            $this->attribute['PSMediaENEM']['Type'] = 'number';
            $this->attribute['PSMediaENEM']['Length'] = 6.2;
            $this->attribute['PSMediaENEM']['Label'] = 'Média ENEM';

            $this->attribute['PSDesempateRedacao']['Type'] = 'number';
            $this->attribute['PSDesempateRedacao']['Length'] = 6.2;
            $this->attribute['PSDesempateRedacao']['Label'] = 'Média Redacao';

            $this->attribute['PSDesempateENEM']['Type'] = 'number';
            $this->attribute['PSDesempateENEM']['Length'] = 6.2;
            $this->attribute['PSDesempateENEM']['Label'] = 'Média ENEM';

            $this->attribute['CESJProcSel_Id']['Type'] = 'number';
            $this->attribute['CESJProcSel_Id']['Length'] = 15;
            $this->attribute['CESJProcSel_Id']['Label'] = 'Programa de Bolsa';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['IdVest'] = 'Vest_qPessoaTodos';


            //Recognizes
            $this->recognize['Recognize'] = 'IP';

            //Índices

            //Todas as Queries da classe
            $this->query['qPessoa'] = 'Vest_qPessoa';
            $this->query['qAusenteQI'] = 'Vest_qAusenteQI';
            $this->query['qAloca'] = 'Vest_qAloca';
            $this->query['qIdStd'] = 'Vest_qIdStd';
            $this->query['qTodos'] = 'Vest_qTodos';
            $this->query['qSelecao'] = 'Vest_qSelecao';
            $this->query['qPROUNI'] = 'Vest_qPROUNI';
            $this->query['qMAIA'] = 'Vest_qMAIA';
            $this->query['qNotaRedacao'] = 'Vest_qNotaRedacao';
            $this->query['qClassificacao'] = 'Vest_qClassificacao';
            $this->query['qCorreios'] = 'Vest_qCorreios';
            $this->query['qWPleito'] = 'Vest_qWPleito';
            $this->query['qPSNotaDesempate'] = 'Vest_qPSNotaDesempate';
            $this->query['qInscInd'] = 'Vest_qInscInd';
            $this->query['qChamada'] = 'Vest_qChamada';
            $this->query['qWPleitoPS'] = 'Vest_qWPleitoPS';
            $this->query['qClass'] = 'Vest_qClass';
            $this->query['qPSClass'] = 'Vest_qPSClass';
            $this->query['qChama'] = 'Vest_qChama';
            $this->query['qEndereco'] = 'Vest_qEndereco';
            $this->query['qInscricao'] = 'Vest_qInscricao';
            $this->query['qPSChamada'] = 'Vest_qPSChamada';
            $this->query['qInscritos'] = 'Vest_qInscritos';
            $this->query['qBolsa'] = 'Vest_qBolsa';
            $this->query['qId'] = 'Vest_qId';
            $this->query['qProcessoSeletivo'] = 'Vest_qProcessoSeletivo';
            $this->query['qNaoPagantes'] = 'Vest_qNaoPagantes';
            $this->query['qPessoaTodos'] = 'Vest_qPessoaTodos';
            $this->query['qConsultaCountNome'] = 'Vest_qConsultaCountNome';
            $this->query['qConsultaChamada'] = 'Vest_qConsultaChamada';
            $this->query['qResultado'] = 'Vest_qResultado';
            $this->query['qQtdePROUNIUSJT'] = 'Vest_qQtdePROUNIUSJT';
            $this->query['qSala'] = 'Vest_qSala';
            $this->query['qContato'] = 'Vest_qContato';
            $this->query['qAusenteLP'] = 'Vest_qAusenteLP';
            $this->query['qPROUNIUSJT'] = 'Vest_qPROUNIUSJT';
            $this->query['qPSNota'] = 'Vest_qPSNota';
            $this->query['qConsultaNome'] = 'Vest_qConsultaNome';
            $this->query['qSelecaoCount'] = 'Vest_qSelecaoCount';
            $this->query['qGeral'] = 'Vest_qGeral';
            $this->query['qIA'] = 'Vest_qIA';
            $this->query['qWPesPLePROUNI'] = 'Vest_qWPesPLePROUNI';
            $this->query['qVerAusentes'] = 'Vest_qVerAusentes';
            $this->query['qPessoaPLetivo'] = 'Vest_qPessoaPLetivo';
            $this->query['qBolsaMAIA'] = 'Vest_qBolsaMAIA';
            $this->query['qQtdePROUNI'] = 'Vest_qQtdePROUNI';
            $this->query['qPessoaTodosPROUNI'] = 'Vest_qPessoaTodosPROUNI';
            $this->query['qEncPROUNI'] = 'Vest_qEncPROUNI';

                 
        } 
} 
?>