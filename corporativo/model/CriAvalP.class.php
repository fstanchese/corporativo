
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CriAvalP extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CriAvalP'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 200;


            $this->attribute['Nome']['Type'] 				= 'varchar2';
            $this->attribute['Nome']['Length'] 				= 30;
            $this->attribute['Nome']['NN'] 					= 1;

            $this->attribute['GradAluNota']['Type'] 		= 'number';
            $this->attribute['GradAluNota']['Length'] 		= 2;
            $this->attribute['GradAluNota']['Label'] 		= 'Provas';

            $this->attribute['CriAval_Id']['Type'] 			= 'number';
            $this->attribute['CriAval_Id']['Length'] 		= 15;

            $this->attribute['NomeAbreviado']['Type'] 		= 'varchar2';
            $this->attribute['NomeAbreviado']['Length'] 	= 10;

            $this->attribute['Substitutiva']['Type'] 		= 'varchar2';
            $this->attribute['Substitutiva']['Length'] 	= 3;
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Selecao'] 	= 'CriAvalP_qGradAluNota';


            //Recognizes
            $this->recognize['Recognize'] 	= 'Nome';

            //Índices

            //Todas as Queries da classe
            $this->query['qPLetivo'] 		= 'CriAvalP_qPLetivo';
            $this->query['qId'] 			= 'CriAvalP_qId';
            $this->query['qGradAluNota']	= 'CriAvalP_qGradAluNota';

                 
        } 
} 