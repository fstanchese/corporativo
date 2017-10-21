<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class TempBoleto extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'TempBoleto'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 500000;


            $this->attribute['Numero']['Type'] = 'number';
            $this->attribute['Numero']['Length'] = 15;
            $this->attribute['Numero']['NN'] = 1;

            $this->attribute['NBanco']['Type'] = 'number';
            $this->attribute['NBanco']['Length'] = 15;
            $this->attribute['NBanco']['NN'] = 1;

            $this->attribute['Aluno']['Type'] = 'number';
            $this->attribute['Aluno']['Length'] = 9;
            $this->attribute['Aluno']['NN'] = 1;
            $this->attribute['Aluno']['Label'] = 'RA';

            $this->attribute['Parcela']['Type'] = 'number';
            $this->attribute['Parcela']['Length'] = 3;
            $this->attribute['Parcela']['Label'] = 'Parcela';

            $this->attribute['Vencto']['Type'] = 'date';
            $this->attribute['Vencto']['NN'] = 1;
            $this->attribute['Vencto']['Label'] = 'Vencimento';
            $this->attribute['Vencto']['Mask'] = 'd';

            $this->attribute['VlTotal']['Type'] = 'number';
            $this->attribute['VlTotal']['Length'] = 12.2;
            $this->attribute['VlTotal']['NN'] = 1;
            $this->attribute['VlTotal']['Label'] = 'Valor';

            $this->attribute['Geracao']['Type'] = 'date';
            $this->attribute['Geracao']['NN'] = 1;
            $this->attribute['Geracao']['Label'] = 'Geração';
            $this->attribute['Geracao']['Mask'] = 'd';

            $this->attribute['Curso']['Type'] = 'number';
            $this->attribute['Curso']['Length'] = 4;
            $this->attribute['Curso']['Label'] = 'Curso';

            $this->attribute['Turma']['Type'] = 'varchar2';
            $this->attribute['Turma']['Length'] = 7;
            $this->attribute['Turma']['Label'] = 'Parcela';

            $this->attribute['ValPago']['Type'] = 'number';
            $this->attribute['ValPago']['Length'] = 12.2;
            $this->attribute['ValPago']['NN'] = 1;
            $this->attribute['ValPago']['Label'] = 'Valor Pago';

            $this->attribute['Retorno']['Type'] = 'number';
            $this->attribute['Retorno']['Length'] = 6;
            $this->attribute['Retorno']['Label'] = 'Retorno';

            $this->attribute['Acresc']['Type'] = 'number';
            $this->attribute['Acresc']['Length'] = 12.2;
            $this->attribute['Acresc']['Label'] = 'Acréscimo';

            $this->attribute['Descon']['Type'] = 'number';
            $this->attribute['Descon']['Length'] = 12.2;
            $this->attribute['Descon']['Label'] = 'Desconto';

            $this->attribute['DP']['Type'] = 'number';
            $this->attribute['DP']['Length'] = 12.2;
            $this->attribute['DP']['Label'] = 'DP';

            $this->attribute['ADAP']['Type'] = 'number';
            $this->attribute['ADAP']['Length'] = 12.2;
            $this->attribute['ADAP']['Label'] = 'ADAP';

            $this->attribute['Licen']['Type'] = 'number';
            $this->attribute['Licen']['Length'] = 12.2;
            $this->attribute['Licen']['Label'] = 'Licen';

            $this->attribute['Bolsa']['Type'] = 'number';
            $this->attribute['Bolsa']['Length'] = 12.2;
            $this->attribute['Bolsa']['Label'] = 'Bolsa';

            $this->attribute['ValMen']['Type'] = 'number';
            $this->attribute['ValMen']['Length'] = 12.2;
            $this->attribute['ValMen']['Label'] = 'Mensalidade';

            $this->attribute['MesTab']['Type'] = 'varchar2';
            $this->attribute['MesTab']['Length'] = 5;
            $this->attribute['MesTab']['Label'] = 'MesTab';

            $this->attribute['DtPgto']['Type'] = 'date';
            $this->attribute['DtPgto']['Label'] = 'dt do Pagamento';
            $this->attribute['DtPgto']['Mask'] = 'd';

            $this->attribute['TipoBai']['Type'] = 'varchar2';
            $this->attribute['TipoBai']['Length'] = 1;
            $this->attribute['TipoBai']['Label'] = 'Tipo de Baixa';

            $this->attribute['DtBaixa']['Type'] = 'date';
            $this->attribute['DtBaixa']['Label'] = 'dt da Baixa';
            $this->attribute['DtBaixa']['Mask'] = 'd';

            $this->attribute['Estagio']['Type'] = 'number';
            $this->attribute['Estagio']['Length'] = 12.2;
            $this->attribute['Estagio']['Label'] = 'Estagio';

            $this->attribute['Monogra']['Type'] = 'number';
            $this->attribute['Monogra']['Length'] = 12.2;
            $this->attribute['Monogra']['Label'] = 'Monografia';

            $this->attribute['TurNova']['Type'] = 'varchar2';
            $this->attribute['TurNova']['Length'] = 8;
            $this->attribute['TurNova']['Label'] = 'TurNova';

            $this->attribute['CompMes']['Type'] = 'number';
            $this->attribute['CompMes']['Length'] = 02.0;
            $this->attribute['CompMes']['Label'] = 'Mes Competencia';

            $this->attribute['CompAno']['Type'] = 'number';
            $this->attribute['CompAno']['Length'] = 04.0;
            $this->attribute['CompAno']['Label'] = 'Ano Competencia';

            $this->attribute['VlrFinan']['Type'] = 'number';
            $this->attribute['VlrFinan']['Length'] = 12.2;
            $this->attribute['VlrFinan']['Label'] = 'Valor Financiado';

            $this->attribute['FIES']['Type'] = 'varchar2';
            $this->attribute['FIES']['Length'] = 3;
            $this->attribute['FIES']['Label'] = 'FIES';

            $this->attribute['BoletoDifFinan']['Type'] = 'number';
            $this->attribute['BoletoDifFinan']['Length'] = 15.0;

            $this->attribute['BoletoFinanCanc']['Type'] = 'varchar2';
            $this->attribute['BoletoFinanCanc']['Length'] = 3;
            $this->attribute['BoletoFinanCanc']['Label'] = 'Cancelado';

            $this->attribute['Campus_Id']['Type'] = 'number';
            $this->attribute['Campus_Id']['Length'] = 15.0;
            $this->attribute['Campus_Id']['Label'] = 'Campus';

            $this->attribute['Boleto_Id']['Type'] = 'number';
            $this->attribute['Boleto_Id']['Length'] = 15.0;
            $this->attribute['Boleto_Id']['Label'] = 'Id do Boleto';

            $this->attribute['BoletoTi_Id']['Type'] = 'number';
            $this->attribute['BoletoTi_Id']['Length'] = 15.0;
            $this->attribute['BoletoTi_Id']['Label'] = 'Id do Boleto';

            $this->attribute['WPessoa_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Id']['Length'] = 15.0;
            $this->attribute['WPessoa_Id']['Label'] = 'Pessoa';

            $this->attribute['EscCobrEnv']['Type'] = 'number';
            $this->attribute['EscCobrEnv']['Length'] = 2.0;
            $this->attribute['EscCobrEnv']['Label'] = 'Enviado ao Escritorio de Cobrança';

            $this->attribute['EscCobrParc']['Type'] = 'number';
            $this->attribute['EscCobrParc']['Length'] = 2.0;
            $this->attribute['EscCobrParc']['Label'] = 'Escritorio de Cobrança Parcelou';

            $this->attribute['EscCobrDono']['Type'] = 'number';
            $this->attribute['EscCobrDono']['Length'] = 2.0;
            $this->attribute['EscCobrDono']['Label'] = 'Parcelamento do Escritorio de Cobrança';

            $this->attribute['DtEnvio']['Type'] = 'date';
            $this->attribute['DtEnvio']['Label'] = 'Data de Envio';
            $this->attribute['DtEnvio']['Mask'] = 'd';

            $this->attribute['PUMensalidade']['Type'] = 'number';
            $this->attribute['PUMensalidade']['Length'] = 12.2;
            $this->attribute['PUMensalidade']['Label'] = 'Prouni Mensalidade';

            $this->attribute['PUOutros']['Type'] = 'number';
            $this->attribute['PUOutros']['Length'] = 12.2;
            $this->attribute['PUOutros']['Label'] = 'Prouni Outros';

            $this->attribute['PUObrigatorio']['Type'] = 'varchar2';
            $this->attribute['PUObrigatorio']['Length'] = 3;
            $this->attribute['PUObrigatorio']['Label'] = 'Bolsa Obrigatória';
            $this->attribute['PUObrigatorio']['OIndex      numero'] = '';
            $this->attribute['PUObrigatorio']['Attributes'] = 'numero';

            //Calculates para a criação de querys no diretório SQL


            //Recognizes

            //Índices
            $this->index['numero']['Cols'] = "numero";

            //Todas as Queries da classe

                 
        } 
} 
?>