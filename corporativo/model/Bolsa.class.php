<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Bolsa extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Bolsa'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 100000;


            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['NN'] = 1;
            $this->attribute['WPessoa_Id']['Label'] = 'Aluno';

            $this->attribute['BolsaTi_Id']['Type'] = 'number';
            $this->attribute['BolsaTi_Id']['Length'] = 15;
            $this->attribute['BolsaTi_Id']['NN'] = 1;
            $this->attribute['BolsaTi_Id']['Label'] = 'Tipo da Bolsa';

            $this->attribute['Percentual']['Type'] = 'number';
            $this->attribute['Percentual']['Length'] = 7.4;
            $this->attribute['Percentual']['Label'] = 'Percentual';

            $this->attribute['Valor']['Type'] = 'number';
            $this->attribute['Valor']['Length'] = 12.2;
            $this->attribute['Valor']['Label'] = 'Valor';

            $this->attribute['State_Id']['Type'] = 'number';
            $this->attribute['State_Id']['Length'] = 15;
            $this->attribute['State_Id']['Label'] = 'Situaзгo';

            $this->attribute['DtInicio']['Type'] = 'date';
            $this->attribute['DtInicio']['NN'] = 1;
            $this->attribute['DtInicio']['Label'] = 'Inнcio';

            $this->attribute['DtTermino']['Type'] = 'date';
            $this->attribute['DtTermino']['NN'] = 1;
            $this->attribute['DtTermino']['Label'] = 'Tйrmino';

            $this->attribute['DtConcessao']['Type'] = 'date';
            $this->attribute['DtConcessao']['NN'] = 1;
            $this->attribute['DtConcessao']['Mask'] = 'd';
            $this->attribute['DtConcessao']['Label'] = 'Data da Concessгo';

            $this->attribute['Obrigatoria']['Type'] = 'varchar2';
            $this->attribute['Obrigatoria']['Length'] = 3;
            $this->attribute['Obrigatoria']['Label'] = 'Obrigatуria';

            $this->attribute['Cotas']['Type'] = 'varchar2';
            $this->attribute['Cotas']['Length'] = 3;
            $this->attribute['Cotas']['Label'] = 'Cotas';

            $this->attribute['QtdeDisciplinas']['Type'] = 'number';
            $this->attribute['QtdeDisciplinas']['Length'] = 3;
            $this->attribute['QtdeDisciplinas']['Label'] = 'Quantidade de Disciplinas';
            $this->attribute['QtdeDisciplinas']['Mask'] = '9';

            $this->attribute['PLetivo_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Id']['Length'] = 15;
            $this->attribute['PLetivo_Id']['Label'] = 'Periodo Letivo';

            $this->attribute['Mes_Inicio_Id']['Type'] = 'number';
            $this->attribute['Mes_Inicio_Id']['Length'] = 15;
            $this->attribute['Mes_Inicio_Id']['Label'] = 'Mкs de Inнcio';

            $this->attribute['Mes_Termino_Id']['Type'] = 'number';
            $this->attribute['Mes_Termino_Id']['Length'] = 15;
            $this->attribute['Mes_Termino_Id']['Label'] = 'Mкs de Tйrmino';

            $this->attribute['Matric_Id']['Type'] = 'number';
            $this->attribute['Matric_Id']['Length'] = 15;
            $this->attribute['Matric_Id']['Label'] = 'Matrнcula';

            $this->attribute['ConfTermo']['Type'] = 'varchar2';
            $this->attribute['ConfTermo']['Length'] = 3;
            $this->attribute['ConfTermo']['Label'] = 'Confirmaзгo do Recebimento do Termo';

            //Calculates para a criaзгo de querys no diretуrio SQL

            //Recognizes

            //Нndices
            $this->index['pessoa']['Cols'] = "wpessoa_id";
            $this->index['dtinicio']['Cols'] = "dtinicio";
            $this->index['dttermino']['Cols'] = "dttermino";
            $this->index['bolsati']['Cols'] = "bolsati_id";

            //Todas as Queries da classe

                 
        } 
        
        
        
        //Retorna o Percentual que o aluno possui de fies
        function GetFiesPercentual($p_WPessoa_Id, $dBase='', $p_Incidencia = '' )
        {
        	if ($dBase == '')
        	{
        		$dBase = date('d/m/Y');
        	}
        
        	$aReturn = '';
        
        	$sql = "select
	  					Bolsa_gnPercentual(bolsa.id, to_char( to_date( '". $dBase ."' ), 'mm'), 3)	as percentual,
  						to_char(bolsa.dtinicio, 'dd/mm/yyyy')										as dtinicio,
  						to_char(bolsa.dttermino, 'dd/mm/yyyy')										as dttermino,
	  					replace(bolsa.valor , ',','.')												as valor,
	  					bolsa.bolsati_id															as bolsati_id        			
					from
						Bolsa join Bolsati on bolsati_id=bolsati.id
					where
        			(
        				(
  							bolsati.mensalidade = 'on'
  						and
  							'" . $p_Incidencia . "' = 'MENSALIDADE'
  						)
  						or
        				(
  							bolsati.licenciatura = 'on'
  						and
  							'" . $p_Incidencia . "' = 'LICENCIATURA'
  						)
  						or
        				(
  							bolsati.dependencia = 'on'
  						and
  							'" . $p_Incidencia . "' = 'DEPENDENCIA'
  						)
  						or
        				(
  							bolsati.adaptacao = 'on'
  						and
  							'" . $p_Incidencia . "' = 'ADAPTACAO'
  						)
  						or
        				(
  							bolsati.estagioprof = 'on'
  						and
  							'" . $p_Incidencia . "' = 'ESTAGIOPROF'
  						)
  						or
        				(
  							bolsati.monografia = 'on'
  						and
  							'" . $p_Incidencia . "' = 'MONOGRAFIA'
  						)
  						or
  						(
  							'" . $p_Incidencia . "' is null
  						)			
  					)
  					and 
  						to_date( '" . $dBase . "' ) between to_date(bolsa.dtinicio) and to_date(bolsa.dttermino)
  					and
  						bolsa.bolsati_id in ( 10600000000048, 10600000000156, 10600000000152, 10600000000153, 10600000000160 ) 
  					and
  						bolsa.state_id=3000000018003
  					and
	  					bolsa.WPessoa_Id = nvl ( '" . $p_WPessoa_Id . "' ,0)
  					order by bolsati.nome";
        
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        
        	while ($row = $dbData->Row())
        	{
        		$aReturn[] = $row;
        	}
        
        	unset($dbData);
        
        
        	return $aReturn;
        }
        


        //Retorna o Percentual que o aluno possui de Prouni
        function GetProuniPercentual($p_WPessoa_Id, $dBase='')
        {
        	if ($dBase == '')
        	{
        		$dBase = date('d/m/Y');
        	}
        
        	$aReturn = '';
        
        	$sql = "select
	  					Bolsa_gnPercentual(bolsa.id, to_char( to_date( '". $dBase ."' ), 'mm'), 3)	as percentual,
  						to_char(bolsa.dtinicio, 'dd/mm/yyyy')										as dtinicio,
  						to_char(bolsa.dttermino, 'dd/mm/yyyy')										as dttermino,
	  					replace(bolsa.valor , ',','.')												as valor,
	  					bolsa.bolsati_id															as bolsati_id
					from
						Bolsa join Bolsati on bolsati_id=bolsati.id
					where
  						to_date( '" . $dBase . "' ) between to_date(bolsa.dtinicio) and to_date(bolsa.dttermino)
  					and
  						bolsa.bolsati_id = 10600000000049
  					and
  						bolsa.state_id=3000000018003
  					and
	  					bolsa.WPessoa_Id = nvl ( '" . $p_WPessoa_Id . "' ,0)
  					order by bolsati.nome";
        
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        
        	while ($row = $dbData->Row())
        	{
        		$aReturn = $row;
        	}
        
        	unset($dbData);
        
        
        	return $aReturn;
        }
        

        
        //Retorna o Percentual que o aluno possui de bolsa sem fies e Prouni
        function GetPercentualSemFiesProuni($p_WPessoa_Id, $dBase='', $p_Incidencia = '' )
        {
        	if ($dBase == '')
        	{
        		$dBase = date('d/m/Y');
        	}
        
        	$aReturn = '';
        
        	$sql = "select
	  					Bolsa_gnPercentual(bolsa.id, to_char( to_date( '". $dBase ."' ), 'mm'), 3)	as percentual,
  						to_char(bolsa.dtinicio, 'dd/mm/yyyy')										as dtinicio,
  						to_char(bolsa.dttermino, 'dd/mm/yyyy')										as dttermino,
	  					replace(bolsa.valor , ',','.')												as valor,
	  					bolsa.bolsati_id															as bolsati_id
					from
						Bolsa join Bolsati on bolsati_id=bolsati.id
					where
        			(
        				(
  							bolsati.mensalidade = 'on'
  						and
  							'" . $p_Incidencia . "' = 'MENSALIDADE'
  						)
  						or
        				(
  							bolsati.licenciatura = 'on'
  						and
  							'" . $p_Incidencia . "' = 'LICENCIATURA'
  						)
  						or
        				(
  							bolsati.dependencia = 'on'
  						and
  							'" . $p_Incidencia . "' = 'DEPENDENCIA'
  						)
  						or
        				(
  							bolsati.adaptacao = 'on'
  						and
  							'" . $p_Incidencia . "' = 'ADAPTACAO'
  						)
  						or
        				(
  							bolsati.estagioprof = 'on'
  						and
  							'" . $p_Incidencia . "' = 'ESTAGIOPROF'
  						)
  						or
        				(
  							bolsati.monografia = 'on'
  						and
  							'" . $p_Incidencia . "' = 'MONOGRAFIA'
  						)
  						or
  						(
  							'" . $p_Incidencia . "' is null
  						)
  					)
  					and
  						to_date( '" . $dBase . "' ) between to_date(bolsa.dtinicio) and to_date(bolsa.dttermino)
  					and
  						bolsa.bolsati_id not in ( 10600000000048, 10600000000156, 10600000000152, 10600000000153, 10600000000160, 10600000000049 )
  					and
  						bolsa.state_id=3000000018003
  					and
	  					bolsa.WPessoa_Id = nvl ( '" . $p_WPessoa_Id . "' ,0)
  					order by bolsati.nome";
        
        
        	$dbData = new DbData($this->db);
        
        	$dbData->Get($sql);
        
        	while ($row = $dbData->Row())
        	{
        		$aReturn[] = $row;
        	}
        
        	unset($dbData);
        
        
        	return $aReturn;
        }
        
        
	} 
?>