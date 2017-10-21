<?php
	require_once ("../engine/Model.class.php");
	
	class Curr extends Model 
	{
	
		public $table = 'Curr';
		
		public $attribute = array();
		public $calculate = array();
		public $query = array();

		public $rows;
		
		public function __construct($db)
		{
			$this->db = $db;
			
			$this->rows = 2000;
			
            $this->attribute['Codigo']['Type'] = 'varchar2';
            $this->attribute['Codigo']['Length'] = 10;
            $this->attribute['Codigo']['Label'] = 'Código do Currículo';

            $this->attribute['CurrNomeHist']['Type'] = 'varchar2';
            $this->attribute['CurrNomeHist']['Length'] = 200;
            $this->attribute['CurrNomeHist']['Label'] = 'Nome Histórico Escolar';

            $this->attribute['CurrNivelDesc']['Type'] = 'varchar2';
            $this->attribute['CurrNivelDesc']['Length'] = 200;
            $this->attribute['CurrNivelDesc']['Label'] = 'Descrição';

            $this->attribute['PLetivo_Inicial_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Inicial_Id']['Length'] = 15;
            $this->attribute['PLetivo_Inicial_Id']['Label'] = 'Início Letivo';

            $this->attribute['Durac_Id']['Type'] = 'number';
            $this->attribute['Durac_Id']['Length'] = 15;
            $this->attribute['Durac_Id']['Label'] = 'Duração';

            $this->attribute['Curso_Id']['Type'] = 'number';
            $this->attribute['Curso_Id']['Length'] = 15;
            $this->attribute['Curso_Id']['NN'] = 1;
            $this->attribute['Curso_Id']['Label'] = 'Curso';

            $this->attribute['PLetivo_Final_Id']['Type'] = 'number';
            $this->attribute['PLetivo_Final_Id']['Length'] = 15;
            $this->attribute['PLetivo_Final_Id']['Label'] = 'Término';

            $this->attribute['CurrNivel_Id']['Type'] = 'number';
            $this->attribute['CurrNivel_Id']['Length'] = 15;
            $this->attribute['CurrNivel_Id']['Label'] = 'Modalidade/Descrição';

            $this->attribute['Curr_Pai_Id']['Type'] = 'number';
            $this->attribute['Curr_Pai_Id']['Length'] = 15;
            $this->attribute['Curr_Pai_Id']['Label'] = 'Currículo Pai';

            $this->attribute['CurrNomeDipl']['Type'] = 'varchar2';
            $this->attribute['CurrNomeDipl']['Length'] = 200;
            $this->attribute['CurrNomeDipl']['Label'] = 'Nome Certificado de Conclusão';

            $this->attribute['CurrNomeVerso']['Type'] = 'varchar2';
            $this->attribute['CurrNomeVerso']['Length'] = 200;
            $this->attribute['CurrNomeVerso']['Label'] = 'Verso e Anverso Diploma';

            $this->attribute['Reconhecimento']['Type'] = 'varchar2';
            $this->attribute['Reconhecimento']['Length'] = 70;
            $this->attribute['Reconhecimento']['Label'] = 'Reconhecimento';

            $this->attribute['Titulo_Id']['Type'] = 'number';
            $this->attribute['Titulo_Id']['Length'] = 15;
            $this->attribute['Titulo_Id']['Label'] = 'Titulo';

            $this->attribute['SerieInicio']['Type'] = 'number';
            $this->attribute['SerieInicio']['Length'] = 2;
            $this->attribute['SerieInicio']['Label'] = 'Série Inicial';

            $this->attribute['AprovacaoCEPE']['Type'] = 'varchar2';
            $this->attribute['AprovacaoCEPE']['Length'] = 30;
            $this->attribute['AprovacaoCEPE']['Label'] = 'Aprovado pelo CEPE no.';

            $this->attribute['Posicionamento']['Type'] = 'number';
            $this->attribute['Posicionamento']['Length'] = 2;
            $this->attribute['Posicionamento']['Label'] = 'Posição Hierárquica';

            $this->attribute['Mneumonico']['Type'] = 'varchar2';
            $this->attribute['Mneumonico']['Length'] = 4;
            $this->attribute['Mneumonico']['Label'] = 'Mneumonico';

            $this->attribute['CodProvao']['Type'] = 'varchar2';
            $this->attribute['CodProvao']['Length'] = 10;
            $this->attribute['CodProvao']['Label'] = 'Código do Provão';

            $this->attribute['CodINEP']['Type'] = 'number';
            $this->attribute['CodINEP']['Length'] = 14;
            $this->attribute['CodINEP']['Label'] = 'Código do INEP';

            $this->attribute['WPessoa_Coord_Id']['Type'] = 'number';
            $this->attribute['WPessoa_Coord_Id']['Length'] = 15;
            $this->attribute['WPessoa_Coord_Id']['Label'] = 'Coordenador do Curso';

            $this->attribute['SimNao_Estagio_Id']['Type'] = 'number';
            $this->attribute['SimNao_Estagio_Id']['Length'] = 15;
            $this->attribute['SimNao_Estagio_Id']['Label'] = 'Soma Estágio ?';

            $this->attribute['SimNao_Monografia_Id']['Type'] = 'number';
            $this->attribute['SimNao_Monografia_Id']['Length'] = 15;
            $this->attribute['SimNao_Monografia_Id']['Label'] = 'Soma Monografia ?';

            $this->attribute['CurrNomeVest']['Type'] = 'varchar2';
            $this->attribute['CurrNomeVest']['Length'] = 200;
            $this->attribute['CurrNomeVest']['Label'] = 'Nome Vestibular';

            $this->attribute['CurrNomeApostila']['Type'] = 'varchar2';
            $this->attribute['CurrNomeApostila']['Length'] = 200;
            $this->attribute['CurrNomeApostila']['Label'] = 'Apostila Diploma';

            $this->attribute['SerieInicioEstagio']['Type'] = 'number';
            $this->attribute['SerieInicioEstagio']['Length'] = 2;
            $this->attribute['SerieInicioEstagio']['Label'] = 'Série Inicial Estágio';

            $this->attribute['DeclaracaoApr']['Type'] = 'varchar2';
            $this->attribute['DeclaracaoApr']['Length'] = 200;
            $this->attribute['DeclaracaoApr']['Label'] = 'Declaracao Aprovado';

            $this->attribute['DeclaracaoRep']['Type'] = 'varchar2';
            $this->attribute['DeclaracaoRep']['Length'] = 200;
            $this->attribute['DeclaracaoRep']['Label'] = 'Declaracao Reprovado';

            $this->attribute['CurrNomeAtest']['Type'] = 'varchar2';
            $this->attribute['CurrNomeAtest']['Length'] = 200;
            $this->attribute['CurrNomeAtest']['Label'] = 'Nome Atestado de Matrícula';

            $this->attribute['CurrCompNome']['Type'] = 'varchar2';
            $this->attribute['CurrCompNome']['Length'] = 200;
            $this->attribute['CurrCompNome']['Label'] = 'Complemento Nome Histórico Escolar';

            $this->attribute['SimNao_SubTotal_Id']['Type'] = 'number';
            $this->attribute['SimNao_SubTotal_Id']['Length'] = 15;
            $this->attribute['SimNao_SubTotal_Id']['Label'] = 'Sub Total ?';			
			
			$this->recognize['Recognize']	= 'Codigo, Curso_Id';
			$this->recognize['RecCurso']	= 'Curso_Id';
			
			//Calculates para a criação de querys no diretório SQL
				
			//Todas as Queries da classe
			$this->query['qCampus']			= "Curr_qCampus";
			$this->query['qConteudo']		= "Curr_qConteudo";
			$this->query['qCurrOfe']		= "Curr_qCurrOfe";
			$this->query['qCurso'] 			= "Curr_qCurso";
			$this->query['qCursoFilhos']	= "Curr_qCursoFilhos";
			$this->query['qCursoPai'] 		= "Curr_qCursoPai";
			$this->query['qFamilia'] 		= "Curr_qFamilia";
			$this->query['qGeral'] 			= "Curr_qGeral";
			$this->query['qHabilitacao'] 	= "Curr_qHabilitacao";
			$this->query['qId'] 			= "Curr_qId";
			$this->query['qIdVest']			= "Curr_qIdVest";
			$this->query['qPlanoEnsino']	= "Curr_qPlanoEnsino";
			$this->query['qRetCiclos'] 		= "Curr_qRetCiclos";
			$this->query['qRetFilhos'] 		= "Curr_qRetFilhos";
			$this->query['qSerie'] 			= "Curr_qSerie";
				
		}
		
		public function GetFormacaoEspecifica($Curr_Id)
		{
			$sRet = ''; 
			$arCurr = $this->GetIdInfo($Curr_Id);
			
			if ($arCurr["CURRCOMPNOME"] != '')
			{
				
				$v_curr_compnome = strtoupper($arCurr["CURRCOMPNOME"]);
				$v_curr_compnome = str_replace('LINHA DE FORMAçãO ESPECíFICA EM' , 'Linha de Formação Específica <b style="text-transform:uppercase;">' , $v_curr_compnome );
				$v_curr_compnome = str_replace('LINHAS DE FORMAçãO ESPECíFICA EM' , 'Linhas de Formação Específica <b style="text-transform:uppercase;">' , $v_curr_compnome);
				$v_curr_compnome .= '.</b>';
				
				$sRet = '</p><p class=texto>Atesto, outrosim, que o referido curso tem como ' . $v_curr_compnome; 
			}
			
			return $sRet; 
			 
		}
        		        
	}
		
?>