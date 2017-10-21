
<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class LPreFolha extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'LPreFolha'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
        public $index        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 600000;


            $this->attribute['LPre_Id']['Type'] 			= 'number';
            $this->attribute['LPre_Id']['Length'] 			= 15;
            $this->attribute['LPre_Id']['NN'] 				= 1;
            $this->attribute['LPre_Id']['Label'] 			= 'Lista de Presença';

            $this->attribute['LPreLote_Id']['Type'] 		= 'number';
            $this->attribute['LPreLote_Id']['Length'] 		= 15;
            $this->attribute['LPreLote_Id']['Label'] 		= 'Número do Lote';
            $this->attribute['LPreLote_Id']['NN'] 			= 0;

            $this->attribute['Folha']['Type'] 				= 'number';
            $this->attribute['Folha']['Length'] 			= 2;
            $this->attribute['Folha']['NN'] 				= 1;
            $this->attribute['Folha']['Label'] 				= 'Lista de Presença';

            $this->attribute['GradAlu_01_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_01_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_01_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_02_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_02_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_02_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_03_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_03_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_03_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_04_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_04_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_04_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_05_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_05_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_05_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_06_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_06_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_06_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_07_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_07_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_07_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_08_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_08_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_08_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_09_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_09_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_09_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_10_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_10_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_10_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_11_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_11_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_11_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_12_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_12_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_12_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_13_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_13_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_13_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_14_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_14_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_14_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_15_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_15_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_15_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_16_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_16_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_16_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_17_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_17_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_17_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_18_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_18_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_18_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_19_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_19_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_19_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_20_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_20_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_20_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_21_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_21_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_21_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_22_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_22_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_22_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_23_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_23_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_23_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_24_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_24_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_24_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_25_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_25_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_25_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_26_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_26_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_26_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_27_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_27_Id']['Length'] 	= 15;
            $this->attribute['GradAlu_27_Id']['NN'] 		= 0;

            $this->attribute['GradAlu_28_Id']['Type'] 		= 'number';
            $this->attribute['GradAlu_28_Id']['Length']		= 15;
            $this->attribute['GradAlu_28_Id']['NN'] 		= 0;

            $this->attribute['Falta_01']['Type'] 			= 'number';
            $this->attribute['Falta_01']['Length'] 			= 1;
            $this->attribute['Falta_01']['NN'] 				= 0;

            $this->attribute['Falta_02']['Type'] 			= 'number';
            $this->attribute['Falta_02']['Length'] 			= 1;
            $this->attribute['Falta_02']['NN'] 				= 0;

            $this->attribute['Falta_03']['Type'] 			= 'number';
            $this->attribute['Falta_03']['Length'] 			= 1;
            $this->attribute['Falta_03']['NN'] 				= 0;

            $this->attribute['Falta_04']['Type'] 			= 'number';
            $this->attribute['Falta_04']['Length'] 			= 1;
            $this->attribute['Falta_04']['NN'] 				= 0;

            $this->attribute['Falta_05']['Type'] 			= 'number';
            $this->attribute['Falta_05']['Length'] 			= 1;
            $this->attribute['Falta_05']['NN'] 				= 0;

            $this->attribute['Falta_06']['Type'] 			= 'number';
            $this->attribute['Falta_06']['Length'] 			= 1;
            $this->attribute['Falta_06']['NN'] 				= 0;

            $this->attribute['Falta_07']['Type'] 			= 'number';
            $this->attribute['Falta_07']['Length'] 			= 1;
            $this->attribute['Falta_07']['NN'] 				= 0;

            $this->attribute['Falta_08']['Type'] 			= 'number';
            $this->attribute['Falta_08']['Length'] 			= 1;
            $this->attribute['Falta_08']['NN'] 				= 0;

            $this->attribute['Falta_09']['Type'] 			= 'number';
            $this->attribute['Falta_09']['Length'] 			= 1;
            $this->attribute['Falta_09']['NN'] 				= 0;

            $this->attribute['Falta_10']['Type'] 			= 'number';
            $this->attribute['Falta_10']['Length'] 			= 1;
            $this->attribute['Falta_10']['NN'] 				= 0;

            $this->attribute['Falta_11']['Type'] 			= 'number';
            $this->attribute['Falta_11']['Length'] 			= 1;
            $this->attribute['Falta_11']['NN'] 				= 0;

            $this->attribute['Falta_12']['Type']		 	= 'number';
            $this->attribute['Falta_12']['Length'] 			= 1;
            $this->attribute['Falta_12']['NN'] 				= 0;

            $this->attribute['Falta_13']['Type'] 			= 'number';
            $this->attribute['Falta_13']['Length'] 			= 1;
            $this->attribute['Falta_13']['NN'] 				= 0;

            $this->attribute['Falta_14']['Type'] 			= 'number';
            $this->attribute['Falta_14']['Length'] 			= 1;
            $this->attribute['Falta_14']['NN'] 				= 0;

            $this->attribute['Falta_15']['Type'] 			= 'number';
            $this->attribute['Falta_15']['Length'] 			= 1;
            $this->attribute['Falta_15']['NN'] 				= 0;

            $this->attribute['Falta_16']['Type'] 			= 'number';
            $this->attribute['Falta_16']['Length'] 			= 1;
            $this->attribute['Falta_16']['NN'] 				= 0;

            $this->attribute['Falta_17']['Type'] 			= 'number';
            $this->attribute['Falta_17']['Length'] 			= 1;
            $this->attribute['Falta_17']['NN'] 				= 0;

            $this->attribute['Falta_18']['Type'] 			= 'number';
            $this->attribute['Falta_18']['Length'] 			= 1;
            $this->attribute['Falta_18']['NN'] 				= 0;

            $this->attribute['Falta_19']['Type'] 			= 'number';
            $this->attribute['Falta_19']['Length'] 			= 1;
            $this->attribute['Falta_19']['NN'] 				= 0;

            $this->attribute['Falta_20']['Type'] 			= 'number';
            $this->attribute['Falta_20']['Length'] 			= 1;
            $this->attribute['Falta_20']['NN'] 				= 0;

            $this->attribute['Falta_21']['Type'] 			= 'number';
            $this->attribute['Falta_21']['Length'] 			= 1;
            $this->attribute['Falta_21']['NN'] 				= 0;

            $this->attribute['Falta_22']['Type'] 			= 'number';
            $this->attribute['Falta_22']['Length'] 			= 1;
            $this->attribute['Falta_22']['NN'] 				= 0;

            $this->attribute['Falta_23']['Type'] 			= 'number';
            $this->attribute['Falta_23']['Length'] 			= 1;
            $this->attribute['Falta_23']['NN'] 				= 0;

            $this->attribute['Falta_24']['Type'] 			= 'number';
            $this->attribute['Falta_24']['Length'] 			= 1;
            $this->attribute['Falta_24']['NN'] 				= 0;

            $this->attribute['Falta_25']['Type'] 			= 'number';
            $this->attribute['Falta_25']['Length'] 			= 1;
            $this->attribute['Falta_25']['NN'] 				= 0;

            $this->attribute['Falta_26']['Type'] 			= 'number';
            $this->attribute['Falta_26']['Length'] 			= 1;
            $this->attribute['Falta_26']['NN'] 				= 0;
            	
            $this->attribute['Falta_27']['Type'] 			= 'number';
            $this->attribute['Falta_27']['Length'] 			= 1;
            $this->attribute['Falta_27']['NN'] 				= 0;

            $this->attribute['Falta_28']['Type'] 			= 'number';
            $this->attribute['Falta_28']['Length'] 			= 1;
            $this->attribute['Falta_28']['NN'] 				= 0;

            $this->attribute['FaltaProf']['Type'] 			= 'number';
            $this->attribute['FaltaProf']['Length'] 		= 1;
            $this->attribute['FaltaProf']['NN'] 			= 0;

            $this->attribute['State_Id']['Type'] 			= 'number';
            $this->attribute['State_Id']['Length'] 			= 15;
            $this->attribute['State_Id']['Label'] 			= 'Situação';
            $this->attribute['State_Id']['NN'] 				= 0;

            //Calculates para a criação de querys no diretório SQL


            //Recognizes

            //Índices
            $this->index['LPreFolha']['Cols'] 			= "LPre_Id Folha";
            $this->index["LPreFolha"]["Unique"] 		= 1;

            $this->index["LPreFolha"]["Unique"] 		= 0;

            $this->index['LPreGradAlu01']['Cols'] 			= "LPre_Id GradAlu_01_Id";
            $this->index["LPreGradAlu01"]["Unique"] 		= 0;

            $this->index['LPreGradAlu02']['Cols'] 			= "LPre_Id GradAlu_02_Id";
            $this->index["LPreGradAlu02"]["Unique"] 		= 0;

            $this->index['LPreGradAlu03']['Cols'] 			= "LPre_Id GradAlu_03_Id";
            $this->index["LPreGradAlu03"]["Unique"] 		= 0;

            $this->index['LPreGradAlu04']['Cols'] 			= "LPre_Id GradAlu_04_Id";
            $this->index["LPreGradAlu04"]["Unique"] 		= 0;

            $this->index['LPreGradAlu05']['Cols'] 			= "LPre_Id GradAlu_05_Id";
            $this->index["LPreGradAlu05"]["Unique"] 		= 0;

            $this->index['LPreGradAlu06']['Cols'] 			= "LPre_Id GradAlu_06_Id";
            $this->index["LPreGradAlu06"]["Unique"] 		= 0;

            $this->index['LPreGradAlu07']['Cols'] 			= "LPre_Id GradAlu_07_Id";
            $this->index["LPreGradAlu07"]["Unique"] 		= 0;

            $this->index['LPreGradAlu08']['Cols'] 			= "LPre_Id GradAlu_08_Id";
            $this->index["LPreGradAlu08"]["Unique"] 		= 0;

            $this->index['LPreGradAlu09']['Cols'] 			= "LPre_Id GradAlu_09_Id";
            $this->index["LPreGradAlu09"]["Unique"] 		= 0;

            $this->index['LPreGradAlu10']['Cols'] 			= "LPre_Id GradAlu_10_Id";
            $this->index["LPreGradAlu10"]["Unique"] 		= 0;

            $this->index['LPreGradAlu11']['Cols'] 			= "LPre_Id GradAlu_11_Id";
            $this->index["LPreGradAlu11"]["Unique"] 		= 0;

            $this->index['LPreGradAlu12']['Cols'] 			= "LPre_Id GradAlu_12_Id";
            $this->index["LPreGradAlu12"]["Unique"] 		= 0;

            $this->index['LPreGradAlu13']['Cols'] 			= "LPre_Id GradAlu_13_Id";
            $this->index["LPreGradAlu13"]["Unique"] 		= 0;

            $this->index['LPreGradAlu14']['Cols'] 			= "LPre_Id GradAlu_14_Id";
            $this->index["LPreGradAlu14"]["Unique"] 		= 0;

            $this->index['LPreGradAlu15']['Cols'] 			= "LPre_Id GradAlu_15_Id";
            $this->index["LPreGradAlu15"]["Unique"] 		= 0;

            $this->index['LPreGradAlu16']['Cols'] 			= "LPre_Id GradAlu_16_Id";
            $this->index["LPreGradAlu16"]["Unique"] 		= 0;

            $this->index['LPreGradAlu17']['Cols'] 			= "LPre_Id GradAlu_17_Id";
            $this->index["LPreGradAlu17"]["Unique"] 		= 0;

            $this->index['LPreGradAlu18']['Cols'] 			= "LPre_Id GradAlu_18_Id";
            $this->index["LPreGradAlu18"]["Unique"] 		= 0;

            $this->index['LPreGradAlu19']['Cols'] 			= "LPre_Id GradAlu_19_Id";
            $this->index["LPreGradAlu19"]["Unique"] 		= 0;

            $this->index['LPreGradAlu20']['Cols'] 			= "LPre_Id GradAlu_20_Id";
            $this->index["LPreGradAlu20"]["Unique"] 		= 0;

            $this->index['LPreGradAlu21']['Cols'] 			= "LPre_Id GradAlu_21_Id";
            $this->index["LPreGradAlu21"]["Unique"] 		= 0;

            $this->index['LPreGradAlu22']['Cols'] 			= "LPre_Id GradAlu_22_Id";
            $this->index["LPreGradAlu22"]["Unique"] 		= 0;

            $this->index['LPreGradAlu23']['Cols'] 			= "LPre_Id GradAlu_23_Id";
            $this->index["LPreGradAlu23"]["Unique"] 		= 0;

            $this->index['LPreGradAlu24']['Cols'] 			= "LPre_Id GradAlu_24_Id";
            $this->index["LPreGradAlu24"]["Unique"] 		= 0;

            $this->index['LPreGradAlu25']['Cols'] 			= "LPre_Id GradAlu_25_Id";
            $this->index["LPreGradAlu25"]["Unique"] 		= 0;

            $this->index['LPreGradAlu26']['Cols'] 			= "LPre_Id GradAlu_26_Id";
            $this->index["LPreGradAlu26"]["Unique"] 		= 0;

            $this->index['LPreGradAlu27']['Cols'] 			= "LPre_Id GradAlu_27_Id";
            $this->index["LPreGradAlu27"]["Unique"] 		= 0;

            $this->index['LPreGradAlu28']['Cols'] 			= "LPre_Id GradAlu_28_Id";
            $this->index["LPreGradAlu28"]["Unique"] 		= 0;

            $this->index['LPreStateGradAlu01']['Cols'] 		= "State_Id, GradAlu_01_Id";
            $this->index['LPreStateGradAlu01']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu02']['Cols'] 		= "State_Id, GradAlu_02_Id";
            $this->index['LPreStateGradAlu02']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu03']['Cols'] 		= "State_Id, GradAlu_03_Id";
            $this->index['LPreStateGradAlu03']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu04']['Cols'] 		= "State_Id, GradAlu_04_Id";
            $this->index['LPreStateGradAlu04']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu05']['Cols'] 		= "State_Id, GradAlu_05_Id";
            $this->index['LPreStateGradAlu05']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu06']['Cols'] 		= "State_Id, GradAlu_06_Id";
            $this->index['LPreStateGradAlu06']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu07']['Cols'] 		= "State_Id, GradAlu_07_Id";
            $this->index['LPreStateGradAlu07']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu08']['Cols'] 		= "State_Id, GradAlu_08_Id";
            $this->index['LPreStateGradAlu08']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu09']['Cols'] 		= "State_Id, GradAlu_09_Id";
            $this->index['LPreStateGradAlu09']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu10']['Cols'] 		= "State_Id, GradAlu_10_Id";
            $this->index['LPreStateGradAlu10']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu11']['Cols'] 		= "State_Id, GradAlu_11_Id";
            $this->index['LPreStateGradAlu11']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu12']['Cols'] 		= "State_Id, GradAlu_12_Id";
            $this->index['LPreStateGradAlu12']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu13']['Cols'] 		= "State_Id, GradAlu_13_Id";
            $this->index['LPreStateGradAlu13']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu14']['Cols'] 		= "State_Id, GradAlu_14_Id";
            $this->index['LPreStateGradAlu14']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu15']['Cols'] 		= "State_Id, GradAlu_15_Id";
            $this->index['LPreStateGradAlu15']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu16']['Cols'] 		= "State_Id, GradAlu_16_Id";
            $this->index['LPreStateGradAlu16']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu17']['Cols'] 		= "State_Id, GradAlu_17_Id";
            $this->index['LPreStateGradAlu17']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu18']['Cols'] 		= "State_Id, GradAlu_18_Id";
            $this->index['LPreStateGradAlu18']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu19']['Cols'] 		= "State_Id, GradAlu_19_Id";
            $this->index['LPreStateGradAlu19']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu20']['Cols'] 		= "State_Id, GradAlu_20_Id";
            $this->index['LPreStateGradAlu20']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu21']['Cols'] 		= "State_Id, GradAlu_21_Id";
            $this->index['LPreStateGradAlu21']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu22']['Cols'] 		= "State_Id, GradAlu_22_Id";
            $this->index['LPreStateGradAlu22']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu23']['Cols'] 		= "State_Id, GradAlu_23_Id";
            $this->index['LPreStateGradAlu23']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu24']['Cols'] 		= "State_Id, GradAlu_24_Id";
            $this->index['LPreStateGradAlu24']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu25']['Cols'] 		= "State_Id, GradAlu_25_Id";
            $this->index['LPreStateGradAlu25']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu26']['Cols'] 		= "State_Id, GradAlu_26_Id";
            $this->index['LPreStateGradAlu26']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu27']['Cols'] 		= "State_Id, GradAlu_27_Id";
            $this->index['LPreStateGradAlu27']['Unique'] 	= "0";
            	
            $this->index['LPreStateGradAlu28']['Cols'] 		= "State_Id, GradAlu_28_Id";
            $this->index['LPreStateGradAlu28']['Unique'] 	= "0";
            
            
            //Todas as Queries da classe
            $this->query['qAluno'] 			= 'LPreFolha_qAluno';
            $this->query['qGeral'] 			= 'LPreFolha_qGeral';
            $this->query['qQtdLPre'] 		= 'LPreFolha_qQtdLPre';
            $this->query['qNaoLidas'] 		= 'LPreFolha_qNaoLidas';
            $this->query['qLPre'] 			= 'LPreFolha_qLPre';
            $this->query['qGradAlu'] 		= 'LPreFolha_qGradAlu';
            $this->query['qProcessada'] 	= 'LPreFolha_qProcessada';
            $this->query['qACancelar'] 		= 'LPreFolha_qACancelar';
            $this->query['qId'] 			= 'LPreFolha_qId';

                 
        } 
        
        
} 
?> 