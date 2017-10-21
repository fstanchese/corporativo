
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class FaltaAbono extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'FaltaAbono'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10000;


            $this->attribute['WPessoa_Id']['Type'] 			= 'number';
            $this->attribute['WPessoa_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Id']['NN'] 			= 1;
            $this->attribute['WPessoa_Id']['Label'] 		= 'Aluno';

            $this->attribute['DtInicio']['Type'] 			= 'date';
            $this->attribute['DtInicio']['NN'] 				= 1;
            $this->attribute['DtInicio']['Label'] 			= 'Data de Início do Abono';

            $this->attribute['DtFinal']['Type'] 			= 'date';
            $this->attribute['DtFinal']['NN'] 				= 1;
            $this->attribute['DtFinal']['Label'] 			= 'Data de Término do Abono';

            $this->attribute['MotivoAbono_Id']['Type'] 		= 'number';
            $this->attribute['MotivoAbono_Id']['Length'] 	= 15;
            $this->attribute['MotivoAbono_Id']['NN'] 		= 1;
            $this->attribute['MotivoAbono_Id']['Label'] 	= 'Motivo do Abono';

            $this->attribute['Justificativa']['Type'] 		= 'varchar2';
            $this->attribute['Justificativa']['Length'] 	= 150;
            $this->attribute['Justificativa']['Label'] 		= 'Justificativa';

            $this->attribute['GradAlu_Id']['Type'] 			= 'number';
            $this->attribute['GradAlu_Id']['Length'] 		= 15;
            $this->attribute['GradAlu_Id']['Label'] 		= 'Disciplina';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'DtInicio,DtFinal,MotivoAbono_Id,GradAlu_Id';

            //Índices

            //Todas as Queries da classe
            $this->query['qDataAbono']		= 'FaltaAbono_qDataAbono';
            $this->query['qDisciplinas'] 	= 'FaltaAbono_qDisciplinas';
            $this->query['qGeral'] 			= 'FaltaAbono_qGeral';
            $this->query['qId'] 			= 'FaltaAbono_qId';
            $this->query['qPessoa'] 		= 'FaltaAbono_qPessoa';
            
                 
        } 
        
        public function GetDataAbono ($WPessoa_Id, $dData, $GradAlu_Id=NULL)
        {
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get($this->Query("qDataAbono",array("p_WPessoa_Id"=>$WPessoa_Id,"p_GradAlu_Id"=>$GradAlu_Id,"p_O_Dt"=>$dData)));
        	
        	$row = $dbData->Row();
        	
        	$vRet = 0;
        	if ($row["TOTAL"] > 0)
        		$vRet = 1;

        	return $vRet;
        	
        }
} 