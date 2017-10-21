
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Pagto extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Pagto'; 

         
        public $attribute    = array(); 
        public $calculate    = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 1000;


            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 50;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Nome';

            $this->attribute['Parcelas']['Type'] 	= 'number';
            $this->attribute['Parcelas']['Length'] 	= 3;
            $this->attribute['Parcelas']['NN'] 		= 1;
            $this->attribute['Parcelas']['Label'] 	= 'Parcelas';

            $this->attribute['DtInicio']['Type'] 	= 'date';
            $this->attribute['DtInicio']['NN'] 		= 1;
            $this->attribute['DtInicio']['Label'] 	= 'Início da Validade';
            $this->attribute['DtInicio']['Mask'] 	= 'd';

            $this->attribute['DtTermino']['Type'] 	= 'date';
            $this->attribute['DtTermino']['NN'] 	= 1;
            $this->attribute['DtTermino']['Label'] 	= 'Término da Validade';
            $this->attribute['DtTermino']['Mask'] 	= 'd';

            $this->attribute['UsarDCex']['Type'] 	= 'varchar2';
            $this->attribute['UsarDCex']['Length'] 	= 3;
            $this->attribute['UsarDCex']['Label'] 	= 'Exclusivo DCex';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['DCex_Id'] = 'Pagto_qDCex';

            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Índices
            $this->index['Nome']['Cols'] = "Nome";
            $this->index["Nome"]["Unique"] = 1;


            //Todas as Queries da classe
            $this->query['qDCex'] 			= 'Pagto_qDCex';
            $this->query['qValor'] 			= 'Pagto_qValor';
            $this->query['qUs'] 			= 'Pagto_qUs';
            $this->query['qValorEspecial'] 	= 'Pagto_qValorEspecial';
            $this->query['qGeral'] 			= 'Pagto_qGeral';
            $this->query['qId'] 			= 'Pagto_qId';

                 
        } 
} 