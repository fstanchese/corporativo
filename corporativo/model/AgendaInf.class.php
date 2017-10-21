<?php
        
    require_once ("../engine/Model.class.php");
        
    class AgendaInf extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'AgendaInf'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();


        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 15000;


            $this->attribute['WPessoa_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Id']['NN'] 		= 1;
            $this->attribute['WPessoa_Id']['Label'] 	= 'Funcionário';

            $this->attribute['Descricao']['Type'] 		= 'varchar2';
            $this->attribute['Descricao']['Length'] 	= 1000;
            $this->attribute['Descricao']['NN'] 		= 1;
            $this->attribute['Descricao']['Label'] 		= 'Descrição';

            $this->attribute['Agenda_Id']['Type'] 		= 'number';
            $this->attribute['Agenda_Id']['Length'] 	= 15;
            $this->attribute['Agenda_Id']['NN'] 		= 1;
            $this->attribute['Agenda_Id']['Label'] 		= 'Agenda';
   
            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Descricao';

            //Índices
            $this->index['WPessoa_Id']['Cols'] = "WPessoa_Id ";

            //Todas as Queries da classe
            $this->query['qAgenda'] 	= 'AgendaInf_qAgenda';
            $this->query['qGeral'] 		= 'AgendaInf_qGeral';
            $this->query['qId']			= 'AgendaInf_qId';			

                
        }
        

}
?> 