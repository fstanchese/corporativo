<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class EstagioEmp extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'EstagioEmp'; 
 
        public $attribute = array(); 
        public $calculate = array(); 
        public $query     = array();
         
        public $rows; 
                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 1000;

            $this->attribute['CGC']['Type'] = 'varchar2';
            $this->attribute['CGC']['Length'] = 14;
            $this->attribute['CGC']['NN'] = 1;
            $this->attribute['CGC']['Label'] = 'CNPJ';
            $this->attribute['CGC']['Mask'] = '9';

            $this->attribute['IE']['Type'] = 'varchar2';
            $this->attribute['IE']['Length'] = 15;
            $this->attribute['IE']['Label'] = 'Inscrição Estadual';
            $this->attribute['IE']['Mask'] = '9';

            $this->attribute['CCM']['Type'] = 'varchar2';
            $this->attribute['CCM']['Length'] = 8;
            $this->attribute['CCM']['Label'] = 'CCM';
            $this->attribute['CCM']['Mask'] = '9';

            $this->attribute['Razao']['Type'] = 'varchar2';
            $this->attribute['Razao']['Length'] = 100;
            $this->attribute['Razao']['NN'] = 1;
            $this->attribute['Razao']['Label'] = 'Razão Social';

            $this->attribute['Fantasia']['Type'] = 'varchar2';
            $this->attribute['Fantasia']['Length'] = 50;
            $this->attribute['Fantasia']['NN'] = 1;
            $this->attribute['Fantasia']['Label'] = 'Nome Fantasia';

            $this->attribute['Fone']['Type'] = 'varchar2';
            $this->attribute['Fone']['Length'] = 20;
            $this->attribute['Fone']['Label'] = 'Telefone';
            $this->attribute['Fone']['Mask'] = '9Xx-, /';

            $this->attribute['Email']['Type'] = 'varchar2';
            $this->attribute['Email']['Length'] = 100;
            $this->attribute['Email']['Label'] = 'Email';
            $this->attribute['Email']['Mask'] = 'e';

            $this->attribute['Lograd_Id']['Type'] = 'number';
            $this->attribute['Lograd_Id']['Length'] = 15;
            $this->attribute['Lograd_Id']['Label'] = 'Endereço';

            $this->attribute['EnderNum']['Type'] = 'varchar2';
            $this->attribute['EnderNum']['Length'] = 14;
            $this->attribute['EnderNum']['Label'] = 'Número/Complemento';

            $this->attribute['Agente']['Type'] = 'varchar2';
            $this->attribute['Agente']['Length'] = 3;
            $this->attribute['Agente']['Label'] = 'Agente de Integração';

            $this->attribute['Ramo']['Type'] = 'varchar2';
            $this->attribute['Ramo']['Length'] = 100;
            $this->attribute['Ramo']['Label'] = 'Ramo de Atividade';

            $this->attribute['Descricao']['Type'] = 'varchar2';
            $this->attribute['Descricao']['Length'] = 1000;
            $this->attribute['Descricao']['Label'] = 'Descrição das Instalações';

            $this->attribute['EstagioEmpTi_Id']['Type'] = 'number';
            $this->attribute['EstagioEmpTi_Id']['Length'] = 15;
            $this->attribute['EstagioEmpTi_Id']['Label'] = 'Tipo';

            //Calculates para a criação de querys no diretório SQL

            //Recognizes
            $this->recognize['Recognize'] = 'Fantasia';

            //Índices
            $this->index['Fantasia']['Cols'] = "Fantasia";
            $this->index["Fantasia"]["Unique"] = 1;

            $this->index['CGC']['Cols'] = "CGC";
            $this->index["CGC"]["Unique"] = 1;

            //Todas as Queries da classe
            $this->query['qSelecao'] = 'EstagioEmp_qSelecao';
            $this->query['qSelecaoCount'] = 'EstagioEmp_qSelecaoCount';
            $this->query['qGeral'] = 'EstagioEmp_qGeral';

                 
        } 
	} 

?>