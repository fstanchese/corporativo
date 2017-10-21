<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class EveHorario extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'EveHorario'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 100;


            $this->attribute['Horario']['Type'] = 'varchar2';
            $this->attribute['Horario']['Length'] = 8;
            $this->attribute['Horario']['NN'] = 1;
            $this->attribute['Horario']['Label'] = 'Horбrio';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize']	= 'Horario';
            
            //Нndices

            //Todas as Queries da classe
            $this->query['qId'] = 'EveHorario_qId';
            $this->query['qGeral'] = 'EveHorario_qGeral';
                 
        } 
	} 
	
?>