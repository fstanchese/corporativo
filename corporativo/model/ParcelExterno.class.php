<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ParcelExterno extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ParcelExterno'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10000;


            $this->attribute['Parcel_Id']['Type'] 		= 'number';
            $this->attribute['Parcel_Id']['Length'] 	= 15;
            $this->attribute['Parcel_Id']['NN'] 		= 1;
            $this->attribute['Parcel_Id']['Label'] 		= 'Parcelamento';
            
            $this->attribute['Empresa_Id']['Type'] 		= 'number';
            $this->attribute['Empresa_Id']['Length'] 	= 15;
            $this->attribute['Empresa_Id']['NN'] 		= 1;
            $this->attribute['Empresa_Id']['Label']		= 'Empresa';
            
            $this->attribute['DtAcordo']['Type'] 		= 'date';
            $this->attribute['DtAcordo']['NN']	 		= 1;
            $this->attribute['DtAcordo']['Label'] 		= 'Data do Acordo';
            

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Parcel_Id, Empresa_Id, DtAcordo';

            //Нndices
            $this->index['Parcel']['Cols'] = "Parcel_Id";

            //Todas as Queries da classe
            $this->query['qGeral'] 					= 'ParcelExterno_qGeral';
            $this->query['qId'] 					= 'ParcelExterno_qId';


                 
        } 
} 

?>