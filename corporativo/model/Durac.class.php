<?php
	require_once ("../engine/Model.class.php");
	
	class Durac extends Model
	 {
	
		public $table = 'Durac';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		public function __construct($db)
		{
			$this->db = $db;	
		
 			$this->attribute['Nome']['Type'] 		= 'varchar2';
			$this->attribute['Nome']['Length'] 		= 30;
			$this->attribute['Nome']['NN'] 			= 1;
			
			$this->attribute['NrCiclos']['Type'] 	= 'number';
			$this->attribute['NrCiclos']['Length']	= 2;
			$this->attribute['NrCiclos']['NN'] 		= 1;

			$this->attribute['Ciclo_Id']['Type'] 	= 'number';
			$this->attribute['Ciclo_Id']['Length']	= 15;
			$this->attribute['Ciclo_Id']['NN'] 		= 1;

			$this->recognize['Recognize']	= 'Nome';
			
			$this->calculate['Geral']	= 'Durac_qGeral';
			$this->calculate['Ciclo']	= 'Durac_qCiclo';
				
			//Todas as Queries da classe
			$this->query['qId'] 	= "Durac_qId";
			$this->query['qGeral'] 	= "Durac_qGeral";
			$this->query['qCiclo'] 	= "Curso_qCiclo";
				
			
		}

	}

?>