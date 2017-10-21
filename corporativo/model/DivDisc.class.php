
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class DivDisc extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'DivDisc'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

        public function __construct($db) 
        {
        	$this->db = $db;

            $this->attribute['TOXCD_Id']['Type'] 	= 'number';
            $this->attribute['TOXCD_Id']['Length'] 	= 15;
            $this->attribute['TOXCD_Id']['NN'] 		= 1;
            $this->attribute['TOXCD_Id']['Label'] 	= 'Disciplinas';

            $this->attribute['AulaTi_Id']['Type'] 	= 'number';
            $this->attribute['AulaTi_Id']['Length']	= 15;
            $this->attribute['AulaTi_Id']['NN'] 	= 1;
            $this->attribute['AulaTi_Id']['Label'] 	= 'Tipo Aula';

            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 100;
            $this->attribute['Nome']['Label'] 		= 'Nome';
            $this->attribute['Nome']['NN'] 			= 1;

            $this->recognize['Recognize']	= 'Nome';
            
            $this->calculate["Recognize"] = "Nome, AulaTi_Id";
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qId'] 		= 'DivDisc_qId';
            $this->query['qGeral'] 		= 'DivDisc_qGeral';
            $this->query['qCountTOXCD']	= 'DivDisc_qCountTOXCD';
            $this->query['qPLetivo'] 	= 'DivDisc_qPLetivo';

                 
        }

} 