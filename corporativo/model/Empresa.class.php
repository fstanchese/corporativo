<?php
	require_once ("../engine/Model.class.php");
	
	class Empresa extends Model
	{
	
		public $table = 'Empresa';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public function __construct($db)
		{
			$this->db = $db;	
		
			$this->attribute['CGC']['Type'] 			= 'varchar2';
			$this->attribute['CGC']['Length'] 			= 14;
			$this->attribute['CGC']['NN'] 				= 1;
			
			$this->attribute['IE']['Type'] 				= 'varchar2';
			$this->attribute['IE']['Length']			= 15;
			$this->attribute['IE']['NN'] 				= 0;
			
			$this->attribute['CCM']['Type'] 			= 'varchar2';
			$this->attribute['CCM']['Length']			= 8;
			$this->attribute['CCM']['NN'] 				= 0;
				
			$this->attribute['Razao']['Type'] 			= 'varchar2';
			$this->attribute['Razao']['Length']			= 100;
			$this->attribute['Razao']['NN'] 			= 1;

			$this->attribute['Fantasia']['Type'] 		= 'varchar2';
			$this->attribute['Fantasia']['Length']		= 50;
			$this->attribute['Fantasia']['NN'] 			= 1;

			$this->attribute['Fone']['Type'] 			= 'varchar2';
			$this->attribute['Fone']['Length']			= 20;
			$this->attribute['Fone']['NN'] 				= 0;
				
			$this->attribute['FoneFax']['Type']			= 'varchar2';
			$this->attribute['FoneFax']['Length']		= 15;
			$this->attribute['FoneFax']['NN'] 			= 0;
				
			$this->attribute['Contato']['Type']			= 'varchar2';
			$this->attribute['Contato']['Length']		= 50;
			$this->attribute['Contato']['NN'] 			= 0;
			
			$this->attribute['Email']['Type'] 			= 'varchar2';
			$this->attribute['Email']['Length']			= 100;
			$this->attribute['Email']['NN'] 			= 0;
				
			$this->attribute['Site']['Type'] 			= 'varchar2';
			$this->attribute['Site']['Length']			= 100;
			$this->attribute['Site']['NN'] 				= 0;
				
			$this->attribute['Lograd_Id']['Type'] 		= 'number';
			$this->attribute['Lograd_Id']['Length']		= 15;
			$this->attribute['Lograd_Id']['NN'] 		= 0;
				
			$this->attribute['EnderNum']['Type']		= 'varchar2';
			$this->attribute['EnderNum']['Length']		= 14;
			$this->attribute['EnderNum']['NN'] 			= 0;
				
			$this->attribute['Fone2']['Type'] 			= 'varchar2';
			$this->attribute['Fone2']['Length']			= 20;
			$this->attribute['Fone2']['NN'] 			= 0;
				
			$this->attribute['CobrancaUSJT']['Type'] 	= 'varchar2';
			$this->attribute['CobrancaUSJT']['Length']	= 15;
			$this->attribute['CobrancaUSJT']['NN'] 		= 0;
				
			$this->recognize['Recognize'] = 'Fantasia';
			
			$this->query["qCobrancaUSJT"] = "Empresa_qCobrancaUSJT";			
			$this->query["qGeral"] = "Empresa_qGeral";
			$this->query["qGrupoAMC"] = "Empresa_qGrupoAMC";
			$this->query["qId"] = "Empresa_qId";
			$this->query["qRamoAtiv"] = "Empresa_qRamoAtiv";
			$this->query["qSelecao"] = "Empresa_qSelecao";
			
			
			
			
		}

	}
?>