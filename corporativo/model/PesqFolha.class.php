<?php 

    require_once ("../engine/Model.class.php"); 

    class PesqFolha extends Model 
    { 

        //Mapeamento da tabela do Banco de Dados 
        public $table = 'PesqFolha'; 


        public $attribute    = array(); 
        public $calculate    = array();     
        public $query        = array();
     
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['PesqTurma_Id']['Type'] = 'number';
            $this->attribute['PesqTurma_Id']['Length'] = Number15;
            $this->attribute['PesqTurma_Id']['NN'] = 1;
            $this->attribute['PesqTurma_Id']['Label'] = 'Pesquisa X Turma';

            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['Label'] = 'Aluno';

            $this->attribute['Folha']['Type'] = 'number';
            $this->attribute['Folha']['Length'] = 11;
            $this->attribute['Folha']['Label'] = 'Código Folha';

            $this->attribute['Conteudo']['Type'] = 'varchar2';
            $this->attribute['Conteudo']['Length'] = 200;
            $this->attribute['Conteudo']['Label'] = 'Conteudo';

            $this->attribute['Acertos']['Type'] = 'number';
            $this->attribute['Acertos']['Length'] = 3;
            $this->attribute['Acertos']['Label'] = 'Acertos';

            $this->attribute['PesqGab_Id']['Type'] = 'number';
            $this->attribute['PesqGab_Id']['Length'] = 15;
            $this->attribute['PesqGab_Id']['Label'] = 'Gabarito';

            $this->attribute['Nota']['Type'] = 'varchar2';
            $this->attribute['Nota']['Length'] = 4;
            $this->attribute['Nota']['Label'] = 'Nota';

            $this->recognize['Recognize']	= 'PesqTurma_Id, WPessoa_Id';
            
            //Calculates para a criação de querys no diretório SQL
            $this->calculate['Selecao_Id'] = 'PesqFolha_qTurma';

            //Todas as Queries da classe
            $this->query['Serie'] = 'PesqFolha_qSerie';
            $this->query['Alunos'] = 'PesqFolha_qAlunos';
            $this->query['TurmaOfe'] = 'PesqFolha_qTurmaOfe';
            $this->query['AlunoAMI'] = 'PesqFolha_qAlunoAMI';
            $this->query['Turma'] = 'PesqFolha_qTurma';
            $this->query['Estatistica'] = 'PesqFolha_qEstatistica';
            $this->query['CountFotoLP'] = 'PesqFolha_qCountFotoLP';
            $this->query['Impressao'] = 'PesqFolha_qImpressao';
            $this->query['FotoLP'] = 'PesqFolha_qFotoLP';
            $this->query['CountAlunos'] = 'PesqFolha_qCountAlunos';
                             
        } 
} 
?> 