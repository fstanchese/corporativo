<?php

    require_once ("../engine/Model.class.php");

    class WOcorrassInf extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrAssInf'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Informacao']['Type'] 		= 'varchar2';
            $this->attribute['Informacao']['Length'] 	= 40;
            $this->attribute['Informacao']['NN']		= 1;
            $this->attribute['Informacao']['Label'] 	= 'Informação';
            $this->attribute['Informacao']['Recognize']	= '1';

            $this->attribute['Label']['Type'] 			= 'varchar2';
            $this->attribute['Label']['Length'] 		= 40;
            $this->attribute['Label']['NN'] 			= 1;
            $this->attribute['Label']['Label'] 			= 'Label';

            $this->attribute['Atributo']['Type'] 		= 'varchar2';
            $this->attribute['Atributo']['Length'] 		= 50;
            $this->attribute['Atributo']['NN'] 			= 1;
            $this->attribute['Atributo']['Label'] 		= 'Código Fonte';

            $this->attribute['Entrada']['Type'] 		= 'varchar2';
            $this->attribute['Entrada']['Length'] 		= 30;
            $this->attribute['Entrada']['NN'] 			= 1;
            $this->attribute['Entrada']['Label'] 		= 'Tipo de Entrada';
            
            $this->attribute['Selecao']['Type'] 		= 'varchar2';
            $this->attribute['Selecao']['Length'] 		= 50;
            $this->attribute['Selecao']['NN'] 			= 0;
            $this->attribute['Selecao']['Label'] 		= 'Query';

            $this->attribute['Formatacao']['Type'] 		= 'varchar2';
            $this->attribute['Formatacao']['Length'] 	= 70;
            $this->attribute['Formatacao']['NN'] 		= 0;
            $this->attribute['Formatacao']['Label'] 	= 'Formatacao';
            
            
            $this->recognize['Recognize']	= 'Informacao';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Assunto']	= 'WOcorrAssInf_qAssunto';
	
            //Todas as Queries da classe
            $this->query['qAssunto']	= 'WOcorrAssInf_qAssunto';
            $this->query['qGeral'] 		= 'WOcorrAssInf_qGeral';
            $this->query['qId'] 		= 'WOcorrAssInf_qId';
            $this->query['qSelecao']	= 'WOcorrAssInf_qSelecao';

                            
        }
}
?> 