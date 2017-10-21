<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ContabilFech extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ContabilFech'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 100;


            $this->attribute['Competencia']['Type'] = 'number';
            $this->attribute['Competencia']['Length'] = 6;
            $this->attribute['Competencia']['NN'] = 1;
            $this->attribute['Competencia']['Label'] = 'Competencia AAAAMM';

            $this->attribute['DtFechamento']['Type'] = 'date';
            $this->attribute['DtFechamento']['Label'] = 'Data do Fechamento';
            $this->attribute['DtFechamento']['Mask'] = 'd';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Competencia';

            //Нndices

            //Todas as Queries da classe
            $this->query['qBoletos'] = 'ContabilFech_qBoletos';            
            
                 
        } 
        
        //Retorna ultima competencia fechada da contabilidade.
        function GetUltimaFechada()
        {
        
        	$sql = "select
            				max(competencia) as competencia
            			from
            				contabilfech
            			where
            				dtfechamento is not null";
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        
        	$aReturn = '';
        
        	while ($row = $dbData->Row())
        	{
        		$aReturn['COMPETENCIA'] = $row['COMPETENCIA'];
        	}
        
        	unset($dbData);
        
        	return $aReturn;
        	 
        }
        
}
 
?>