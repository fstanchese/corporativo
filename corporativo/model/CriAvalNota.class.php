<?php 

    require_once ("../engine/Model.class.php"); 

    class CriAvalNota extends Model 
    { 

        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CriAvalNota'; 


        public $attribute     = array(); 
        public $calculate     = array();     
        public $query        = array();
       
        
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['CriAval_Id']['Type'] 		= 'number';
            $this->attribute['CriAval_Id']['Length'] 	= 15;
            $this->attribute['CriAval_Id']['NN'] 		= 1;
            $this->attribute['CriAval_Id']['Label']		= 'Critério de Avaliação';

            $this->attribute['NotaTi_Id']['Type'] 		= 'number';
            $this->attribute['NotaTi_Id']['Length']		= 15;
            $this->attribute['NotaTi_Id']['NN'] 		= 1;
            $this->attribute['NotaTi_Id']['Label'] 		= 'Tipo de Nota';

            $this->attribute['Label']['Type'] 			= 'varchar2';
            $this->attribute['Label']['Length'] 		= 30;
            $this->attribute['Label']['NN'] 			= 1;
            $this->attribute['Label']['Label'] 			= 'Label';

            $this->attribute['Atributo']['Type'] 		= 'varchar2';
            $this->attribute['Atributo']['Length'] 		= 3;
            $this->attribute['Atributo']['NN'] 			= 1;
            $this->attribute['Atributo']['Label'] 		= 'Atributo';

            $this->recognize['Recognize']	= 'Label';
            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qId'] 			= 'CriAvalNota_qId';
            $this->query['qGeral'] 			= 'CriAvalNota_qGeral';
            $this->query['qCriterioNota'] 	= 'CriAvalNota_qCriterioNota';
                             
        } 
} 
?> 