<?php
	require_once ("../engine/Model.class.php");
	
	class Curso extends Model 
	{
	
		public $table = 'Curso';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public function __construct($db)
		{
			$this->db = $db;	

 			$this->attribute['Codigo']['Type'] 					= 'varchar2';
			$this->attribute['Codigo']['Length']			 	= 15;
			$this->attribute['Codigo']['NN'] 					= 0;

 			$this->attribute['Nome']['Type'] 					= 'varchar2';
			$this->attribute['Nome']['Length'] 					= 250;
			$this->attribute['Nome']['NN'] 						= 1;

 			$this->attribute['CursoNivel_Id']['Type'] 			= 'number';
			$this->attribute['CursoNivel_Id']['Length'] 		= 15;
			$this->attribute['CursoNivel_Id']['NN'] 			= 1;

 			$this->attribute['InstEns_Id']['Type']			 	= 'number';
			$this->attribute['InstEns_Id']['Length']		 	= 15;
			$this->attribute['InstEns_Id']['NN'] 				= 1;

 			$this->attribute['Facul_Id']['Type']	 			= 'number';
			$this->attribute['Facul_Id']['Length'] 				= 15;
			$this->attribute['Facul_Id']['NN'] 					= 1;
	
 			$this->attribute['Provao']['Type'] 					= 'varchar2';
			$this->attribute['Provao']['Length'] 				= 3;
			$this->attribute['Provao']['NN'] 					= 0;

 			$this->attribute['PLetivo_Inicial_Id']['Type'] 		= 'number';
			$this->attribute['PLetivo_Inicial_Id']['Length'] 	= 15;
			$this->attribute['PLetivo_Inicial_Id']['NN'] 		= 0;

 			$this->attribute['PLetivo_Curric_Id']['Type']	 	= 'number';
			$this->attribute['PLetivo_Curric_Id']['Length'] 	= 15;
			$this->attribute['PLetivo_Curric_Id']['NN'] 		= 1;

 			$this->attribute['CodProvao']['Type'] 				= 'varchar2';
			$this->attribute['CodProvao']['Length'] 			= 10;
			$this->attribute['CodProvao']['NN'] 				= 0;

 			$this->attribute['NomeProvao']['Type'] 				= 'varchar2';
			$this->attribute['NomeProvao']['Length'] 			= 100;
			$this->attribute['NomeProvao']['NN'] 				= 0;

 			$this->attribute['Depart_Id']['Type']			 	= 'number';
			$this->attribute['Depart_Id']['Length'] 			= 15;
			$this->attribute['Depart_Id']['NN'] 				= 1;

 			$this->attribute['WPessoa_AtivComp_Id']['Type'] 	= 'number';
			$this->attribute['WPessoa_AtivComp_Id']['Length'] 	= 15;
			$this->attribute['WPessoa_AtivComp_Id']['NN'] 		= 0;

 			$this->attribute['NomeRed']['Type'] 				= 'varchar2';
			$this->attribute['NomeRed']['Length'] 				= 40;
			$this->attribute['NomeRed']['NN'] 					= 0;

 			$this->attribute['AreaFormacao']['Type'] 			= 'varchar2';
			$this->attribute['AreaFormacao']['Length'] 			= 1;
			$this->attribute['AreaFormacao']['NN'] 				= 0;
			
			$this->recognize['Recognize']	= 'Nome';
			//Calculates para a criaзгo de querys no diretуrio SQL
			
			$this->calculate['CursoColacao']	= 'Curso_qColacao';
			$this->calculate['CursoUSJT']		= 'Curso_qUSJT';
			$this->calculate['CursoNivel']		= 'Curso_qNivel';
			$this->calculate['CursoCampus']		= 'Curso_qCampus';
				
			//Todas as Queries da classe
			$this->query['qAlunos']				= "Curso_qAlunos";
			$this->query['qAlunosTurmaEsp']		= "Curso_qAlunosTurmaEsp";
			$this->query['qCampus']				= "Curso_qCampus";
			$this->query['qColacao']			= "Curso_qColacao";
			$this->query['qCoordenador']		= "Curso_qCoordenador";
			$this->query['qDisciplina']			= "Curso_qDisciplina";
			$this->query['qFacul']				= "Curso_qFacul";
			$this->query['qGeral']				= "Curso_qGeral";
			$this->query['qGeralUSJT']			= "Curso_qGeralUSJT";
			$this->query['qId'] 				= "Curso_qId";
			$this->query['qInst']				= "Curso_qInst";
			$this->query['qInstExt']			= "Curso_qInstExt";
			$this->query['qInstituicao']		= "Curso_qInstituicao";
			$this->query['qInstituicaoLato']	= "Curso_qInstituicaoLato";
			$this->query['qUSJT'] 				= "Curso_qUSJT";
			$this->query['qNivel'] 				= "Curso_qNivel";
			$this->query['qNivelProvao']		= "Curso_qNivelProvao";
			$this->query['qPesquisa']			= "Curso_qPesquisa";
			$this->query['qProvao']				= "Curso_qProvao";
			$this->query['qSerie']				= "Curso_qSerie";
			$this->query['qUSJT']				= "Curso_qUSJT";
			$this->query['qUSJTCursoSel']		= "Curso_qUSJTCursoSel";
			$this->query['qUSJTGrad']			= "Curso_qUSJTGrad";
			$this->query['qUSJTLato']			= "Curso_qUSJTLato";
			$this->query['qUSJTLatoStricto']	= "Curso_qUSJTLatoStricto";
			$this->query['qUSJTMat']			= "Curso_qUSJTMat";
			$this->query['qUSJTNivel']			= "Curso_qUSJTNivel";
			$this->query['qUSJTPeriodo']		= "Curso_qUSJTPeriodo";
			$this->query['qUSJTPos']			= "Curso_qUSJTPos";
			$this->query['qVest']				= "Curso_qVest";
			
				
		}
		
	}

?>