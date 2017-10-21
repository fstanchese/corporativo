<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class AlocXHor extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'AlocXHor'; 

         
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

            $this->attribute['AlocaProf_Junto_Id']['Type'] = 'number';
            $this->attribute['AlocaProf_Junto_Id']['Length'] = 15;
            $this->attribute['AlocaProf_Junto_Id']['Label'] = 'e a Disciplina';

            $this->attribute['HoraAula_01_Id']['Type'] = 'number';
            $this->attribute['HoraAula_01_Id']['Length'] = 15;
            $this->attribute['HoraAula_01_Id']['Label'] = 'Horário de Aula';

            $this->attribute['HoraAula_02_Id']['Type'] = 'number';
            $this->attribute['HoraAula_02_Id']['Length'] = 15;
            $this->attribute['HoraAula_02_Id']['Label'] = 'Horário de Aula';

            $this->attribute['HoraAula_03_Id']['Type'] = 'number';
            $this->attribute['HoraAula_03_Id']['Length'] = 15;
            $this->attribute['HoraAula_03_Id']['Label'] = 'Horário de Aula';

            $this->attribute['HoraAula_04_Id']['Type'] = 'number';
            $this->attribute['HoraAula_04_Id']['Length'] = 15;
            $this->attribute['HoraAula_04_Id']['Label'] = 'Horário de Aula';

            $this->attribute['HoraAula_05_Id']['Type'] = 'number';
            $this->attribute['HoraAula_05_Id']['Length'] = 15;
            $this->attribute['HoraAula_05_Id']['Label'] = 'Horário de Aula';

            $this->attribute['HoraAula_06_Id']['Type'] = 'number';
            $this->attribute['HoraAula_06_Id']['Length'] = 15;
            $this->attribute['HoraAula_06_Id']['Label'] = 'Horário de Aula';

            //Calculates para a criação de querys no diretório SQL

            //Todas as Queries da classe
            $this->query['qId'] = 'AlocXHor_qId';
            $this->query['qProfessor'] = 'AlocXHor_qProfessor';
            $this->query['qSincronia'] = 'AlocXHor_qSincronia';
            $this->query['qHistorico'] = 'AlocXHor_qHistorico';
            $this->query['qJunto'] = 'AlocXHor_qJunto';
            $this->query['qHoraAula'] = 'AlocXHor_qHoraAula';
            $this->query['qAlocaProf'] = 'AlocXHor_qAlocaProf';
            $this->query['qHorario'] = 'AlocXHor_qHorario';

                 
        } 
} 