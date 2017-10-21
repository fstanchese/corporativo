
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Semana extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Semana'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

        
        public function __construct($db) 
        {

        	$this->db = $db;
        	
            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 20;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Dia da Semana';

            $this->attribute['Numero']['Type'] 		= 'number';
            $this->attribute['Numero']['Length'] 	= 2;
            $this->attribute['Numero']['NN'] 		= 1;
            $this->attribute['Numero']['Label'] 	= 'Sequência';

            $this->recognize["Recognize"]	= "Nome";
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Horario_01_Id'] 	= 'Semana_qGeral';
            $this->calculate['Horario_02_Id'] 	= 'Semana_qGeral';
            $this->calculate['Horario_03_Id'] 	= 'Semana_qGeral';
            $this->calculate['Horario_04_Id'] 	= 'Semana_qGeral';
            $this->calculate['Semana']	= 'Semana_qGeral';

            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'Semana_qGeral';
            $this->query['qId'] 	= 'Semana_qId';
            $this->query['qNome'] 	= 'Semana_qNome';

                 
        } 
        
} 