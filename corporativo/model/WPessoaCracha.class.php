<?php
        
    require_once ("../engine/Model.class.php");
        
    class WPessoaCracha extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'WPessoaCracha'; 

        
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
            $this->attribute['WPessoa_Id']['Label'] = 'Pessoa';

            $this->attribute['Empresa_Id']['Type'] = 'number';
            $this->attribute['Empresa_Id']['Length'] = 15;
            $this->attribute['Empresa_Id']['Label'] = 'Empresa';
            $this->attribute['Empresa_Id']['NN'] = 1;

            $this->attribute['DtInicio']['Type'] = 'date';
            $this->attribute['DtInicio']['NN'] = 1;
            $this->attribute['DtInicio']['Label'] = 'Data de Início';

            $this->attribute['Codigo']['Type'] = 'number';
            $this->attribute['Codigo']['Length'] = 10;
            $this->attribute['Codigo']['Label'] = 'Código';
            $this->attribute['Codigo']['Mask'] = '9';

            $this->attribute['State_Id']['Type'] = 'number';
            $this->attribute['State_Id']['Length'] = 15;
            $this->attribute['State_Id']['NN'] = 1;
            $this->attribute['State_Id']['Label'] = 'State da Impressão do Crachá';


            //Recognizes
            $this->recognize['Recognize'] = 'WPessoa_Id, Empresa_Id';


                
        }
}
?> 