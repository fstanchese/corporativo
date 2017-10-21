<?php
        
    require_once ("../engine/Model.class.php");
        
    class RegTrab extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'RegTrab'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query         = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 30;


            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length'] 			= 50;
            $this->attribute['Nome']['Label'] 			= 'Regime de Trabalho';

            $this->attribute['NrAulasMin']['Type'] 		= 'number';
            $this->attribute['NrAulasMin']['Length'] 	= 3;
            $this->attribute['NrAulasMin']['Label'] 	= 'Nъmero de Aulas - Mнnimo';

            $this->attribute['NrAulasMax']['Type'] 		= 'number';
            $this->attribute['NrAulasMax']['Length'] 	= 3;
            $this->attribute['NrAulasMax']['Label'] 	= 'Nъmero de Aulas - Mбximo';

            $this->attribute['Codigo']['Type'] 			= 'varchar2';
            $this->attribute['Codigo']['Length'] 		= 10;
            $this->attribute['Codigo']['Label'] 		= 'Cуdigo';

            $this->attribute['NrAulasCCGPE']['Type'] 	= 'number';
            $this->attribute['NrAulasCCGPE']['Length'] 	= 5.2;
            $this->attribute['NrAulasCCGPE']['Label'] 	= 'Nъmero de Aulas para cбlculo de centro de custo GPE';

            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Selecao_Id'] = 'RegTrab_qGeral';


            //Recognizes
            $this->recognize['Recognize'] = 'Codigo';

            //Нndices

            //Todas as Queries da classe
            $this->query['qId'] 	= 'RegTrab_qId';
            $this->query['qGeral'] 	= 'RegTrab_qGeral';

                
        }
}
?>