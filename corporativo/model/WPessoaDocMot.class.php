<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class WPessoaDocMot extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'WPessoaDocMot'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 500;


            $this->attribute['Referencia']['Type'] 		= 'varchar2';
            $this->attribute['Referencia']['Length'] 	= 50;
            $this->attribute['Referencia']['Label'] 	= 'Referкncia';
            $this->attribute['Referencia']['NN'] 		= 1;

            $this->attribute['Descricao']['Type'] 		= 'varchar2';
            $this->attribute['Descricao']['Length'] 	= 1000;
            $this->attribute['Descricao']['Label'] 		= 'Descriзгo';
            $this->attribute['Descricao']['NN'] 		= 1;

            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['RefDesc']		= 'WPessoaDocMot_qGeral';
            $this->calculate['Geral'] 		= 'WPessoaDocMot_qGeral';


            //Recognizes
            $this->recognize['Recognize'] 	= 'Referencia';

            //Нndices

            //Todas as Queries da classe
            $this->query['qGeral'] 			= 'WPessoaDocMot_qGeral';

                 
        } 
}

?>