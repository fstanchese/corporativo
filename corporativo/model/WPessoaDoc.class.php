<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class WPessoaDoc extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'WPessoaDoc'; 

         
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();
         

        public $rows; 

                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 180000;


            $this->attribute['WPessoa_Id']['Type'] 			= 'number';
            $this->attribute['WPessoa_Id']['Length'] 		= 15;
            $this->attribute['WPessoa_Id']['NN'] 			= 1;
            $this->attribute['WPessoa_Id']['Label'] 		= 'Aluno';

            $this->attribute['WPessoaDocTi_Id']['Type'] 	= 'number';
            $this->attribute['WPessoaDocTi_Id']['Length'] 	= 15;
            $this->attribute['WPessoaDocTi_Id']['NN'] 		= 1;
            $this->attribute['WPessoaDocTi_Id']['Label'] 	= 'Tipo de Documento';

            $this->attribute['DtEntrega']['Type'] 			= 'date';
            $this->attribute['DtEntrega']['NN'] 			= 0;
            $this->attribute['DtEntrega']['Label'] 			= 'Data da Entrega';

            $this->attribute['Motivo']['Type'] 				= 'varchar2';
            $this->attribute['Motivo']['Length'] 			= 200;
            $this->attribute['Motivo']['NN']				= 0;
            $this->attribute['Motivo']['Label'] 			= 'Observacao';

            $this->attribute['QtdeVias']['Type'] 			= 'number';
            $this->attribute['QtdeVias']['Length'] 			= 3;
            $this->attribute['QtdeVias']['NN'] 				= 0;
            $this->attribute['QtdeVias']['Label'] 			= 'Quantidade de Vias';

            $this->attribute['DtEntrega_DocSAA']['Type'] 	= 'date';
            $this->attribute['DtEntrega_DocSAA']['NN'] 		= 0;
            $this->attribute['DtEntrega_DocSAA']['Label'] 	= 'Prazo de Entrega';

            $this->attribute['WPessoaDocMot_Id']['Type'] 	= 'number';
            $this->attribute['WPessoaDocMot_Id']['Length'] 	= 15;
            $this->attribute['WPessoaDocMot_Id']['NN']		= 0;
            $this->attribute['WPessoaDocMot_Id']['Label'] 	= 'Motivo';

            $this->attribute['DtEmail']['Type'] 			= 'date';
            $this->attribute['DtEmail']['NN']				= 0; 
            $this->attribute['DtEmail']['Label'] 			= 'Data do Envio do Email';

            $this->attribute['Depart_Id']['Type'] 			= 'number';
            $this->attribute['Depart_Id']['Length'] 		= 15;
            $this->attribute['Depart_Id']['NN']				= 0;
            $this->attribute['Depart_Id']['Label'] 			= 'Departamento';

            $this->attribute['Parentesco_Id']['Type'] 		= 'number';
            $this->attribute['Parentesco_Id']['Length'] 	= 15;
            $this->attribute['Parentesco_Id']['NN']			= 0;
            $this->attribute['Parentesco_Id']['Label'] 		= 'Parentesco';
            
            //Calculates para a criação de querys no diretório SQL
            
            //Recognizes
            $this->recognize['Recognize'] 	= 'WPessoaDocTi_Id,WPessoaDocMot_Id';

            //Índices

            //Todas as Queries da classe
            $this->query['qAluno'] 			= 'WPessoaDoc_qAluno';
            $this->query['qConsDiaProUni'] 	= 'WPessoaDoc_qConsDiaProUni';
            $this->query['qGeral'] 			= 'WPessoaDoc_qGeral';
            $this->query['qId'] 			= 'WPessoaDoc_qId';
            $this->query['qConsulta'] 		= 'WPessoaDoc_qConsulta';
            $this->query['qTurma'] 			= 'WPessoaDoc_qTurma';

                 
        } 
        
        public function GetPessoaDocInternet($WPessoa_Id){

            $dbData = new DbData($this->db);

            $dbData->Get("
            		SELECT 
            			WPessoaDoc.*,
  						WPessoaDoc.Id                               AS WPessoaDoc_Id,
 						WPessoaDocTi_gsRecognize(WPessoaDocTi_Id)   AS Documento,
  						WPessoaDoc.QTDEVIAS                         AS Vias,
  						WPessoaDocMot_gsRecognize(WPessoaDocMot_Id) || ' ' || WPessoaDoc.Motivo AS RecognizeMotivo,  
  						WPessoaDoc.DTENTREGA_DOCSAA  AS DataEntrega
					FROM  
						WPessoaDoc 
					WHERE
						WPessoaDoc.Depart_Id IS NULL
					AND  
						WPessoaDoc.DtEntrega IS NULL
					AND
						WPessoaDoc.WPessoa_Id = nvl( '".$WPessoa_Id."' ,0) 
					ORDER BY 
						WPessoaDoc_Id DESC");

            $cont = 0;
            	
            while($row = $dbData->Row() )
            {
                $arEnd[$cont]["ID"] 		   = $row["WPESSOADOC_ID"];
                $arEnd[$cont]["DOCUMENTO"]	   = $row["DOCUMENTO"];                
                $arEnd[$cont]["DATAENTREGA"]   = $row["DATAENTREGA"];
                $arEnd[$cont]["MOTIVO"]	       = $row["RECOGNIZEMOTIVO"];

                //se for "Assinatura do Termo de Atualização - PROUNI"
                if($row["WPESSOADOCTI_ID"] == '106400000000017'){
                    //$arEnd[$cont]["MOTIVO"]	   = $row["MOTIVOPROUNI"];                   
                    
                }else{
                    $arEnd[$cont]["VIAS"]	   = $row["VIAS"];
                    //$arEnd[$cont]["MOTIVO"]	   = $row["MOTIVO"];
                }
                                
                //$arEnd[$cont]["LOCAL"]     = "Setor de Atendimento ao Aluno (SAA)";

                $cont++;
            }

            return $arEnd;
        }
}