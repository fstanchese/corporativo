<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AlocXHorDt extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AlocXHorDt'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 10000;


            $this->attribute['AlocaProf_Id']['Type'] = 'number';
            $this->attribute['AlocaProf_Id']['Length'] = 15;
            $this->attribute['AlocaProf_Id']['NN'] = 1;
            $this->attribute['AlocaProf_Id']['Label'] = 'Professor';

            $this->attribute['Indice']['Type'] = 'number';
            $this->attribute['Indice']['Length'] = 1;
            $this->attribute['Indice']['Label'] = 'Indice';

            $this->attribute['Horario_01_Id']['Type'] = 'number';
            $this->attribute['Horario_01_Id']['Length'] = 15;
            $this->attribute['Horario_01_Id']['Label'] = 'Horário';

            $this->attribute['Horario_02_Id']['Type'] = 'number';
            $this->attribute['Horario_02_Id']['Length'] = 15;
            $this->attribute['Horario_02_Id']['Label'] = 'Horário';

            $this->attribute['Horario_03_Id']['Type'] = 'number';
            $this->attribute['Horario_03_Id']['Length'] = 15;
            $this->attribute['Horario_03_Id']['Label'] = 'Horário';

            $this->attribute['Horario_04_Id']['Type'] = 'number';
            $this->attribute['Horario_04_Id']['Length'] = 15;
            $this->attribute['Horario_04_Id']['Label'] = 'Horário';

            $this->attribute['Horario_05_Id']['Type'] = 'number';
            $this->attribute['Horario_05_Id']['Length'] = 15;
            $this->attribute['Horario_05_Id']['Label'] = 'Horário';

            $this->attribute['Horario_06_Id']['Type'] = 'number';
            $this->attribute['Horario_06_Id']['Length'] = 15;
            $this->attribute['Horario_06_Id']['Label'] = 'Horário';

            $this->attribute['DtInicio']['Type'] = 'date';
            $this->attribute['DtInicio']['NN'] = 1;
            $this->attribute['DtInicio']['Label'] = 'Horário de Aula Válido a partir de';

            $this->attribute['DtTermino']['Type'] = 'date';
            $this->attribute['DtTermino']['Label'] = 'Horário de Aula Válido até';

            $this->attribute['Professor_Id']['Type'] = 'number';
            $this->attribute['Professor_Id']['Length'] = 15;
            $this->attribute['Professor_Id']['Label'] = 'Professor';

            $this->attribute['State_Id']['NN'] = 1;
            $this->attribute['State_Id']['Type'] = 'number';
            $this->attribute['State_Id']['Length'] = 15;
            $this->attribute['State_Id']['Label'] = 'Situação';

            $this->attribute['Finalizado']['Type'] = 'varchar2';
            $this->attribute['Finalizado']['Length'] = 1;
            $this->attribute['Finalizado']['Label'] = 'finalizado';

            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qSimular'] = 'AlocXHorDt_qSimular';
            $this->query['qDtInicio'] = 'AlocXHorDt_qDtInicio';
            $this->query['qProfQuadro'] = 'AlocXHorDt_qProfQuadro';
            $this->query['qTurmaQuadro'] = 'AlocXHorDt_qTurmaQuadro';

                 
        } 
} 