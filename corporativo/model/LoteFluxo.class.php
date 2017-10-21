<?php

	require_once ("../engine/Model.class.php");

	class LoteFluxo extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'LoteFluxo';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 50000;
		
			$this->attribute['LoteProc_Id']['Type']			= 'number';
			$this->attribute['LoteProc_Id']['Length']		= 15;
			$this->attribute['LoteProc_Id']['NN']	 		= 1;
			$this->attribute['LoteProc_Id']['Label'] 		= 'Tipo de Processo de Lote';
			
				
			$this->attribute['Sala_Id']['Type']				= 'number';
			$this->attribute['Sala_Id']['Length']			= 15;
			$this->attribute['Sala_Id']['NN']	 			= 0;
			$this->attribute['Sala_Id']['Label'] 			= 'Sala';
				
			$this->attribute['Campus_Id']['Type']			= 'number';
			$this->attribute['Campus_Id']['Length']			= 15;
			$this->attribute['Campus_Id']['NN']	 			= 1;
			$this->attribute['Campus_Id']['Label'] 			= 'Unidade';
				
			$this->attribute['Depart_Id']['Type']			= 'number';
			$this->attribute['Depart_Id']['Length']			= 15;
			$this->attribute['Depart_Id']['NN']	 			= 0;
			$this->attribute['Depart_Id']['Label'] 			= 'Departamento';
				
			$this->attribute['DtRecebimento']['Type']		= 'date';
			$this->attribute['DtRecebimento']['NN']	 		= 0;
			$this->attribute['DtRecebimento']['Label'] 		= 'Data de Recebimento';
			
			
			$this->attribute['Numero']['Type']				= 'number';
			$this->attribute['Numero']['Length']			= 5;
			$this->attribute['Numero']['NN']		 		= 1;
			$this->attribute['Numero']['Label'] 			= 'Número do Lote';
			
			$this->attribute['CAEvXWPes_Id']['Type']		= 'number';
			$this->attribute['CAEvXWPes_Id']['Length']		= 15;
			$this->attribute['CAEvXWPes_Id']['NN']	 		= 1;
			$this->attribute['CAEvXWPes_Id']['Label'] 		= 'Pessoa X Evento';
			
			$this->attribute['DocTi_Id']['Type']			= 'number';
			$this->attribute['DocTi_Id']['Length']			= 15;
			$this->attribute['DocTi_Id']['NN']	 			= 1;
			$this->attribute['DocTi_Id']['Label'] 			= 'Tipo de Documento';

			$this->attribute['WPessoa_Rec_Id']['Type']		= 'number';
			$this->attribute['WPessoa_Rec_Id']['Length']	= 15;
			$this->attribute['WPessoa_Rec_Id']['NN']	 	= 1;
			$this->attribute['WPessoa_Rec_Id']['Label'] 	= 'Tipo de Documento';
			
			
			$this->attribute['CASenha_Id']['Type']			= 'number';
			$this->attribute['CASenha_Id']['Length']		= 15;
			$this->attribute['CASenha_Id']['NN']	 		= 0;
			$this->attribute['CASenha_Id']['Label'] 		= 'Senha';
			
			$this->attribute['EnvSecretaria']['Type']		= 'varchar2';
			$this->attribute['EnvSecretaria']['Length']		= 3;
			$this->attribute['EnvSecretaria']['NN']	 		= 0;
			$this->attribute['EnvSecretaria']['Label'] 		= 'Envia para Secretaria';
			
				
			$this->calculate['Geral']		= 'LoteFluxo_qGeral';
		
			$this->recognize['Recognize'] 	= 'LoteProc_Id,Numero,CAEvXWPes_Id,Campus_Id,Sala_Id,Depart_Id';

		
			$this->query['Geral']			= 'LoteFluxo_qGeral';
			$this->query['Id']				= 'LoteFluxo_qId';
			
		}
		
		

		public function GetNextLoteNum()
		{
				
			$dbData = new DbData($this->db);
				
			$nextNum = $dbData->Row($dbData->Get("SELECT max(numero) as numero FROM lotefluxo"));
				
			if($nextNum[NUMERO] == "") return 1; else return $nextNum[NUMERO]+1;
				
				
		}
		
		
		
	}
	
	
?>