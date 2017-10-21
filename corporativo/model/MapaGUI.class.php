<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class MapaGUI extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'MapaGUI'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query         = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 2000;

            $this->attribute['MapaSub_Id']['Type'] 		= 'number';
            $this->attribute['MapaSub_Id']['Length'] 	= 15;
            $this->attribute['MapaSub_Id']['NN'] 		= 1;
            $this->attribute['MapaSub_Id']['Label'] 	= 'Menu Mapa';
            
            $this->attribute['IndexGUI_Id']['Type'] 	= 'number';
            $this->attribute['IndexGUI_Id']['Length'] 	= 15;
            $this->attribute['IndexGUI_Id']['NN'] 		= 1;
            $this->attribute['IndexGUI_Id']['Label'] 	= 'Página';
            
            $this->attribute['LinkBox']['Type'] 	= 'varchar2';
            $this->attribute['LinkBox']['Length'] 	= 3;
            $this->attribute['LinkBox']['Label'] 	= 'Abre em Box?';
            
            
            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] 	= 'MapaSub_Id,IndexGUI_Id';

            //Índices
			$this->index['Nome'] = 'Nome';
			
            //Todas as Queries da classe
            $this->query['qMapa']		= 'MapaGUI_qMapa';
            $this->query['qMapaSub']	= 'MapaGUI_qMapaSub';
                 
        } 
} 