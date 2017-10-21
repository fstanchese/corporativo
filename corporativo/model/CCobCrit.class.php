<?php

	require_once ("../engine/Model.class.php");

	class CCobCrit extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobCrit';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 5000;
		
			$this->attribute['CCobProc_Id']['Type'] 		= 'number';
			$this->attribute['CCobProc_Id']['Length'] 		= 15;
			$this->attribute['CCobProc_Id']['NN'] 			= 1;
			$this->attribute['CCobProc_Id']['Label'] 		= 'Proceso';
			
			$this->attribute['CCobCartaTi_Id']['Type'] 		= 'number';
			$this->attribute['CCobCartaTi_Id']['Length'] 	= 15;
			$this->attribute['CCobCartaTi_Id']['NN'] 		= 1;
			$this->attribute['CCobCartaTi_Id']['Label'] 	= 'Tipo de Carta';
			
			$this->attribute['BoletoTi_Id']['Type'] 		= 'number';
			$this->attribute['BoletoTi_Id']['Length'] 	= 15;
			$this->attribute['BoletoTi_Id']['NN'] 		= 0;
			$this->attribute['BoletoTi_Id']['Label'] 	= 'Tipo de Boleto';
			
			$this->attribute['State_Matric_Id']['Type'] 	= 'number';
			$this->attribute['State_Matric_Id']['Length'] 	= 15;
			$this->attribute['State_Matric_Id']['NN'] 		= 0;
			$this->attribute['State_Matric_Id']['Label'] 	= 'Situação Matrícula';
			
			$this->attribute['Curso_Id']['Type'] 	= 'number';
			$this->attribute['Curso_Id']['Length'] 	= 15;
			$this->attribute['Curso_Id']['NN'] 		= 0;
			$this->attribute['Curso_Id']['Label'] 	= 'Curso';
			
			$this->attribute['CursoNivel_Id']['Type'] 	= 'number';
			$this->attribute['CursoNivel_Id']['Length'] 	= 15;
			$this->attribute['CursoNivel_Id']['NN'] 		= 0;
			$this->attribute['CursoNivel_Id']['Label'] 	= 'Nível do Curso';
			
			$this->attribute['Qtde']['Type'] 	= 'number';
			$this->attribute['Qtde']['Length'] 	= 5;
			$this->attribute['Qtde']['NN'] 		= 0;
			$this->attribute['Qtde']['Label'] 	= 'Número de Boletos';
			
			$this->attribute['DtVencto']['Type'] 	= 'date';
			$this->attribute['DtVencto']['NN'] 		= 1;
			$this->attribute['DtVencto']['Label'] 	= 'Prazo';
			
			$this->attribute['SCPC']['Type'] 	= 'varchar';
			$this->attribute['SCPC']['Length'] 	= 150;
			$this->attribute['SCPC']['NN'] 		= 0;
			$this->attribute['SCPC']['Label'] 	= 'SCPC';
			
			$this->attribute['QtdeBoleto']['Type'] 	= 'number';
			$this->attribute['QtdeBoleto']['Length'] 	= 5;
			$this->attribute['QtdeBoleto']['NN'] 		= 0;
			$this->attribute['QtdeBoleto']['Label'] 	= 'Quantidade de Boletos';
			
			$this->attribute['QtdeAluno']['Type'] 	= 'number';
			$this->attribute['QtdeAluno']['Length'] 	= 5;
			$this->attribute['QtdeAluno']['NN'] 		= 0;
			$this->attribute['QtdeAluno']['Label'] 	= 'Quantidade de Alunos';
			
			$this->attribute['ValorTotal']['Type'] 	= 'number';
			$this->attribute['ValorTotal']['Length'] 	= 15;
			$this->attribute['ValorTotal']['NN'] 		= 0;
			$this->attribute['ValorTotal']['Label'] 	= 'Valor Total';
			
		
			$this->recognize["Recognize"] = "CCobProc_Id, CCobCartaTi_Id, DtVencto";
			
			$this->index["CCobProc"]["Cols"] 	= "CCobProc_Id";
			$this->index["CCobCartaTi"]["Cols"]	= "CCobCartaTi_Id";
			
				
		}
		
		
		public function SetCriterioSession($arCriterios)
		{
			
			require_once "../model/CCobCarta.class.php";
			
			$ccobCarta = new CCobCarta($this->db);
			
			$listaDevedores = $ccobCarta->GetDevedores($arCriterios);
			
			foreach($listaDevedores as $wpessoa => $matricArray)
			{
				
				
				foreach($matricArray as $matric => $parcelArray)
				{
					$auxParc = "";
					
					foreach($parcelArray as $parcel => $boletoArray)
					{
						if($auxParc !== $parcel)
							$pQtdeWPessoa++;
						
						$auxParc = $parcel;
						
						
						foreach($boletoArray as $bol => $valor)
						{
							
								
							$pQtdeBoleto++;
							$pValor += $valor;
								
						}		
						
					}
					
				}
				
			}
			
			 
			$cont = uniqid();
			
			
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][RESUMO][WPESSOA] 		= $pQtdeWPessoa;
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][RESUMO][BOLETO] 			= $pQtdeBoleto;
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][RESUMO][VALOR] 			= $pValor;
			
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][CRITERIO][SITACADEMICA] 	= $arCriterios[p_State_Matric_Id];
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][CRITERIO][NIVELCURSO]	= $arCriterios[p_CursoNivel_Id];
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][CRITERIO][CURSO] 		= $arCriterios[p_Curso_Id];
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][CRITERIO][TIPOCARTA] 	= $arCriterios[p_CCobCartaTi_Id];
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][CRITERIO][TIPOBOLETO]	= $arCriterios[p_BoletoTi_Id];
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][CRITERIO][BOLETOABERTO] 	= $arCriterios[p_Qtde];
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][CRITERIO][DTVENCTO] 		= $arCriterios[p_DtVencto];
			$_SESSION[CCOB][$arCriterios[p_DtInicio]."_".$arCriterios[p_DtTermino]][$cont][CRITERIO][IGNORASCPC] 	= $arCriterios[p_SCPC];
			
						
			
			
		}
		
		
		public function GetCriterioSession($processo)
		{
			
			return $_SESSION[CCOB][$processo];
			
		}
		
		
		public function GetCriterio($processo)
		{
			
			
		}
		
		
		
	}
	
	
?>

