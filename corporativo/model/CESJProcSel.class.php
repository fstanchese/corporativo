<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CESJProcSel extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CESJProcSel'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 50;


            $this->attribute['Nome']['Type'] 				= 'varchar2';
            $this->attribute['Nome']['Length'] 				= 50;
            $this->attribute['Nome']['NN'] 					= 1;
            $this->attribute['Nome']['Label'] 				= 'Nome';

            $this->attribute['PLetivo_Id']['Type'] 			= 'number';
            $this->attribute['PLetivo_Id']['Length'] 		= 15;
            $this->attribute['PLetivo_Id']['Label'] 		= 'Periodo Letivo';

            $this->attribute['DtInicio']['Type'] 			= 'date';
            $this->attribute['DtInicio']['Label'] 			= 'Data de Inнcio';

            $this->attribute['DtTermino']['Type'] 			= 'date';
            $this->attribute['DtTermino']['Label'] 			= 'Data de Tйrmino';

            $this->attribute['BolsaIncentivo']['Type'] 		= 'varchar2';
            $this->attribute['BolsaIncentivo']['Length'] 	= 3;
            $this->attribute['BolsaIncentivo']['Label'] 	= 'Й do tipo bolsa incentivo?';

            $this->attribute['NomeExtenso']['Type'] 		= 'varchar2';
            $this->attribute['NomeExtenso']['Length'] 		= 50;
            $this->attribute['NomeExtenso']['NN'] 			= 1;
            $this->attribute['NomeExtenso']['Label'] 		= 'Nome Completo';

            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['IdRecognize'] = 'CESJProcSel_qBolsaIncentivo';


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Нndices
            $this->index['nome']['Cols'] = "nome";
            $this->index["nome"]["Unique"] = 1;


            //Todas as Queries da classe
            $this->query['qId'] 				= 'CESJProcSel_qId';
            $this->query['qGeral'] 				= 'CESJProcSel_qGeral';
            $this->query['qBolsaIncentivo'] 	= 'CESJProcSel_qBolsaIncentivo';
            $this->query['qPLetivo']			= 'CESJProcSel_qPLetivo';

                 
        } 
} 
?>