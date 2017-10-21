
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class TOXCD extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'TOXCD'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 50000;


            $this->attribute['TurmaOfe_Id']['Type'] 			= 'number';
            $this->attribute['TurmaOfe_Id']['Length'] 			= 15;
            $this->attribute['TurmaOfe_Id']['NN'] 				= 1;
            $this->attribute['TurmaOfe_Id']['Label'] 			= 'Turma';

            $this->attribute['CurrXDisc_Id']['Type'] 			= 'number';
            $this->attribute['CurrXDisc_Id']['Length'] 			= 15;
            $this->attribute['CurrXDisc_Id']['Label'] 			= 'Disciplina';

            $this->attribute['DivTeoria']['Type'] 				= 'number';
            $this->attribute['DivTeoria']['Length'] 			= 2;
            $this->attribute['DivTeoria']['Label'] 				= 'Quantidade de Divisões-Teoria';

            $this->attribute['DivPratica']['Type'] 				= 'number';
            $this->attribute['DivPratica']['Length'] 			= 2;
            $this->attribute['DivPratica']['Label'] 			= 'Quantidade de Divisões-Prática';

            $this->attribute['DivLab']['Type'] 					= 'number';
            $this->attribute['DivLab']['Length'] 				= 2;
            $this->attribute['DivLab']['Label'] 				= 'Quantidade de Divisões-Laboratório';

            $this->attribute['CriDivTur_Teoria_Id']['Type'] 	= 'number';
            $this->attribute['CriDivTur_Teoria_Id']['Length'] 	= 15;
            $this->attribute['CriDivTur_Teoria_Id']['Label'] 	= 'Critério Utilizado-Teoria';

            $this->attribute['CriDivTur_Pratica_Id']['Type'] 	= 'number';
            $this->attribute['CriDivTur_Pratica_Id']['Length'] 	= 15;
            $this->attribute['CriDivTur_Pratica_Id']['Label'] 	= 'Critério Utilizado-Prática';

            $this->attribute['CriDivTur_Lab_Id']['Type'] 		= 'number';
            $this->attribute['CriDivTur_Lab_Id']['Length'] 		= 15;
            $this->attribute['CriDivTur_Lab_Id']['Label'] 		= 'Critério Utilizado-Laboratório';

            $this->attribute['WPessoa_ProfResp_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_ProfResp_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_ProfResp_Id']['Label'] 	= 'Professor Responsável';

            $this->attribute['CustoZero']['Type'] 				= 'varchar2';
            $this->attribute['CustoZero']['Length'] 			= 3;
            $this->attribute['CustoZero']['Label'] 				= 'Custo Zero';

            $this->attribute['DtInicio']['Type'] 				= 'date';
            $this->attribute['DtInicio']['Label'] 				= 'Início das Aulas';

            $this->attribute['DtTermino']['Type'] 				= 'date';
            $this->attribute['DtTermino']['Label'] 				= 'Término das Aulas';

            $this->attribute['WPessoa_ProfA2_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_ProfA2_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_ProfA2_Id']['Label'] 		= 'Professor';

            $this->attribute['WPessoa_ProfA3_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_ProfA3_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_ProfA3_Id']['Label'] 		= 'Professor';

            $this->attribute['WPessoa_ProfA4_Id']['Type'] 		= 'number';
            $this->attribute['WPessoa_ProfA4_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_ProfA4_Id']['Label'] 		= 'Professor';

            $this->attribute['Sala_Pratica_Id']['Type'] 		= 'number';
            $this->attribute['Sala_Pratica_Id']['Length'] 		= 15;
            $this->attribute['Sala_Pratica_Id']['Label'] 		= 'Sala';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['IdRecognize'] 	= 'TOXCD_qDiscSerie';
            $this->calculate['IdDiscEsp'] 		= 'TOXCD_qDiscEsp';
            $this->calculate['ProfNet_Id'] 		= 'TOXCD_qProfNet';
            $this->calculate['LancaNota_Id'] 	= 'TOXCD_qLancaNota';
			$this->calculate['Disciplina']		= 'TOXCD_qTurmaOfe';

            //Recognizes
            $this->recognize['Recognize'] = 'TurmaOfe_Id, CurrXDisc_Id';

            //Índices
            $this->index['TOXCD']['Cols'] = "turmaofe_id currxdisc_id";
            $this->index["TOXCD"]["Unique"] = 1;

            $this->index['TOXCDTurmaOfe']['Cols'] = "turmaofe_id ";
            $this->index['TOXCDCurrXDisc']['Cols'] = "CurrXDisc_Id ";

            //Todas as Queries da classe
            $this->query['qLPre'] 				= 'TOXCD_qLPre';
            $this->query['qProfAula'] 			= 'TOXCD_qProfAula';
            $this->query['qCurso'] 				= 'TOXCD_qCurso';
            $this->query['qCursoNivel'] 		= 'TOXCD_qCursoNivel';
            $this->query['qPresenca'] 			= 'TOXCD_qPresenca';
            $this->query['qGradAlu'] 			= 'TOXCD_qGradAlu';
            $this->query['qTurmaOfe'] 			= 'TOXCD_qTurmaOfe';
            $this->query['qQtdeAlunosNota'] 	= 'TOXCD_qQtdeAlunosNota';
            $this->query['qDiscSerie'] 			= 'TOXCD_qDiscSerie';
            $this->query['qIdEsp'] 				= 'TOXCD_qIdEsp';
            $this->query['qProfNet'] 			= 'TOXCD_qProfNet';
            $this->query['qHoraAula'] 			= 'TOXCD_qHoraAula';
            $this->query['qPLetivo'] 			= 'TOXCD_qPLetivo';
            $this->query['qProfessor'] 			= 'TOXCD_qProfessor';
            $this->query['qProfResp'] 			= 'TOXCD_qProfResp';
            $this->query['qTeste'] 				= 'TOXCD_qTeste';
            $this->query['qId'] 				= 'TOXCD_qId';
            $this->query['qLancaNota'] 			= 'TOXCD_qLancaNota';
            $this->query['qDiscEsp'] 			= 'TOXCD_qDiscEsp';
            $this->query['qProfCurso'] 			= 'TOXCD_qProfCurso';
            $this->query['qSerie'] 				= 'TOXCD_qSerie';

                 
        } 
} 