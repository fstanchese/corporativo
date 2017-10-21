<?php
	require_once ("../engine/Model.class.php");
	
	class SisMenu extends Model {
	
		public $table = 'SisMenu';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public function __construct($db)
		{
			$this->db = $db;

			$this->rows = 50000;
		
 			$this->attribute['WPessoa_Id']['Type'] 			= 'int';
			$this->attribute['WPessoa_Id']['Length'] 		= 15;
			
			
			$this->attribute['IndexGUI_Id']['Type'] 		= 'int';
			$this->attribute['IndexGUI_Id']['Length']		= 15;
			

			$this->attribute['Nome']['Type'] 				= 'varchar2';
			$this->attribute['Nome']['Length']				= 30;

			
			$this->attribute['SisMenu_Pai_Id']['Type']	 	= 'int';
			$this->attribute['SisMenu_Pai_Id']['Length']	= 15;
				
			
			$this->attribute['Sistema_Id']['Type']	 		= 'int';
			$this->attribute['Sistema_Id']['Length']		= 15;

			
			$this->attribute['Raiz']['Type'] 				= 'varchar2';
			$this->attribute['Raiz']['Length']				= 3;
				
			$this->recognize['Recognize']	= 'WPessoa_Id, IndexGui_Id';
						
			//Todas as querys da Classe 
			$this->query['qContainer'] 	= "SisMenu_qPessoaContainer";
			$this->query['qRaiz'] 		= "SisMenu_qPessoaRaiz";
			$this->query['qMenu'] 		= "SisMenu_qPessoaMenu";
			$this->query['qNome'] 		= "SisMenu_qPessoaNome";
		}
		
	}

?>