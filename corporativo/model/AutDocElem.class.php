<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AutDocElem extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AutDocElem'; 

         
        public $attribute	= array(); 
        public $calculate 	= array(); 
        public $query     	= array();

         
        public function __construct($db) 
        {
        	$this->db = $db;

        	$this->rows = 200000; 
        	
            $this->attribute['AutDoc_Id']['Type'] 	= 'number';
            $this->attribute['AutDoc_Id']['Length']	= 15;
            $this->attribute['AutDoc_Id']['NN'] 	= 1;
            $this->attribute['AutDoc_Id']['Label'] 	= 'Autenticação do Documento';


            $this->attribute['Tag']['Type'] 		= 'varchar2';
            $this->attribute['Tag']['Length']		= 30;
            $this->attribute['Tag']['NN'] 			= 1;
            $this->attribute['Tag']['Label'] 		= 'Tag';
            
            $this->attribute['Valor']['Type'] 		= 'varchar2';
            $this->attribute['Valor']['Length']		= 250;
            $this->attribute['Valor']['NN'] 		= 1;
            $this->attribute['Valor']['Label'] 		= 'Valor';
            
            $this->recognize['Recognize'] 	= 'AutDoc_Id, Tag';
            //Calculates para a criação de querys no diretório SQL
            
            $this->index["AutDocTag"]["Cols"]	= "AutDoc_Id, Tag";
            $this->index["AutDocTag"]["Unique"] 	= 0;
            
            //Todas as Queries da classe
            $this->query['qGeral'] 		= 'AutDocElem_qGeral';
            $this->query['qId'] 		= 'AutDocElem_qId';
            $this->query['qTag']		= 'AutDocElem_qValor';
                 
        } 
        
        
        public function GetValor($AutDoc_Id,$Tag)
        {
        	
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get($this->Query("qTag",array("p_AutDocElem_AutDoc_Id"=>$AutDoc_Id,"p_AutDocElem_Tag"=>$Tag)));
        	
        	$row = $dbData->Row();
        	
        	return $row[VALOR];
        	
        }
        
        
	} 

?>
