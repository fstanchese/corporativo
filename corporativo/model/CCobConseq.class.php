<?php

	require_once ("../engine/Model.class.php");

	class CCobConseq extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobConseq';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 5000;
		
			$this->attribute['CCobCarta_Id']['Type'] 		= 'number';
			$this->attribute['CCobCarta_Id']['Length'] 		= 15;
			$this->attribute['CCobCarta_Id']['NN'] 			= 1;
			$this->attribute['CCobCarta_Id']['Label'] 		= 'Carta';
			
			
			$this->attribute['CCobConseqTi_Id']['Type'] 		= 'number';
			$this->attribute['CCobConseqTi_Id']['Length'] 	= 15;
			$this->attribute['CCobConseqTi_Id']['NN'] 		= 1;
			$this->attribute['CCobConseqTi_Id']['Label'] 	= 'Tipo de Consequência';
			

			$this->attribute['DtInclusao']['Type'] 			= 'date';
			$this->attribute['DtInclusao']['NN'] 			= 0;
			$this->attribute['DtInclusao']['Label'] 		= 'Data Inclusão';
			
			
			$this->attribute['DtExclusao']['Type'] 		= 'date';
			$this->attribute['DtExclusao']['NN'] 		= 0;
			$this->attribute['DtExclusao']['Label'] 	= 'Data Exclusão';

			
			$this->attribute['Retorno']['Type'] 	= 'varchar2';
			$this->attribute['Retorno']['Length'] 	= 2;
			$this->attribute['Retorno']['NN'] 		= 1;
			$this->attribute['Retorno']['Label'] 	= 'Código Retorno';
			
			
			$this->recognize["Recognize"] = "CCobCarta_Id, CCobConseqTi_Id, DtInclusao, DtExclusao";
			
			$this->index["CCobCarta"]["Cols"] = "CCobCarta_Id";
				
		}
		
		public function GetSCPC($WPessoaId)
		{
			
			$dbData = new DbData($this->db);
			
			$dbData->Get("select ccobconseq.* from ccobconseq, ccobcarta where CCobConseq.CCobCarta_Id = CCobCarta.Id and CCobCarta.WPessoa_Id = '".$WPessoaId."' order by CCobConseq.DtInclusao");
			
			while ($row = $dbData->Row())
			{
				$aConseq[] = $row;
			}
			
			return $aConseq;
		}
		
	}
	
	
?>

