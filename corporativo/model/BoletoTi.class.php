<?php
	require_once ("../engine/Model.class.php");
	
	class BoletoTi extends Model {
	
		public $table = 'BoletoTi';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;
			
			$this->rows = 30;
		
 			$this->attribute['Nome']['Type'] 		= 'varchar2';
			$this->attribute['Nome']['Length'] 		= 22;
			$this->attribute['Nome']['NN'] 			= 1;
			
			$this->attribute['Imprimir']['Type'] 	= 'varchar2';
			$this->attribute['Imprimir']['Length'] 	= 3;
			$this->attribute['Imprimir']['NN'] 		= 0;
			
			$this->attribute['Parcelar']['Type'] 	= 'varchar2';
			$this->attribute['Parcelar']['Length']	= 3;
			$this->attribute['Parcelar']['NN']		= 0;

			$this->attribute['Exibir']['Type'] 		= 'varchar2';
			$this->attribute['Exibir']['Length']	= 3;
			$this->attribute['Exibir']['NN']		= 0;
			
			$this->calculate['Geral'] 		= 'BoletoTi_qGeral';
			$this->calculate['CCob'] 		= 'BoletoTi_qCCob';
			
			$this->recognize['Recognize']	= 'Nome';
			
			$this->query["qGeral"]			= "BoletoTi_qGeral";
			$this->query["qId"] 			= "BoletoTi_qId";
			$this->query["qCCob"]			= "BoletoTi_qCCob";
						
		}
		
	}

?>
