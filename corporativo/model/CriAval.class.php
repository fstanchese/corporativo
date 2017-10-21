<?php 

    require_once ("../engine/Model.class.php"); 

    class CriAval extends Model 
    { 

        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CriAval'; 


        public $attribute     = array(); 
        public $calculate     = array();     
        public $query        = array();
     
        
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length'] 			= 30;
            $this->attribute['Nome']['NN'] 				= 1;
            $this->attribute['Nome']['Label'] 			= 'Nome';

            $this->attribute['Descricao']['Type'] 		= 'varchar2';
            $this->attribute['Descricao']['Length'] 	= 255;
            $this->attribute['Descricao']['NN'] 		= 1;
            $this->attribute['Descricao']['Label'] 		= 'Descriзгo';

            $this->attribute['CriAvalTi_Id']['Type'] 	= 'number';
            $this->attribute['CriAvalTi_Id']['Length']	= 15;
            $this->attribute['CriAvalTi_Id']['Label'] 	= 'Tipo';

            $this->recognize['Recognize']	= 'Nome';
            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate["Geral"] = 'CriAval_qGeral';

            //Todas as Queries da classe
            $this->query['qId'] = 'CriAval_qId';


                             
        } 
} 
?>