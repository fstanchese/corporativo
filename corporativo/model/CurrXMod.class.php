
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CurrXMod extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CurrXMod'; 

         
        public $attribute 	= array(); 
        public $calculate 	= array(); 
        public $query    	= array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 100;


            $this->attribute['Curr_Id']['Type'] 			= 'number';
            $this->attribute['Curr_Id']['Length'] 			= 15;
            $this->attribute['Curr_Id']['NN'] 				= 1;
            $this->attribute['Curr_Id']['Label'] 			= 'Currículo';

            $this->attribute['Modalidade_Id']['Type'] 		= 'number';
            $this->attribute['Modalidade_Id']['Length'] 	= 15;
            $this->attribute['Modalidade_Id']['Label'] 		= 'Modalidade';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] 	= 'Curr_Id';

            //Índices

            //Todas as Queries da classe
            $this->query['qModalidade'] 	= 'CurrXMod_qModalidade';
            $this->query['qReconhece'] 		= 'CurrXMod_qReconhece';
                 
        }

        public function GetNomeCurso($Curr_Id)
        {
        	$dbData = new DbData($this->db);
        	
        	$v_primeiro = 0;
        	$CurrXMod_qReconhece = array();
        	
        	$dbData->Get($this->Query("qReconhece",array("p_Curr_Id"=>$Curr_Id)));

        	while ($row = $dbData->Row())
        	{
     			if ($v_primeiro == 0)
     			{
   					$v_curr_recognize = $row["NOMEDIPLANVERSO"].' - ';
    				$v_primeiro = 1;
     			}
     			
        		$v_curr_recognize .= $row["MODALIDADE"].' e ';

    		}
        	if ($v_primeiro == 1)
        	{
      			$v_curr_recognize = substr($v_curr_recognize,0,-3);
        	}
        	
        	return $v_curr_recognize;
        	 
        }
} 