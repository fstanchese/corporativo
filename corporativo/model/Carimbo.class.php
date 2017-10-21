<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Carimbo extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Carimbo'; 

         
        public $attribute	= array(); 
        public $calculate	= array(); 
        public $query		= array();
         
        public function __construct($db) 
        {

        	$this->db = $db;
        	 
            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['NN'] = 1;
            $this->attribute['WPessoa_Id']['Label'] = 'Funcionбrio';

            $this->attribute['Descricao']['Type'] = 'varchar2';
            $this->attribute['Descricao']['Length'] = 200;
            $this->attribute['Descricao']['Label'] = 'Descriзгo';

            $this->attribute['Tipo']['Type'] = 'varchar2';
            $this->attribute['Tipo']['Length'] = 10;
            $this->attribute['Tipo']['Label'] = 'Tipo';

            $this->recognize['Recognize']	= 'WPessoa_Id, Descricao';
            
            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['Atestado_Id'] = 'Carimbo_qAtestado';
            $this->calculate['Tipo1_Id'] = 'Carimbo_qTipo';
            $this->calculate['Tipo2_Id'] = 'Carimbo_qTipo';

            //Todas as Queries da classe
            $this->query['qPessoa'] = 'Carimbo_qPessoa';
            $this->query['qDiploma2'] = 'Carimbo_qDiploma2';
            $this->query['qId'] = 'Carimbo_qId';
            $this->query['qGeral'] = 'Carimbo_qGeral';
            $this->query['qDiploma1'] = 'Carimbo_qDiploma1';
            $this->query['qAtestado'] = 'Carimbo_qAtestado';
            $this->query['qTipo'] = 'Carimbo_qTipo';

                 
        } 
} 
?>