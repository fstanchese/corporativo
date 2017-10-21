
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class ColacaoGrau extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'ColacaoGrau'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 500;


            $this->attribute['PLetivo_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Id']['Length'] = 15;
            $this->attribute['PLetivo_Id']['NN'] = 1;
            $this->attribute['PLetivo_Id']['Label'] = 'Período Letivo';

            $this->attribute['Curso_Id']['Type'] = 'number';
            $this->attribute['Curso_Id']['Length'] = 15;
            $this->attribute['Curso_Id']['Label'] = 'Curso';

            $this->attribute['Serie']['Type'] = 'number';
            $this->attribute['Serie']['Length'] = 2;
            $this->attribute['Serie']['Label'] = 'Série';

            $this->attribute['Curr_Id']['Type'] = 'number';
            $this->attribute['Curr_Id']['Length'] = 15;
            $this->attribute['Curr_Id']['Label'] = 'Curriculos';

            $this->attribute['DtColacao']['Type'] = 'date';
            $this->attribute['DtColacao']['NN'] = 1;
            $this->attribute['DtColacao']['Label'] = 'Data da Colação';

            $this->attribute['Horario']['Type'] = 'varchar2';
            $this->attribute['Horario']['Length'] = 10;
            $this->attribute['Horario']['NN'] = 1;
            $this->attribute['Horario']['Label'] = 'Horário';

            $this->attribute['ColacaoGrauTi_Id']['Type'] = 'number';
            $this->attribute['ColacaoGrauTi_Id']['Length'] = 15;
            $this->attribute['ColacaoGrauTi_Id']['NN'] = 1;
            $this->attribute['ColacaoGrauTi_Id']['Label'] = 'Tipo Colação de Grau';

            $this->attribute['WPessoa_Pres_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Pres_Id']['Length'] = 15;
            $this->attribute['WPessoa_Pres_Id']['Label'] = 'Presidente da Solenidade';

            $this->attribute['Localizacao']['Type'] = 'varchar2';
            $this->attribute['Localizacao']['Length'] = 100;
            $this->attribute['Localizacao']['NN'] = 1;
            $this->attribute['Localizacao']['Label'] = 'Local';

            $this->attribute['Campus_Id']['Type'] = 'number';
            $this->attribute['Campus_Id']['Length'] = 15;
            $this->attribute['Campus_Id']['NN'] = 1;
            $this->attribute['Campus_Id']['Label'] = 'Unidade';

            $this->attribute['TurmaOfe_Id']['Type'] 			= 'number';
            $this->attribute['TurmaOfe_Id']['Length'] 			= 15;
            $this->attribute['TurmaOfe_Id']['Label'] 			= 'Turma';

            $this->attribute['Colacao']['Type'] 					= 'varchar2';
            $this->attribute['Colacao']['Length']					= 3;
            $this->attribute['Colacao']['NN'] 					= 0;
            
            $this->attribute['Diploma']['Type'] 					= 'varchar2';
            $this->attribute['Diploma']['Length']					= 3;
            $this->attribute['Diploma']['NN'] 					= 0;
            
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['CursoDt_Id'] = 'ColacaoGrau_qCurso';

            //Recognizes
            $this->recognize['Recognize'] = 'PLetivo_Id,Curso_Id,DtColacao,Horario,ColacaoGrauTi_Id';

            //Índices
            $this->index['ColacaoUnica']['Cols'] = "Campus_Id PLetivo_Id,Curso_Id,Serie,Curr_Id,DtColacao,ColacaoGrauTi_Id unique";

            //Todas as Queries da classe
            $this->query['qConvocacao'] 		= 'ColacaoGrau_qConvocacao';
            $this->query['qDataColacao'] 		= 'ColacaoGrau_qDataColacao';
            $this->query['qColacaoOficial'] 	= 'ColacaoGrau_qColacaoOficial';
            $this->query['qId'] 				= 'ColacaoGrau_qId';
            $this->query['qPLetivo'] 			= 'ColacaoGrau_qPLetivo';
            $this->query['qColacaoEspecial'] 	= 'ColacaoGrau_qColacaoEspecial';
            $this->query['qQtdeColacaoEsp'] 	= 'ColacaoGrau_qQtdeColacaoEsp';

                 
        } 
} 