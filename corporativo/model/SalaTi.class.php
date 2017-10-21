
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class SalaTi extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'SalaTi'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

         
        public function __construct() 
        {

            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length'] 			= 50;
            $this->attribute['Nome']['NN'] 				= 1;
            $this->attribute['Nome']['Label'] 			= 'Tipo';
            $this->attribute['Nome']['Recognize'] 		= '1';

            $this->attribute['SalaTi_Pai_Id']['Type'] 	= 'number';
            $this->attribute['SalaTi_Pai_Id']['Length']	= 15;
            $this->attribute['SalaTi_Pai_Id']['Label'] 	= 'Tipo de Sala Pai';

            $this->attribute['NomeReduzido']['Type'] 	= 'varchar2';
            $this->attribute['NomeReduzido']['Length'] 	= 5;
            $this->attribute['NomeReduzido']['Label'] 	= 'Nome Reduzido';

            $this->recognize['Recognize']	= 'Nome';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['TipoSala'] = 'SalaTi_qGeral';

            //Todas as Queries da classe
            $this->query['gId'] 		= 'SalaTi_qId';
            $this->query['qGeral'] 		= 'SalaTi_qGeral';
            $this->query['qTipoLab'] 	= 'SalaTi_qTipoLab';
        }
    }
                 
?>
