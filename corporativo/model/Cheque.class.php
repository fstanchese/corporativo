<?php

    require_once ("../engine/Model.class.php");

    class Cheque extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table 	= 'Cheque'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query         = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['WPessoa_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Id']['Label'] 	= 'Aluno';

            $this->attribute['Banco_Id']['Type'] 		= 'number';
            $this->attribute['Banco_Id']['Length'] 		= 15;
            $this->attribute['Banco_Id']['NN'] 			= 1;
            $this->attribute['Banco_Id']['Label'] 		= 'Banco';

            $this->attribute['Agencia']['Type'] 		= 'varchar2';
            $this->attribute['Agencia']['Length'] 		= 15;
            $this->attribute['Agencia']['NN'] 			= 1;
            $this->attribute['Agencia']['Label'] 		= 'Agência';

            $this->attribute['Conta']['Type'] 			= 'varchar2';
            $this->attribute['Conta']['Length'] 		= 15;
            $this->attribute['Conta']['NN'] 			= 1;
            $this->attribute['Conta']['Label'] 			= 'Número da Conta';

            $this->attribute['Numero']['Type'] 			= 'varchar2';
            $this->attribute['Numero']['Length'] 		= 10;
            $this->attribute['Numero']['NN'] 			= 1;
            $this->attribute['Numero']['Label'] 		= 'Número do Cheque';

            $this->attribute['Valor']['Type'] 			= 'number';
            $this->attribute['Valor']['Length'] 		= 12.2;
            $this->attribute['Valor']['NN'] 			= 1;
            $this->attribute['Valor']['Label'] 			= 'Valor';

            $this->attribute['DtEmissao']['Type'] 		= 'date';
            $this->attribute['DtEmissao']['Label'] 		= 'Data de Emissão';
            $this->attribute['DtEmissao']['Mask'] 		= 'd';

            $this->attribute['OutroEmitente']['Type']	= 'varchar2';
            $this->attribute['OutroEmitente']['Length']	= 40;
            $this->attribute['OutroEmitente']['Label'] 	= 'Outro Emitente';

            $this->attribute['Empresa_Id']['Type'] 		= 'number';
            $this->attribute['Empresa_Id']['Length'] 	= 15;
            $this->attribute['Empresa_Id']['Label'] 	= 'Empresa';

            $this->recognize['Recognize']	= 'Banco_Id, Agencia, Conta, Numero, Valor';
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qEmAberto'] 		= 'Cheque_qEmAberto';
            $this->query['qWPessoa'] 		= 'Cheque_qWPessoa';
            $this->query['qPessoaEmpresa']	= 'Cheque_qPessoaEmpresa';
            $this->query['qSelecao'] 		= 'Cheque_qSelecao';
            $this->query['qGeral'] 			= 'Cheque_qGeral';
            $this->query['qId'] 			= 'Cheque_qId';

                            
        }
        
        public function EmAberto($WPessoaId)
        {
        	$dbData 	= new DbData($this->db);
        	$dbData2 	= new DbData($this->db);
        	
        	$dbData->Get("select id from cheque where wpessoa_id='".$WPessoaId."'");
        	
        	while($row = $dbData->Row())
        	{
        		$dbData2->Get($this->Query("qEmAberto",array("p_Cheque_Id"=>$row["ID"])));
        		
        		$aEmAberto = $dbData2->Row();
        		 
        		if ($aEmAberto["CHEQUEMOVTI_ID"] == 16600000000002 || $aEmAberto["CHEQUEMOVTI_ID"] == 16600000000004)
        		{
        			$aRet = $aEmAberto;
        		}  
        		
        	}
        	
        	return $aRet;
        	
       }
}
?> 