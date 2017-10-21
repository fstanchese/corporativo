<?php 

    require_once ("../engine/Model.class.php"); 

    class PesqTurma extends Model 
    { 

        //Mapeamento da tabela do Banco de Dados 
        public $table = 'PesqTurma'; 


        public $attribute    = array(); 
        public $calculate    = array();     
        public $query        = array();
     

        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Ano_Id']['Type'] = 'number';
            $this->attribute['Ano_Id']['Length'] = Number15;
            $this->attribute['Ano_Id']['NN'] = 1;
            $this->attribute['Ano_Id']['Label'] = 'Ano';

            $this->attribute['Semestre_Id']['Type'] = 'number';
            $this->attribute['Semestre_Id']['Length'] = 15;
            $this->attribute['Semestre_Id']['NN'] = 1;
            $this->attribute['Semestre_Id']['Label'] = 'Semestre';

            $this->attribute['PesqTi_Id']['Type'] = 'number';
            $this->attribute['PesqTi_Id']['Length'] = 15;
            $this->attribute['PesqTi_Id']['NN'] = 1;
            $this->attribute['PesqTi_Id']['Label'] = 'Tipo';

            $this->attribute['TurmaOfe_Id']['Type'] = 'number';
            $this->attribute['TurmaOfe_Id']['Length'] = 15;
            $this->attribute['TurmaOfe_Id']['NN'] = 1;
            $this->attribute['TurmaOfe_Id']['Label'] = 'Turma Oferecida';

            $this->attribute['Sequencia']['Type'] = 'number';
            $this->attribute['Sequencia']['Length'] = 2;
            $this->attribute['Sequencia']['Label'] = 'Sequência';

            $this->attribute['DivTurma_Id']['Type'] = 'number';
            $this->attribute['DivTurma_Id']['Length'] = 15;
            $this->attribute['DivTurma_Id']['Label'] = 'Divisão';

            $this->attribute['SubDivisao']['Type'] = 'varchar2';
            $this->attribute['SubDivisao']['Length'] = 1;
            $this->attribute['SubDivisao']['Label'] = 'Sub-Divisão';

            $this->attribute['IdTurma']['Type'] = 'number';
            $this->attribute['IdTurma']['Length'] = 7;
            $this->attribute['IdTurma']['Label'] = 'Divisão';

            $this->attribute['PesqGab_Id']['Type'] = 'number';
            $this->attribute['PesqGab_Id']['Length'] = 15;
            $this->attribute['PesqGab_Id']['Label'] = 'Gabarito';

            $this->recognize['Recognize']	= 'Ano_Id, Semestre_Id, TurmaOfe_Id';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Turma_Id'] = 'PesqTurma_qAnoSemest';

            //Todas as Queries da classe
            $this->query['TurmaOfe'] = 'PesqTurma_qTurmaOfe';
                             
        } 
} 
?> 