<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class WPleito extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'wpleito'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 50;


            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 50;
            $this->attribute['Nome']['NN'] = 1;
            $this->attribute['Nome']['Label'] = 'Nome';

            $this->attribute['InstEns_Id']['Type'] = 'number';
            $this->attribute['InstEns_Id']['Length'] = 15;
            $this->attribute['InstEns_Id']['Label'] = 'Instituiзгo de Ensino';

            $this->attribute['Data']['Type'] = 'date';
            $this->attribute['Data']['Label'] = 'Data';

            $this->attribute['VestTi_Id']['Type'] = 'number';
            $this->attribute['VestTi_Id']['Length'] = 15;
            $this->attribute['VestTi_Id']['NN'] = 1;
            $this->attribute['VestTi_Id']['Label'] = 'Tipo de Pleito';

            $this->attribute['PLetivo_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Id']['Length'] = 15;
            $this->attribute['PLetivo_Id']['Label'] = 'Periodo Letivo';

            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Tipo'] = 'WPleito_qTipo';

            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Нndices
            $this->index['nome']['Cols'] = "nome";
            $this->index["nome"]["Unique"] = 1;


            //Todas as Queries da classe
            $this->query['qGeral'] 		= 'WPleito_qGeral';
            $this->query['qPROUNI'] 	= 'WPleito_qPROUNI';
            $this->query['qVestTi'] 	= 'WPleito_qVestTi';
            $this->query['qId'] 		= 'WPleito_qId';
            $this->query['qPLetivo'] 	= 'WPleito_qPLetivo';

                 
        } 
        
        
        
        public function GetDtProva($wpleito_id)
        {
        	
        	$dbData = new DbData($this->db);
        	 
        	$data = $dbData->Row($dbData->Get("SELECT to_char(data,'dd/mm/yyyy') as data FROM wpleito WHERE id = '".$wpleito_id."'"));

        	return $data[DATA];
        	        	
        	
        }
        
}

?>