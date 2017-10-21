
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class SAASenha extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'SAASenha'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10000;


            $this->attribute['Numero']['Type'] 			= 'number';
            $this->attribute['Numero']['Length'] 		= 3;
            $this->attribute['Numero']['NN'] 			= 1;
            $this->attribute['Numero']['Label'] 		= 'Número';

            $this->attribute['SAAMesa_Id']['Type'] 		= 'number';
            $this->attribute['SAAMesa_Id']['Length'] 	= 15;
            $this->attribute['SAAMesa_Id']['Label'] 	= 'Mesa de atendimento';
            $this->attribute['SAAMesa_Id']['NN']		= 0;

            $this->attribute['Chamar']['Type'] 			= 'date';
            $this->attribute['Chamar']['NN']			= 0;

            $this->attribute['Chamada']['Type'] 		= 'date';
            $this->attribute['Chamada']['NN']			= 0;

            $this->attribute['Prioridade']['Type'] 		= 'varchar2';
            $this->attribute['Prioridade']['Length'] 	= 3;
            $this->attribute['Prioridade']['NN']		= 0;

            $this->attribute['Cancelada']['Type'] 		= 'date';
            $this->attribute['Cancelada']['NN']			= 0;

            $this->attribute['Atendida']['Type'] 		= 'date';
            $this->attribute['Atendida']['NN']			= 0;

            $this->attribute['Campus_Id']['Type'] 		= 'number';
            $this->attribute['Campus_Id']['Length'] 	= 15;
            $this->attribute['Campus_Id']['Label'] 		= 'Campus';
            $this->attribute['Campus_Id']['NN']			= 0;

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = "Numero";
            //Índices

            //Todas as Queries da classe
            $this->query['qChamar'] 	= 'SAASenha_qChamar';
            $this->query['qChamada'] 	= 'SAASenha_qChamada';
            $this->query['qGeral'] 		= 'SAASenha_qGeral';

                 
        } 
} 