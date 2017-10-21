<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Sala extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Sala'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         
        public function __construct($db) 
        {
        	$this->db = $db;

            $this->attribute['Codigo']['Type'] 			= 'varchar2';
            $this->attribute['Codigo']['Length'] 		= 10;
            $this->attribute['Codigo']['NN'] 			= 1;
            $this->attribute['Codigo']['Label'] 		= 'Código';
            $this->attribute['Codigo']['Recognize'] 	= '1';

            $this->attribute['Campus_Id']['Type'] 		= 'number';
            $this->attribute['Campus_Id']['Length'] 	= 15;
            $this->attribute['Campus_Id']['NN'] 		= 1;
            $this->attribute['Campus_Id']['Label'] 		= 'Unidade';

            $this->attribute['Metragem']['Type'] 		= 'number';
            $this->attribute['Metragem']['Length'] 		= 3;
            $this->attribute['Metragem']['Label'] 		= 'Metragem';

            $this->attribute['QtdMaxAlun']['Type'] 		= 'number';
            $this->attribute['QtdMaxAlun']['Length'] 	= 3;
            $this->attribute['QtdMaxAlun']['Label'] 	= 'Quantidade Máxima de Alunos';

            $this->attribute['QtdCarteiras']['Type'] 	= 'number';
            $this->attribute['QtdCarteiras']['Length'] 	= 3;
            $this->attribute['QtdCarteiras']['Label'] 	= 'Quantidade de Carteiras';

            $this->attribute['QtdAtualCart']['Type'] 	= 'number';
            $this->attribute['QtdAtualCart']['Length'] 	= 3;
            $this->attribute['QtdAtualCart']['Label'] 	= 'Qtde Atual de Carteiras';

            $this->attribute['Preview']['Type'] 		= 'number';
            $this->attribute['Preview']['Length'] 		= 3;
            $this->attribute['Preview']['Label'] 		= 'Preview Matrícula';

            $this->attribute['QtdMaxCand']['Type'] 		= 'number';
            $this->attribute['QtdMaxCand']['Length'] 	= 3;
            $this->attribute['QtdMaxCand']['Label'] 	= 'Quantidade Máxima de Candidatos para o Vestibular';

            $this->attribute['QtdProvaEsp']['Type'] 	= 'number';
            $this->attribute['QtdProvaEsp']['Length'] 	= 3;

            $this->attribute['Andar_Id']['Type'] 		= 'number';
            $this->attribute['Andar_Id']['Length'] 		= 15;
            $this->attribute['Andar_Id']['Label'] 		= 'Andar';

            $this->attribute['Bloco_Id']['Type'] 		= 'number';
            $this->attribute['Bloco_Id']['Length'] 		= 15;
            $this->attribute['Bloco_Id']['Label'] 		= 'Bloco';

            $this->attribute['VestOrdem']['Type'] 		= 'number';
            $this->attribute['VestOrdem']['Length'] 	= 3;
            $this->attribute['VestOrdem']['Label'] 		= 'Ordem de alocação no Vestibular';

            $this->attribute['VestAlocados']['Type'] 	= 'number';
            $this->attribute['VestAlocados']['Length']	= 3;
            $this->attribute['VestAlocados']['Label'] 	= 'Numero de candidatos alocados';

            $this->attribute['SalaTi_Id']['Type'] 		= 'number';
            $this->attribute['SalaTi_Id']['Length'] 	= 15;
            $this->attribute['SalaTi_Id']['NN'] 		= 1;
            $this->attribute['SalaTi_Id']['Label'] 		= 'Tipo da Sala';

            $this->attribute['Nome']['Type'] 			= 'varchar2';
            $this->attribute['Nome']['Length'] 			= 50;
            $this->attribute['Nome']['Label'] 			= 'Nome da Sala';

            $this->attribute['Depart_Id']['Type'] 		= 'number';
            $this->attribute['Depart_Id']['Length'] 	= 15;
            $this->attribute['Depart_Id']['Label'] 		= 'Departamento';

            $this->attribute['Sala_Pai_Id']['Type'] 	= 'number';
            $this->attribute['Sala_Pai_Id']['Length'] 	= 15;
            $this->attribute['Sala_Pai_Id']['Label'] 	= 'Faz parte da Sala';

            $this->recognize['Recognize']	= 'Codigo';
            
            //Calculates para a criação de querys no diretório SQL
			$this->calculate["Geral"] 		= 'Sala_qGeral';
			$this->calculate["SS"] 			= 'Sala_qSS';
            
            //Todas as Queries da classe
            $this->query['qEtiCandSala'] 	= 'Sala_qEtiCandSala';
            $this->query['qPLetivo'] 		= 'Sala_qPLetivo';
            $this->query['qExist'] 			= 'Sala_qExist';
            $this->query['qQtdCand']	 	= 'Sala_qQtdCand';
            $this->query['qQtdCandConf'] 	= 'Sala_qQtdCandConf';
            $this->query['qTipoSala'] 		= 'Sala_qTipoSala';
            $this->query['qSSDetalhe'] 		= 'Sala_qSSDetalhe';
            $this->query['qCampus'] 		= 'Sala_qCampus';
            $this->query['qAlocaVest'] 		= 'Sala_qAlocaVest';
            $this->query['qVestibular'] 	= 'Sala_qVestibular';
            $this->query['qSS'] 			= 'Sala_qSS';
            $this->query['qTipoLab'] 		= 'Sala_qTipoLab';
            $this->query['qCodigo'] 		= 'Sala_qCodigo';
            $this->query['qId'] 			= 'Sala_qId';
            $this->query['qVestQtdeBut']	= 'Sala_qVestQtdeBut';
            $this->query['qGeral'] 			= 'Sala_qGeral';
            $this->query['qVest'] 			= 'Sala_qVest';
            $this->query['qSelecaoAuto']	= 'Sala_qSelecaoAuto';
                 
        }

        public function AutoComplete($value)
        {
                
        	$dbData = new DbData($this->db);
        		
        	$arVal[p_Sala_Codigo] = utf8_decode($value);
        		
        	$dbData->Get($this->Query("qSelecaoAuto",$arVal));
        	
        		
        	if($dbData->Count() > 100)	die('0');
        	if($dbData->Count() == 0) 	die('1');
        		
        		
        	echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
        		
        	while($row = $dbData->Row())
        	{
        			
        		echo $this->Li(array("idr"=>$row[ID],"nomeExibicao"=>str_replace("'","´",$row[CODIGO])));
        		echo $row[CODIGO];
        		echo $this->CloseLi();
        			
        	}
        		
        	echo $this->CloseUl();
        		
        	unset($dbData);
        		
        		
        }        
        
}
?>