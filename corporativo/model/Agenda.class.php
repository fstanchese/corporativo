<?php
        
    require_once ("../engine/Model.class.php");
        
    class Agenda extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'Agenda'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        
        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 15000;


            $this->attribute['Campus_Id']['Type'] 			= 'number';
            $this->attribute['Campus_Id']['Length'] 		= 15;
            $this->attribute['Campus_Id']['NN'] 			= 0;
            $this->attribute['Campus_Id']['Label'] 			= 'Unidade';

            $this->attribute['Depart_Id']['Type'] 			= 'number';
            $this->attribute['Depart_Id']['Length'] 		= 15;
            $this->attribute['Depart_Id']['NN'] 			= 1;
            $this->attribute['Depart_Id']['Label'] 			= 'Departamento';

            $this->attribute['DtInicio']['Type'] 			= 'date';
            $this->attribute['DtInicio']['NN'] 				= 1;
            $this->attribute['DtInicio']['Label'] 			= 'Data de Início';

            $this->attribute['HoraInicio']['Type'] 			= 'varchar2';
            $this->attribute['HoraInicio']['Length'] 		= 5;
            $this->attribute['HoraInicio']['NN'] 			= 0;
            $this->attribute['HoraInicio']['Label'] 		= 'Horário de Início';

            $this->attribute['DtTermino']['Type'] 			= 'date';
            $this->attribute['DtTermino']['NN'] 			= 0;
            $this->attribute['DtTermino']['Label'] 			= 'Data de Término';

            $this->attribute['HoraTermino']['Type'] 		= 'varchar2';
            $this->attribute['HoraTermino']['Length'] 		= 5;
            $this->attribute['HoraTermino']['NN'] 			= 0;
            $this->attribute['HoraTermino']['Label'] 		= 'Horário de Término';

            $this->attribute['AgendaAss_Id']['Type'] 		= 'number';
            $this->attribute['AgendaAss_Id']['Length'] 		= 15;
            $this->attribute['AgendaAss_Id']['NN'] 			= 1;
            $this->attribute['AgendaAss_Id']['Label'] 		= 'Assunto';

            $this->attribute['Descricao']['Type'] 			= 'varchar2';
            $this->attribute['Descricao']['Length'] 		= 500;
            $this->attribute['Descricao']['NN'] 			= 1;
            $this->attribute['Descricao']['Label'] 			= 'Descrição';

            $this->attribute['Ciclo_Id']['Type'] 			= 'number';
            $this->attribute['Ciclo_Id']['Length'] 			= 15;
            $this->attribute['Ciclo_Id']['NN'] 				= 0;
            $this->attribute['Ciclo_Id']['Label'] 			= 'Ciclo';

            $this->attribute['WPessoa_Resp_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_Resp_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Resp_Id']['NN'] 		= 0;
            $this->attribute['WPessoa_Resp_Id']['Label'] 	= 'Usuário Responsável';

            $this->attribute['WPessoa_UltAlt_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_UltAlt_Id']['Length']	= 15;
            $this->attribute['WPessoa_UltAlt_Id']['NN'] 	= 0;
            $this->attribute['WPessoa_UltAlt_Id']['Label'] 	= 'US da Última Alteração';

            $this->attribute['Realizado']['Type'] 			= 'varchar2';
            $this->attribute['Realizado']['Length'] 		= 3;
            $this->attribute['Realizado']['NN'] 			= 0;
            $this->attribute['Realizado']['Label'] 			= 'Realizado?';

            $this->attribute['WPessoa_Id']['Type'] 			= 'number';
            $this->attribute['WPessoa_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Id']['NN'] 			= 1;
            $this->attribute['WPessoa_Id']['Label'] 		= 'Criado por';

            $this->attribute['Ativo']['Type'] 				= 'varchar2';
            $this->attribute['Ativo']['Length'] 			= 3;
            $this->attribute['Ativo']['NN'] 				= 0;
            $this->attribute['Ativo']['Label'] 				= 'Ativo';

            $this->attribute['Campus_Destino_Id']['Type'] 	= 'number';
            $this->attribute['Campus_Destino_Id']['Length']	= 15;
            $this->attribute['Campus_Destino_Id']['NN'] 	= 0;
            $this->attribute['Campus_Destino_Id']['Label'] 	= 'Unidade de Destino';

            $this->attribute['WPessoa_Conc_Id']['Type'] 	= 'number';
            $this->attribute['WPessoa_Conc_Id']['Length'] 	= 15;
            $this->attribute['WPessoa_Conc_Id']['NN'] 		= 0;
            $this->attribute['WPessoa_Conc_Id']['Label'] 	= 'Concluído por';

            $this->attribute['DtConclusao']['Type'] 		= 'date';
            $this->attribute['DtConclusao']['NN'] 			= 1;
            $this->attribute['DtConclusao']['Label'] 		= 'Data de Conclusão';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['WPessoa_Usuario'] 	= 'Agenda_qUserDepto';


            //Recognizes
            $this->recognize['Recognize'] 	= 'DtInicio, HoraInicio, DtTermino, HoraTermino, Descricao';

            //Índices

            //Todas as Queries da classe
            $this->query['qAndamento'] 		= 'Agenda_qAndamento';
            $this->query['qConcluido'] 		= 'Agenda_qConcluido';
            $this->query['qGeral'] 			= 'Agenda_qGeral';
        	$this->query['qId']				= 'Agenda_qId';    
        	$this->query['qNaoConcluida'] 	= 'Agenda_qNaoConcluida';
        	$this->query['qResponsavel'] 	= 'Agenda_qResponsavel';        	 
        	$this->query['qUltAlt'] 		= 'Agenda_qUltAlt';
            $this->query['qUserDepto'] 		= 'Agenda_qUserDepto';

                
        }
        
        
        public function GetAgendaInfo($Agenda_Id)
        {
        
        	$dbData = new DbData($this->db);
        	 
        	if($param["class"] != "") $param['class'] .= " dataGrid"; else $param["class"] = "dataGrid";
        	 
        	$param["cellspacing"] = 1;
        	 
        	 
        	$row = $this->GetIdInfo($Agenda_Id);
        	
        	$vDtTermino =  date("Ymd", mktime(0,0,0, date("m"), date("d")+7, date("y")));
        	$vDt = date("Ymd");
        	$vStrong = '';
        	
        	if ($row[DtInicioFormat] >= $vDt && $row[DtInicioFormat] <= $vDtTermino)
        	{
        		$vStrong = "<span style='color:#FF0000;'>";
        	}
        	
	       	$html  = $this->Table(array($param)).$this->Tr();
        	$html .= $this->Td(array("class"=>"pequeno")) . $vStrong . $row[DTINICIO] . ' ' . _diaDaSemana($row[DTINICIO],1)  . ' ' . $row[HORAINICIO] . $this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . $vStrong  . _NVL($row[DTTERMINO],$row[DTINICIO]) . ' ' . _diaDaSemana(_NVL($row[DTTERMINO],$row[DTINICIO]),1) . ' ' . $row[HORATERMINO] . $this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . $vStrong  . $row[AGENDAASS_NOME]                                    . $this->CloseTd();
        	$html .= $this->Td(array("class"=>"grande"))  . $vStrong  . $row[DESCRICAO]                                         . $this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . $vStrong  . $row[CAMPUS_DESTINO_NOME]                               . $this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . $vStrong  . $row[CICLO_NOME]                                        . $this->CloseTd();
        	$html .= $this->Td(array("class"=>"pequeno")) . $vStrong  . $row[WPESSOA_RESP_NOME]                                 . $this->CloseTd();
        	$html .= $this->CloseTr().$this->CloseTable();
        	 
        	 
        	return $html;
        
        }
        
        public function GetAgendaCalFormat($data,$depart_Id)
        {

        	$dbData = new DbData($this->db);
        	
        	
        	$aMeses = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

        	$arData = explode('/',$data);
        	$diaD = $arData[0];
        	$mesD = $arData[1];
        	$anoD = $arData[2];
        	
        	$cal_mes = $aMeses[(int)$mesD] . ' ' . $anoD;
        	
        	
        	$ts = mktime(0, 0, 0, $mesD, $diaD, $anoD );
        	$diaInicio = date('w',$ts);
        	
        	$diasSemana = array('Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado');
        	
        	$html = "\n\t<h2><a href=\"javascript:fAlteraData('menos');\"><img src=\"assets/images/anterior.png\" width=25px height=25px border=0></a>&nbsp;&nbsp;$cal_mes&nbsp;&nbsp;<a href=\"javascript:fAlteraData('mais');\"><img src=\"assets/images/proximo.png\" width=25px height=25px border=0></a></h2>";
        	for ( $d=0, $labels=NULL; $d < 7; ++$d)
        	{
        		$labels .= "\n\t\t<li>" . $diasSemana[$d] . "</li>";
        	}
        	
      	
        	$html .= "\n\t<ul class=\"diasSemana\"><strong>".$labels."</strong>\n\t</ul>";
        	
        	$html .= "\n\t<ul>";

        	$diasNoMes =  date('t', mktime(0, 0, 0, $mesD, $diaD, $anoD ));
        	
     	
        	for ( $i=1, $c=1, $t=(int)$diaD, $m=$mesD, $y=$anoD; $c<=$diasNoMes; ++$i )
        	{
        		$class = $i<=$diaInicio ? "fill" : NULL;
        	
        		if ($c==$t && $m==$mesD && $y==$anoD)
        		{
        			$class = "today";
        		}
        	
        		$ls = sprintf("\n\t\t<li class=\"%s\">", $class);
        		$le = "\n\t\t</li>";

        		if ( $diaInicio<$i && $diasNoMes>=$c )
        		{

        			$p_Data = sprintf('%02d',$c).'/'.$mesD.'/'.$anoD;
        			 
        			$date = sprintf("\n\t\t\t\t<strong>%02d</strong>", $c++);
        			
        			$dbData->Get("select count(*) as Qtde from agenda where to_date('$p_Data') between trunc(dtinicio) and trunc(dttermino) and depart_id='$depart_Id'");
        			
        			$row = $dbData->Row();        			
        			if ($row[QTDE] > 0)
        			{
        				$date .= "\n\n<img border=0 class=OpenAgenda id=$p_Data width=50px src=../images/post-it-yellow.png>";
        			}
        		}
        		else
        		{
        			$date = "&nbsp;";
        		}
        		
        		$wrap = $i!=0 && $i%7==0 ? "\n\t</ul>\n\t<ul>" : NULL;
        	
        		$html .= $ls . $date . $evento_info . $le . $wrap;
        	
        	}
        	
        	while ( $i%7!=1 )
        	{
        		$html .= "\n\t\t<li class=\"fill\">&nbsp;</li>";
        		++$i;
        	}
        	
        	$html .= "\n\t</ul>\n\n<br><br>";
        	
        	return $html;
        	
        }
        
}
?>
    