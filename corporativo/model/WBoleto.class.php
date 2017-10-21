
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class WBoleto extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'WBoleto'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 500000;


            $this->attribute['wpessoa_sacado_id']['Type'] 		= 'number';
            $this->attribute['wpessoa_sacado_id']['Length'] 	= 15;
            $this->attribute['wpessoa_sacado_id']['Label'] 		= 'Sacado';
            $this->attribute['wpessoa_sacado_id']['NN']			= 0;
            
            $this->attribute['dtemissao']['Type'] 				= 'date';
            $this->attribute['dtemissao']['Label'] 				= 'Emissão';
            $this->attribute['dtemissao']['NN']					= 0;

            $this->attribute['dtgeracao']['Type'] 				= 'date';
            $this->attribute['dtgeracao']['Label'] 				= 'Geração';
            $this->attribute['dtgeracao']['NN']					= 0;

            $this->attribute['dtvencto']['Type'] 				= 'date';
            $this->attribute['dtvencto']['Label'] 				= 'Vencimento';
            $this->attribute['dtvencto']['NN']					= 0;

            $this->attribute['dtpagto']['Type'] 				= 'date';
            $this->attribute['dtpagto']['Label'] 				= 'Pagamento';
            $this->attribute['dtpagto']['NN']					= 0;

            $this->attribute['ref']['Type'] 					= 'varchar2';
            $this->attribute['ref']['Length'] 					= 20;
            $this->attribute['ref']['NN'] 						= 1;
            $this->attribute['ref']['Label'] 					= 'Referência';

            $this->attribute['valor']['Type'] 					= 'number';
            $this->attribute['valor']['Length'] 				= 12.2;
            $this->attribute['valor']['NN'] 					= 1;
            $this->attribute['valor']['Label'] 					= 'Valor';

            $this->attribute['valorpago']['Type'] 				= 'number';
            $this->attribute['valorpago']['Length'] 			= 12.2;
            $this->attribute['valorpago']['Label'] 				= 'Valor';
            $this->attribute['valorpago']['NN']					= 0;

            $this->attribute['nossonr']['Type'] 				= 'number';
            $this->attribute['nossonr']['Length'] 				= 13;
            $this->attribute['nossonr']['NN'] 					= 1;
            $this->attribute['nossonr']['Label'] 				= 'Nosso Número';

            $this->attribute['nrdoc']['Type'] 					= 'number';
            $this->attribute['nrdoc']['Length'] 				= 13;
            $this->attribute['nrdoc']['NN'] 					= 1;
            $this->attribute['nrdoc']['Label'] 					= 'Número do Documento';

            $this->attribute['especie']['Type'] 				= 'varchar2';
            $this->attribute['especie']['Length'] 				= 10;
            $this->attribute['especie']['NN'] 					= 1;
            $this->attribute['especie']['Label'] 				= 'Espécie';

            $this->attribute['aceite']['Type'] 					= 'varchar2';
            $this->attribute['aceite']['Length'] 				= 5;
            $this->attribute['aceite']['Label'] 				= 'Aceite';
            $this->attribute['aceite']['NN']					= 0;

            $this->attribute['carteira']['Type'] 				= 'varchar2';
            $this->attribute['carteira']['Length'] 				= 10;
            $this->attribute['carteira']['Label'] 				= 'Carteira';
            $this->attribute['carteira']['NN']					= 0;

            $this->attribute['state_id']['Type'] 				= 'number';
            $this->attribute['state_id']['Length'] 				= 15;
            $this->attribute['state_id']['Label'] 				= 'Estado';
            $this->attribute['state_id']['NN']					= 0;

            $this->attribute['instrucoes']['Type'] 				= 'varchar2';
            $this->attribute['instrucoes']['Length'] 			= 400;
            $this->attribute['instrucoes']['Label'] 			= 'Instruções';
            $this->attribute['instrucoes']['NN']				= 0;

            $this->attribute['composicao']['Type'] 				= 'varchar2';
            $this->attribute['composicao']['Length'] 			= 350;
            $this->attribute['composicao']['Label'] 			= 'Composição';
            $this->attribute['composicao']['NN']				= 0;

            $this->attribute['agencia']['Type'] 				= 'varchar2';
            $this->attribute['agencia']['Length'] 				= 5;
            $this->attribute['agencia']['Label'] 				= 'Agência';
            $this->attribute['agencia']['NN']					= 0;

            $this->attribute['contaCorrente']['Type'] 			= 'varchar2';
            $this->attribute['contaCorrente']['Length'] 		= 10;
            $this->attribute['contaCorrente']['Label'] 			= 'Conta Corrente';
            $this->attribute['contaCorrente']['NN']				= 0;

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'nossonr';
            //Índices
            $this->index['pessoa']['Cols'] = "wpessoa_sacado_id";


            //Todas as Queries da classe
            $this->query['qGeral'] 			= 'WBoleto_qGeral';
            $this->query['qTeste2'] 		= 'WBoleto_qTeste2';
            $this->query['qVest'] 			= 'WBoleto_qVest';
            $this->query['qPendente'] 		= 'WBoleto_qPendente';
            $this->query['qInscricao'] 		= 'WBoleto_qInscricao';
            $this->query['qNrDoc'] 			= 'WBoleto_qNrDoc';
            $this->query['qId'] 			= 'WBoleto_qId';
            $this->query['qCountPendente'] 	= 'WBoleto_qCountPendente';
            $this->query['qPesRef'] 		= 'WBoleto_qPesRef';
            $this->query['qConsulta'] 		= 'WBoleto_qConsulta';
            $this->query['qCountDebito'] 	= 'WBoleto_qCountDebito';
            $this->query['qAbertos'] 		= 'WBoleto_qAbertos';
            $this->query['qTeste'] 			= 'WBoleto_qTeste';

                 
        } 
} 