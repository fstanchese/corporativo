<?php

    require_once ("../engine/Model.class.php");

    class AnexoTi extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'AnexoTi'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();

        
        public function __construct($db)
        {
        	$this->db = $db;
            $this->attribute['Anexo']['Type'] 		= 'varchar2';
            $this->attribute['Anexo']['Length'] 	= 100;
            $this->attribute['Anexo']['NN'] 		= 1;
            $this->attribute['Anexo']['Label'] 		= 'Tipo de Anexo';

            $this->attribute['Ativo']['Type'] 		= 'varchar2';
            $this->attribute['Ativo']['Length'] 	= 3;
            $this->attribute['Ativo']['Label'] 		= 'Ativar Tipo de Anexo?';

            $this->recognize['Recognize']			= 'Anexo';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['AnexoTiList'] 		= 'AnexoTi_qGeral';
            $this->calculate['AnexoTiAtivoList'] 	= 'AnexoTi_qAtivo';            

            //Todas as Queries da classe
            $this->query['qAtivo'] 		= 'AnexoTi_qAtivo';
            $this->query['qGeral']		= 'AnexoTi_qGeral';
            $this->query['qId'] 		= 'AnexoTi_qId';

                            
        }
}
?> 