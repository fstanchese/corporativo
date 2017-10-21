<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class DivTurma extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'DivTurma'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

        public function __construct($db)         
        {
        	$this->db = $db;

            $this->attribute['Nome']['Type'] 		= 'varchar2';
            $this->attribute['Nome']['Length'] 		= 20;
            $this->attribute['Nome']['NN'] 			= 1;
            $this->attribute['Nome']['Label'] 		= 'Divisão';            

            $this->attribute['Numero']['Type'] 		= 'number';
            $this->attribute['Numero']['Length'] 	= 2;
            $this->attribute['Numero']['NN'] 		= 1;
            $this->attribute['Numero']['Label'] 	= 'Sequência';

			$this->recognize['Recognize'] = "Nome";
			
            //Calculates para a criação de querys no diretório SQL
			$this->calculate['Prova'] = 'DivTurma_qProva';
			
            //Todas as Queries da classe
            $this->query['qDivTurTeoria'] 	= 'DivTurma_qDivTurTeoria';
            $this->query['qProva'] 			= 'DivTurma_qProva';
            $this->query['qGradAluLab'] 	= 'DivTurma_qGradAluLab';
            $this->query['qDivTurPratica'] 	= 'DivTurma_qDivTurPratica';
            $this->query['qGeral'] 			= 'DivTurma_qGeral';
            $this->query['qGradAluTeoria'] 	= 'DivTurma_qGradAluTeoria';
            $this->query['qDivTurLab'] 		= 'DivTurma_qDivTurLab';
            $this->query['qDivisao'] 		= 'DivTurma_qDivisao';
            $this->query['qGradAluPratica'] = 'DivTurma_qGradAluPratica';
            $this->query['qId'] 			= 'DivTurma_qId';

                 
        }

} 