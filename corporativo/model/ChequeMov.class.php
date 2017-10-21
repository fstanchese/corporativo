<?php

    require_once ("../engine/Model.class.php");

    class ChequeMov extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'ChequeMov'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();

        
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Cheque_Id']['Type'] 			= 'number';
            $this->attribute['Cheque_Id']['Length'] 		= 15;
            $this->attribute['Cheque_Id']['NN'] 			= 1;
            $this->attribute['Cheque_Id']['Label'] 			= 'Cheque';
            $this->attribute['Cheque_Id']['Recognize'] 		= '3';

            $this->attribute['Alinea_Id']['Type'] 			= 'number';
            $this->attribute['Alinea_Id']['Length'] 		= 15;
            $this->attribute['Alinea_Id']['NN'] 			= 1;
            $this->attribute['Alinea_Id']['Label'] 			= 'Alínea';

            $this->attribute['ChequeMovTi_Id']['Type'] 		= 'number';
            $this->attribute['ChequeMovTi_Id']['Length'] 	= 15;
            $this->attribute['ChequeMovTi_Id']['NN'] 		= 1;
            $this->attribute['ChequeMovTi_Id']['Label'] 	= 'Tipo de Movimento';
            $this->attribute['ChequeMovTi_Id']['Recognize']	= '1';

            $this->attribute['VlrPago']['Type'] 			= 'number';
            $this->attribute['VlrPago']['Length'] 			= 12.2;
            $this->attribute['VlrPago']['Label'] 			= 'Valor Pago';

            $this->attribute['DtMovimento']['Type'] 		= 'date';
            $this->attribute['DtMovimento']['NN'] 			=	1;
            $this->attribute['DtMovimento']['Mask'] 		= 'd';
            $this->attribute['DtMovimento']['Label'] 		= 'Data do Movimento';
            $this->attribute['DtMovimento']['Recognize'] 	= '2';

            $this->attribute['Empresa_Id']['Type'] 			= 'number';
            $this->attribute['Empresa_Id']['Length'] 		= 15;
            $this->attribute['Empresa_Id']['Label'] 		= 'Empresa de Cobrança';

            $this->recognize['Recognize'] 	= 'ChequeMovTi_Id, DtMovimento, Cheque_Id';
            
            //Calculates para a criação de querys no diretório SQL

            
            //Todas as Queries da classe
            $this->query['qId'] 				= 'ChequeMov_qId';
            $this->query['qExtrato'] 			= 'ChequeMov_qExtrato';
            $this->query['qCobrancaExterna']	= 'ChequeMov_qCobrancaExterna';
            $this->query['qMovimento'] 			= 'ChequeMov_qMovimento';
            $this->query['qCheque'] 			= 'ChequeMov_qCheque';

                            
        }
}
?> 