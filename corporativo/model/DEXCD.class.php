<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class DEXCD extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'DEXCD'; 
         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         
        public $rows; 
                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10000;

            $this->attribute['DiscEsp_Id']['Type'] = 'number';
            $this->attribute['DiscEsp_Id']['Length'] = 15;
            $this->attribute['DiscEsp_Id']['NN'] = 1;
            $this->attribute['DiscEsp_Id']['Label'] = 'Disciplina Especial';

            $this->attribute['CurrXDisc_Id']['Type'] = 'number';
            $this->attribute['CurrXDisc_Id']['Length'] = 15;
            $this->attribute['CurrXDisc_Id']['NN'] = 1;
            $this->attribute['CurrXDisc_Id']['Label'] = 'Currнculo x Disciplina';

            //Recognizes
            $this->recognize['Recognize'] = 'CurrXDisc_Id';
            
            //Calculates para a criaзгo de querys no diretуrio SQL

            //Нndices
            $this->index['DiscEsp']['Cols'] = "DiscEsp_Id";
            $this->index['CurrXDisc']['Cols'] = "CurrXDisc_Id";
            $this->index['recognize']['Cols'] = "DiscEsp_Id,CurrXDisc_Id";
            $this->index["recognize"]["Unique"] = 1;

            //Todas as Queries da classe
            $this->query['qId'] = 'DEXCD_qId';
            $this->query['qDiscEsp'] = 'DEXCD_qDiscEsp';
                 
        } 
	}
	 
?>