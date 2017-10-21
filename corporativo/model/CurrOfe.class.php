
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CurrOfe extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CurrOfe'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 1000;


            $this->attribute['Curr_Id']['Type'] 		= 'number';
            $this->attribute['Curr_Id']['Length'] 		= 15;
            $this->attribute['Curr_Id']['NN'] 			= 1;
            $this->attribute['Curr_Id']['Label'] 		= 'Currículo';

            $this->attribute['Periodo_Id']['Type'] 		= 'number';
            $this->attribute['Periodo_Id']['Length'] 	= 15;
            $this->attribute['Periodo_Id']['NN'] 		= 1;
            $this->attribute['Periodo_Id']['Label'] 	= 'Período';

            $this->attribute['Campus_Id']['Type'] 		= 'number';
            $this->attribute['Campus_Id']['Length'] 	= 15;
            $this->attribute['Campus_Id']['NN'] 		= 1;
            $this->attribute['Campus_Id']['Label'] 		= 'Unidade';

            $this->attribute['PLetivo_Id']['Type'] 		= 'number';
            $this->attribute['PLetivo_Id']['Length']	= 15;
            $this->attribute['PLetivo_Id']['NN'] 		= 1;
            $this->attribute['PLetivo_Id']['Label'] 	= 'Início Letivo';

            $this->attribute['Vest']['Type'] 			= 'varchar2';
            $this->attribute['Vest']['Length'] 			= 3;
            $this->attribute['Vest']['Label'] 			= 'Vestibular';
            $this->attribute['Vest']['NN'] 				= 0;

            $this->attribute['VestVagas']['Type'] 		= 'number';
            $this->attribute['VestVagas']['Length'] 	= 3;
            $this->attribute['VestVagas']['Label'] 		= 'Vagas no Vestibular';
            $this->attribute['VestVagas']['NN'] 		= 0;

            $this->attribute['VestChama']['Type'] 		= 'number';
            $this->attribute['VestChama']['Length'] 	= 3;
            $this->attribute['VestChama']['Label'] 		= 'Vagas no Vestibular';
            $this->attribute['VestChama']['NN'] 		= 0;

            $this->attribute['PROUNI']['Type'] 			= 'varchar2';
            $this->attribute['PROUNI']['Length'] 		= 3;
            $this->attribute['PROUNI']['Label'] 		= 'PROUNI';
            $this->attribute['PROUNI']['NN'] 			= 0;
            
            $this->attribute['RecCurso_Id']['Type']		= 'number';
            $this->attribute['RecCurso_Id']['Length'] 	= 15;
            $this->attribute['RecCurso_Id']['Label'] 	= 'Reconhecimento do Curso';
            $this->attribute['RecCurso_Id']['NN'] 		= 0;
            

            //Calculates para a criação de querys no diretório SQL
			$this->calculate['PLetivo'] 			= "CurrOfe_qDistInicio";
            $this->calculate['IdCursoInicio'] 		= 'CurrOfe_qInicioCursoSerie';
            $this->calculate['CurrSerie_Id'] 		= 'CurrOfe_qCurrSerie';
            $this->calculate['CursoSerie_Id'] 		= 'CurrOfe_qCursoSerie';
            $this->calculate['PesquisaSerie_Id'] 	= 'CurrOfe_qSeriePesquisa';
            $this->calculate['IdCursoInicioCurr'] 	= 'CurrOfe_qInicioCursoSerieCurr';
            $this->calculate['IdVest'] 				= 'CurrOfe_qIdVest';
            $this->calculate['IdVestTodos1'] 		= 'CurrOfe_qIdVestTodos';
            $this->calculate['IdVestTodos2'] 		= 'CurrOfe_qIdVestTodos';
            $this->calculate['IdPROUNIUSJT'] 		= 'CurrOfe_qPROUNI';


            //Recognizes
            $this->recognize['Recognize']	= 'Curr_Id,Periodo_Id,Campus_Id,PLetivo_Id';
            $this->recognize['RecPLetivo']	= 'PLetivo_Id';
            

            //Índices
            $this->index['IniCurrPeca']['Cols'] = "PLetivo_Id Curr_Id Periodo_Id Campus_Id";
            $this->index["IniCurrPeca"]["Unique"] = 1;

            $this->index['Curr']['Cols'] = "Curr_Id";
            $this->index['PLetivo']['Cols'] = "PLetivo_Id";
            $this->index['Campus']['Cols'] = "Campus_Id";

            //Todas as Queries da classe
            $this->query['qCurso'] 					= 'CurrOfe_qCurso';
            $this->query['qGradAlu'] 				= 'CurrOfe_qGradAlu';
            $this->query['qPrevisao'] 				= 'CurrOfe_qPrevisao';
            $this->query['qSerieAnterior'] 			= 'CurrOfe_qSerieAnterior';
            $this->query['qInicioCursoSerieCurr'] 	= 'CurrOfe_qInicioCursoSerieCurr';
            $this->query['qCurrSerie'] 				= 'CurrOfe_qCurrSerie';
            $this->query['qMaxSerie'] 				= 'CurrOfe_qMaxSerie';
            $this->query['qInicioCursoSerie'] 		= 'CurrOfe_qInicioCursoSerie';
            $this->query['qId'] 					= 'CurrOfe_qId';
            $this->query['qPROUNI'] 				= 'CurrOfe_qPROUNI';
            $this->query['qIdPROUNI'] 				= 'CurrOfe_qIdPROUNI';
            $this->query['qPLetivo'] 				= 'CurrOfe_qPLetivo';
            $this->query['qIdVestTodos'] 			= 'CurrOfe_qIdVestTodos';
            $this->query['qInicio'] 				= 'CurrOfe_qInicio';
            $this->query['qInicioCurso'] 			= 'CurrOfe_qInicioCurso';
            $this->query['qIdVest'] 				= 'CurrOfe_qIdVest';
            $this->query['qMatricCancelado'] 		= 'CurrOfe_qMatricCancelado';
            $this->query['qDistInicio'] 			= 'CurrOfe_qDistInicio';
            $this->query['qCursoSerie'] 			= 'CurrOfe_qCursoSerie';
            $this->query['qCancelado'] 				= 'CurrOfe_qCancelado';
            $this->query['qCursoPLetivo'] 			= 'CurrOfe_qCursoPLetivo';
            $this->query['qCursoNivel'] 			= 'CurrOfe_qCursoNivel';
            $this->query['qCoordPos'] 				= 'CurrOfe_qCoordPos';
            $this->query['qSeriePesquisa'] 			= 'CurrOfe_qSeriePesquisa';
            $this->query['qCurrInicio'] 			= 'CurrOfe_qCurrInicio';

                 
        } 
} 
?> 
   