<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ParcelBol extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ParcelBol'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 60000;


            $this->attribute['Parcel_Id']['Type'] 			= 'number';
            $this->attribute['Parcel_Id']['Length'] 		= 15;
            $this->attribute['Parcel_Id']['NN'] 			= 1;
            $this->attribute['Parcel_Id']['Label'] 			= 'Parcelamento';

            $this->attribute['Boleto_Id']['Type'] 			= 'number';
            $this->attribute['Boleto_Id']['Length'] 		= 15;
            $this->attribute['Boleto_Id']['NN']				= 0;
            $this->attribute['Boleto_Id']['Label'] 			= 'Boleto';

            $this->attribute['Mora']['Type'] 				= 'varchar2';
            $this->attribute['Mora']['Length'] 				= 3;
            $this->attribute['Mora']['NN']					= 0;
            $this->attribute['Mora']['Label'] 				= 'Mora';

            $this->attribute['Multa']['Type'] 				= 'varchar2';
            $this->attribute['Multa']['Length'] 			= 3;
            $this->attribute['Multa']['NN']					= 0;
            $this->attribute['Multa']['Label'] 				= 'Multa';

            $this->attribute['DescontoMora']['Type'] 		= 'number';
            $this->attribute['DescontoMora']['Length'] 		= 12.2;
            $this->attribute['DescontoMora']['NN']			= 0;
            $this->attribute['DescontoMora']['Label'] 		= 'Desconto';

            $this->attribute['DescontoMulta']['Type'] 		= 'number';
            $this->attribute['DescontoMulta']['Length'] 	= 12.2;
            $this->attribute['DescontoMulta']['NN']			= 0;
            $this->attribute['DescontoMulta']['Label'] 		= 'Desconto';

            $this->attribute['CESJRepasse_Id']['Type'] 		= 'number';
            $this->attribute['CESJRepasse_Id']['Length'] 	= 15;
            $this->attribute['CESJRepasse_Id']['NN']		= 0;
            $this->attribute['CESJRepasse_Id']['Label'] 	= 'Referencia ao Crйdito Educativo';

            //Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Parcel'] 				= 'ParcelBol_qParcel';

            //Recognizes
            $this->recognize['Recognize'] 			= 'Parcel_Id, Boleto_Id';

            //Нndices
            $this->index['ParcelBoleto']['Cols'] 	= "Parcel_Id Boleto_Id";

            //Todas as Queries da classe
            $this->query['qDistribuicaoDivida'] 	= 'ParcelBol_qDistribuicaoDivida';
            $this->query['qGeral'] 					= 'ParcelBol_qGeral';
            $this->query['qId'] 					= 'ParcelBol_qId';
            $this->query['qParcel'] 				= 'ParcelBol_qParcel';
            $this->query['qParcelCESJ'] 			= 'ParcelBol_qParcelCESJ';
            $this->query['qSelecao'] 				= 'ParcelBol_qSelecao';            
            $this->query['qTotalDivida'] 			= 'ParcelBol_qTotalDivida';
                 
        } 
} 

?>