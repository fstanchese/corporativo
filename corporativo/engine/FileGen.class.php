<?php

	class FileGen{
	
		private $fileName;
		private $line;
		private $handle;
		private $br;
		
		
		public function __construct($fileName)
		{
		
			$this->fileName = "/oracle/system/nfe/".$fileName;
			
			$this->handle = fopen ($this->fileName, "w+");
			
		}
		
		
		public function Info($value,$size="",$fill="",$align="")
		{
			if($size == "")
			{
				$this->line .= $value;
			}
			else 
			{
				if($align == "L")	$this->line .= 	str_pad($value, $size, $fill, STR_PAD_LEFT);
				if($align == "R")	$this->line .= 	str_pad($value, $size, $fill);
				if($align == "C")	$this->line .= 	str_pad($value, $size, $fill, STR_PAD_BOTH);
			}
			
			
			
			
			
		}
		
		public function NextLine($os = 'L')
		{
			
			if($os == 'L')		$this->br = chr(13);
			if($os == 'W')		$this->br = chr(13).chr(10);
		
			
			fwrite($this->handle, $this->line .$this->br);
			
			$this->line = "";
			
		}
		
		public function __destruct()
		{
			
			if($this->line != "")
				fwrite($this->handle, $this->line);
			
			
			fclose($this->handle);
			
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($this->fileName));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($this->fileName));
			readfile($this->fileName);
			
		}
		
		
		
		
		
		
		
	}

?>