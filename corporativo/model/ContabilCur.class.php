<?php
        
    require_once ("../engine/Model.class.php");
        
    class ContabilCur extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'ContabilCur'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        
        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 1000;


            $this->attribute['Curso_Id']['Type'] 			= 'number';
            $this->attribute['Curso_Id']['Length'] 			= 15;
            $this->attribute['Curso_Id']['NN'] 				= 1;
            $this->attribute['Curso_Id']['Label'] 			= 'Curso';

            $this->attribute['DtInicio']['Type'] 			= 'date';
            $this->attribute['DtInicio']['NN'] 				= 1;
            $this->attribute['DtInicio']['Label'] 			= 'Data Início';

            
            $this->attribute['DtTermino']['Type'] 			= 'date';
            $this->attribute['DtTermino']['NN'] 			= 0;
            $this->attribute['DtTermino']['Label'] 			= 'Data Término';
            
            
            $this->attribute['Nome']['Type'] 				= 'varchar2';
            $this->attribute['Nome']['Length'] 				= 100;
            $this->attribute['Nome']['NN'] 					= 1;
            $this->attribute['Nome']['Label'] 				= 'Nome';




            //Recognizes
            $this->recognize['Recognize'] 	= 'Nome';

            
            //Indices
            $this->index["Curso"]["Cols"] = "Curso_Id";
			$this->index["Curso"]["Unique"] = 0;
			
        }


        
		function GetNomeCurso($Curso_Id, $dBase = '')
		{
			if ($dBase == '')
				$dBase = date('d/m/Y');
		
			$sql = "select
				contabilcur.nome as contabilcur_nome
			from
				contabilcur
			where
				to_date(nvl(contabilcur.dttermino, sysdate)) >= to_Date( '" . $dBase . "')
			and
				contabilcur.curso_id =  nvl('". $Curso_Id . "',0)";
			
			$dbData = new DbData($this->db);			
			$dbData->Get($sql);			
					
			$aReturn = $dbData->Row();
			
			unset($dbData);
				
			return $aReturn[CONTABILCUR_NOME];
                
        }        
        
	}
?>