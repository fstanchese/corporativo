<?php
        
    require_once ("../engine/Model.class.php");
        
    class FIES extends Model
    {
        
        //Mapeamento da tabela do Banco de Dados
        public $table = 'FIES'; 

        
        public $attribute     = array();
        public $calculate     = array();
        public $query        = array();
        

        public $rows;

                
        public function __construct($db)
        {

            $this->db = $db;

            $this->rows = 5000;


            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15;
            $this->attribute['WPessoa_Id']['NN'] = 1;
            $this->attribute['WPessoa_Id']['Label'] = 'Aluno';

            $this->attribute['Contrato']['Type'] = 'number';
            $this->attribute['Contrato']['Length'] = 20;
            $this->attribute['Contrato']['NN'] = 1;
            $this->attribute['Contrato']['Label'] = 'Contrato';
            $this->attribute['Contrato']['Mask'] = '9';

            $this->attribute['CodFIES']['Type'] = 'number';
            $this->attribute['CodFIES']['Length'] = 20;
            $this->attribute['CodFIES']['Label'] = 'Código do FIES';
            $this->attribute['CodFIES']['Mask'] = '9';

            $this->attribute['CCorrente_Id']['Type'] = 'number';
            $this->attribute['CCorrente_Id']['Length'] = 15;
            $this->attribute['CCorrente_Id']['Label'] = 'Banco';

            $this->attribute['DtProcSelecao']['Type'] = 'date';
            $this->attribute['DtProcSelecao']['Label'] = 'Data do Processo de Seleção';
            $this->attribute['DtProcSelecao']['Mask'] = 'd';

            $this->attribute['DtEncerramento']['Type'] = 'date';
            $this->attribute['DtEncerramento']['Label'] = 'Data do Encerramento';
            $this->attribute['DtEncerramento']['Mask'] = 'd';

            $this->attribute['FIESTi_Id']['Type'] = 'number';
            $this->attribute['FIESTi_Id']['Length'] = 15;
            $this->attribute['FIESTi_Id']['Label'] = 'Tipo';

            $this->attribute['BolsaSol_Id']['Type'] = 'number';
            $this->attribute['BolsaSol_Id']['Length'] = 15;
            $this->attribute['BolsaSol_Id']['Label'] = 'Solicitação de CESJ';

            $this->attribute['WPessoa_Contratante_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Contratante_Id']['Length'] = 15;
            $this->attribute['WPessoa_Contratante_Id']['Label'] = 'Contratante';

            $this->attribute['Matric_Id']['Type'] = 'number';
            $this->attribute['Matric_Id']['Length'] = 15;
            $this->attribute['Matric_Id']['Label'] = 'Matrícula';

            $this->attribute['PLetivo_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Id']['Length'] = 15;
            $this->attribute['PLetivo_Id']['Label'] = 'Periodo Letivo';

            $this->attribute['State_CESJ_Id']['Type'] = 'number';
            $this->attribute['State_CESJ_Id']['Length'] = 15;
            $this->attribute['State_CESJ_Id']['Label'] = 'Situação';

            $this->attribute['FundoGarantidor']['Type'] = 'varchar2';
            $this->attribute['FundoGarantidor']['Length'] = 3;
            $this->attribute['FundoGarantidor']['Label'] = 'Faz parte do Fundo Garantidor?';

            $this->attribute['ProUni']['Type'] = 'varchar2';
            $this->attribute['ProUni']['Length'] = 3;
            $this->attribute['ProUni']['Label'] = 'Aluno ProUni?';

            $this->attribute['Agencia_Id']['Type'] = 'number';
            $this->attribute['Agencia_Id']['Length'] = 15;
            $this->attribute['Agencia_Id']['Label'] = 'Agência';

            
            //Recognizes
            $this->recognize['Recognize'] = 'WPessoa_Id,Contrato';

            //Índices
            $this->index['WPessoa_Id']['Cols'] = "WPESSOA_ID";

            

                
        }
}
?> 