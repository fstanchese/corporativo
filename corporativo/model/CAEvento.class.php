<?php

    require_once ("../engine/Model.class.php");

    class CAEvento extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table	= 'CAEvento'; 


        public $attribute 	= array();
        public $calculate 	= array();    
        public $query      	= array();
        public $rows;
            
      
        
        public function __construct($db)
        {
        	$this->db = $db;
        	
        	$this->rows = 50;

            $this->attribute['Descricao']['Type'] 		= 'varchar2';
            $this->attribute['Descricao']['Length'] 	= 50;
            $this->attribute['Descricao']['NN'] 		= 1;
            $this->attribute['Descricao']['Label'] 		= 'Descriзгo';

            $this->attribute['Campus_Id']['Type'] 		= 'number';
            $this->attribute['Campus_Id']['Length'] 	= 15;
            $this->attribute['Campus_Id']['NN'] 		= 1;
            $this->attribute['Campus_Id']['Label'] 		= 'Unidade';

            $this->attribute['DtInicio']['Type'] 		= 'date';
            $this->attribute['DtInicio']['NN'] 			= 1;
            $this->attribute['DtInicio']['Label'] 		= 'Data de Inнcio';

            $this->attribute['DtTermino']['Type'] 		= 'date';
            $this->attribute['DtTermino']['NN'] 		= 1;
            $this->attribute['DtTermino']['Label'] 		= 'Data de Tйrmino';

            $this->attribute['SenhaNominal']['Type'] 	= 'varchar2';            
            $this->attribute['SenhaNominal']['Length'] 	= 3;
            $this->attribute['SenhaNominal']['NN'] 		= 0;
            $this->attribute['SenhaNominal']['Label']	= 'Evento Utiliza Senhas Nominais?';
            
            $this->attribute['LinMonitor']['Type'] 		= 'number';
            $this->attribute['LinMonitor']['Length'] 	= 2;
            $this->attribute['LinMonitor']['NN'] 		= 0;
            $this->attribute['LinMonitor']['Label'] 	= 'Quantidade de Linhas Exibidas no Monitor';            

            $this->attribute['BloqCham']['Type'] 		= 'varchar2';
            $this->attribute['BloqCham']['Length'] 		= 3;
            $this->attribute['BloqCham']['NN'] 			= 0;
            $this->attribute['BloqCham']['Label']		= 'Bloquear Chamada sem Finalizar Anterior';
            
            $this->attribute['EscondeMesa']['Type'] 	= 'varchar2';
            $this->attribute['EscondeMesa']['Length']	= 3;
            $this->attribute['EscondeMesa']['NN'] 		= 0;
            $this->attribute['EscondeMesa']['Label']	= 'Mostrar Informaзгo de Mesa no Painel';
            
			$this->index["Desc"]["Cols"] 	= "Descricao";
			$this->index["Desc"]["Unique"] 	= 0;
            
			$this->recognize["Recognize"] 	= "Descricao, Campus_Id, DtInicio, DtTermino";
			$this->recognize["RecReduz"] 	= "Descricao, Campus_Id";

			$this->calculate["Geral"] 		= "CAEvento_qGeral";
			$this->calculate["Data"]		= "CAEvento_qData";
			
			$this->query["qGeral"]			= "CAEvento_qGeral";
			$this->query["qId"] 			= "CAEvento_qId";
			
        }
        
}
?>