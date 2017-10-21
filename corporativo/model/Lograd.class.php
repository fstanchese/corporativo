<?php
	require_once ("../engine/Model.class.php");
	
	class Lograd extends Model 
	{
	
		public $table = 'Lograd';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
	
		public function __construct($db)
		{
			$this->db = $db;	
		
			$this->attribute['Bairro_Id']['Type'] 		= 'int';
			$this->attribute['Bairro_Id']['Length']		= 15;
			$this->attribute['Bairro_Id']['NN'] 		= 1;
		
			$this->attribute['Nome']['Type'] 			= 'varchar2';
			$this->attribute['Nome']['Length']			= 40;
			$this->attribute['Nome']['NN'] 				= 1;
				
			$this->attribute['CEP']['Type'] 			= 'number';
			$this->attribute['CEP']['Length']			= 10;
			$this->attribute['CEP']['NN'] 				= 1;

			$this->recognize['Recognize']	= 'CEP, Nome';
			$this->recognize['RecCEP']		= 'CEP';
			$this->recognize['RecNome']		= 'Nome';
			
			
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->query['qId']			= 'Lograd_qId';
			$this->query['qCEP']		= 'Lograd_qCEP';
			$this->query['qSelecao'] 	= 'Lograd_qSelecao'; 
			
		}
		
		
		
		
		
		public function GetEndereco($lograd_id)
		{
			
			$dbData = new DbData($this->db);
			
			$aLograd = $dbData->Row($dbData->Get("SELECT lograd.nome as endereco, lograd.cep, cidade.nome as cidade, bairro.nome as bairro, estado.sigla as uf FROM lograd, bairro, cidade, estado WHERE lograd.bairro_id = bairro.id AND cidade.id = bairro.cidade_id AND estado.id = cidade.estado_id AND lograd.id = '".$lograd_id."'"));
			
			
			
			$arEnd["ENDERECO"] 	= $aLograd["ENDERECO"];
			$arEnd["CEP"] 		= $aLograd["CEP"];
			$arEnd["BAIRRO"]	= $aLograd["BAIRRO"];
			$arEnd["CIDADE"]	= $aLograd["CIDADE"];
			$arEnd["UF"] 		= $aLograd["UF"];
			
			return $arEnd;
			
		}
		
		
	}

?>