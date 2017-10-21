<?php
	require_once ("../engine/Model.class.php");
	
	class IndexGUI extends Model
	{
	
		public $table = 'IndexGUI';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public $db;

        public function __construct($db)
        {
        	$this->db = $db;	
		
 			$this->attribute['ProcName']['Type'] 				= 'varchar2';
			$this->attribute['ProcName']['Length'] 				= 100;
			$this->attribute['ProcName']['NN'] 					= 0;

			$this->attribute['GUIName']['Type'] 				= 'varchar2';
			$this->attribute['GUIName']['Length'] 				= 200;
			$this->attribute['GUIName']['NN'] 					= 0;
				
			$this->attribute['GUIDescription']['Type'] 			= 'varchar2';
			$this->attribute['GUIDescription']['Length']		= 2000;
			$this->attribute['GUIDescription']['NN'] 			= 0;
				
			$this->attribute['SecurityGroups']['Type'] 			= 'varchar2';
			$this->attribute['SecurityGroups']['Length']		= 500;
			$this->attribute['SecurityGroups']['NN'] 			= 0;
				
			$this->attribute['WPessoa_Aceitacao_Id']['Type']	= 'number';
			$this->attribute['WPessoa_Aceitacao_Id']['Length']	= 15;
			$this->attribute['WPessoa_Aceitacao_Id']['NN'] 		= 0;
				
			$this->attribute['Versao']['Type']					= 'date';
			$this->attribute['Versao']['NN'] 					= 0;

			$this->attribute['Aceitacao']['Type']				= 'date';
			$this->attribute['Aceitacao']['NN'] 				= 0;
				
			$this->attribute['Parametros']['Type'] 				= 'varchar2';
			$this->attribute['Parametros']['Length']			= 255;
			$this->attribute['Parametros']['NN'] 				= 0;
			
			
			$this->attribute['Path']['Type'] 					= 'varchar2';
			$this->attribute['Path']['Length']					= 10;
			$this->attribute['Path']['NN'] 						= 0;
			
			$this->attribute['Producao']['Type'] 				= 'varchar2';
			$this->attribute['Producao']['Length']				= 3;
			$this->attribute['Producao']['NN'] 					= 0;
				
			$this->recognize['Recognize']	= 'ProcName';
			$this->recognize['Desc']		= 'GUIDescription';
			
			$this->index["GUIName"] 		= "GUIName_Id";
			
			$this->query["qConsulta"]		= "IndexGUI_qConsulta";
			
		}
		
		
		public function GetLink($id)
		{
			$url 		= "http://dbnet.usjt.br/";
			
			$dbData = new DbData($this->db);
			
			$linha = $this->GetIdInfo($id);
			
			$local = explode("/",$_SERVER[REQUEST_URI]);

			$path = $url."private/";
			
			if(strtolower($linha[PRODUCAO]) == "on") $path = $url.$local[1]."/".$linha[PATH]."/";
			
			
			$path .= $linha[PROCNAME].".php";
			
			
			return $this->Link($linha[GUIDESCRIPTION],array("href"=>$path));
			
			
			
			
		}
		
		
		public function AutoCompletaNome($value)
		{
		
		
			$dbData = new DbData($this->db);
		
			$value = str_replace(" ","%",$value);
			
			$dbData->Get("SELECT id, procname, guiname FROM indexgui WHERE lower(procname) like'".strtolower($value)."%' OR lower(guiname) like'".strtolower($value)."%' OR lower(guidescription) like'".strtolower($value)."%'");
		
			if($dbData->Count() > 100)	die('0');
			if($dbData->Count() == 0) 	die('1');
		
		
			echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
		
			while($row = $dbData->Row())
			{
					
				echo $this->Li(array("idr"=>$row[ID],"nomeExibicao"=>str_replace("'","´",$row[GUINAME])));
		
				echo $row[GUINAME].$this->Div(array("style"=>"color:#777;font-size:10px")).$row[PROCNAME].$this->CloseDiv();
					
		
				echo $this->CloseLi();
					
			}
		
			echo $this->CloseUl();
		
			unset($dbData);
		
		
		}
		
		
		
		
		
		
	}

?>