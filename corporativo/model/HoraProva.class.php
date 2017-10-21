<?php
        
    require_once ("../engine/Model.class.php");
        
    class HoraProva extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'HoraProva'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();

        
        public function __construct($db)
        {

        	$this->db = $db;
        	
            $this->attribute['TOXCD_Id']['Type'] 			= 'number';
            $this->attribute['TOXCD_Id']['Length'] 			= 15;
            $this->attribute['TOXCD_Id']['NN'] 				= 1;
            $this->attribute['TOXCD_Id']['Label'] 			= 'Disciplina';

            $this->attribute['CriAvalPDt_Id']['Type'] 		= 'number';
            $this->attribute['CriAvalPDt_Id']['Length'] 	= 15;
            $this->attribute['CriAvalPDt_Id']['Label'] 		= 'Prova';
            $this->attribute['CriAvalPDt_Id']['NN'] 		= 1;

            $this->attribute['Campus_Id']['Type'] 			= 'number';
            $this->attribute['Campus_Id']['Length'] 		= 15;
            $this->attribute['Campus_Id']['NN'] 			= 0;
            $this->attribute['Campus_Id']['Label'] 			= 'Unidade';

            $this->attribute['Data']['Type'] 				= 'date';
            $this->attribute['Data']['NN'] 					= 1;
            $this->attribute['Data']['Label'] 				= 'Dia e Horário';

            $this->attribute['Sala_Id']['Type'] 			= 'number';
            $this->attribute['Sala_Id']['Length'] 			= 15;
            $this->attribute['Sala_Id']['Label'] 			= 'Sala';
            $this->attribute['Sala_Id']['NN'] 				= 0;

            $this->attribute['DivTurma_Id']['Type'] 		= 'number';
            $this->attribute['DivTurma_Id']['Length'] 		= 15;
            $this->attribute['DivTurma_Id']['NN'] 			= 1;
            $this->attribute['DivTurma_Id']['Label'] 		= 'Divisão';

            $this->attribute['Duracao']['Type'] 			= 'number';
            $this->attribute['Duracao']['Length'] 			= 3;
            $this->attribute['Duracao']['Label'] 			= 'Duração min';
            $this->attribute['Duracao']['NN'] 				= 0;

            $this->attribute['WPessoa_Id']['Type'] 			= 'number';
            $this->attribute['WPessoa_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Id']['Label'] 		= 'Professor';
            $this->attribute['WPessoa_Id']['NN'] 			= 0;

            $this->attribute['Facul_Id']['Type'] 			= 'number';
            $this->attribute['Facul_Id']['Length'] 			= 15;
            $this->attribute['Facul_Id']['Label'] 			= 'Nome';
            $this->attribute['Facul_Id']['NN'] 				= 0;

            $this->attribute['EspForaPrazo']['Type'] 		= 'varchar2';
            $this->attribute['EspForaPrazo']['Length']		= 3;
            $this->attribute['EspForaPrazo']['Label'] 		= 'Prova Especial Solicitada Fora do Prazo Oficial';
            $this->attribute['EspForaPrazo']['NN'] 			= 0;

            
            $this->recognize["Recognize"]	= "TOXCD_Id,Data,DivTurma_Id";
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Horarios_Id'] = 'HoraProva_qProvaEsp';
            $this->calculate['HoraPEsp_Id'] = 'HoraProva_qWPessoaEsp';

            //Todas as Queries da classe
            $this->query['qQuaProvaTurma'] = 'HoraProva_qQuaProvaTurma';
            $this->query['qQtdeCurso'] = 'HoraProva_qQtdeCurso';
            $this->query['qAtaQtdeAlunos'] = 'HoraProva_qAtaQtdeAlunos';
            $this->query['qGradAlu'] = 'HoraProva_qGradAlu';
            $this->query['qComprovanteProvaEsp'] = 'HoraProva_qComprovanteProvaEsp';
            $this->query['qTurma'] = 'HoraProva_qTurma';
            $this->query['qProfessor'] = 'HoraProva_qProfessor';
            $this->query['qAtaGeral'] = 'HoraProva_qAtaGeral';
            $this->query['qTurmaOfe'] = 'HoraProva_qTurmaOfe';
            $this->query['qQtdProvaTurma'] = 'HoraProva_qQtdProvaTurma';
            $this->query['qUltimaSerie'] = 'HoraProva_qUltimaSerie';
            $this->query['qCountProva'] = 'HoraProva_qCountProva';
            $this->query['qAtaAlunosSub'] = 'HoraProva_qAtaAlunosSub';
            $this->query['qQuaProvaDia'] = 'HoraProva_qQuaProvaDia';
            $this->query['qSalasAlocadas'] = 'HoraProva_qSalasAlocadas';
            $this->query['qProvaEsp'] = 'HoraProva_qProvaEsp';
            $this->query['qProfEsp'] = 'HoraProva_qProfEsp';
            $this->query['qAtaQtdeAluSub'] = 'HoraProva_qAtaQtdeAluSub';
            $this->query['qProvaEspFP'] = 'HoraProva_qProvaEspFP';
            $this->query['qQtdProvaDia'] = 'HoraProva_qQtdProvaDia';
            $this->query['qFolhaNota'] = 'HoraProva_qFolhaNota';
            $this->query['qQtdProvaDiaE'] = 'HoraProva_qQtdProvaDiaE';
            $this->query['qTurmaDia'] = 'HoraProva_qTurmaDia';
            $this->query['qTurmaExiste'] = 'HoraProva_qTurmaExiste';
            $this->query['qCadastroProvaEsp'] = 'HoraProva_qCadastroProvaEsp';
            $this->query['qHorario'] = 'HoraProva_qHorario';
            $this->query['qProfDia'] = 'HoraProva_qProfDia';
            $this->query['qAtaAlunos'] = 'HoraProva_qAtaAlunos';
            $this->query['qProfEspDisc'] = 'HoraProva_qProfEspDisc';
            $this->query['qListaTurma'] = 'HoraProva_qListaTurma';
            $this->query['qId'] = 'HoraProva_qId';
            $this->query['qAtaProva'] = 'HoraProva_qAtaProva';
            $this->query['qDivTurma'] = 'HoraProva_qDivTurma';
            $this->query['qQtdeProfEsp'] = 'HoraProva_qQtdeProfEsp';
            $this->query['qQtdProvaTurmaE'] = 'HoraProva_qQtdProvaTurmaE';
            $this->query['qDiscExist'] = 'HoraProva_qDiscExist';
            $this->query['qWPessoaEsp'] = 'HoraProva_qWPessoaEsp';
            $this->query['qPlanilhaProva'] = 'HoraProva_qPlanilhaProva';

                
        }
}
?>
   