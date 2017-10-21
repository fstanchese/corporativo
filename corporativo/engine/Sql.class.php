<?php

require_once '../engine/View.class.php';

/**
 *
 *  
 *
*/
class Sql extends View
{
 
	/**	 
	 *	@param unknown $query
	 *	@return string
	 *	@return
	 */
	private function ReplaceQueryParam($query)
	{
		$query = str_replace("\n"," ",$query);
		$query = str_replace("\t"," ",$query);
			
		$aux = explode(" ",$query);

		foreach($aux as $string)
		{
			if(substr($string,0,2) == 'p_') 
			{
				$string = "'".$$string."'";
			}

			$queryFormated .= " ".$string;
		}
			
		return $queryFormated;
	}

	/**
	 * 	Mуtodo responsуvel por carregar um arquivo com extensуo sql	 
	 *	@param unknown $queryName = nome do arquivo
	 *	@param string $params = array com os parametros da query. Ex: array("p_Nome"=>"Nome")
	 *	@param string $arrayName
	 *	@return string instruчуo SQL pronta
	 */
	public function Query($queryName,$params="",$modelName="")
	{
		if($modelName != "")
		{
			$path = reset(explode("_",$this->{$modelName}[$queryName]))."/".$this->{$modelName}[$queryName].".sql";
		}
		else
		{
			$path = reset(explode("_",$this->query[$queryName]))."/".$this->query[$queryName].".sql";
		}
		if(is_array($params))
		{

			$query = file_get_contents("../sql/".$path);

			foreach($params as $varName => $value)
			{					
				$query = str_replace($varName,"'".$value."'",$query);
			}

			return $this->ReplaceQueryParam($query);
		}
		else
		{
			return $this->ReplaceQueryParam(file_get_contents("../sql/".$path));

		}

	}

	/**
	 *	 
	 *	@param unknown $queryName
	 *	@param string $params
	 *	@return string
	 *
	 */
	public function QueryFile($queryName,$params="")
	{
			
		$path = reset(explode("_",$queryName))."/".$queryName.".sql";
			
		if(is_array($params))
		{
			$query = file_get_contents("../sql/".$path);

			foreach($params as $varName => $value)
			{
				$query = str_replace($varName,"'".$value."'",$query);
			}

			return $this->ReplaceQueryParam($query);
		}
		else
		{
			return $this->ReplaceQueryParam(file_get_contents("../sql/".$path));
		}

	}

	
	
	
	/**
	 * 	Mуtodo responsуvel por montar instruчуo SQL - INSERT, UPDATE ou DELETE.
	 *  p_O_Option obrigatуrio - insert / update / delete
	 *  p_{NomeDaTabela}_Id obrigatуrio para UPDATE ou DELETE	 
	 *	@param unknown $data = array com os parametros - Ex: array("Nome","Nome da Pessoa");
	 *	@return Instruчуo SQL
	 */
	public function IUD($data,$flagMsg=TRUE)
	{
		//
		//print_r($data);

		require_once '../engine/Db.class.php';
		$dbData = new DbData($this->db);
		
		
		if ($data['p_O_Option'] == "" || $data['p_O_Option'] == "select" || $data['p_O_Option'] == "search")
		{
			return false;
		}
			
		//coloco todas as chaves em caixa baixa e retiro possiveis p_
		foreach($data as $key => $value)
		{
			if(substr($key,0,2) == 'p_') 
			{
				$coluna = substr($key,2,99); 
			}
			else
			{
				$coluna = $key;
			}
			
			if(strpos($newData[strtolower($coluna)],strtolower($this->table)))
				$newData[strtolower($coluna)] = str_replace(strtolower($this->table)."_","",$newData[strtolower($coluna)] = $value);
			
				
			$newData[strtolower($coluna)] = $value;
		}
					
		//
		if (($data['p_O_Option'] == 'update' || $data['p_O_Option'] == 'delete') && $newData[strtolower($this->table)."_id"] == '')
		{
			return false;
		}

		//
		if(!is_numeric($newData[strtolower($this->table)."_id"]))
		{
			$newData[strtolower($this->table)."_id"] = _Decrypt($newData[strtolower($this->table)."_id"]);
		}
			
		$arColumnData = array_map('strtolower', array_keys($newData));
		
		
		/**
		 * 
		 * Antes de fazer Insert ou Update
		 * Verificar todos os tipos de dados para cada coluna
		 * 
		 */
		
		$arAttr = $this->LowerAttribute($this->attribute);
		
	
		foreach($arColumnData as $column)
		{
			if(array_search(trim($column),$this->TableColumn()) !== FALSE)
			{				
		
				//verificar NOT NULL
				if($arAttr[trim($column)]["NN"] == 1)
				{
					if(trim($newData[$column]) == "")
					{
						echo $this->MsgPage("Error","O valor do campo '".$arAttr[trim($column)]["Label"]."' nуo pode ser vazio.");
						
						$dbData->ReportError("RC","Erro Validaчуo de Campos no PHP","O valor do campo '".$arAttr[trim($column)]["Label"]."' nуo pode ser vazio.");
						
						return;
					}
					
				}
				else 
				{
				
					//verificar tamanho
					if(strlen(trim($newData[$column])) > $arAttr[trim($column)]["Length"] && $arAttr[trim($column)]["Type"] != 'date')
					{
						
						echo $this->MsgPage("Error","O tamanho do texto/valor do campo '".$arAttr[trim($column)]["Label"]."' ultrapassou o limite mсximo.");
						
						$dbData->ReportError("RC","Erro Validaчуo de Campos no PHP","O tamanho do texto/valor do campo '".$arAttr[trim($column)]["Label"]."' ultrapassou o limite mсximo.");
						
						return;
							
					}
					
					
					//verificar type
					if($newData[$column] != "" && ( $arAttr[trim($column)]["Type"] == "number" && !is_numeric($newData[$column] )))
					{
						echo $this->MsgPage("Error","O valor do campo '".$arAttr[trim($column)]["Label"]."' deve ser Numщrico. String foi passada.");
						
						$dbData->ReportError("RC","Erro Validaчуo de Campos no PHP","O valor do campo '".$arAttr[trim($column)]["Label"]."' deve ser Numщrico. String foi passada.");
						
						return;
					}
					
/*					if($arAttr[trim($column)]["Type"] == "date" && $newData[$column] != "")
					{
						list($data,$hora) = explode(" ",$newData[$column]);
							
						list($d, $m, $y) = explode("/", $data);
							
						if(!checkdate($m, $d, $y)){
							echo $this->MsgPage("Error","O valor do campo '".$arAttr[trim($column)]["Label"]."'  deve ser Data. String foi passada.");
							
							$dbData->ReportError("Erro Validaчуo de Campos no PHP","O valor do campo '".$arAttr[trim($column)]["Label"]."'  deve ser Data. String foi passada.");
							
							return;
						}
							
					} */
				}
				
			}
		}
		
				
		//
		if($data['p_O_Option'] == 'insert')
		{

			$return = "Begin INSERT INTO 	".$this->table."  (	Dt,	US,  ";

			foreach($arColumnData as $column)
			{
				if(array_search(trim($column),$this->TableColumn()) !== FALSE)
				{
					$arCol[] = $column;
				}
			}

			$return .= implode(", ",$arCol). "	)	VALUES ( sysdate, '".strtoupper($_SESSION[user]) ."', ";

			
			foreach($arColumnData as $column)
			{
				if(array_search(strtolower($column),$this->TableColumn()) !== FALSE)
				{
					if($arAttr[trim($column)]["Type"] == "date")
						$arVal[] = "to_date('".addslashes($newData[$column])."', 'DD/MM/YYYY HH24:MI:SS') ";
					else
					{
						if ($arAttr[trim($column)]["Type"] == "number")
						{
							if(trim(!is_numeric($newData[$column])))
								$arVal[] = 'null';
							else 
								$arVal[] = "'".strtr($newData[$column],".",",")."'";
						}
							
						else
						{
							$arVal[] = "'".addslashes($newData[$column])."'";
						}
					}
				}

			}

			$return .=  implode(", ",$arVal). " ) ; End; ";
			

		}

		
		//
		if($data['p_O_Option'] == 'update')
		{

			$dbData->Get("SELECT * FROM ".$this->table." WHERE id = ".$newData[strtolower($this->table)."_id"]);
			

			$lastData = $dbData->Row();

			$queryUpdate = "UPDATE

					".$this->table."
					  SET
							LUPD = sysdate, ";

			//
			foreach($arColumnData as $column)
			{					
				if(array_search(strtolower($column),$this->TableColumn()) !== FALSE)
				{
					if($arAttr[trim($column)]["Type"] == "date")
					{
						$arColVal[] = $column." = to_date('".addslashes($newData[$column])."', 'DD/MM/YYYY HH24:MI:SS') ";
					}
					else
					{
						if ($arAttr[trim($column)]["Type"] == "number")
						{
							if(trim(!is_numeric($newData[$column])))
								$arColVal[] = $column." = null";
							else
								$arColVal[] = $column." = '" .strtr($newData[$column],".",",")."'";
						}
							
						else
						{
							$arColVal[] = $column." = '".addslashes($newData[$column])."'";
						}
					}
						
				}
			}

			$queryUpdate .=  implode(", ",$arColVal). " WHERE id = '".$newData[strtolower($this->table)."_id"]."'	";

			
			
			foreach($arColumnData as $key => $value)
			{
				//
				if(array_search(strtolower($value),$this->TableColumn()) !== FALSE)
				{	
					if(addslashes($newData[$value]) != $lastData[strtoupper($value)] &&  $arAttr[trim($value)]["Type"] != 'clob' && $arAttr[trim($value)]["Type"] != 'blob' )
					{
						
						if($arAttr[trim($value)]["Type"] == "date")
							$newValue = "to_date('".$newData[$value]."', 'DD/MM/YYYY HH24:MI:SS') ";
						else
						{
							if ($arAttr[trim($column)]["Type"] == "number")
							{
								if(trim(!is_numeric($newData[$column])))
									$newValue = "null";
								else
									$newValue = "'".strtr($newData[$column],".",",")."'";
							}
								
							else
							{
								$newValue =  "'".$newData[$value]."'";
							}
						}
						
						$newValue =  "'".$newData[$value]."'";
						
						$queryHist[] = "INSERT INTO  ".$this->table."hi (dt,us,col,".strtolower($this->table)."_id,old,new) values (sysdate,'".strtoupper($_SESSION[user])."','".$value."','".$newData[strtolower($this->table)."_id"]."','".$lastData[strtoupper($value)]."',".$newValue.")";
							
					}
				}

				
					
			}
			

			//
			if(is_array($queryHist))
			{
				$return = "Begin ".implode("; ",$queryHist)."; ".$queryUpdate."; End;";
			}
			else
			{
				$return = "Begin ".$queryUpdate."; End;";
			}

		}
			
		//
		if($data['p_O_Option'] == 'delete')
		{
			$return = "Begin DELETE FROM ".$this->table." WHERE id = '".$data[strtolower($this->table)."_id"]."'; End; ";
		}

		//echo $return;
		
		if($dbData->Set($return))
		{
			$dbData->Commit();
			if(strpos($_SERVER[SCRIPT_FILENAME], "ajax") === FALSE && $flagMsg === TRUE)
				echo $this->MsgPage("Success","Aчуo efetuada com sucesso.");
			else 
				return true;
		}
		else
		{
			if(strpos($_SERVER[SCRIPT_FILENAME], "ajax") === FALSE && $flagMsg === TRUE)
				echo $this->MsgPage("Error","Ocorreu um erro. Verifique se as informaчѕes digitadas estуo corretas, caso o erro persista entre em contato com o Depto de TI.");
			else 
				return false;
		}


		unset($dbData);
			
	}



	/**
	 *	
	 *	@return multitype:
	 */
	public function TableColumn()
	{
		return array_map('strtolower', array_keys($this->attribute));

	}
	
	public function TableColumnCamelCase()
	{
		return array_keys($this->attribute);
	
	}
	
	
	
	
	

}
?>