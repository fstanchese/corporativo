<?php
	require_once ("../engine/Model.class.php");
	
	class PLetivo extends Model {
	
		public $table = 'PLetivo';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;	
		
			$this->attribute['Nome']['Type'] 				= 'varchar2';
			$this->attribute['Nome']['Length']				= 20;
			$this->attribute['Nome']['NN'] 					= 1;
			
			$this->attribute['Ciclo_Id']['Type'] 			= 'number';
			$this->attribute['Ciclo_Id']['Length']			= 15;
			$this->attribute['Ciclo_Id']['NN'] 				= 1;

			$this->attribute['Inicio']['Type'] 				= 'date';
			$this->attribute['Inicio']['NN'] 				= 0;

			$this->attribute['Final']['Type'] 				= 'date';
			$this->attribute['Final']['NN'] 				= 0;

			$this->attribute['DtProvao']['Type'] 			= 'date';
			$this->attribute['DtProvao']['NN'] 				= 0;
				
			$this->attribute['PLetivo_Pai_Id']['Type']		= 'number';
			$this->attribute['PLetivo_Pai_Id']['Length']	= 15;
			$this->attribute['PLetivo_Pai_Id']['NN'] 		= 0;

			$this->attribute['Semanas']['Type'] 			= 'int';
			$this->attribute['Semanas']['Length']			= 3;
			$this->attribute['Semanas']['NN'] 				= 0;

			$this->attribute['CriAval_Id']['Type']		 	= 'number';
			$this->attribute['CriAval_Id']['Length']		= 15;
			$this->attribute['CriAval_Id']['NN'] 			= 0;

			$this->attribute['DtSolBolsa']['Type'] 			= 'date';
			$this->attribute['DtSolBolsa']['NN'] 			= 0;

			$this->attribute['AnoCorrente']['Type'] 		= 'varchar2';
			$this->attribute['AnoCorrente']['Length']		= 3;
			$this->attribute['AnoCorrente']['NN'] 			= 0;

			$this->attribute['Geracao']['Type'] 			= 'varchar2';
			$this->attribute['Geracao']['Length']			= 3;
			$this->attribute['Geracao']['NN'] 				= 0;

			$this->attribute['Ano_Id']['Type'] 				= 'number';
			$this->attribute['Ano_Id']['Length']			= 15;
			$this->attribute['Ano_Id']['NN'] 				= 0;
			
			$this->recognize['Recognize']	= 'Nome'; 
			
			$this->calculate['Geral'] 		= "PLetivo_qGeral";
			$this->calculate['DataCiclo']	= "PLetivo_qDataCiclo";				
			$this->calculate['CriAvalAp'] 	= "PLetivo_qCriAvalAp";
				
			$this->query["qGeral"]		= "PLetivo_qGeral";
			$this->query["qId"]			= "PLetivo_qId";
			$this->query["qDataCiclo"]	= "PLetivo_qDataCiclo";				
			$this->query["qCriAvalAp"]	= "PLetivo_qCriAvalAp";
				
		}
		
		public function GetIdAnual()
		{
			$dbData = new DbData($this->db);
			
			$dbData->Get("select id from PLetivo where Ciclo_Id=5400000000001 and AnoCorrente='on'");
			
			$aReturn = $dbData->Row();
			
			return $aReturn["ID"];
			
		}
		
		public function GetIdAtual()
		{
			$dbData = new DbData($this->db);
			
			$dbData->Get("select id from PLetivo where AnoCorrente='on'");
			
			while ($row = $dbData->Row())
			{
				$aReturn[] = $row[ID];				
			}

			return $aReturn;			 
		}

		
		public function GetIdAno($vAno,$vCiclo=null)
		{
			$dbData = new DbData($this->db);
				
			$dbData->Get("select PLetivo.* from PLetivo, Ano where Ano.id = PLetivo.ano_id AND Ano.ano = '$vAno' and ('$vCiclo' is null or Ciclo_Id = '$vCiclo')");
				
			while ($row = $dbData->Row())
			{
				$aReturn[] = $row[ID];
			}
		
			return $aReturn;
		}
		
	}

?>