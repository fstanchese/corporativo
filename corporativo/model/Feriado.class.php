<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Feriado extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Feriado'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 500;


            $this->attribute['DtFeriado']['Type'] = 'date';
            $this->attribute['DtFeriado']['NN'] = 1;
            $this->attribute['DtFeriado']['Label'] = 'Data';
            $this->attribute['DtFeriado']['Mask'] = 'd';

            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 50;
            $this->attribute['Nome']['NN'] = 1;
            $this->attribute['Nome']['Label'] = 'Nome';

            $this->attribute['Administrativo']['Type'] = 'varchar2';
            $this->attribute['Administrativo']['Length'] = 3;
            $this->attribute['Administrativo']['Label'] = 'Administrativo';

            $this->attribute['Academico']['Type'] = 'varchar2';
            $this->attribute['Academico']['Length'] = 3;
            $this->attribute['Academico']['Label'] = 'Acadкmico';

            $this->attribute['Bancario']['Type'] = 'varchar2';
            $this->attribute['Bancario']['Length'] = 3;
            $this->attribute['Bancario']['Label'] = 'Bancбrio';

            $this->attribute['Pos']['Type'] = 'varchar2';
            $this->attribute['Pos']['Length'] = 3;
            $this->attribute['Pos']['Label'] = 'Pos';

            //Calculates para a criaзгo de querys no diretуrio SQL


            //Recognizes
            $this->recognize['Recognize'] = 'DtFeriado,Nome';

            //Нndices
            $this->index['DTFeriado']['Cols'] = "DTFeriado";
            $this->index['DtFeriado']['Unique'] = 1;

            //Todas as Queries da classe
                 
        }

		// Retorno proximo dia util Bancario
		function GetProximoDiaUtilBancario($dBase = '')
		{
			if ($dBase == '')
			{	
				$dBase = date('d/m/Y');
			}

		
			$dbData = new DbData($this->db);
		
			$nContinua = 1;
		
    	    while ($nContinua >= 1)
        	{
	        	$sql = "select
    	    				count(*) as qtd 
        				from 
        					feriado 
        				where 
        					nvl (bancario,'off') = 'on' 
	        			and 
    	    				to_date (dtferiado) = to_date ('$dBase')";      	
 
        	        
        		$dbData->Get($sql);
        	
        		$row = $dbData->Row();
        		
        		$nContinua = $row['QTD'];
        		
        		$aDate = explode( '/', $dBase);
        		
        		if ($row['QTD'] >=1 || date('w',mktime(0,0,0,$aDate[1],$aDate[0],$aDate[2])) == 0 || date('w',mktime(0,0,0,$aDate[1],$aDate[0],$aDate[2])) == 6)        	
        		{        		
        			$dBase = date('d/m/Y',mktime(0,0,0,$aDate[1],$aDate[0]+1,$aDate[2]));
        			$nContinua = 1;
        		}
        		        		
        	}      	

        	Return $dBase;
		}        
	}
?>