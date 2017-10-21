
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Horario extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Horario'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         
        public function __construct($db) 
        {
        	$this->db = $db;

            $this->attribute['Semana_Id']['Type'] 		= 'number';
            $this->attribute['Semana_Id']['Length'] 	= 15;
            $this->attribute['Semana_Id']['NN'] 		= 1;
            $this->attribute['Semana_Id']['Label'] 		= 'Dia da Semana';

            $this->attribute['Periodo_Id']['Type'] 		= 'number';
            $this->attribute['Periodo_Id']['Length'] 	= 15;
            $this->attribute['Periodo_Id']['NN'] 		= 1;
            $this->attribute['Periodo_Id']['Label'] 	= 'Período';

            $this->attribute['HoraInicio']['Type'] 		= 'date';
            $this->attribute['HoraInicio']['NN'] 		= 1;
            $this->attribute['HoraInicio']['Label'] 	= 'Hora Inicial';

            $this->attribute['HorarioTi_Id']['Type'] 	= 'number';
            $this->attribute['HorarioTi_Id']['Length'] 	= 15;
            $this->attribute['HorarioTi_Id']['NN'] 		= 1;
            $this->attribute['HorarioTi_Id']['Label'] 	= 'Tipo do Horário';

            $this->attribute['Duracao']['Type'] 		= 'number';
            $this->attribute['Duracao']['Length'] 		= 4;
            $this->attribute['Duracao']['NN'] 			= 1;
            $this->attribute['Duracao']['Label'] 		= 'Duração minutos';

            $this->attribute['Sequencia']['Type'] 		= 'number';
            $this->attribute['Sequencia']['Length'] 	= 2;
            $this->attribute['Sequencia']['Label'] 		= 'Sequência da Aula';

            $this->attribute['Oficial']['Type'] 		= 'varchar2';
            $this->attribute['Oficial']['Length'] 		= 3;
            $this->attribute['Oficial']['Label'] 		= 'Horario Oficial';

            $this->attribute['Horario_P_Id']['Type'] 	= 'number';
            $this->attribute['Horario_P_Id']['Length'] 	= 15;
            $this->attribute['Horario_P_Id']['Label'] 	= 'Proximo Horario';
			
            $this->recognize['Recognize']	= 'Semana_Id, HoraInicio';
			
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Horario']	= 'Horario_qPeriodoSemana';

            //Todas as Queries da classe
            $this->query['qSequencia'] 		= 'Horario_qSequencia';
            $this->query['qSemana'] 		= 'Horario_qSemana';
            $this->query['qPeriodo'] 		= 'Horario_qPeriodo';
            $this->query['qDedicacao'] 		= 'Horario_qDedicacao';
            $this->query['qGeral'] 			= 'Horario_qGeral';
            $this->query['qHorario3'] 		= 'Horario_qHorario3';
            $this->query['qPeriodoSemana'] 	= 'Horario_qPeriodoSemana';
            $this->query['qHorario2'] 		= 'Horario_qHorario2';
            $this->query['qHoraNormal'] 	= 'Horario_qHoraNormal';
            $this->query['qHoraInicio'] 	= 'Horario_qHoraInicio';
            $this->query['qId'] 			= 'Horario_qId';
            $this->query['qTiPeSeHI'] 		= 'Horario_qTiPeSeHI';
            $this->query['qNormalEspecial']	= 'Horario_qNormalEspecial';
            $this->query['qNormal'] 		= 'Horario_qNormal';
            $this->query['qHorario'] 		= 'Horario_qHorario';
            $this->query['qHorario4'] 		= 'Horario_qHorario4';
            $this->query['qIdRecognize'] 	= 'Horario_qIdRecognize';
            $this->query['qHorario1'] 		= 'Horario_qHorario1';

                 
        }

} 
?> 
     