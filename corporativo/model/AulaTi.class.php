
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AulaTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AulaTi'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

         
        public function __construct($db) 
        {
        	$this->db = $db;

            $this->attribute['nome']['Type'] 	= 'varchar2';
            $this->attribute['nome']['Length']	= 20;
            $this->attribute['nome']['NN'] 		= 1;
            $this->attribute['nome']['Label'] 	= 'Descrição';

            $this->recognize['Recognize'] 	= 'Nome';
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Recognize'] = "Nome";
            
            

            //Todas as Queries da classe
            $this->query['qGeral'] 		= 'AulaTi_qGeral';
            $this->query['qId'] 		= 'AulaTi_qId';
            $this->query['qCurrXDisc'] 	= 'AulaTi_qCurrXDisc';
            $this->query['qDiscEsp'] 	= 'AulaTi_qDiscEsp';
                 
        } 
        
	} 

?>
