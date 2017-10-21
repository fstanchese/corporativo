
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class CriAvalPDt extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'CriAvalPDt'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 100;


            $this->attribute['PLetivo_Id']['Type'] 			= 'number';
            $this->attribute['PLetivo_Id']['Length'] 		= 15;
            $this->attribute['PLetivo_Id']['NN'] 			= 1;
            $this->attribute['PLetivo_Id']['Label'] 		= 'Per�odo Letivo';

            $this->attribute['CriAvalP_Id']['Type'] 		= 'number';
            $this->attribute['CriAvalP_Id']['Length'] 		= 15;
            $this->attribute['CriAvalP_Id']['NN'] 			= 1;
            $this->attribute['CriAvalP_Id']['Label'] 		= 'Tipo de Prova';

            $this->attribute['DtIniCad']['Type'] 			= 'date';
            $this->attribute['DtIniCad']['Label'] 			= 'In�cio do Cadastro das Provas';
            $this->attribute['DtIniCad']['NN'] 				= 0;
            
            $this->attribute['DtTerCad']['Type'] 			= 'date';
            $this->attribute['DtTerCad']['Label'] 			= 'T�rmino do Cadastro das Provas';
            $this->attribute['DtTerCad']['NN'] 				= 0;
            
            $this->attribute['DtIniRev']['Type'] 			= 'date';
            $this->attribute['DtIniRev']['Label'] 			= 'In�cio da Revis�o de Notas';
            $this->attribute['DtIniRev']['NN'] 				= 0;
            
            $this->attribute['DtTerRev']['Type'] 			= 'date';
            $this->attribute['DtTerRev']['Label'] 			= 'T�rmino do Revis�o de Notas';
            $this->attribute['DtTerRev']['NN'] 				= 0;
            
            $this->attribute['DtIniProv']['Type'] 			= 'date';
            $this->attribute['DtIniProv']['Label'] 			= 'In�cio do Per�odo de Provas';
            $this->attribute['DtIniProv']['NN'] 			= 0;
            
            $this->attribute['DtTerProv']['Type'] 			= 'date';
            $this->attribute['DtTerProv']['Label'] 			= 'T�rmino do Per�odo de Provas';
            $this->attribute['DtTerProv']['NN'] 			= 0;
            
            $this->attribute['DtEntProv']['Type'] 			= 'date';
            $this->attribute['DtEntProv']['Label'] 			= 'Data Limite para Entrega das Provas';
            $this->attribute['DtEntProv']['NN'] 			= 0;
            
            $this->attribute['DtEntProvEsp']['Type'] 		= 'date';
            $this->attribute['DtEntProvEsp']['Label'] 		= 'Data Limite para Entrega das Provas Especiais';
            $this->attribute['DtEntProvEsp']['NN'] 			= 0;
            
            $this->attribute['Internet']['Type'] 			= 'varchar2';
            $this->attribute['Internet']['Length'] 			= 3;
            $this->attribute['Internet']['Label'] 			= 'Dispon�vel na Internet?';
            $this->attribute['Internet']['NN']	 			= 0;

            $this->attribute['LimiteProvaEsp']['Type'] 		= 'number';
            $this->attribute['LimiteProvaEsp']['Length'] 	= 15;
            $this->attribute['LimiteProvaEsp']['Label'] 	= 'Limite m�ximo de alunos para as Provas Especiais';
            $this->attribute['LimiteProvaEsp']['NN'] 		= 0;

            //Calculates para a cria��o de querys no diret�rio SQL
            $this->calculate['SelPLetivo_Id'] 	= 'CriAvalPDt_qSelPLetivo';
            $this->calculate['Notas_Id'] 		= 'CriAvalPDt_qNotas';
            $this->calculate['IdRecognize'] 	= 'CriAvalPDt_qPLetivo';


            //Recognizes
            $this->recognize['Recognize'] = 'CriAvalP_Id';

            //�ndices
            $this->index['CriAvalAp']['Cols'] = "PLetivo_Id CriAvalP_Id";
            $this->index["CriAvalAp"]["Unique"] = 1;


            //Todas as Queries da classe
            $this->query['qPLetivo'] 	= 'CriAvalPDt_qPLetivo';
            $this->query['qId'] 		= 'CriAvalPDt_qId';
            $this->query['qCriAval'] 	= 'CriAvalPDt_qCriAval';
            $this->query['qDtProv'] 	= 'CriAvalPDt_qDtProv';
            $this->query['qGeral'] 		= 'CriAvalPDt_qGeral';
            $this->query['qInternet'] 	= 'CriAvalPDt_qInternet';
            $this->query['qDtCad'] 		= 'CriAvalPDt_qDtCad';
            $this->query['qNotas'] 		= 'CriAvalPDt_qNotas';
            $this->query['qSelPLetivo']	= 'CriAvalPDt_qSelPLetivo';

                 
        } 
        
} 

?>