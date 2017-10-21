<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Evento extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Evento'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 5000;


            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 250;
            $this->attribute['Nome']['NN'] = 1;
            $this->attribute['Nome']['Label'] = 'Nome do Evento';

            $this->attribute['Depart_Id']['Type'] = 'number';
            $this->attribute['Depart_Id']['Length'] = 15;
            $this->attribute['Depart_Id']['Label'] = 'Departamento Responsável';

            $this->attribute['QtdePub']['Type'] = 'number';
            $this->attribute['QtdePub']['Length'] = 5;
            $this->attribute['QtdePub']['Label'] = 'Nº de Público Participante';
            $this->attribute['QtdePub']['Mask'] = '9';

            $this->attribute['Data']['Type'] = 'date';
            $this->attribute['Data']['Label'] = 'Data de início do evento';
            $this->attribute['Data']['Mask'] = 'd';

            $this->attribute['Evento_Pai_Id']['Type'] = 'number';
            $this->attribute['Evento_Pai_Id']['Length'] = 15;
            $this->attribute['Evento_Pai_Id']['Label'] = 'Evento Pai';

            $this->attribute['WPessoa_Professor_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Professor_Id']['Length'] = 15;
            $this->attribute['WPessoa_Professor_Id']['Label'] = 'Professor Palestrante';

            $this->attribute['WPessoa_Professor2_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Professor2_Id']['Length'] = 15;
            $this->attribute['WPessoa_Professor2_Id']['Label'] = 'Professor Palestrante';

            $this->attribute['Descricao']['Type'] = 'varchar2';
            $this->attribute['Descricao']['Length'] = 1000;
            $this->attribute['Descricao']['Label'] = 'Descrição';

            $this->attribute['Descricao2']['Type'] = 'varchar2';
            $this->attribute['Descricao2']['Length'] = 1000;
            $this->attribute['Descricao2']['Label'] = 'Descrição';

            $this->attribute['CHTotal']['Type'] = 'varchar2';
            $this->attribute['CHTotal']['Length'] = 100;
            $this->attribute['CHTotal']['Label'] = 'Carga Horária';

            $this->attribute['WPessoa_Professor3_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Professor3_Id']['Length'] = 15;
            $this->attribute['WPessoa_Professor3_Id']['Label'] = 'Professor Palestrante';

            $this->attribute['DescVaga']['Type'] = 'varchar2';
            $this->attribute['DescVaga']['Length'] = 100;
            $this->attribute['DescVaga']['Label'] = 'Destinadas';

            $this->attribute['EventoTi_Id']['Type'] = 'number';
            $this->attribute['EventoTi_Id']['Length'] = 15;
            $this->attribute['EventoTi_Id']['Label'] = 'Tipo do Evento';

            $this->attribute['DataInsc']['Type'] = 'date';
            $this->attribute['DataInsc']['Label'] = 'Início das inscrições';

            $this->attribute['DataInscFim']['Type'] = 'date';
            $this->attribute['DataInscFim']['Label'] = 'Término das inscrições';

            $this->attribute['SoAlunos']['Type'] = 'varchar2';
            $this->attribute['SoAlunos']['Length'] = 3;
            $this->attribute['SoAlunos']['Label'] = 'Só para alunos';

            $this->attribute['InscAuto']['Type'] = 'varchar2';
            $this->attribute['InscAuto']['Length'] = 3;
            $this->attribute['InscAuto']['Label'] = 'Inscrição automática';

            $this->attribute['EveLocal_Id']['Type'] = 'number';
            $this->attribute['EveLocal_Id']['Length'] = 15;
            $this->attribute['EveLocal_Id']['Label'] = 'Local';

            $this->attribute['Hora']['Type'] = 'varchar2';
            $this->attribute['Hora']['Length'] = 8;
            $this->attribute['Hora']['Label'] = 'Horário de Início';

            $this->attribute['HoraFim']['Type'] = 'varchar2';
            $this->attribute['HoraFim']['Length'] = 8;
            $this->attribute['HoraFim']['Label'] = 'Horário de Término';

            $this->attribute['Sequencia']['Type'] = 'number';
            $this->attribute['Sequencia']['Length'] = 3;
            $this->attribute['Sequencia']['Label'] = 'Seqüência Planilha';
            $this->attribute['Sequencia']['Mask'] = '9';

            $this->attribute['DescEveLocal']['Type'] = 'varchar2';
            $this->attribute['DescEveLocal']['Length'] = 10;
            $this->attribute['DescEveLocal']['Label'] = 'Descrição do Local';

            $this->attribute['TextoCert']['Type'] = 'varchar2';
            $this->attribute['TextoCert']['Length'] = 1000;
            $this->attribute['TextoCert']['Label'] = 'Texto do Certificado';

            $this->attribute['CHCalculo']['Type'] = 'varchar2';
            $this->attribute['CHCalculo']['Length'] = 100;
            $this->attribute['CHCalculo']['Label'] = 'Cálculo Carga Horária';

            $this->attribute['NomeCert']['Type'] = 'varchar2';
            $this->attribute['NomeCert']['Length'] = 250;
            $this->attribute['NomeCert']['Label'] = 'Nome Certificado';

            //Calculates para a criação de querys no diretório SQL
            $this->calculate['IdPai'] = 'Evento_qPai';
            $this->calculate['IdFilho'] = 'Evento_qPaiTodos';
            $this->calculate['IdTipo'] = 'Evento_qTipo';
            $this->calculate['IdPaiAtual'] = 'Evento_qPaiAtual';


            //Recognizes
            $this->recognize['Recognize'] = 'Nome';

            //Índices

            //Todas as Queries da classe
            $this->query['qGeral'] = 'Evento_qGeral';
            $this->query['qId'] = 'Evento_qId';
            $this->query['qAprimorando'] = 'Evento_qAprimorando';
            $this->query['qListaEspera'] = 'Evento_qListaEspera';
            $this->query['qPaiParticipantes'] = 'Evento_qPaiParticipantes';
            $this->query['qAtivComp'] = 'Evento_qAtivComp';
            $this->query['qPaiParticipantesAtual'] = 'Evento_qPaiParticipantesAtual';
            $this->query['qParticipantes'] = 'Evento_qParticipantes';
            $this->query['qOferecido'] = 'Evento_qOferecido';
            $this->query['qSelecaoCount'] = 'Evento_qSelecaoCount';
            $this->query['qIdPosicao'] = 'Evento_qIdPosicao';
            $this->query['qCracha'] = 'Evento_qCracha';
            $this->query['qTotalParticipantes'] = 'Evento_qTotalParticipantes';
            $this->query['qPaiParticipante'] = 'Evento_qPaiParticipante';
            $this->query['qPaiTodos'] = 'Evento_qPaiTodos';
            $this->query['qPaiAtual'] = 'Evento_qPaiAtual';
            $this->query['qInscrito'] = 'Evento_qInscrito';
            $this->query['qTipo'] = 'Evento_qTipo';
            $this->query['qSelecao'] = 'Evento_qSelecao';
            $this->query['qPai'] = 'Evento_qPai';
            $this->query['qEventos'] = 'Evento_qEventos';
            $this->query['qDadosCadastrais'] = 'Evento_qDadosCadastrais';
            $this->query['qPlanilha'] = 'Evento_qPlanilha';
            $this->query['qVencimento'] = 'Evento_qVencimento';

                 
        } 
	}

?>