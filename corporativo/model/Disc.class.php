<?php
	require_once ("../engine/Model.class.php");
	
	class Disc extends Model 
	{
	
		public $table = 'Disc';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		

		
		public function __construct($db)
		{
			$this->db = $db;	
			
			$this->attribute['Codigo']['Type'] 		= 'varchar2';
			$this->attribute['Codigo']['Length']	= 10;
			$this->attribute['Codigo']['NN'] 		= 1;
			
			$this->attribute['Nome']['Type'] 		= 'varchar2';
			$this->attribute['Nome']['Length'] 		= 150;
			$this->attribute['Nome']['NN'] 			= 1;
			
			$this->recognize['Recognize']	= 'Codigo, Nome';
			
			$this->calculate['Geral'] = "Disc_qGeral";
				
				
			$this->query["qSelecaoDisc"]	= "Disc_qSelecaoDisc";
			$this->query["qGeral"]			= "Disc_qGeral";
			$this->query["qId"] 			= "Disc_qId";				
				
		}
		
		public function AutoComplete($value)
		{
		
			$dbData = new DbData($this->db);
		
			$arVal[p_Disc_Codigo]	= utf8_decode($value);
			$arVal[p_Disc_Nome]		= utf8_decode($value);
				
			$dbData->Get($this->Query("qSelecaoDisc",$arVal));
			 
		
			if($dbData->Count() > 100)	die('0');
			if($dbData->Count() == 0) 	die('1');
		
		
			echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
		
			while($row = $dbData->Row())
			{
				 
				echo $this->Li(array("idr"=>$row[ID],"nomeExibicao"=>str_replace("'","´",$row[CODIGODISC].' - '.$row[NOMEDISC])));
				echo $row[CODIGODISC].' - '.$row[NOMEDISC];
				echo $this->CloseLi();
				 
			}
		
			echo $this->CloseUl();
		
			unset($dbData);
		
		
		}		
	}
?>