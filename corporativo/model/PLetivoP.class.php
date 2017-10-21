
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class PLetivoP extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'PLetivoP'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query         = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 3000;


            $this->attribute['PLetivo_Id']['Type'] 			= 'number';
            $this->attribute['PLetivo_Id']['Length'] 		= 15;
            $this->attribute['PLetivo_Id']['NN'] 			= 1;
            $this->attribute['PLetivo_Id']['Label'] 		= 'Período Letivo';

            $this->attribute['Nome']['Type'] 				= 'varchar2';
            $this->attribute['Nome']['Length'] 				= 20;
            $this->attribute['Nome']['NN'] 					= 1;
            $this->attribute['Nome']['Label'] 				= 'Parcela';

            $this->attribute['DtInicial']['Type'] 			= 'date';
            $this->attribute['DtInicial']['NN'] 			= 1;
            $this->attribute['DtInicial']['Label'] 			= 'Data Inicial';
            $this->attribute['DtInicial']['Mask']	 		= 'd';

            $this->attribute['DtFinal']['Type'] 			= 'date';
            $this->attribute['DtFinal']['NN'] 				= 1;
            $this->attribute['DtFinal']['Label'] 			= 'Data Final';
            $this->attribute['DtFinal']['Mask'] 			= 'd';

            $this->attribute['Ciclo_Id']['Type'] 			= 'number';
            $this->attribute['Ciclo_Id']['Length'] 			= 15;
            $this->attribute['Ciclo_Id']['NN'] 				= 1;
            $this->attribute['Ciclo_Id']['Label']	 		= 'Periodicidade';

            $this->attribute['CriAvalPDt_Id']['Type'] 		= 'number';
            $this->attribute['CriAvalPDt_Id']['Length']		= 15;
            $this->attribute['CriAvalPDt_Id']['NN'] 		= 0;
            $this->attribute['CriAvalPDt_Id']['Label'] 		= 'Prova';

            $this->attribute['DtGeracao']['Type'] 			= 'date';
            $this->attribute['DtGeracao']['Label'] 			= 'Data da Geracao LPRE';
            $this->attribute['DtGeracao']['NN'] 			= 0;
            $this->attribute['DtGeracao']['Mask'] 			= 'd';

            $this->attribute['Mes_Id']['Type'] 				= 'number';
            $this->attribute['Mes_Id']['Length'] 			= 15;
            $this->attribute['Mes_Id']['NN'] 				= 0;
            $this->attribute['Mes_Id']['Label'] 			= 'Mes';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Selecao_Id'] 	= 'PLetivoP_qGeral';


            //Recognizes
            $this->recognize['Recognize'] 	= 'PLetivo_Id,Nome,Ciclo_Id';

            //Índices

            //Todas as Queries da classe
            $this->query['qDtGeracao'] 	= 'PLetivoP_qDtGeracao';
            $this->query['qAltTurma'] 	= 'PLetivoP_qAltTurma';
            $this->query['qMes'] 		= 'PLetivoP_qMes';
            //$this->query['qGeral'] 		= 'PLetivoP_qGeral';

                 
        } 
} 