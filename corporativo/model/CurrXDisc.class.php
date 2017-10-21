<?php
	require_once ("../engine/Model.class.php");
	
	class CurrXDisc extends Model 
	{
	
		public $table = 'CurrXDisc';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;
			
			$this->attribute['Curr_Id']['Type'] 				= 'number';
			$this->attribute['Curr_Id']['Length']				= 15;
			$this->attribute['Curr_Id']['NN'] 					= 1;

			$this->attribute['Disc_Id']['Type'] 				= 'number';
			$this->attribute['Disc_Id']['Length']				= 15;
			$this->attribute['Disc_Id']['NN'] 					= 1;
			
			$this->attribute['CHSemanal']['Type'] 				= 'number';
			$this->attribute['CHSemanal']['Length']				= 5;
			$this->attribute['CHSemanal']['NN'] 				= 0;
				
			$this->attribute['CHSemanalTeoria']['Type'] 		= 'number';
			$this->attribute['CHSemanalTeoria']['Length']		= 5;
			$this->attribute['CHSemanalTeoria']['NN'] 			= 0;

			$this->attribute['CHSemanalPratica']['Type'] 		= 'number';
			$this->attribute['CHSemanalPratica']['Length']		= 5;
			$this->attribute['CHSemanalPratica']['NN'] 			= 0;

			$this->attribute['CHSemanalLab']['Type'] 			= 'number';
			$this->attribute['CHSemanalLab']['Length']			= 5;
			$this->attribute['CHSemanalLab']['NN'] 				= 0;

			$this->attribute['CHSemanalExerc']['Type'] 			= 'number';
			$this->attribute['CHSemanalExerc']['Length']		= 5;
			$this->attribute['CHSemanalExerc']['NN'] 			= 0;
				
			$this->attribute['DuracXCi_Id']['Type'] 			= 'number';
			$this->attribute['DuracXCi_Id']['Length']			= 15;
			$this->attribute['DuracXCi_Id']['NN'] 				= 0;

			$this->attribute['DiscCat_Id']['Type'] 				= 'number';
			$this->attribute['DiscCat_Id']['Length']			= 15;
			$this->attribute['DiscCat_Id']['NN'] 				= 0;

			$this->attribute['Obrig']['Type'] 					= 'varchar2';
			$this->attribute['Obrig']['Length']					= 3;
			$this->attribute['Obrig']['NN'] 					= 0;

			$this->attribute['DiscSel_Id']['Type'] 				= 'number';
			$this->attribute['DiscSel_Id']['Length']			= 15;
			$this->attribute['DiscSel_Id']['NN'] 				= 0;

			$this->attribute['CargaHoraTi_Id']['Type'] 			= 'number';
			$this->attribute['CargaHoraTi_Id']['Length']		= 15;
			$this->attribute['CargaHoraTi_Id']['NN'] 			= 0;

			$this->attribute['SemSubs']['Type'] 				= 'varchar2';
			$this->attribute['SemSubs']['Length']				= 3;
			$this->attribute['SemSubs']['NN'] 					= 0;

			$this->attribute['SemProva']['Type'] 				= 'varchar2';
			$this->attribute['SemProva']['Length']				= 3;
			$this->attribute['SemProva']['NN'] 					= 0;
				
			$this->attribute['CHTotal']['Type'] 				= 'number';
			$this->attribute['CHTotal']['Length']				= 5;
			$this->attribute['CHTotal']['NN'] 					= 0;

			$this->attribute['CurrXDisc_Teo_Id']['Type'] 		= 'number';
			$this->attribute['CurrXDisc_Teo_Id']['Length']		= 15;
			$this->attribute['CurrXDisc_Teo_Id']['NN'] 			= 0;
			
			$this->attribute['NotaTi_Id']['Type'] 				= 'number';
			$this->attribute['NotaTi_Id']['Length']				= 15;
			$this->attribute['NotaTi_Id']['NN'] 				= 0;
				
			$this->attribute['CursoNivel_Id']['Type'] 			= 'number';
			$this->attribute['CursoNivel_Id']['Length']			= 15;
			$this->attribute['CursoNivel_Id']['NN'] 			= 0;
			
			$this->recognize['Recognize']	= 'Curr_Id, Disc_Id';
			
			//Calculates para a criaзгo de querys no diretуrio SQL
			$this->calculate['Curr']		= 'CurrXDisc_qCurr';
			$this->calculate['Familia']		= 'CurrXDisc_qFamilia';
			$this->calculate['Teoria']		= 'CurrXDisc_qTeoria';
			$this->calculate['Disciplina']	= 'CurrXDisc_qTurmaEsp';
				
			//Todas as Queries da classe
			$this->query['qTurmaEsp']	= "CurrXDisc_qTurmaEsp";
			$this->query['qTeoria']		= "CurrXDisc_qTeoria";
			$this->query['qFamilia']	= "CurrXDisc_qFamilia";
			$this->query['qCurr'] 		= "CurrXDisc_qCurr";
			$this->query['qId'] 		= "CurrXDisc_qId";
			$this->query['qSequencia'] 	= "CurrXDisc_qSequencia";
				
				
		}
	}
?>