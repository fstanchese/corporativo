<?php

    require_once ("../engine/Model.class.php");

    class WOcorrIsento extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrIsento'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['PLetivo_Id']['Type'] 		= 'number';
            $this->attribute['PLetivo_Id']['Length'] 	= 15;
            $this->attribute['PLetivo_Id']['Label'] 	= 'Periodo Letivo';
            $this->attribute['PLetivo_Id']['NN'] 		= 1;

            $this->attribute['Matric_Id']['Type'] 		= 'number';
            $this->attribute['Matric_Id']['Length'] 	= 15;
            $this->attribute['Matric_Id']['Label'] 		= 'Matrícula';
            $this->attribute['Matric_Id']['NN'] 		= 1;

            $this->attribute['WPessoa_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Id']['Label'] 	= 'Aluno';
            $this->attribute['WPessoa_Id']['NN'] 		= 1;

            $this->recognize['Recognize']	= 'WPessoa_Id, Matric_Id, PLetivo_Id';
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['Id'] 		= 'WOcorrIsento_qId';
            $this->query['Pessoa'] 	= 'WOcorrIsento_qPessoa';
            $this->query['Geral'] 	= 'WOcorrIsento_qGeral';

                            
        }
}
?> 