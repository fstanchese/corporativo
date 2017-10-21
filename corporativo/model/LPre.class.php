
<?php
        
    require_once ("../engine/Model.class.php");
        
    class LPre extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'LPre'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        public $index        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 150000;


            $this->attribute['PLetivoP_Id']['Type'] 			= 'number';
            $this->attribute['PLetivoP_Id']['Length'] 			= 15;
            $this->attribute['PLetivoP_Id']['NN'] 				= 1;
            $this->attribute['PLetivoP_Id']['Label'] 			= 'Parcela do Período Letivo';

            $this->attribute['HoraAula_Id']['Type'] 			= 'number';
            $this->attribute['HoraAula_Id']['Length'] 			= 15;
            $this->attribute['HoraAula_Id']['NN'] 				= 1;
            $this->attribute['HoraAula_Id']['Label'] 			= 'Horário de Aula';

            $this->attribute['Dt1']['Type'] 					= 'date';
            $this->attribute['Dt1']['Label'] 					= 'Data 1';
            $this->attribute['Dt1']['NN'] 						= 0;
            

            $this->attribute['Dt2']['Type'] 					= 'date';
            $this->attribute['Dt2']['Label'] 					= 'Data 2';
            $this->attribute['Dt2']['NN'] 						= 0;
            

            $this->attribute['Dt3']['Type'] 					= 'date';
            $this->attribute['Dt3']['Label'] 					= 'Data 3';
            $this->attribute['Dt3']['NN'] 						= 0;
            

            $this->attribute['QtdAulas1']['Type']				= 'number';
            $this->attribute['QtdAulas1']['Length']				= 2;
            $this->attribute['QtdAulas1']['Label'] 				= 'Número de Aulas 1';
            $this->attribute['QtdAulas1']['NN'] 				= 0;

            $this->attribute['QtdAulas2']['Type'] 				= 'number';
            $this->attribute['QtdAulas2']['Length'] 			= 2;
            $this->attribute['QtdAulas2']['Label'] 				= 'Número de Aulas 2';
            $this->attribute['QtdAulas2']['NN'] 				= 0;

            $this->attribute['QtdAulas3']['Type'] 				= 'number';
            $this->attribute['QtdAulas3']['Length'] 			= 2;
            $this->attribute['QtdAulas3']['Label'] 				= 'Número de Aulas 3';
            $this->attribute['QtdAulas3']['NN'] 				= 0;

            $this->attribute['WPessoa_Prof1_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Prof1_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Prof1_Id']['Label'] 		= 'Professor 1';
            $this->attribute['WPessoa_Prof1_Id']['NN'] 			= 0;

            $this->attribute['WPessoa_Prof2_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Prof2_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Prof2_Id']['Label'] 		= 'Professor 2';
            $this->attribute['WPessoa_Prof2_Id']['NN'] 			= 0;

            $this->attribute['WPessoa_Prof3_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Prof3_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Prof3_Id']['Label'] 		= 'Professor 3';
            $this->attribute['WPessoa_Prof3_Id']['NN'] 			= 0;

            $this->attribute['WPessoa_Prof4_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Prof4_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Prof4_Id']['Label']		= 'Professor 4';
            $this->attribute['WPessoa_Prof4_Id']['NN'] 			= 0;

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] 						= 'PLetivoP_Id,HoraAula_Id,WPessoa_Prof1_Id';

            //Índices
            $this->index['PLetivoPHoraAulaDtS']['Cols'] 		= "PLetivoP_Id HoraAula_Id Dt1 Dt2 Dt3";
            $this->index["PLetivoPHoraAulaDtS"]["Unique"] 		= 1;

            $this->index['PLetivoP']['Cols'] 					= "PLetivoP_Id";
            $this->index['WPessoa_Prof1_Id']['Cols'] 			= "WPessoa_Prof1_Id";
            $this->index['HoraAula_Id']['Cols'] 				= "HoraAula_Id";

            //Todas as Queries da classe
            $this->query['qCancelamento'] 						= 'LPre_qCancelamento';
            $this->query['qConsulta']							= 'LPre_qConsulta';
            $this->query['qImpressao'] 							= 'LPre_qImpressao';
            $this->query['qHoraAula'] 							= 'LPre_qHoraAula';
            $this->query['qConferencia'] 						= 'LPre_qConferencia';
            $this->query['qPodeGerar'] 							= 'LPre_qPodeGerar';
            //$this->query['qGeral'] 								= 'LPre_qGeral';
            $this->query['qNaoProcessadas']						= 'LPre_qNaoProcessadas';
            $this->query['qTOXCDGeradas'] 						= 'LPre_qTOXCDGeradas';
            $this->query['qFaltas'] 							= 'LPre_qFaltas';
            $this->query['qGeracao'] 							= 'LPre_qGeracao';
            //$this->query['qId'] 								= 'LPre_qId';

                
        }
        
        
        
        
}
?> 