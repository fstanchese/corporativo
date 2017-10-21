<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Apostila extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Apostila'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         
        public function __construct($db) 
        {

            $this->db = $db;

            $this->attribute['DtApostila']['Type'] = 'date';
            $this->attribute['DtApostila']['Label'] = 'Data da Apostila';
            $this->attribute['DtApostila']['Mask'] = 'd';

            $this->attribute['Texto']['Type'] = 'varchar2';
            $this->attribute['Texto']['Length'] = 2000;
            $this->attribute['Texto']['Label'] = 'Texto';

            $this->attribute['DiplProc_Id']['Type'] = 'number';
            $this->attribute['DiplProc_Id']['Length'] = 15;
            $this->attribute['DiplProc_Id']['Label'] = 'Nr do Processo';

            $this->attribute['DiplReg_Id']['Type'] = 'number';
            $this->attribute['DiplReg_Id']['Length'] = 15;
            $this->attribute['DiplReg_Id']['Label'] = 'Nr do Registro';

            $this->attribute['Curr_Id']['Type'] = 'number';
            $this->attribute['Curr_Id']['Length'] = 15;
            $this->attribute['Curr_Id']['Label'] = 'Habilitaзгo';

            $this->attribute['Curr_02_Id']['Type'] = 'number';
            $this->attribute['Curr_02_Id']['Length'] = 15;
            $this->attribute['Curr_02_Id']['Label'] = 'Habilitaзгo';

            $this->attribute['PeriodoLetivo']['Type'] = 'varchar2';
            $this->attribute['PeriodoLetivo']['Length'] = 30;
            $this->attribute['PeriodoLetivo']['Label'] = 'Ano de Conclusao';

            $this->attribute['WPessoa_Diretor_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Diretor_Id']['Length'] = 15;
            $this->attribute['WPessoa_Diretor_Id']['NN'] = 1;
            $this->attribute['WPessoa_Diretor_Id']['Label'] = 'Diretor';

            $this->attribute['TempTitulo_Id']['Type'] = 'number';
            $this->attribute['TempTitulo_Id']['Length'] = 15;
            $this->attribute['TempTitulo_Id']['Label'] = 'Curso';

            $this->attribute['DtAnotacao']['Type'] = 'date';
            $this->attribute['DtAnotacao']['Label'] = 'Data da Anotaзгo';
            $this->attribute['DtAnotacao']['Mask'] = 'd';

            $this->attribute['WPessoa_Assina1_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Assina1_Id']['Length'] = 15;
            $this->attribute['WPessoa_Assina1_Id']['Label'] = 'Assinatura 1';

            $this->attribute['Carimbo_Assina1_Id']['Type'] = 'number';
            $this->attribute['Carimbo_Assina1_Id']['Length'] = 15;
            $this->attribute['Carimbo_Assina1_Id']['Label'] = 'Assinatura 1';

            $this->attribute['WPessoa_Assina2_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Assina2_Id']['Length'] = 15;
            $this->attribute['WPessoa_Assina2_Id']['Label'] = 'Assinatura 2';

            $this->attribute['Carimbo_Assina2_Id']['Type'] = 'number';
            $this->attribute['Carimbo_Assina2_Id']['Length'] = 15;
            $this->attribute['Carimbo_Assina2_Id']['Label'] = 'Assinatura 2';

            $this->attribute['ApostilaReconhe']['Type'] = 'varchar2';
            $this->attribute['ApostilaReconhe']['Length'] = 100;
            $this->attribute['ApostilaReconhe']['Label'] = 'Reconhecimento';

            $this->attribute['ApostilaNome']['Type'] = 'varchar2';
            $this->attribute['ApostilaNome']['Length'] = 80;
            $this->attribute['ApostilaNome']['Label'] = 'Apostila';

            $this->recognize['Recognize']		= 'DtApostila, Texto';
            //Calculates para a criaзгo de querys no diretуrio SQL

            //Todas as Queries da classe
            $this->query['qApostila'] = 'Apostila_qApostila';
            $this->query['qDiplProc'] = 'Apostila_qDiplProc';
            $this->query['qCount'] = 'Apostila_qCount';
            $this->query['qProcesso'] = 'Apostila_qProcesso';
            $this->query['qId'] = 'Apostila_qId';
            $this->query['qCurr'] = 'Apostila_qCurr';
            $this->query['qMatric'] = 'Apostila_qMatric';

                 
        } 
} 
?>