<?php
	require_once ("../engine/Model.class.php");
	
	class EmpresaAltN extends Model
	{
	
		public $table = 'EmpresaAltN';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

        public function __construct($db)
        {
        	$this->db = $db;	
		
 			$this->attribute['Empresa_Id']['Type'] 	= 'number';
			$this->attribute['Empresa_Id']['Length'] 	= 15;
			$this->attribute['Empresa_Id']['NN'] 		= 1;
			
			
			$this->attribute['Razao']['Type'] 	= 'varchar2';
			$this->attribute['Razao']['Length'] 		= 100;
			$this->attribute['Razao']['NN'] 			= 1;
			
			$this->attribute['DtInicio']['Type'] 	= 'date';
			$this->attribute['DtInicio']['NN'] 			= 1;

			$this->attribute['DtTermino']['Type'] 	= 'date';
			$this->attribute['DtTermino']['NN'] 	= 1;
				
			$this->index["Empresa_Idx"] = "Empresa_Id";
			
			$this->recognize['Recognize']	= 'Razao, DtInicio, DtTermino';
			
			$this->query["qId"] = "EmpresaAltN_qId";
			$this->query["qGeral"] = "EmpresaAltN_qGeral";
			
			
		}
	
	}
?>