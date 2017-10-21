<?php

    require_once ("../engine/Model.class.php");

    class CAAtendente extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAAtendente'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;

        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 1000;

            $this->attribute['WPessoa_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Id']['Length']	= 15;
            $this->attribute['WPessoa_Id']['NN'] 		= 1;
            $this->attribute['WPessoa_Id']['Label']		= 'Funcionário';

            $this->attribute['CAMesa_Id']['Type'] 		= 'number';
            $this->attribute['CAMesa_Id']['Length'] 	= 15;
            $this->attribute['CAMesa_Id']['NN'] 		= 1;
            $this->attribute['CAMesa_Id']['Label']		= 'Mesa';
                        
            $this->attribute['DtInicio']['Type']		= 'date';
            $this->attribute['DtInicio']['NN']			= 0;
            $this->attribute['DtInicio']['Label']		= 'Data/Hora de Início'; 

            $this->attribute['DtTermino']['Type']		= 'date';
            $this->attribute['DtTermino']['NN']			= 0;
            $this->attribute['DtTermino']['Label']		= 'Data/Hora de Término';

            $this->attribute['CAPausaTi_Id']['Type'] 	= 'number';
            $this->attribute['CAPausaTi_Id']['Length'] 	= 15;
            $this->attribute['CAPausaTi_Id']['NN'] 		= 0;
            $this->attribute['CAPausaTi_Id']['Label']	= 'Mesa';
            
            
          	$this->recognize["Recognize"] = "WPessoa_Id, CAMesa_Id";

          	$this->query["qGeral"]	= "CAAtendente_qGeral";
          	$this->query["qId"]		= "CAAtendente_qId";
          	
        }
        
        public function SetAtendente($WPessoa_Id,$CAMesa_Id,$CAPausaTi_Id)
        {
        	
        	$dbData 	= new DbData($this->db);
        	
        	$sql = $dbData->Get("select * from CAAtendente where trunc(dtinicio) = trunc(sysdate) and CAMesa_Id = '$CAMesa_Id' order by id desc");
        	
        	$aAtend = $dbData->Row($sql);
			print_r($aArray);
			if (!is_array($aAtend))
			{
				$aInc = array("p_O_Option"=>"insert","WPessoa_Id"=>$WPessoa_Id,"CAMesa_Id"=>$CAMesa_Id,"CAPausaTi_Id"=>$CAPausaTi_Id,"DtInicio"=>date("d/m/Y H:i:s"));
				$this->IUD($aInc);				
			}
			else
			{
				if ($aAtend["WPESSOA_ID"] != $WPessoa_Id || $aAtend["CAPAUSATI_ID"] != $CAPausaTi_Id)
				{
					$aUpd = array("p_O_Option"=>"update","CAAtendente_id"=>$aAtend["ID"],"DtTermino"=>date("d/m/Y H:i:s"));
					$this->IUD($aUpd);
					
					$aInc = array("p_O_Option"=>"insert","WPessoa_Id"=>$WPessoa_Id,"CAMesa_Id"=>$CAMesa_Id,"CAPausaTi_Id"=>$CAPausaTi_Id,"DtInicio"=>date("d/m/Y H:i:s"));
					$this->IUD($aInc);						
				}
			}        	
        	return null;
        }
}
?> 