<?php

	require_once ("../engine/Sql.class.php");
	
	class Devices extends Sql {

		
		public $table = "Devices";


        public function __construct($db)
        {
        	$this->db = $db;
			$this->attribute['uniqueID']['Type'] 		= 'int';
			$this->attribute['uniqueID']['Length']		= 15;

			$this->recognize['Recognize'] = 'uniqueID';
			
			$this->query['qIpaddr']	= "Devices_qIpaddr";
			
		}


		public function AutoCompleteIP($value)
		{
		

			$dbData = new DbData($this->db);
			
			
			$arVal[p_ipaddr] = $value."%";
			

			
			$dbData->Get($this->Query("qIpaddr",$arVal));
			
			
			
			if($dbData->Count() > 100)	die('0');
			if($dbData->Count() == 0) 	die('1');
			
			
			echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
			
			while($row = $dbData->Row())
			{
			
				echo $this->Li(array("idr"=>$row[uniqueID],"nomeExibicao"=>str_replace("'","´",$row[cpu]." - ".utf8_decode($row[registryName]))));
				
				echo $row[cpu]." - ".utf8_decode($row[registryName]);
			
				
				echo $this->CloseLi();
			
			}
			
			echo $this->CloseUl();
			
			unset($dbData);
			
			
		}
		


	}


?>