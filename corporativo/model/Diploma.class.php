<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class Diploma extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'Diploma'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();

        public function __construct($db) 
        {

            $this->db = $db;

            $this->attribute['DtExpedicao']['Type'] = 'date';
            $this->attribute['DtExpedicao']['Label'] = 'Data de Expediзгo';
            $this->attribute['DtExpedicao']['Mask'] = 'd';

            $this->attribute['DtColacao']['Type'] = 'date';
            $this->attribute['DtColacao']['Mask'] = 'd';
            $this->attribute['DtColacao']['Label'] = 'Data de Colaзгo';

            $this->attribute['DiplProc_Id']['Type'] = 'number';
            $this->attribute['DiplProc_Id']['Length'] = 15;
            $this->attribute['DiplProc_Id']['NN'] = 1;
            $this->attribute['DiplProc_Id']['Label'] = 'Nr do Processo';

            $this->attribute['DiplReg_Id']['Type'] = 'number';
            $this->attribute['DiplReg_Id']['Length'] = 15;
            $this->attribute['DiplReg_Id']['Label'] = 'Nr do Registro';

            $this->attribute['WPessoa_Reitor_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Reitor_Id']['Length'] = 15;
            $this->attribute['WPessoa_Reitor_Id']['NN'] = 1;
            $this->attribute['WPessoa_Reitor_Id']['Label'] = 'Reitor';

            $this->attribute['WPessoa_Diretor_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Diretor_Id']['Length'] = 15;
            $this->attribute['WPessoa_Diretor_Id']['NN'] = 1;
            $this->attribute['WPessoa_Diretor_Id']['Label'] = 'Diretor';

            $this->attribute['WPessoa_DRA_Id']['Type'] = 'number';
            $this->attribute['WPessoa_DRA_Id']['Length'] = 15;
            $this->attribute['WPessoa_DRA_Id']['NN'] = 1;
            $this->attribute['WPessoa_DRA_Id']['Label'] = 'Funcionбrio/Professor';

            $this->attribute['Vias']['Type'] = 'number';
            $this->attribute['Vias']['Length'] = 1;
            $this->attribute['Vias']['Label'] = 'Vias';

            $this->attribute['CursoNome1']['Type'] = 'varchar2';
            $this->attribute['CursoNome1']['Length'] = 200;
            $this->attribute['CursoNome1']['Label'] = 'Curso';

            $this->attribute['CursoNome2']['Type'] = 'varchar2';
            $this->attribute['CursoNome2']['Length'] = 200;
            $this->attribute['CursoNome2']['Label'] = 'Curso';

            $this->attribute['NomeAluno']['Type'] = 'varchar2';
            $this->attribute['NomeAluno']['Length'] = 100;
            $this->attribute['NomeAluno']['Label'] = 'Nome do Aluno';

            $this->attribute['Nacionalidade']['Type'] = 'varchar2';
            $this->attribute['Nacionalidade']['Length'] = 50;
            $this->attribute['Nacionalidade']['Label'] = 'Nacionalidade';

            $this->attribute['Natural']['Type'] = 'varchar2';
            $this->attribute['Natural']['Length'] = 50;
            $this->attribute['Natural']['Label'] = 'Naturalidade';

            $this->attribute['Nascimento']['Type'] = 'varchar2';
            $this->attribute['Nascimento']['Length'] = 50;
            $this->attribute['Nascimento']['Label'] = 'Data de Nascimento';

            $this->attribute['Documento']['Type'] = 'varchar2';
            $this->attribute['Documento']['Length'] = 50;
            $this->attribute['Documento']['Label'] = 'Documento';

            $this->attribute['WPessoa_Assina1_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Assina1_Id']['Length'] = 15;
            $this->attribute['WPessoa_Assina1_Id']['Label'] = 'Assinatura 1';

            $this->attribute['WPessoa_Assina2_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Assina2_Id']['Length'] = 15;
            $this->attribute['WPessoa_Assina2_Id']['Label'] = 'Assinatura 2';

            $this->attribute['Carimbo_Assina1_Id']['Type'] = 'number';
            $this->attribute['Carimbo_Assina1_Id']['Length'] = 15;
            $this->attribute['Carimbo_Assina1_Id']['Label'] = 'Assinatura 1';

            $this->attribute['Carimbo_Assina2_Id']['Type'] = 'number';
            $this->attribute['Carimbo_Assina2_Id']['Length'] = 15;
            $this->attribute['Carimbo_Assina2_Id']['Label'] = 'Assinatura 2';

            $this->attribute['PeriodoLetivo']['Type'] = 'varchar2';
            $this->attribute['PeriodoLetivo']['Length'] = 4;
            $this->attribute['PeriodoLetivo']['Label'] = 'Ano de Conclusao';

            $this->attribute['RAAluno']['Type'] = 'varchar2';
            $this->attribute['RAAluno']['Length'] = 9;
            $this->attribute['RAAluno']['Label'] = 'RA do Aluno';

            $this->attribute['Reconhecimento']['Type'] = 'varchar2';
            $this->attribute['Reconhecimento']['Length'] = 100;
            $this->attribute['Reconhecimento']['Label'] = 'Reconhecimento';

            $this->attribute['ChTotal']['Type'] = 'number';
            $this->attribute['ChTotal']['Length'] = 4;
            $this->attribute['ChTotal']['Label'] = 'CH Total';

            $this->attribute['Titulo_Id']['Type'] = 'number';
            $this->attribute['Titulo_Id']['Length'] = 15;
            $this->attribute['Titulo_Id']['Label'] = 'Titulo';

            $this->recognize['Recognize']	= 'DtExpedicao';
            //Calculates para a criaзгo de querys no diretуrio SQL

            //Todas as Queries da classe
            $this->query['qDiplReg'] = 'Diploma_qDiplReg';
            $this->query['qRegistro'] = 'Diploma_qRegistro';
            $this->query['qDiplProc'] = 'Diploma_qDiplProc';

                 
        } 
} 
?>