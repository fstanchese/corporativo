
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class FormaPag extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'FormaPag'; 

         
        public $attribute    = array(); 
        public $calculate    = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 1000;


            $this->attribute['Nome']['Type'] 				= 'varchar2';
            $this->attribute['Nome']['Length'] 				= 50;
            $this->attribute['Nome']['NN'] 					= 1;
            $this->attribute['Nome']['Label'] 				= 'Nome';
            $this->attribute['Nome']['Mask'] 				= 'Aa9';

            $this->attribute['CursoNivel_Id']['Type'] 		= 'number';
            $this->attribute['CursoNivel_Id']['Length'] 	= 15;
            $this->attribute['CursoNivel_Id']['NN'] 		= 1;
            $this->attribute['CursoNivel_Id']['Label'] 		= 'Aplicável ao Nível de Curso';

            $this->attribute['PLetivo_Id']['Type'] 			= 'number';
            $this->attribute['PLetivo_Id']['Length'] 		= 15;
            $this->attribute['PLetivo_Id']['NN'] 			= 1;
            $this->attribute['PLetivo_Id']['Label'] 		= 'Aplicável ao Período Letivo';

            $this->attribute['MatricTi_Id']['Type'] 		= 'number';
            $this->attribute['MatricTi_Id']['Length'] 		= 15;
            $this->attribute['MatricTi_Id']['NN'] 			= 1;
            $this->attribute['MatricTi_Id']['Label'] 		= 'Aplicável ao Tipo de Matrícula';

            $this->attribute['Padrao']['Type'] 				= 'varchar2';
            $this->attribute['Padrao']['Length'] 			= 3;
            $this->attribute['Padrao']['Label'] 			= 'É o tipo de cobrança padrão';
            $this->attribute['Padrao']['NN'] 				= 0;
            //Calculates para a criação de querys no diretório SQL


            //Recognizes
            $this->recognize['Recognize'] = 'Nome,PLetivo_Id,Padrao';

            //Índices
            $this->index['Nome']['Cols'] = "Nome";
            $this->index["Nome"]["Unique"] = 1;

            $this->index['Padrao']['Cols'] = "CursoNivel_Id,PLetivo_Id,MatricTi_Id,Padrao";
            $this->index["Padrao"]["Unique"] = 1;


            //Todas as Queries da classe            
            $this->query['qGeral']		= 'FormaPag_qGeral';
            $this->query['qId'] 		= 'FormaPag_qId';
            $this->query['qNivel'] 		= 'FormaPag_qNivel';
            $this->query['qRetPadrao'] 	= 'FormaPag_qRetPadrao';
            
        } 
} 

?>
