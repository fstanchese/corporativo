<?php

	require_once ("../engine/Sql.class.php");
	

	class Model extends Sql
	{		
	 
		public $db;
		
						
		public function GetLabel($arKey)
		{			
			return $this->attribute[$arKey]["Label"];			
		}
		
		public function GetLength($arKey)
		{
				
			return $this->attribute[$arKey]["Length"];
							
		}

		
		//Transforma o array Attribute para LOWER
		public function LowerAttribute($array)
		{
			foreach (array_keys($array) as $key):
			    
			    $value = $array[$key];
			    unset($array[$key]);
			    
			    
			    $transformedKey = strtolower($key);
			    
			    if (is_array($value)) $this->LowerAttribute($value);
			    
			    $array[$transformedKey] = $value;      
			    
			    unset($value);
			  endforeach;
			  
			  return $array;
			 
		}
		
		/**
		 * 
		 * Lista todas as linhas da Tabela
		 * 
		 * Retorna array com todas as informações
		 * 
		 */
		
		public function GetInfo( $vOrderBy=NULL )
		{
			
			require_once('../engine/Db.class.php');
			
			if (!empty($vOrderBy))
				$vOrderBy = ' order by '.$vOrderBy;
			
			$dbData = new DbData($this->db);
			
			$dbData->Get("select id from $this->table $vOrderBy");
				
			while($aDados =  $dbData->Row())
			{
				
				$arRet[] = $this->GetIdInfo($aDados[ID]);
				
			}
			
			
			return $arRet;
			
		}
		
		
		/**
		 * 
		 * Retorna todos os atributos de uma tabela, passando o Id da linha
		 * 
		 * @var id
		 * 
		 * 
		 */
		
		public function GetIdInfo($id)
		{
			
			if($id == "") return false;
			
			require_once('../engine/Db.class.php');

			
			$dbData = new DbData($this->db);
											
			$dbData->Get("select $this->table.*, to_char(dt,'dd/mm/yyyy hh24:mi') as datahora from $this->table where id = $id");
			
			$aDados =  $dbData->Row();
			 
			
			foreach ($this->TableColumnCamelCase() as $key)
			{
				if (substr(strtoupper($key),-3) == "_ID")
				{
					require_once("../model/".reset(explode('_',$key)).".class.php");

					$aAux = reset(explode('_',$key));
					${strtolower(reset(explode('_',$key)))} = new $aAux($this->db);										

				}		
			}
			
			$arReturn["ID"] 			= $aDados["ID"];
			$arReturn["DT"] 			= $aDados["DT"];
			$arReturn["DATAHORA"] 		= $aDados["DATAHORA"];
			$arReturn["US"] 			= $aDados["US"];
			$arReturn["RECOGNIZE"] 		= $this->Recognize($id);
			
			foreach ($this->TableColumn() as $key)
			{
				
				$arReturn[strtoupper($key)] = $aDados[strtoupper($key)];
				
								
				if (substr(strtoupper($key),-3) == "_ID")
				{
					$keyAux = strtoupper(substr($key,0,-3))."_NOME";
					if ($aDados[strtoupper($key)] != '')
					{	
						$arReturn["$keyAux"] = ${strtolower(reset(explode('_',$key)))}->Recognize($aDados[strtoupper($key)]);
					}
					else
					{
						$arReturn["$keyAux"] = NULL;
					}
				}
				
				
			}

			//unset dos objetos instanciados
			foreach ($this->TableColumn() as $key)
			{
				if (substr(strtoupper($key),-3) == "_ID")
				{
					$Obj = reset(explode('_',$key));
					unset($$Obj);
				}
			}
				
			
			return $arReturn ;
			
		}
		
		
		/**
		 * 
		 * @var id
		 * @var recognize 
		 * Monta o Recognize baseado nas informações da Model
		 */
		
		public function Recognize($id,$recognize='Recognize')
		{
			
			
			
			
			require_once('../engine/Db.class.php');
			
			$tableColumn = $this->TableColumnCamelCase();
			
			
			$dbData = new DbData($this->db);
			
			$dbData->Get("select ".$this->recognize[$recognize]." from $this->table where id = '$id'");

			$aDados =  $dbData->Row();
			
			if(!is_array($aDados)) return ;
			
			
			foreach ($aDados as $key => $value)
			{
				
				if (substr($key,-3) == "_ID")
				{
					
					foreach($tableColumn as $atributoTabela)
					{
						
						if(strtoupper($atributoTabela) == $key)
						{
							require_once("../model/".reset(explode('_',$atributoTabela)).".class.php");
							
							$aAux = reset(explode('_',$atributoTabela));
							${strtolower(reset(explode('_',$atributoTabela)))} = new $aAux($this->db);
						}
						
					}
						
					
				
				}
			}
			
			
			foreach ($aDados as $key => $value)
			{
				if($value != "")
				{
					if (substr(strtoupper($key),-3) == "_ID")
				
						$arReturn[] = ${strtolower(reset(explode('_',$key)))}->Recognize($value);
				
					else
				
						$arReturn[] = $value;
				}				
			}
			
			return implode( " - ", $arReturn);
			
		}
		
		
		
		/**
		 *
		 *	@param unknown $name
		 *	@param string $param
		 *	@return boolean|Ambigous <multitype:, string>
		 *	@return
		 */
		public function Calculate($name="",$param="",$orderBy="")
		{
			
			$arReturn[''] = " Selecione ";
			
			if($name == "")
			{
			
				$arDados = $this->GetInfo($orderBy);
				
				if(!is_array($arDados)) return ;

				
				foreach($arDados as $arLinha)
				{
					
					$arReturn[$arLinha[ID]] = $arLinha[RECOGNIZE];
				
				}
			}
			else 
			{

				if($this->calculate[$name]['input'] == '') return false;
				
				
				require_once('../engine/Db.class.php');
				$dbData = new DbData($this->db);
				
				
				$dbData->Get($this->Query($name,$param,"calculate"));

				while ($row = $dbData->Row())
				{
					$arReturn[$row[ID]] = $row[RECOGNIZE];
				}
					
			
				
			}			
			
			return $arReturn;
			
		}
		
	} 
?>