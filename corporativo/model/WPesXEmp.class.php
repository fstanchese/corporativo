<?php
        
    require_once ("../engine/Model.class.php");
        
    class WPesXEmp extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'WPesXEmp'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 15000;


            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['NN'] = 1;
            $this->attribute['WPessoa_Id']['Label'] = 'Prestador';

            $this->attribute['Empresa_Id']['Type'] = 'number';
            $this->attribute['Empresa_Id']['Length'] = 15;
            $this->attribute['Empresa_Id']['NN'] = 1;
            $this->attribute['Empresa_Id']['Label'] = 'Empresa';

            $this->attribute['DtInicio']['Type'] = 'date';
            $this->attribute['DtInicio']['NN'] = 1;
            $this->attribute['DtInicio']['Label'] = 'Data de Inнcio';

            $this->attribute['DtTermino']['Type'] = 'date';
            $this->attribute['DtTermino']['Label'] = 'Data de Tйrmino';

            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['EmpresaPrest'] = 'WPesXEmp_qPrestador';


            //Recognizes
            $this->recognize['Recognize'] = 'WPessoa_Id, Empresa_Id';



                
        }
        
        
        public function GetEmpresa($prestadorId)
        {
        	require_once '../engine/Db.class.php';
        	
        	$dbData = new DbData($this->db);
        	
        	$dbData->Get("SELECT razao, fantasia, contato, fone, email, empresa_id as id FROM wpesxemp, empresa WHERE empresa.id = wpesxemp.empresa_id AND wpesxemp.dttermino is null and wpesxemp.wpessoa_id = '".$prestadorId."' ORDER BY fantasia");
        	
        	
        	while($row = $dbData->Row())
        	{
        		
        		$arEmp[RAZAO][] 	= $row[RAZAO];
        		$arEmp[FANTASIA][] 	= $row[FANTASIA];
        		$arEmp[CONTATO][]	= $row[CONTATO];
        		$arEmp[FONE][] 		= $row[FONE];
        		$arEmp[EMAIL][] 	= $row[EMAIL];
        		$arEmp[ID][] 		= $row[ID];
        	}
        	
        	return $arEmp;
        	
        }
}
?>