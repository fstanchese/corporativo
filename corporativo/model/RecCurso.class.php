<?php
	require_once ("../engine/Model.class.php");
	
	class RecCurso extends Model {
	
		public $table = 'RecCurso';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();

		
		public function __construct($db)
		{
			$this->db = $db;	

 			$this->attribute['Curso_Id']['Type'] 				= 'number';
			$this->attribute['Curso_Id']['Length']			 	= 15;
			$this->attribute['Curso_Id']['NN'] 					= 1;
			
			$this->attribute['Modalidade_Id']['Type'] 			= 'number';
			$this->attribute['Modalidade_Id']['Length']		 	= 15;
			$this->attribute['Modalidade_Id']['NN'] 			= 1;
				
			$this->attribute['Reconhecimento']['Type'] 			= 'varchar2';
			$this->attribute['Reconhecimento']['Length']	 	= 70;
			$this->attribute['Reconhecimento']['NN'] 			= 1;

			$this->attribute['NomeDiplAnverso']['Type'] 		= 'varchar2';
			$this->attribute['NomeDiplAnverso']['Length']	 	= 200;
			$this->attribute['NomeDiplAnverso']['NN'] 			= 1;

			$this->attribute['NomeDiplVerso']['Type'] 			= 'varchar2';
			$this->attribute['NomeDiplVerso']['Length']	 		= 200;
			$this->attribute['NomeDiplVerso']['NN'] 			= 0;
			
			$this->attribute['Habilitacao']['Type'] 			= 'varchar2';
			$this->attribute['Habilitacao']['Length']	 		= 200;
			$this->attribute['Habilitacao']['NN'] 				= 0;
				
			$this->attribute['Titulo_Id']['Type'] 				= 'number';
			$this->attribute['Titulo_Id']['Length']		 		= 15;
			$this->attribute['Titulo_Id']['NN'] 				= 1;
			$this->attribute['Titulo_Id']['Label'] 				= 'Título';
				
			$this->attribute['RecCurso_Pai_Id']['Type'] 		= 'number';
			$this->attribute['RecCurso_Pai_Id']['Length']		= 15;
			$this->attribute['RecCurso_Pai_Id']['NN'] 			= 1;
			
			$this->attribute['Vigente']['Type'] 				= 'varchar2';
			$this->attribute['Vigente']['Length']	 			= 3;
			$this->attribute['Vigente']['NN'] 					= 0;

			$this->attribute['DtDOU']['Type'] 					= 'date';
			$this->attribute['DtDOU']['NN'] 					= 0;
				
			$this->attribute['Campus_Id']['Type'] 				= 'number';
			$this->attribute['Campus_Id']['Length']		 		= 15;
			$this->attribute['Campus_Id']['NN'] 				= 0;
			
			$this->attribute['NomeHistorico']['Type'] 			= 'varchar2';
			$this->attribute['NomeHistorico']['Length']	 		= 200;
			$this->attribute['NomeHistorico']['NN'] 			= 1;
				
			$this->attribute['NomeAtestado']['Type'] 			= 'varchar2';
			$this->attribute['NomeAtestado']['Length']	 		= 200;
			$this->attribute['NomeAtestado']['NN'] 				= 0;

			$this->attribute['NomeCertificado']['Type'] 		= 'varchar2';
			$this->attribute['NomeCertificado']['Length']	 	= 200;
			$this->attribute['NomeCertificado']['NN'] 			= 0;

			$this->attribute['RecCurso_Filho_Id']['Type'] 		= 'number';
			$this->attribute['RecCurso_Filho_Id']['Length']	 	= 15;
			$this->attribute['RecCurso_Filho_Id']['NN'] 		= 0;
			
			$this->recognize['Recognize']			= 'Curso_Id, Reconhecimento';
			$this->recognize['RetReconhecimento']	= 'Reconhecimento';
			$this->recognize['NomeAtestado']		= 'NomeAtestado';
			
			//Calculates para a criação de querys no diretório SQL
			$this->calculate['RecCursoPai']	= 'RecCurso_qCurso';				
			
			//Todas as Queries da classe
			$this->query['qCurso'] 		= "RecCurso_qCurso";
			$this->query['qId'] 		= "RecCurso_qId";
			$this->query['qDiplProc']	= "RecCurso_qDiplProc";
			$this->query['qVigente']	= "RecCurso_qVigente";
				
			
				
		}
		
		
		public function GetReconhecimentoCurso($Id)
		{
			$aRecPai = $this->GetIdInfo($Id);
				
			if (empty($aRecPai["RECCURSO_FILHO_ID"]))
			{
				$aRet["PORTARIA"] 	= $aRecPai["NOMEATESTADO"] .'<br>'. $aRecPai["RECONHECIMENTO"];
				$aRet["CURSO"]		= $aRecPai["NOMEATESTADO"];
			}
			else
			{
				$aRecFilho = $this->GetIdInfo($aRecPai["RECCURSO_FILHO_ID"]);
				
				if ($aRecPai["RECONHECIMENTO"] != $aRecFilho["RECONHECIMENTO"])
				{
					$aRet["PORTARIA"] 	= $aRecFilho["NOMEATESTADO"] . ' e ' . end(explode('-',$aRecPai["NOMEATESTADO"]))  .'<br>'. $aRecFilho["RECONHECIMENTO"] .'<br>'. $aRecPai["RECONHECIMENTO"];
					$aRet["CURSO"] 		= $aRecFilho["NOMEATESTADO"] . ' e ' . end(explode('-',$aRecPai["NOMEATESTADO"]));
				}
				else
				{
					$aRet["PORTARIA"] 	= $aRecFilho["NOMEATESTADO"] . ' e ' . end(explode('-',$aRecPai["NOMEATESTADO"])) . '<br>' . $aRecPai["RECONHECIMENTO"];
					$aRet["CURSO"] 		= $aRecFilho["NOMEATESTADO"] . ' e ' . end(explode('-',$aRecPai["NOMEATESTADO"]));
				}
			}
				
			return $aRet;
				
		}
			
	}
			
?>