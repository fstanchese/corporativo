<?php

    require_once ("../engine/Model.class.php");

    class WOcorrAss extends Model
    {

        //Mapeamento da tabela do Banco de Dados
        public $table = 'WOcorrAss'; 


        public $attribute     = array();
        public $calculate     = array();    
        public $query        = array();
    
        public function __construct($db)
        {
        	$this->db = $db;

            $this->attribute['Nome']['Type'] 				=         'varchar2';
            $this->attribute['Nome']['Length'] 				=         20;
            $this->attribute['Nome']['NN'] 					=         1;
            $this->attribute['Nome']['Label'] 				=         'Assunto';

            $this->attribute['Codigo']['Type'] 				=         'number';
            $this->attribute['Codigo']['Length'] 			=         4;
            $this->attribute['Codigo']['NN'] 				=         1;
            $this->attribute['Codigo']['Label'] 			=         'Cуdigo';

            $this->attribute['AutoRel']['Type'] 			=         'number';
            $this->attribute['AutoRel']['Length'] 			=         15;
            $this->attribute['AutoRel']['Label'] 			=         'Autorel';

            $this->attribute['Internet']['Type'] 			=         'varchar2';
            $this->attribute['Internet']['Length'] 			=         3;
            $this->attribute['Internet']['Label'] 			=         'Ofertar na Internet';

            $this->attribute['Ativo']['Type'] 				=         'varchar2';
            $this->attribute['Ativo']['Length'] 			=         3;
            $this->attribute['Ativo']['Label'] 				=         'Assunto ativo';

            $this->attribute['NomeNet']['Type'] 			=         'varchar2';
            $this->attribute['NomeNet']['Length'] 			=         100;
            $this->attribute['NomeNet']['Label'] 			=         'Nome na Internet';

            $this->attribute['Descricao']['Type'] 			=         'varchar2';
            $this->attribute['Descricao']['Length'] 		=         500;
            $this->attribute['Descricao']['Label'] 			=         'Descriзгo';

            $this->attribute['DescEntrada']['Type'] 		=         'varchar2';
            $this->attribute['DescEntrada']['Length'] 		=         400;
            $this->attribute['DescEntrada']['Label'] 		=         'Documentos Necessбrios';

            $this->attribute['DescSaida']['Type'] 			=         'varchar2';
            $this->attribute['DescSaida']['Length'] 		=         400;
            $this->attribute['DescSaida']['Label'] 			=         'Documentos Emitidos';

            $this->attribute['TempoResposta']['Type'] 		=         'number';
            $this->attribute['TempoResposta']['Length'] 	=         3;
            $this->attribute['TempoResposta']['Label'] 		=         'Quantidade de dias para retirar';
            $this->attribute['TempoResposta']['Mask'] 		=         '9';

            $this->attribute['Info']['Type'] 				=         'varchar2';
            $this->attribute['Info']['Length'] 				=         400;
            $this->attribute['Info']['Label'] 				=         'info';

            $this->attribute['Motivo']['Type'] 				=         'varchar2';
            $this->attribute['Motivo']['Length'] 			=         200;
            $this->attribute['Motivo']['Label'] 			=         'Motivonгo disponibilidade na Internet';

            $this->attribute['WtxServico_Id']['Type'] 		=         'number';
            $this->attribute['WtxServico_Id']['Length'] 	=         15;
            $this->attribute['WtxServico_Id']['Label'] 		=         'Valor da Ocorrкncia de Serviзo';

            $this->attribute['RefBoleto']['Type'] 			=         'varchar2';
            $this->attribute['RefBoleto']['Length'] 		=         20;
            $this->attribute['RefBoleto']['Label'] 			=         'Referencia para o Boleto';

            $this->attribute['TpGrad']['Type'] 				=         'varchar2';
            $this->attribute['TpGrad']['Length'] 			=         3;
            $this->attribute['TpGrad']['Label'] 			=         'Graduaзгo';

            $this->attribute['TpPos']['Type'] 				=         'varchar2';
            $this->attribute['TpPos']['Length'] 			=         3;
            $this->attribute['TpPos']['Label'] 				=         'Pуs-Graduaзгo';

            $this->attribute['TpFinan']['Type'] 			=         'varchar2';
            $this->attribute['TpFinan']['Length'] 			=         3;
            $this->attribute['TpFinan']['Label'] 			=         'Financeiro';

            $this->attribute['OrAcademica']['Type'] 		=         'varchar2';
            $this->attribute['OrAcademica']['Length'] 		=         1200;
            $this->attribute['OrAcademica']['Label'] 		=         'Orientaзгo Acadкmica';

            $this->attribute['OrFinanceira']['Type'] 		=         'varchar2';
            $this->attribute['OrFinanceira']['Length'] 		=         1200;
            $this->attribute['OrFinanceira']['Label'] 		=         'Orientaзгo Financeira';

            $this->attribute['Disponibilizada']['Type'] 	=         'varchar2';
            $this->attribute['Disponibilizada']['Length'] 	=         3;
            $this->attribute['Disponibilizada']['Label'] 	=         'Disponнvel no S.A.A.';

            $this->attribute['RespostaObrig']['Type'] 		=         'varchar2';
            $this->attribute['RespostaObrig']['Length'] 	=         400;
            $this->attribute['RespostaObrig']['Label'] 		=         'Resposta Obrigatуria';

            $this->attribute['SelGrad']['Type'] 			=         'varchar2';
            $this->attribute['SelGrad']['Length'] 			=         3;
            $this->attribute['SelGrad']['Label'] 			=         'Graduaзгo';

            $this->attribute['SelPos']['Type'] 				=         'varchar2';
            $this->attribute['SelPos']['Length'] 			=         3;
            $this->attribute['SelPos']['Label'] 			=         'Pуs-Graduaзгo';

            $this->attribute['SelProUni']['Type'] 			=         'varchar2';
            $this->attribute['SelProUni']['Length'] 		=         3;
            $this->attribute['SelProUni']['Label'] 			=         'Financeiro';

            $this->attribute['AutoAtend']['Type'] 			=         'varchar2';
            $this->attribute['AutoAtend']['Length'] 		=         3;
            $this->attribute['AutoAtend']['Label'] 			=         'Disponнvel no Autoatendimento';

            $this->attribute['imgDocumento']['Type'] 		=         'varchar2';
            $this->attribute['imgDocumento']['Length'] 		=         40;
            $this->attribute['imgDocumento']['Label'] 		=         'Imagem do Tipo de Documento';

            $this->attribute['Nuprajur']['Type'] 			=         'varchar2';
            $this->attribute['Nuprajur']['Length'] 			=         3;
            $this->attribute['Nuprajur']['Label'] 			=         'Nuprajur';

            $this->attribute['OrNuprajur']['Type'] 			=         'varchar2';
            $this->attribute['OrNuprajur']['Length'] 		=         900;
            $this->attribute['OrNuprajur']['Label'] 		=         'Orientaзгo Nuprajur';

            $this->attribute['CEPA']['Type'] 				=         'varchar2';
            $this->attribute['CEPA']['Length'] 				=         3;
            $this->attribute['CEPA']['Label'] 				=         'CEPA';

            $this->attribute['SemUrgencia']['Type'] 		=         'varchar2';
            $this->attribute['SemUrgencia']['Length'] 		=         3;
            $this->attribute['SemUrgencia']['Label'] 		=         'Retirar Data de Urgкncia';

            $this->attribute['QtdeViasProt']['Type'] 		=         'number';
            $this->attribute['QtdeViasProt']['Length'] 		=         1;
            $this->attribute['QtdeViasProt']['Label'] 		=         'Quantidade de vias do Protocolo';

            $this->attribute['ObrigMatric']['Type'] 		=         'varchar2';
            $this->attribute['ObrigMatric']['Length'] 		=         3;
            $this->attribute['ObrigMatric']['Label'] 		=         'Obrigatуrio Matrнcula';

            $this->recognize['Recognize']	= 'Nomenet';
            
            //Calculates para a criaзгo de querys no diretуrio SQL
            $this->calculate['IdSelecao'] 			=	'WOcorrAss_qDisponibilizada';
            $this->calculate['IdSelecaoNuprajur'] 	=	'WOcorrAss_qNuprajur';
            $this->calculate['IdSelecaoCEPA'] 		=	'WOcorrAss_qCEPA';
            $this->calculate['Geral']				=	'WOcorrAss_qGeral';

            //Todas as Queries da classe
            $this->query['qAtivos'] 			= 	'WOcorrAss_qAtivos';
            $this->query['qAutoAtendimento'] 	= 	'WOcorrAss_qAutoAtendimento';
            $this->query['qNuprajur'] 			= 	'WOcorrAss_qNuprajur';
            $this->query['qGeral'] 				=	'WOcorrAss_qGeral';
            $this->query['qIncluir'] 			= 	'WOcorrAss_qIncluir';
            $this->query['qDisponibilizada']	= 	'WOcorrAss_qDisponibilizada';
            $this->query['qCons3'] 				=  	'WOcorrAss_qCons3';
            $this->query['qConsultar'] 			=  	'WOcorrAss_qConsultar';
            $this->query['qId'] 				=	'WOcorrAss_qId';
            $this->query['qCEPA'] 				= 	'WOcorrAss_qCEPA';
            $this->query['qCons'] 				= 	'WOcorrAss_qCons';
            $this->query['qDoc'] 				= 	'WOcorrAss_qDoc';
            $this->query['qPrimeiraLetra'] 		= 	'WOcorrAss_qPrimeiraLetra';
            $this->query['qId2'] 				= 	'WOcorrAss_qId2';
            $this->query['qCons2'] 				= 	'WOcorrAss_qCons2';
            $this->query['qSelecao']     		= 	'WOcorrAss_qSelecao';

                            
        }
}
?>