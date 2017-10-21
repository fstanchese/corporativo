
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class HorarioTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'HorarioTi'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

        
        public function __construct($db) 
        {
        	$this->db = $db;

            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 20;
            $this->attribute['Nome']['NN'] = 1;
            $this->attribute['Nome']['Label'] = 'Nome';

            
            $this->recognize["Recognize"] = "Nome";
            
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qGeral']			= 'HorarioTi_qGeral';
            $this->query['qId']				= 'HorarioTi_qId';
            $this->query['qNormalEspecial']	= 'HorarioTi_qNormalEspecial';

                 
        }

} 