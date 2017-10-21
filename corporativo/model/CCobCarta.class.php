<?php

	require_once ("../engine/Model.class.php");

	class CCobCarta extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public $table	= 'CCobCarta';
		
		
		public $attribute 	= array();
		public $calculate 	= array();
		public $query      	= array();
		public $rows;
		
		
		public function __construct($db)
		{
			$this->db = $db;
			 
			$this->rows = 5000;
		
			$this->attribute['CCobCrit_Id']['Type'] 	= 'number';
			$this->attribute['CCobCrit_Id']['Length'] 	= 15;
			$this->attribute['CCobCrit_Id']['NN'] 		= 1;
			$this->attribute['CCobCrit_Id']['Label'] 	= 'Critйrio do Proceso';
			
			$this->attribute['WPessoa_Id']['Type'] 		= 'number';
			$this->attribute['WPessoa_Id']['Length'] 	= 15;
			$this->attribute['WPessoa_Id']['NN'] 		= 1;
			$this->attribute['WPessoa_Id']['Label'] 	= 'Aluno';

			$this->attribute['DtVencto']['Type'] 		= 'date';
			$this->attribute['DtVencto']['NN'] 			= 1;
			$this->attribute['DtVencto']['Label'] 		= 'Vencimento';
			
			$this->attribute['State_Id']['Type'] 		= 'number';
			$this->attribute['State_Id']['Length'] 		= 15;
			$this->attribute['State_Id']['NN'] 			= 1;
			$this->attribute['State_Id']['Label'] 		= 'Situaзгo';
			
			$this->attribute['DtAvisoRec']['Type'] 		= 'date';
			$this->attribute['DtAvisoRec']['NN'] 		= 0;
			$this->attribute['DtAvisoRec']['Label'] 	= 'Data Recebimento';
			
			$this->attribute['DtEmissao']['Type'] 		= 'date';
			$this->attribute['DtEmissao']['NN'] 		= 0;
			$this->attribute['DtEmissao']['Label'] 		= 'Data Emissгo';
			
			$this->attribute['Matric_Id']['Type'] 		= 'number';
			$this->attribute['Matric_Id']['Length'] 	= 15;
			$this->attribute['Matric_Id']['NN'] 		= 0;
			$this->attribute['Matric_Id']['Label'] 		= 'Matrнcula';
			
			$this->attribute['Parcel_Id']['Type'] 		= 'number';
			$this->attribute['Parcel_Id']['Length'] 	= 15;
			$this->attribute['Parcel_Id']['NN'] 		= 0;
			$this->attribute['Parcel_Id']['Label'] 		= 'Parcelamento';
			
			
			$this->calculate["Pessoa"]		= "CCobCarta_qPessoa";
		
			$this->recognize["Recognize"] 	= "CCobCrit_Id, WPessoa_Id, State_Id";
			
			$this->index['WPessoa']['Cols']	= "WPessoa_Id";
			$this->index['Matric']['Cols'] 	= "Matric_Id";
			$this->index['Parcel']['Cols'] 	= "Parcel_Id";
			$this->index['State']['Cols']	= "State_Id";
			
			$this->query["qPessoa"]			= "CCobCarta_qPessoa";
				
		}
		
		
		public function GetCartaInfo($vCartaId)
		{
			require_once("../model/CCobDebito.class.php");

			$dbData 	= new DbData ($this->db);
			
			$aCarta = $this->GetIdInfo($vCartaId);
			
			$html  = $this->Div(array("class"=>"boxInfoCarta"));
			$html .= "Aluno(a):" . $this->Strong($aCarta["WPESSOA_NOME"]) .$this->Br();
			$html .= "Carta Nъmero: ". $this->Strong(substr($aCarta[ID],-9)) .$this->Br();
			$html .= "Dt.Geraзгo: ". $this->Strong($aCarta[DT]).$this->Br();
			$html .= "Dt.Recebimento AR: " . $this->Strong(_NVL($aCarta[DTAVISOREC], "- -")) .$this->Br(); 
			$html .= "Dt.Impressгo: ". $this->Strong(_NVL($aCarta[DTEMISSAO], "- -")) .$this->Br();
			$html .= "Dйbitos: ". $this->Br();
			
			$dbData->Get("select Boleto.Referencia,Boleto.Valor,State_gsRecognize(State_Base_Id) as State from Boleto,CCobDebito where Boleto.Id = CCobDebito.Boleto_Id and CCobDebito.CCobCarta_Id='$vCartaId' order by ordemref");
			
			while ($row = $dbData->Row())
			{
				$html .= "- " . $row["REFERENCIA"] . ' R$' . trim($row["VALOR"]) . ' - ' . $row["STATE"] . $this->Br(); 
			}
			
			return $html;
			
		}
		
		public function GetResponsavel($vCartaId)
		{
			require_once("../model/Contratante.class.php");
			require_once("../model/Boleto.class.php");
			
			$boleto 		= new Boleto($this->db);
			$contratante 	= new Contratante($this->db);
			$dbData			= new DbData($this->db);
			
			$dbData->Get("select CCobDebito.Boleto_Id, Boleto.BoletoTi_Id from CCobDebito,Boleto where Boleto.Id = CCobDebito.Boleto_Id and  CCobDebito.CCobCarta_Id = '".$vCartaId."'");
			while ($row = $dbData->Row())
			{
				$vMatric = $boleto->GetMatric($row["BOLETO_ID"]);
				$vBoleto = $row["BOLETOTI_ID"];
				if ($vMatric != "")
				{
					break;
				}
			}
			
			if ($vBoleto == 92200000000003)
			{
				return $contratante->GetNome($vMatric);
			}		
			
		}
		
		public function GetDevedores($arCriterios)
		{
			require_once ("../model/Boleto.class.php");
			
			$dbData = new DbData($this->db);
			$boleto = new Boleto($this->db);
			
			$aDevedores = $boleto->GetDevedores($arCriterios);
			
		
			foreach($aDevedores as $pessoa => $aMatricula)
			{								
				foreach($aMatricula as $matric => $aParcel)
				{
					
					foreach($aParcel as $parcel => $aBoleto)
					{
						if($parcel > 0)
						{
							$aMatricPar = $dbData->Row($dbData->Get("select count(*) as qtde from ccobcarta where state_id in (3000000047001,3000000047002,3000000047003) and parcel_id='$parcel'"));
							if ($aMatricPar[QTDE] > 0)
							{
								$arMatriRet[] = $pessoa."_".$matric."_".$parcel;
							}
						}
						else
						{
							$aMatricDeb = $dbData->Row($dbData->Get("select count(*) as qtde from ccobcarta where state_id in (3000000047001,3000000047002,3000000047003) and matric_id='$matric'"));
							if ($aMatricDeb[QTDE] > 0)
							{
								$arMatriRet[] = $pessoa."_".$matric."_0";
							}								
						}
						
					}
				}
			}
			
			if(is_array($arMatriRet))
			{
				foreach ($arMatriRet as $valor)
				{
					$aux = explode("_",$valor);
					unset($aDevedores[$aux[0]][$aux[1]][$aux[2]]);
				}
				
			}
			
		
			return $aDevedores;
		}
		
	}
	
	
?>