<?php 

    require_once ("../engine/Model.class.php"); 

    class Pesq extends Model 
    { 

        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Pesq'; 


        public $attribute    = array(); 
        public $calculate    = array();     
        public $query        = array();
       
        
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Ano_Id']['Type'] 			= 'number';
            $this->attribute['Ano_Id']['Length'] 		= Number15;
            $this->attribute['Ano_Id']['NN'] 			= 1;
            $this->attribute['Ano_Id']['Label'] 		= 'Ano';

            $this->attribute['Campus_Id']['Type'] 		= 'number';
            $this->attribute['Campus_Id']['Length']		= 15;
            $this->attribute['Campus_Id']['Label'] 		= 'Unidade';

            $this->attribute['Semestre_Id']['Type'] 	= 'number';
            $this->attribute['Semestre_Id']['Length'] 	= 15;
            $this->attribute['Semestre_Id']['NN'] 		= 1;
            $this->attribute['Semestre_Id']['Label'] 	= 'Semestre';

            $this->attribute['PesqTi_Id']['Type'] 		= 'number';
            $this->attribute['PesqTi_Id']['Length'] 	= 15;
            $this->attribute['PesqTi_Id']['NN'] 		= 1;
            $this->attribute['PesqTi_Id']['Label'] 		= 'Tipo';

            $this->attribute['Sequencia']['Type'] 		= 'number';
            $this->attribute['Sequencia']['Length'] 	= 2;
            $this->attribute['Sequencia']['Label'] 		= 'Sequência';

            $this->attribute['PesqQuest_Id']['Type'] 	= 'number';
            $this->attribute['PesqQuest_Id']['Length'] 	= 15;
            $this->attribute['PesqQuest_Id']['Label'] 	= 'Questão';

            $this->attribute['Complemento']['Type'] 	= 'varchar2';
            $this->attribute['Complemento']['Length'] 	= 100;
            $this->attribute['Complemento']['Label'] 	= 'Complemento a Questão';

            $this->attribute['QtdeQuestoes']['Type'] 	= 'number';
            $this->attribute['QtdeQuestoes']['Length'] 	= 3;
            $this->attribute['QtdeQuestoes']['Label'] 	= 'Qtde de Questões';

            $this->attribute['Curso_Id']['Type'] 		= 'number';
            $this->attribute['Curso_Id']['Length'] 		= 15;
            $this->attribute['Curso_Id']['Label'] 		= 'Curso';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Selecao_Id'] 		= 'Pesq_qSelecao';
            $this->calculate['Sequencia_Id'] 	= 'Pesq_qSequencia';
            $this->calculate['Capa_Id'] 		= 'Pesq_qCapa';

            $this->recognize['Recognize']	= 'Ano_Id, Campus_Id, Semestre_Id, Sequencia, Curso_Id';
            
            //Todas as Queries da classe
            $this->query['Selecao'] = 'Pesq_qSelecao';
            $this->query['Sequencia'] = 'Pesq_qSequencia';
            $this->query['Geral'] = 'Pesq_qGeral';
            $this->query['Capa'] = 'Pesq_qCapa';
            $this->query['Curso'] = 'Pesq_qCurso';
            $this->query['Id'] = 'Pesq_qId';
            $this->query['CountTipo'] = 'Pesq_qCountTipo';                             
            
        } 
} 
?> 