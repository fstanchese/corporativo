<?php 
         
    require_once ("../engine/Model.class.php"); 
         
    class DiscEsp extends Model 
    { 
         
        //Mapeamento da tabela do Banco de Dados 
        public $table = 'DiscEsp'; 
  
        public $attribute     = array(); 
        public $calculate     = array(); 
        public $query        = array();         

        public $rows; 
                 
        public function __construct($db) 
        {

            $this->db = $db;

            $this->rows = 5000;

            $this->attribute['PLetivo_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Id']['Length'] = 15;
            $this->attribute['PLetivo_Id']['NN'] = 1;
            $this->attribute['PLetivo_Id']['Label'] = 'Período Letivo';

            $this->attribute['NomeReduz']['Type'] = 'varchar2';
            $this->attribute['NomeReduz']['Length'] = 10;
            $this->attribute['NomeReduz']['Label'] = 'Código';

            $this->attribute['Nome']['Type'] = 'varchar2';
            $this->attribute['Nome']['Length'] = 100;
            $this->attribute['Nome']['NN'] = 1;
            $this->attribute['Nome']['Label'] = 'Descrição';

            $this->attribute['AreaAcad_Id']['Type'] = 'number';
            $this->attribute['AreaAcad_Id']['Length'] = 15;
            $this->attribute['AreaAcad_Id']['Label'] = 'Área Acadêmica';

            $this->attribute['CHSemanal']['Type'] = 'number';
            $this->attribute['CHSemanal']['Length'] = 5.2;
            $this->attribute['CHSemanal']['Label'] = 'Carga Horária Semanal CHS';

            $this->attribute['CHSemanalTeoria']['Type'] = 'number';
            $this->attribute['CHSemanalTeoria']['Length'] = 5.2;
            $this->attribute['CHSemanalTeoria']['Label'] = 'CHS Teoria';

            $this->attribute['CHSemanalPratica']['Type'] = 'number';
            $this->attribute['CHSemanalPratica']['Length'] = 5.2;
            $this->attribute['CHSemanalPratica']['Label'] = 'CHS Pratica';

            $this->attribute['CHSemanalLab']['Type'] = 'number';
            $this->attribute['CHSemanalLab']['Length'] = 5.2;
            $this->attribute['CHSemanalLab']['Label'] = 'CHS Laboratorio';

            $this->attribute['CHAnual']['Type'] = 'number';
            $this->attribute['CHAnual']['Length'] = 5.2;
            $this->attribute['CHAnual']['Label'] = 'Carga Horária Anual CHA';
            $this->attribute['CHAnual']['Mask'] = '9';

            $this->attribute['DiscEspTi_Id']['Type'] = 'number';
            $this->attribute['DiscEspTi_Id']['Length'] = 15;
            $this->attribute['DiscEspTi_Id']['NN'] = 1;
            $this->attribute['DiscEspTi_Id']['Label'] = 'Tipo Disciplina';

            $this->attribute['Codigo']['Type'] = 'varchar2';
            $this->attribute['Codigo']['Length'] = 10;
            $this->attribute['Codigo']['Label'] = 'Codigo';

            $this->attribute['Facul_Id']['Type'] = 'number';
            $this->attribute['Facul_Id']['Length'] = 15;
            $this->attribute['Facul_Id']['Label'] = 'Faculdade';
            
            $this->attribute['SerieMin']['Type'] = 'number';
            $this->attribute['SerieMin']['Length'] = 1;
            $this->attribute['SerieMin']['Label'] = 'Série Mínima';

            //Recognizes
            $this->recognize['Recognize'] = 'Nome,AreaAcad_Id,DiscEspTi_Id';
            
            //Calculates para a criação de querys no diretório SQL
            
            //Índices

            //Todas as Queries da classe
            $this->query['qInicio'] = 'DiscEsp_qInicio';
            $this->query['qLicenciatura'] = 'DiscEsp_qLicenciatura';
            $this->query['qDistInicio'] = 'DiscEsp_qDistInicio';
            $this->query['qPLetivo'] = 'DiscEsp_qPLetivo';
            $this->query['qId'] = 'DiscEsp_qId';
            $this->query['qLibras'] = 'DiscEsp_qLibras';
            
        } 
	}
	
?>	 