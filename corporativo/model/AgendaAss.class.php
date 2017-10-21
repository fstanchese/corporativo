<?php
        
    require_once ("../engine/Model.class.php");
        
    class AgendaAss extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'AgendaAss'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 100;


            $this->attribute['Descricao']['Type'] 	= 'varchar2';
            $this->attribute['Descricao']['Length']	= 200;
            $this->attribute['Descricao']['NN'] 	= 1;
            $this->attribute['Descricao']['Label'] 	= 'Descrição';

            $this->attribute['Depart_Id']['Type'] 	= 'number';
            $this->attribute['Depart_Id']['Length']	= 15;
            $this->attribute['Depart_Id']['NN'] 	= 1;
            $this->attribute['Depart_Id']['Label'] 	= 'Departamento';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Descricao';

            //Índices

            //Todas as Queries da classe
            $this->query['qDepart'] = 'AgendaAss_qDepart';
            $this->query['qGeral'] = 'AgendaAss_qGeral';
            $this->query['qId'] = 'AgendaAss_qId';
            $this->query['qWPes'] = 'AgendaAss_qWPes';

                
        }
        

}
?>
   