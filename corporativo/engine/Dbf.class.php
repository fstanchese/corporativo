<?php

	require_once ("../engine/View.class.php"); 


	define ("DBFPATH", "/mount/prd/");


	/**
	 * Classe para leitura e gravação em arquivo DBF
	 * Utiliza a biblioteca DBF compilada dentro do PHP 
	 */
	 
	class Dbf extends View
	{
		public $db;
		
		private $rowNum = 0;
		
		/**
		 * Construtor da classe, recebe como parâmetro o nome do arquivo a ser aberto
		 */
		public function __construct ($filename)
		{
			//$this->db = @dbase_open (DBFPATH . $filename, 0);
			$this->db = @dbase_open ($filename, 0);
			
			
			if ($this->db == "")
			{
				parent::Dialog("E", "Erro de banco de dados", "Erro ao abrir o arquivo!");
				exit(0);
			}
		}
		
		
		/**
		 * Retorna o cabeçalho do arquivo DBF
		 */
		public function GetHeaderNames ()
		{
			$h = dbase_get_header_info($this->db);
			
			foreach ($h as $val)
				$ret[] = $val[name];

			return $ret;
		}
		
		
		public function GetHeaderInfo ()
		{
			return dbase_get_header_info($this->db);
		}
		
		public function RowNumber ()
		{
			return $this->row;
		}
		
		public function Row ()
		{
			if ($this->row < dbase_numrecords($this->db))
			{
				$this->row++;
				return dbase_get_record($this->db, $this->row); 
			}
			else
			{
				return false;
			}
		}
		
		public function Set ( $rowColumn="", $rowNumber="" )
		{
			if($rowColumn != "" && $rowNumber != "")
				if ($rowNumber <= dbase_numrecords($this->db))
					return dbase_replace_record( $this->db, $rowColumn, $rowNumber);
				else 
					return FALSE;
			else 
			 	return FALSE;		
		}
	}
	
?>