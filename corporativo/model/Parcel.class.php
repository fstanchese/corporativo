<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Parcel extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Parcel'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 20000;


            $this->attribute['WPessoa_Id']['Type'] 				= 'number';
            $this->attribute['WPessoa_Id']['Length'] 			= 15;
            $this->attribute['WPessoa_Id']['NN'] 				= 1;
            $this->attribute['WPessoa_Id']['Label'] 			= 'Aluno';

            $this->attribute['WPessoa_Confessor_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_Confessor_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Confessor_Id']['NN']		= 0;
            $this->attribute['WPessoa_Confessor_Id']['Label'] 	= 'Confessor';

            $this->attribute['WPessoa_Avalista_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_Avalista_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Avalista_Id']['NN']		= 0;
            $this->attribute['WPessoa_Avalista_Id']['Label'] 	= 'Avalista';

            $this->attribute['ParcelPlano_Id']['Type'] 			= 'number';
            $this->attribute['ParcelPlano_Id']['Length'] 		= 15;
            $this->attribute['ParcelPlano_Id']['NN']			= 0;
            $this->attribute['ParcelPlano_Id']['Label'] 		= 'Plano';

            $this->attribute['Parcelas']['Type'] 				= 'number';
            $this->attribute['Parcelas']['Length'] 				= 3;
            $this->attribute['Parcelas']['NN']					= 0;
            $this->attribute['Parcelas']['Mask'] 				= '9';
            $this->attribute['Parcelas']['Label'] 				= 'Parcelas';

            $this->attribute['TaxaMora']['Type'] 				= 'number';
            $this->attribute['TaxaMora']['Length'] 				= '12,4';
            $this->attribute['TaxaMora']['NN']					= 0;
            $this->attribute['TaxaMora']['Label'] 				= 'Taxa de Mora';

            $this->attribute['Desconto']['Type'] 				= 'number';
            $this->attribute['Desconto']['Length'] 				= 12.4;
            $this->attribute['Desconto']['NN']					= 0;
            $this->attribute['Desconto']['Label'] 				= 'Desconto';

            $this->attribute['DescontoPerc']['Type'] 			= 'varchar2';
            $this->attribute['DescontoPerc']['Length'] 			= 3;
            $this->attribute['DescontoPerc']['NN']				= 0;
            $this->attribute['DescontoPerc']['Label'] 			= 'Desconto Pecentual';

            $this->attribute['State_Id']['Type'] 				= 'number';
            $this->attribute['State_Id']['Length'] 				= 15;
            $this->attribute['State_Id']['NN'] 					= 1;
            $this->attribute['State_Id']['Label'] 				= 'Situação';

            $this->attribute['WPessoa_ConjAval_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_ConjAval_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_ConjAval_Id']['NN']		= 0;
            $this->attribute['WPessoa_ConjAval_Id']['Label'] 	= 'Conjuge do Avalista';

            $this->attribute['Campus_Id']['Type'] 				= 'number';
            $this->attribute['Campus_Id']['Length'] 			= 15;
            $this->attribute['Campus_Id']['NN'] 				= 1;
            $this->attribute['Campus_Id']['Label'] 				= 'Campus';

            $this->attribute['FIES_Id']['Type'] 				= 'number';
            $this->attribute['FIES_Id']['Length'] 				= 15;
            $this->attribute['FIES_Id']['NN']					= 0;
            $this->attribute['FIES_Id']['Label'] 				= 'Crédito Educativo';
            
            $this->attribute['NPOk']['Type'] 					= 'varchar2';
            $this->attribute['NPOk']['Length']					= 3;
            $this->attribute['NPOk']['NN'] 						= 0;
            $this->attribute['NPOk']['Label'] 					= 'Nota Promissória Ok';

            $this->attribute['Judicial']['Type'] 			= 'varchar2';
            $this->attribute['Judicial']['Length'] 			= 3;
            $this->attribute['Judicial']['NN']				= 0;
            $this->attribute['Judicial']['Label'] 			= 'Acordo Judicial';  

            $this->attribute['Esccobr']['Type'] 				= 'number';
            $this->attribute['Esccobr']['Length'] 				= 3;
            $this->attribute['Esccobr']['NN']					= 0;
            $this->attribute['Esccobr']['Label'] 				= 'Escritorio de cobrança';
                        
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['IdRecognize'] 			= 'Parcel_qPessoa';

            //Recognizes
			$this->recognize['Recognize'] 				= 'Dt,WPessoa_Id';
            //Índices

            //Todas as Queries da classe
            $this->query['qBoleto'] 					= 'Parcel_qBoleto';
            $this->query['qCountSituacao'] 				= 'Parcel_qCountSituacao';
            $this->query['qDemonstrativoValores'] 		= 'Parcel_qDemonstrativoValores';            
            $this->query['qDemonstrativoValoresCESJ'] 	= 'Parcel_qDemonstrativoValoresCESJ';
            $this->query['qGeral'] 						= 'Parcel_qGeral';
            $this->query['qId'] 						= 'Parcel_qId';
            $this->query['qIdSituacao'] 				= 'Parcel_qIdSituacao';
            $this->query['qPeriodo'] 					= 'Parcel_qPeriodo';
            $this->query['qPessoa'] 					= 'Parcel_qPessoa';
            $this->query['qPessoaAvalConf'] 			= 'Parcel_qPessoaAvalConf';            
            $this->query['qPessoaParcelados'] 			= 'Parcel_qPessoaParcelados';            
            $this->query['qRelacionamentos'] 			= 'Parcel_qRelacionamentos';
            $this->query['qRelacionamentosCount'] 		= 'Parcel_qRelacionamentosCount';
                 
        } 
        
        public function GetValores($ParcelId)
        {
        	$dbData = new DbData($this->db);
        	
        	$aValores = $dbData->Row($dbData->Get("select sum(vlrprincipal) as Principal,
        					sum(vlrmora) as Mora, 
        					sum(vlrmulta) as Multa, 
        					sum(vlrtxfinanc) as TxFinanc,
        					sum(vlrmora)+sum(vlrmulta)+sum(vlrtxfinanc) as Encargos,
        					sum(vlrmora)+sum(vlrmulta)+sum(vlrtxfinanc)+sum(vlrprincipal) as Total   
        					from 
        						parcelxbol 
        					where 
        						parcel_id='$ParcelId'"));
        	
			return $aValores;        	
        }
        
} 