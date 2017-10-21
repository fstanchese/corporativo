<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class DiplProc extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'DiplProc'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

        public function __construct($db) 
        {

            $this->db = $db;

            $this->attribute['NrProcesso']['Type'] = 'number';
            $this->attribute['NrProcesso']['Length'] = 10;
            $this->attribute['NrProcesso']['NN'] = 1;
            $this->attribute['NrProcesso']['Label'] = 'Nъmero do Processo';

            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['NN'] = 1;
            $this->attribute['WPessoa_Id']['Label'] = 'Nome';

            $this->attribute['DiplProcTi_Id']['Type'] = 'number';
            $this->attribute['DiplProcTi_Id']['Length'] = 15;
            $this->attribute['DiplProcTi_Id']['NN'] = 1;
            $this->attribute['DiplProcTi_Id']['Label'] = 'Tipo Processo';

            $this->attribute['WOcorr_Id']['Type'] = 'number';
            $this->attribute['WOcorr_Id']['Length'] = 15;
            $this->attribute['WOcorr_Id']['Label'] = 'Solicitaзгo';

            $this->attribute['State_Id']['Type'] = 'number';
            $this->attribute['State_Id']['Length'] = 15;
            $this->attribute['State_Id']['Label'] = 'Situaзгo';

            $this->attribute['Matric_Id']['Type'] = 'number';
            $this->attribute['Matric_Id']['Length'] = 15;
            $this->attribute['Matric_Id']['Label'] = 'Matrнcula';

            $this->attribute['Curr_Id']['Type'] = 'number';
            $this->attribute['Curr_Id']['Length'] = 15;
            $this->attribute['Curr_Id']['Label'] = 'Currнculo';

            $this->attribute['DiplProc_Pai_Id']['Type'] = 'number';
            $this->attribute['DiplProc_Pai_Id']['Length'] = 15;
            $this->attribute['DiplProc_Pai_Id']['Label'] = 'Processo Pai';

            $this->attribute['TempTitulo_Id']['Type'] = 'number';
            $this->attribute['TempTitulo_Id']['Length'] = 15;
            $this->attribute['TempTitulo_Id']['Label'] = 'Curso';

            $this->attribute['Arquivado']['Type'] = 'date';
            $this->attribute['Arquivado']['Mask'] = 'd';
            $this->attribute['Arquivado']['Label'] = 'Arquivado em';

            $this->attribute['Devolucao']['Type'] = 'varchar2';
            $this->attribute['Devolucao']['Length'] = 1;
            $this->attribute['Devolucao']['Label'] = 'Devolucao';

            $this->attribute['Depart_Id']['Type'] = 'number';
            $this->attribute['Depart_Id']['Length'] = 15;
            $this->attribute['Depart_Id']['Label'] = 'Departamento';

            $this->attribute['DtRetirada']['Type'] = 'date';
            $this->attribute['DtRetirada']['Label'] = 'Data da Retirada';
            $this->attribute['DtRetirada']['Mask'] = 'd';

            $this->attribute['DtConvocacao']['Type'] = 'date';
            $this->attribute['DtConvocacao']['Label'] = 'Data da Convocaзгo';
            $this->attribute['DtConvocacao']['Mask'] = 'd';
            
            
            $this->recognize['Recognize']	= 'NrProcesso, WPessoa_Id';
            //Calculates para a criaзгo de querys no diretуrio SQL

            //Todas as Queries da classe
            $this->query['qId'] = 'DiplProc_qId';
            $this->query['qTipo'] = 'DiplProc_qTipo';
            $this->query['qProcesso'] = 'DiplProc_qProcesso';
            $this->query['qNrProcesso'] = 'DiplProc_qNrProcesso';
            $this->query['qMatric'] = 'DiplProc_qMatric';
            $this->query['qFluxo'] = 'DiplProc_qFluxo';

                 
        } 
} 
?>