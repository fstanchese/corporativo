<?php
	require_once ("../engine/Model.class.php");
 
	class ContabilBol extends Model
	{
	 
		//Mapeamento da tabela do Banco de Dados
		public $table = 'ContabilBol';

	 
		public $attribute     = array();
		public $calculate     = array();
		public $query        = array();
	 

		public $rows;

	 
		public function __construct($db)
		{
		
			$this->db = $db;

			$this->rows = 500000;

			$this->attribute['Boleto_Id']['Type'] 			= 'number';
			$this->attribute['Boleto_Id']['Length'] 		= 15;
			$this->attribute['Boleto_Id']['NN'] 			= 1;
			$this->attribute['Boleto_Id']['Label'] 			= 'Id do Boleto';			

			$this->attribute['BoletoItemTi_Id']['Type'] 	= 'number';
			$this->attribute['BoletoItemTi_Id']['Length'] 	= 15;
			$this->attribute['BoletoItemTi_Id']['NN'] 		= 1;
			$this->attribute['BoletoItemTi_Id']['Label'] 	= 'Item do Boleto';
		
			$this->attribute['Valor']['Type'] 				= 'number';
			$this->attribute['Valor']['Length'] 			= '12,2';
			$this->attribute['Valor']['NN'] 				= 1;
			$this->attribute['Valor']['Label'] 				= 'Valor';

			$this->attribute['TurmaOfe_Id']['Type'] 		= 'number';
			$this->attribute['TurmaOfe_Id']['Length'] 		= 15;
			$this->attribute['TurmaOfe_Id']['NN'] 			= 1;
			$this->attribute['TurmaOfe_Id']['Label'] 		= 'Turma Oferecida';
		
			$this->attribute['Competencia']['Type'] 		= 'varchar2';
			$this->attribute['Competencia']['Length'] 		= 6;
			$this->attribute['Competencia']['Label'] 		= 'Ano Mes';
			$this->attribute['Competencia']['NN']			= 1;		
		
			$this->attribute['Matric_Id']['Type'] 			= 'number';
			$this->attribute['Matric_Id']['Length'] 		= 15;
			$this->attribute['Matric_Id']['NN'] 			= 0;
			$this->attribute['Matric_Id']['Label'] 			= 'Turma Oferecida';
			
			$this->attribute['CCusto_Id']['Type'] 			= 'number';
			$this->attribute['CCusto_Id']['Length'] 		= 15;
			$this->attribute['CCusto_Id']['NN'] 			= 0;
			$this->attribute['CCusto_Id']['Label'] 			= 'Turma Oferecida';			
			
			//Recognizes

		
			//Índices
			$this->index['boleto_id']['Cols'] 	= "boleto_id";

		
			//Todas as Queries da classe

		}
		
		//Retorna informações do boleto que esta na contabilbol.
		function GetBoleto($Boleto_Id,$dBase = '')
		{
		
			if ($dBase == '')
				$dBase = date('d/m/Y');		
		
			$sql = "select
				boleto_id as boleto_id,
				boletoitemti_id as boletoitemti_id,
				replace(contabilbol.valor,',','.') 	as Valor,
				turmaofe_id as turmaofe_id,
				competencia as competencia					
			from
				contabilbol
			where
				to_Date(dt) <= to_Date( '" . $dBase . "')
			and
				contabilbol.boleto_id = '". $Boleto_Id ."'";

			$dbData = new DbData($this->db);
		
			$dbData->Get($sql);
			
			$aReturn = '';
		
			while ($row = $dbData->Row())
			{
				$aReturn[$row['BOLETOITEMTI_ID']]['VALOR']		 = $row['VALOR'];
				$aReturn[$row['BOLETOITEMTI_ID']]['TURMAOFE_ID'] = $row['TURMAOFE_ID'];
				$aReturn[$row['BOLETOITEMTI_ID']]['COMPETENCIA'] = $row['COMPETENCIA'];
			}

			unset($dbData);
		
			return $aReturn;
		}		
		
	}

?>