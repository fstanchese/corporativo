<?php
        
    require_once ("../engine/Model.class.php");
        
    class CCusto extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'CCusto'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 100;


            $this->attribute['Codigo']['Type'] = 'varchar2';
            $this->attribute['Codigo']['Length'] = 10;
            $this->attribute['Codigo']['NN'] = 1;
            $this->attribute['Codigo']['Label'] = 'Cуdigo';

            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 50;
            $this->attribute['Nome']['NN'] = 1;
            $this->attribute['Nome']['Label'] = 'Descriзгo';

            $this->attribute['CCusto_Pai_Id']['Type'] = 'number';
            $this->attribute['CCusto_Pai_Id']['Length'] = 15;
            $this->attribute['CCusto_Pai_Id']['Label'] = 'Faz parte do Centro de Custo';

            $this->attribute['Desativado']['Type'] = 'varchar2';
            $this->attribute['Desativado']['Length'] = 3;
            $this->attribute['Desativado']['Label'] = 'Desativado?';

            $this->attribute['Campus_Id']['Type'] = 'number';
            $this->attribute['Campus_Id']['Length'] = 15;
            $this->attribute['Campus_Id']['NN'] = 1;
            $this->attribute['Campus_Id']['Label'] = 'Unidade';

            $this->attribute['ApuraResultado']['Type'] = 'varchar2';
            $this->attribute['ApuraResultado']['Length'] = 3;
            $this->attribute['ApuraResultado']['Label'] = 'Apura Resultado?';

            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Geral'] 	= 'CCusto_qGeral';

            //Recognizes
            $this->recognize['Recognize'] = 'Codigo,Nome,Campus_Id';

            
            //Todas as Queries da classe
            $this->query['qGeral'] 	= 'CCusto_qGeral';
            

                
        }
}
?>