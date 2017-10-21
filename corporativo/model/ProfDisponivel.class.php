<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ProfDisponivel extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ProfDisponivel'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 3000;


            $this->attribute['PLetivo_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Id']['Length'] = 15;
            $this->attribute['PLetivo_Id']['Label'] = 'Período Letivo';
            $this->attribute['PLetivo_Id']['NN'] = 1;

            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['Label'] = 'Professor';
            $this->attribute['WPessoa_Id']['NN'] = 1;

            $this->attribute['Confirmado']['Type'] = 'varchar2';
            $this->attribute['Confirmado']['Length'] = 3;
            $this->attribute['Confirmado']['Label'] = 'Confirmado';

            $this->attribute['Horarios']['Type'] = 'varchar2';
            $this->attribute['Horarios']['Length'] = 168;
            $this->attribute['Horarios']['Label'] = 'Horarios';

            $this->attribute['DiscipLivre']['Type'] = 'varchar2';
            $this->attribute['DiscipLivre']['Length'] = 1000;
            $this->attribute['DiscipLivre']['Label'] = 'Disciplina / Curso';

            $this->attribute['TextoLivre']['Type'] = 'varchar2';
            $this->attribute['TextoLivre']['Length'] = 2000;
            $this->attribute['TextoLivre']['Label'] = 'Observações';

            //Calculates para a criação de querys no diretório SQL

            //Recognizes

            //Índices

            //Todas as Queries da classe
            $this->query['qWPessoa'] = 'ProfDisponivel_qWPessoa';
            $this->query['qId'] = 'ProfDisponivel_qId';

                 
        } 
} 