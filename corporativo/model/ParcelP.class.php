<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ParcelP extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ParcelP'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 60000;


            $this->attribute['Parcel_Id']['Type'] 		= 'number';
            $this->attribute['Parcel_Id']['Length'] 	= 15;
            $this->attribute['Parcel_Id']['NN'] 		= 1;
            $this->attribute['Parcel_Id']['Label'] 		= 'Parcelamento';

            $this->attribute['Numero']['Type'] 			= 'number';
            $this->attribute['Numero']['Length'] 		= 3;
            $this->attribute['Numero']['Label'] 		= 'Parcela Numero';

            $this->attribute['DtVencto']['Type'] 		= 'date';
            $this->attribute['DtVencto']['Label'] 		= 'Data de Vencimento';

            $this->attribute['Valor']['Type'] 			= 'number';
            $this->attribute['Valor']['Length'] 		= 12.2;
            $this->attribute['Valor']['Label'] 			= 'Valor';

            $this->attribute['ValorFixo']['Type'] 		= 'varchar2';
            $this->attribute['ValorFixo']['Length'] 	= 3;
            $this->attribute['ValorFixo']['Label'] 		= 'Й Valor Fixo?';
	
            $this->attribute['VlrTxFinanc']['Type'] 	= 'number';
            $this->attribute['VlrTxFinanc']['Length'] 	= 12.2;
            $this->attribute['VlrTxFinanc']['Label'] 	= 'Vlr.Tx.de Financiamento na Parcela';

            $this->attribute['Boleto_Id']['Type'] 		= 'number';
            $this->attribute['Boleto_Id']['Length'] 	= 15;
            $this->attribute['Boleto_Id']['Label'] 		= 'Boleto Destino';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Parcel_Id, Numero, DtVencto, Valor';

            //Нndices
            $this->index['ParcelNumero']['Cols'] = "Parcel_Id Numero";

            //Todas as Queries da classe
            $this->query['qGeral'] 					= 'ParcelP_qGeral';
            $this->query['qDemonstrativoValores']	= 'ParcelP_qDemonstrativoValores';
            $this->query['qId'] 					= 'ParcelP_qId';
            $this->query['qParcelDesc'] 			= 'ParcelP_qParcelDesc';
            $this->query['qSaveCount'] 				= 'ParcelP_qSaveCount';
            $this->query['qParcel'] 				= 'ParcelP_qParcel';
            $this->query['qBoleto'] 				= 'ParcelP_qBoleto';
            $this->query['qCountParcel'] 			= 'ParcelP_qCountParcel';
            $this->query['qSave'] 					= 'ParcelP_qSave';

                 
        } 
} 

?>