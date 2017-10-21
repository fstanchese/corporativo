<?php
	require_once ("../engine/Model.class.php");
		
	class WPessoa extends Model {
	
		public $table = 'WPessoa';
		
		public $attribute = array();
		public $calculate = array();
		public $index = array();
		
		public function __construct($db){

			$this->db = $db;
			

			$this->attribute['Codigo']['Type'] 			= 'number';
			$this->attribute['Codigo']['Length'] 		= 10;
			$this->attribute['Codigo']['NN'] 			= 0;
			$this->attribute['Codigo']['Label'] 		= 'Código';
				
			$this->attribute['CodigoFunc']['Type'] 		= 'varchar2';
			$this->attribute['CodigoFunc']['Length'] 	= 80;
			$this->attribute['CodigoFunc']['NN'] 		= 0;
			$this->attribute['CodigoFunc']['Label'] 	= 'Codigo do Funcionário';
				
			$this->attribute['Nome']['Type'] 			= 'varchar2';
			$this->attribute['Nome']['Length'] 			= 80;
			$this->attribute['Nome']['NN'] 				= 1;
			$this->attribute['Nome']['Label'] 			= 'Nome';
				
			$this->attribute['Pai']['Type'] 			= 'varchar2';
			$this->attribute['Pai']['Length'] 			= 50;
			$this->attribute['Pai']['NN'] 				= 0;
			$this->attribute['Pai']['Label'] 			= 'Nome do Pai';
				
			$this->attribute['Mae']['Type'] 			= 'varchar2';
			$this->attribute['Mae']['Length'] 			= 50;
			$this->attribute['Mae']['NN'] 				= 0;
			$this->attribute['Mae']['Label'] 			= 'Nome da Mãe';
				
			$this->attribute['Conjuge']['Type'] 		= 'varchar2';
			$this->attribute['Conjuge']['Length'] 		= 50;
			$this->attribute['Conjuge']['NN'] 			= 0;
			$this->attribute['Conjuge']['Label'] 		= 'Cônjuge';
				
			$this->attribute['DtNascto']['Type'] 		= 'date';
			$this->attribute['DtNascto']['NN'] 			= 0;
			$this->attribute['DtNascto']['Label']		= 'Data de Nascimento';
				
			$this->attribute['RGRNE']['Type'] 			= 'varchar2';
			$this->attribute['RGRNE']['Length'] 		= 20;
			$this->attribute['RGRNE']['NN'] 			= 0;
			$this->attribute['RGRNE']['Label'] 			= 'RGRNE';
				
			$this->attribute['PIS']['Type'] 			= 'varchar2';
			$this->attribute['PIS']['Length'] 			= 20;
			$this->attribute['PIS']['NN'] 				= 0;
			$this->attribute['PIS']['Label'] 			= 'PIS';

			$this->attribute['TEleNum']['Type'] 		= 'varchar2';
			$this->attribute['TEleNum']['Length'] 		= 15;
			$this->attribute['TEleNum']['NN'] 			= 0;
			$this->attribute['TEleNum']['Label']		= 'Título de Eleitor';

			$this->attribute['TEleZona']['Type'] 		= 'varchar2';
			$this->attribute['TEleZona']['Length'] 		= 3;
			$this->attribute['TEleZona']['NN'] 			= 0;
			$this->attribute['TEleZona']['Label'] 		= 'Título de Eleitor - Zona';
				
			$this->attribute['TEleSecao']['Type'] 		= 'varchar2';
			$this->attribute['TEleSecao']['Length'] 	= 4;
			$this->attribute['TEleSecao']['NN'] 		= 0;
			$this->attribute['TEleSecao']['Label'] 		= 'Título de Eleitor - Seção';
				
			$this->attribute['MilitarNum']['Type'] 		= 'varchar2';
			$this->attribute['MilitarNum']['Length']	= 25;
			$this->attribute['MilitarNum']['NN'] 		= 0;
			$this->attribute['MilitarNum']['Label']		= 'Carteira de Reservista';
				
			$this->attribute['Estado_RG_Id']['Type'] 	= 'number';
			$this->attribute['Estado_RG_Id']['Length'] 	= 15;
			$this->attribute['Estado_RG_Id']['NN'] 		= 0;
			$this->attribute['Estado_RG_Id']['Label'] 	= 'UF Emissor do RG';
				
			$this->attribute['CPF']['Type'] 			= 'number';
			$this->attribute['CPF']['Length'] 			= 11;
			$this->attribute['CPF']['NN'] 				= 0;
			$this->attribute['CPF']['Label'] 			= 'CPF';

			$this->attribute['Senha']['Type'] 			= 'varchar2';
			$this->attribute['Senha']['Length'] 		= 15;
			$this->attribute['Senha']['NN'] 			= 0;
				
			$this->attribute['Lograd_Id']['Type'] 		= 'number';
			$this->attribute['Lograd_Id']['Length']		= 15;
			$this->attribute['Lograd_Id']['NN'] 		= 0;
				
			$this->attribute['EnderNum']['Type'] 		= 'varchar2';
			$this->attribute['EnderNum']['Length'] 		= 14;
			$this->attribute['EnderNum']['NN'] 			= 0;
				
			$this->attribute['FoneRes']['Type'] 		= 'varchar2';
			$this->attribute['FoneRes']['Length'] 		= 20;
			$this->attribute['FoneRes']['NN'] 			= 0;
			$this->attribute['FoneRes']['Label'] 		= 'Telefone Residencial';
				
			$this->attribute['FoneCom']['Type'] 		= 'varchar2';
			$this->attribute['FoneCom']['Length'] 		= 20;
			$this->attribute['FoneCom']['NN'] 			= 0;
			$this->attribute['FoneCom']['Label']		= 'Telefone Comercial';
				
			$this->attribute['FoneCel']['Type'] 		= 'varchar2';
			$this->attribute['FoneCel']['Length'] 		= 15;
			$this->attribute['FoneCel']['NN'] 			= 0;
			$this->attribute['FoneCel']['Label'] 		= 'Telefone Celular';
				
			$this->attribute['FoneFax']['Type'] 		= 'varchar2';
			$this->attribute['FoneFax']['Length']		= 15;
			$this->attribute['FoneFax']['NN'] 			= 0;
			$this->attribute['FoneFax']['Label'] 		= 'Fax';
				
			$this->attribute['Email1']['Type'] 			= 'varchar2';
			$this->attribute['Email1']['Length'] 		= 100;
			$this->attribute['Email1']['NN'] 			= 0;
			$this->attribute['Email1']['Label']			= 'e-mail';
				
			$this->attribute['Mensagem']['Type'] 		= 'varchar2';
			$this->attribute['Mensagem']['Length'] 		= 120;
			$this->attribute['Mensagem']['NN'] 			= 0;
				
			$this->attribute['Sexo_Id']['Type'] 		= 'number';
			$this->attribute['Sexo_Id']['Length'] 		= 15;
			$this->attribute['Sexo_Id']['NN'] 			= 0;
				
			$this->attribute['Cidade_Natural_Id']['Type'] 	= 'number';
			$this->attribute['Cidade_Natural_Id']['Length'] = 15;
			$this->attribute['Cidade_Natural_Id']['NN'] 	= 0;
				
			$this->attribute['Escrita_Id']['Type'] 		= 'number';
			$this->attribute['Escrita_Id']['Length'] 	= 15;
			$this->attribute['Escrita_Id']['NN'] 		= 0;
				
			$this->attribute['LabBcoFlh']['Type'] 		= 'number';
			$this->attribute['LabBcoFlh']['Length'] 	= 4;
			$this->attribute['LabBcoFlh']['NN'] 		= 0;
			
			$this->attribute['LabBcoFlhMensal']['Type'] 	= 'number';
			$this->attribute['LabBcoFlhMensal']['Length'] 	= 4;
			$this->attribute['LabBcoFlhMensal']['NN'] 		= 0;
			
			$this->attribute['Apelido']['Type'] 		= 'varchar2';
			$this->attribute['Apelido']['Length'] 		= 20;
			$this->attribute['Apelido']['NN'] 			= 0;
			
			$this->attribute['Titulo_Id']['Type'] 		= 'number';
			$this->attribute['Titulo_Id']['Length'] 	= 15;
			$this->attribute['Titulo_Id']['NN'] 		= 0;
			
			$this->attribute['Ano_Titulo_Id']['Type'] 	= 'number';
			$this->attribute['Ano_Titulo_Id']['Length'] = 15;
			$this->attribute['Ano_Titulo_Id']['NN'] 	= 0;
			
			$this->attribute['Civil_Id']['Type'] 		= 'number';
			$this->attribute['Civil_Id']['Length'] 		= 15;
			$this->attribute['Civil_Id']['NN'] 			= 0;
			
			$this->attribute['Matric_Cart_Id']['Type'] 		= 'number';
			$this->attribute['Matric_Cart_Id']['Length']	= 15;
			$this->attribute['Matric_Cart_Id']['NN'] 		= 0;
			
			$this->attribute['Ano_EnsMedio_Id']['Type'] 	= 'number';
			$this->attribute['Ano_EnsMedio_Id']['Length'] 	= 15;
			$this->attribute['Ano_EnsMedio_Id']['NN'] 		= 0;
				
			$this->attribute['DefAuditivo']['Type'] 	= 'varchar2';
			$this->attribute['DefAuditivo']['Length'] 	= 3;
			$this->attribute['DefAuditivo']['NN'] 		= 0;
				
			$this->attribute['DefFisico']['Type'] 		= 'varchar2';
			$this->attribute['DefFisico']['Length'] 	= 3;
			$this->attribute['DefFisico']['NN'] 		= 0;
				
			$this->attribute['DefVisual']['Type'] 		= 'varchar2';
			$this->attribute['DefVisual']['Length'] 	= 3;
			$this->attribute['DefVisual']['NN'] 		= 0;
				
			$this->attribute['Docente']['Type'] 		= 'varchar2';
			$this->attribute['Docente']['Length'] 		= 3;
			$this->attribute['Docente']['NN'] 			= 0;
				
			$this->attribute['DtNasctoPai']['Type'] 	= 'date';
			$this->attribute['DtNasctoPai']['NN'] 		= 0;
				
			$this->attribute['DtNasctoMae']['Type'] 	= 'date';
			$this->attribute['DtNasctoMae']['NN'] 		= 0;
				
			$this->attribute['DtNasctoConjuge']['Type']	= 'date';
			$this->attribute['DtNasctoConjuge']['NN'] 	= 0;
				
			$this->attribute['CNHNum']['Type'] 			= 'number';
			$this->attribute['CNHNum']['Length'] 		= 15;
			$this->attribute['CNHNum']['NN'] 			= 0;
				
			$this->attribute['CNHDtExpedicao']['Type'] 	= 'date';
			$this->attribute['CNHDtExpedicao']['NN'] 	= 0;
				
			$this->attribute['CNHCategoria']['Type'] 	= 'varchar2';
			$this->attribute['CNHCategoria']['Length'] 	= 3;
			$this->attribute['CNHCategoria']['NN'] 		= 0;
				
			$this->attribute['Depart_Id']['Type'] 		= 'number';
			$this->attribute['Depart_Id']['Length'] 	= 15;
			$this->attribute['Depart_Id']['NN'] 		= 0;
				
			$this->attribute['Cracha']['Type'] 			= 'number';
			$this->attribute['Cracha']['Length'] 		= 15;
			$this->attribute['Cracha']['NN'] 			= 0;
				
			$this->attribute['Uniforme']['Type'] 		= 'varchar2';
			$this->attribute['Uniforme']['Length'] 		= 3;
			$this->attribute['Uniforme']['NN'] 			= 0;
				
			$this->attribute['Estacionamento']['Type'] 		= 'varchar2';
			$this->attribute['Estacionamento']['Length']	= 3;
			$this->attribute['Estacionamento']['NN'] 		= 0;
				
			$this->attribute['ValeTransporte']['Type'] 		= 'varchar2';
			$this->attribute['ValeTransporte']['Length'] 	= 3;
			$this->attribute['ValeTransporte']['NN'] 		= 0;

			$this->attribute['CodigoFuncAntigo']['Type'] 	= 'varchar2';
			$this->attribute['CodigoFuncAntigo']['Length'] 	= 10;
			$this->attribute['CodigoFuncAntigo']['NN'] 		= 0;
				
			$this->attribute['Horario']['Type'] 			= 'varchar2';
			$this->attribute['Horario']['Length'] 			= 23;
			$this->attribute['Horario']['NN'] 				= 0;
				
			$this->attribute['Lograd_Entreg_Id']['Type'] 	= 'number';
			$this->attribute['Lograd_Entreg_Id']['Length']	= 15;
			$this->attribute['Lograd_Entreg_Id']['NN'] 		= 0;
				
			$this->attribute['EnderNumEntreg']['Type'] 		= 'varchar2';
			$this->attribute['EnderNumEntreg']['Length'] 	= 14;
			$this->attribute['EnderNumEntreg']['NN'] 		= 0;
				
			$this->attribute['Funcionario']['Type'] 		= 'varchar2';
			$this->attribute['Funcionario']['Length'] 		= 3;
			$this->attribute['Funcionario']['NN'] 			= 0;

			$this->attribute['Usuario']['Type'] 			= 'varchar2';
			$this->attribute['Usuario']['Length'] 			= 30;
			$this->attribute['Usuario']['NN'] 				= 0;
				
			$this->attribute['CargHorMensal']['Type'] 	= 'number';
			$this->attribute['CargHorMensal']['Length'] = 3;
			$this->attribute['CargHorMensal']['NN'] 	= 0;
				
			$this->attribute['Clas_Id']['Type'] 		= 'number';
			$this->attribute['Clas_Id']['Length'] 		= 15;
			$this->attribute['Clas_Id']['NN'] 			= 0;
				
			$this->attribute['HorarioSab']['Type'] 		= 'varchar2';
			$this->attribute['HorarioSab']['Length'] 	= 23;
			$this->attribute['HorarioSab']['NN'] 		= 0;
				
			$this->attribute['DtCargo']['Type'] 		= 'date';
			$this->attribute['DtCargo']['NN'] 			= 0;
				
			$this->attribute['Lograd_Com_Id']['Type'] 	= 'number';
			$this->attribute['Lograd_Com_Id']['Length'] = 15;
			$this->attribute['Lograd_Com_Id']['NN'] 	= 0;
				
			$this->attribute['EnderNumCom']['Type'] 	= 'varchar2';
			$this->attribute['EnderNumCom']['Length'] 	= 14;
			$this->attribute['EnderNumCom']['NN'] 		= 0;
				
			$this->attribute['DtCurr']['Type'] 			= 'date';
			$this->attribute['DtCurr']['NN'] 			= 0;

			$this->attribute['RegTrab_Id']['Type'] 		= 'number';
			$this->attribute['RegTrab_Id']['Length'] 	= 15;
			$this->attribute['RegTrab_Id']['NN'] 		= 0;
			
			$this->attribute['RegTrabDt']['Type'] 		= 'date';
			$this->attribute['RegTrabDT']['NN'] 		= 0;
				
			$this->attribute['CBO_Id']['Type'] 			= 'number';
			$this->attribute['CBO_Id']['Length']		= 15;
			$this->attribute['CBO_Id']['NN'] 			= 0;
			
			$this->attribute['RGRNEFormatado']['Type'] 		= 'varchar2';
			$this->attribute['RGRNEFormatado']['Length']	= 20;
			$this->attribute['RGRNEFormatado']['NN'] 		= 0;
				
			$this->attribute['Sangue_Id']['Type'] 		= 'number';
			$this->attribute['Sangue_Id']['Length'] 	= 15;
			$this->attribute['Sangue_Id']['NN'] 		= 0;
			
			$this->attribute['DtObito']['Type'] 		= 'date';
			$this->attribute['DtObito']['NN'] 			= 0;
				
			$this->attribute['MilitarSerie']['Type'] 	= 'varchar2';
			$this->attribute['MilitarSerie']['Length'] 	= 5;
			$this->attribute['MilitarSerie']['NN'] 		= 0;
			
			$this->attribute['MilitarRegiao']['Type'] 	= 'varchar2';
			$this->attribute['MilitarRegiao']['Length'] = 5;
			$this->attribute['MilitarRegiao']['NN'] 	= 0;
			
			$this->attribute['CPFMae']['Type'] 			= 'number';
			$this->attribute['CPFMae']['Length'] 		= 11;
			$this->attribute['CPFMae']['NN'] 			= 0;
			
			$this->attribute['CPFPai']['Type'] 			= 'number';
			$this->attribute['CPFPai']['Length'] 		= 11;
			$this->attribute['CPFPai']['NN'] 			= 0;
			
			$this->attribute['RGRNEEmissor']['Type'] 	= 'varchar2';
			$this->attribute['RGRNEEmissor']['Length'] 	= 20;
			$this->attribute['RGRNEEmissor']['NN'] 		= 0;
			
			$this->attribute['RGRNEDt']['Type'] 		= 'date';
			$this->attribute['RGRNEDt']['NN'] 			= 0;
			
			$this->attribute['Adesao']['Type'] 			= 'date';
			$this->attribute['Adesao']['NN'] 			= 0;
			
			$this->attribute['EmailPromocional']['Type'] 	= 'varchar2';
			$this->attribute['EmailPromocional']['Length'] 	= 3;
			$this->attribute['EmailPromocional']['NN'] 		= 0;
			
			$this->attribute['DefFisicaDesc']['Type'] 	= 'varchar2';
			$this->attribute['DefFisicaDesc']['Length'] = 40;
			$this->attribute['DefFisicaDesc']['NN'] 	= 0;

			$this->attribute['Empresa']['Type'] 		= 'varchar2';
			$this->attribute['Empresa']['Length'] 		= 50;
			$this->attribute['Empresa']['NN'] 			= 0;
				
			$this->attribute['DtAdmissao']['Type'] 		= 'date';
			$this->attribute['DtAdmissao']['NN'] 		= 0;
				
			$this->attribute['Cargo']['Type'] 			= 'varchar2';
			$this->attribute['Cargo']['Length'] 		= 50;
			$this->attribute['Cargo']['NN'] 			= 0;
				
			$this->attribute['Email2']['Type'] 			= 'varchar2';
			$this->attribute['Email2']['Length'] 		= 100;
			$this->attribute['Email2']['NN'] 			= 0;

			$this->attribute['Site']['Type'] 			= 'varchar2';
			$this->attribute['Site']['Length'] 			= 100;
			$this->attribute['Site']['NN'] 				= 0;
				
			$this->attribute['EstacionamentoVal']['Type'] 	= 'date';
			$this->attribute['EstacionamentoVal']['NN'] 	= 0;
				
			$this->attribute['Prestador']['Type'] 		= 'varchar2';
			$this->attribute['Prestador']['Length'] 	= 3;
			$this->attribute['Prestador']['NN'] 		= 0;
				
			$this->attribute['EnsMedio']['Type'] 		= 'varchar2';
			$this->attribute['EnsMedio']['Length'] 		= 100;
			$this->attribute['EnsMedio']['NN'] 			= 0;
				
			$this->attribute['SeedContraSenha']['Type'] 	= 'number';
			$this->attribute['SeedContraSenha']['Length'] 	= 6;
			$this->attribute['SeedContraSenha']['NN'] 		= 0;

			$this->attribute['Acessos']['Type'] 		= 'number';
			$this->attribute['Acessos']['Length'] 		= 6;
			$this->attribute['Acessos']['NN'] 			= 0;

			$this->attribute['WPessoa_Conjuge_Id']['Type'] 		= 'number';
			$this->attribute['WPessoa_Conjuge_Id']['Length']	= 6;
			$this->attribute['WPessoa_Conjuge_Id']['NN'] 		= 0;
				
			$this->attribute['APDCdiContratado']['Type'] 	= 'number';
			$this->attribute['APDCdiContratado']['Length'] 	= 10;
			$this->attribute['APDCdiContratado']['NN'] 		= 0;
				
			$this->attribute['CivilTi_Id']['Type'] 		= 'number';
			$this->attribute['CivilTi_Id']['Length'] 	= 15;
			$this->attribute['CivilTi_Id']['NN'] 		= 0;
				
			$this->attribute['DtEmancipacao']['Type'] 	= 'date';
			$this->attribute['DtEmancipacao']['NN'] 	= 0;
				
			$this->attribute['SMS']['Type'] 			= 'varchar2';
			$this->attribute['SMS']['Length'] 			= 3;
			$this->attribute['SMS']['NN'] 				= 0;
				
			$this->attribute['NomeReceita']['Type'] 	= 'varchar2';
			$this->attribute['NomeReceita']['Length'] 	= 80;
			$this->attribute['NomeReceita']['NN'] 		= 0;

			$this->attribute['CorRaca_Id']['Type']		= 'number';
			$this->attribute['CorRaca_Id']['Length']	= 15;
			$this->attribute['CorRaca_Id']['NN'] 		= 0;
				
			
			//Todas as Queries da classe
			$this->query['qSelecaoFunc'] 			= "WPessoa_qSelecaoFunc";
			$this->query['qSelecaoProf'] 			= "WPessoa_qSelecaoProf";
			$this->query['qSelecaoAlunoEx']			= "WPessoa_qSelecaoAlunoEx";
			$this->query['qInfoAluno']				= "WPessoa_qInfoAluno";
			$this->query['qInfoDocente']			= "WPessoa_qInfoDocente";
			$this->query['qInfoFunc']				= "WPessoa_qInfoFunc";
			$this->query['qId']						= "WPessoa_qId";
				
			//Calculates para a criaï¿½ï¿½o de querys no diretï¿½rio SQL
			$this->calculate['SelecaoFunc']	= 'WPessoa_qSelecaoFunc';				
			$this->calculate['SelecaoProf']	= 'WPessoa_qSelecaoProf';
			
			$this->recognize['Recognize'] = "Nome";
			$this->recognize['RecCodigo'] = "Codigo";
				
		}
		
		
		
		public function GetFoto($WPessoa_Id,$param="")
		{
			
			$dbData = new DbData($this->db);
			
			
			$dbData->Get("SELECT id FROM wpessoafoto WHERE wpessoa_id = '".$WPessoa_Id."'");
			$row = $dbData->Row();
				
			
			if($param[width] == "") $param[width] = 100;
			
			
			if($row[ID] != '')
				$param[src] = "../lib/generate_image.php?id=".$WPessoa_Id;
			else
				$param[src] = "../images/foto_nao_disponivel.jpg";
				

			$foto = $this->Img($param);
			
			unset($dbData);
			
			return $foto;
			
					
			
		}
		
		public function AutoCompleteAlunoEx($value)
		{
		

			$dbData = new DbData($this->db);
			
			$arVal[p_WPessoa_Nome] = $arVal[p_WPessoa_RGRNE] = utf8_decode($value);
			if(is_numeric($value)) $arVal[p_WPessoa_Codigo] = $value;
			
			$dbData->Get($this->Query("qSelecaoAlunoEx",$arVal));
			
			if($dbData->Count() > 100)	die('0');
			if($dbData->Count() == 0) 	die('1');
			
			
			echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
			
			while($row = $dbData->Row())
			{
			
				echo $this->Li(array("idr"=>$row[ID],"nomeExibicao"=>str_replace("'","´",$row[NOME])));
				
				echo $this->GetFoto($row[ID],array("width"=>"30"))." ".$row[NOME]." - RA: ".$row[CODIGO];
			
				
				echo $this->CloseLi();
			
			}
			
			echo $this->CloseUl();
			
			unset($dbData);
			
			
		}
		
		
		public function AutoCompleteFunc($value)
		{
		
		
			$dbData = new DbData($this->db);
				
			$arVal[p_WPessoa_Nome] = utf8_decode($value);
			if(is_numeric($value)) $arVal[p_WPessoa_RGRNE] = $value;
				
			$dbData->Get($this->Query("qSelecaoFunc",$arVal));
				
			if($dbData->Count() > 100)	die('0');
			if($dbData->Count() == 0) 	die('1');
				
				
			echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
				
			while($row = $dbData->Row())
			{
					
				echo $this->Li(array("idr"=>$row[ID],"nomeExibicao"=>str_replace("'","´",$row[NOME])));
		
				echo $this->GetFoto($row[ID],array("width"=>"30"))." ".$row[NOME];
					
		
				echo $this->CloseLi();
					
			}
				
			echo $this->CloseUl();
				
			unset($dbData);
				
				
		}
		
		
		public function AutoCompletePrestador($value)
		{
		
		
			$dbData = new DbData($this->db);
		
			$p_WPessoa_Nome = utf8_decode($value);
			if(is_numeric($value)) $p_WPessoa_RGRNE = $value;
			
			$sql = 
			"SELECT Id, WPessoa.Nome, WPessoa.RGRNE, WPessoa.CodigoFunc,	WPessoa.CPF
			FROM WPessoa
			WHERE ( ( ( RGRNE = '".$p_WPessoa_RGRNE."'	or	CodigoFunc = '".$p_WPessoa_RGRNE."' ) AND ( '".$p_WPessoa_RGRNE."' IS NOT NULL ) ) or	( translate(upper(nome),'ÁÃÉÍÓÔÚÇ','AAEIOOUC') LIKE replace( trim( translate(upper( '".$p_WPessoa_Nome."' ),'ÁÃÉÍÓÔÚÇ','AAEIOOUC') ),' ','%')||'%'	AND	'".$p_WPessoa_Nome."' IS NOT NULL ) )
			AND	prestador = 'on'	
			ORDER BY nome";
		
			$dbData->Get($sql);
		
			if($dbData->Count() > 100)	die('0');
			if($dbData->Count() == 0) 	die('1');
		
		
			echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
		
			while($row = $dbData->Row())
			{
					
				echo $this->Li(array("idr"=>$row[ID],"nomeExibicao"=>str_replace("'","´",$row[NOME])));
		
				echo $this->GetFoto($row[ID],array("width"=>"30"))." ".$row[NOME];
					
		
				echo $this->CloseLi();
					
			}
		
			echo $this->CloseUl();
		
			unset($dbData);
		
		
		}
		
		
		public function AutoCompleteTodos($value)
		{
		
		
			$dbData = new DbData($this->db);
		
			$p_WPessoa_Nome = utf8_decode($value);
			if(is_numeric($value)) $p_WPessoa_RGRNE = $value;
				
			$sql =
			"SELECT Id, WPessoa.Nome, WPessoa.RGRNE, WPessoa.CodigoFunc,	WPessoa.CPF
			FROM WPessoa
			WHERE ( ( ( RGRNE = '".$p_WPessoa_RGRNE."'	or	CodigoFunc = '".$p_WPessoa_RGRNE."' ) AND ( '".$p_WPessoa_RGRNE."' IS NOT NULL ) ) or	( translate(upper(nome),'ÁÃÉÍÓÔÚÇ','AAEIOOUC') LIKE replace( trim( translate(upper( '".$p_WPessoa_Nome."' ),'ÁÃÉÍÓÔÚÇ','AAEIOOUC') ),' ','%')||'%'	AND	'".$p_WPessoa_Nome."' IS NOT NULL ) )
			ORDER BY nome";
		
			$dbData->Get($sql);
		
			if($dbData->Count() > 100)	die('0');
			if($dbData->Count() == 0) 	die('1');
		
		
			echo $this->Ul(array("class"=>"autoComplete","idInput"=>$_POST[idInput]));
		
			while($row = $dbData->Row())
			{
					
				echo $this->Li(array("idr"=>$row[ID],"nomeExibicao"=>str_replace("'","´",$row[NOME])));
		
				echo $this->GetFoto($row[ID],array("width"=>"30"))." ".$row[NOME];
					
		
				echo $this->CloseLi();
					
			}
		
			echo $this->CloseUl();
		
			unset($dbData);
		
		
		}

		
		
		public function GetInfoAluno($WPessoa_Id="",$vSemLink="")
		{
			
			require_once ('../model/Matric.class.php');
			require_once ('../model/TurmaOfe.class.php');
						
			$matric = new Matric($this->db);
			$turmaOfe = new TurmaOfe($this->db);
					
			$dbData = new DbData($this->db);
			
			if(!is_numeric($WPessoa_Id)) return false;
			
			$row = $this->GetIdInfo($WPessoa_Id); 
			
			if($row[CODIGO] == NULL) return "Não é Aluno";

			
			$dbData->Get($matric->Query("qAlunoUltima",array("p_WPessoa_Id"=>$row[ID])));

			$rowMatric = $dbData->Row();
			
			$arMatric = $matric->GetIdInfo($rowMatric[ID]);
			 
				$html = $this->Div(array("class"=>"boxInfoWPessoa"));
			
					$html .= $this->GetFoto($row[ID],array("class"=>"fotoInfoWPessoa"));
					$html .= $this->Div(array("class"=>"dadosInfoWPessoa"));
					if ($vSemLink == '') 
					{
						$html .= "Nome: ".$this->Link($row[NOME],array("class"=>"openColorBox","href"=>"../box/wpessoa_iinfogeral.php?p_WPessoa_Id="._UrlEncrypt($row[ID]))).$this->Br();
					}
					else
					{ 
						$html .= "Nome: ".$row[NOME].$this->Br();
					}
					$html .= "RA: ".$row[CODIGO].$this->Br();
					$html .= "Curso: "._ShortName($matric->GetCurso($rowMatric[ID]),80).$this->Br();
					$html .= "Turma: ".$arMatric[TURMAOFE_NOME].$this->Br();
					$html .= "Período Letivo: ".$turmaOfe->GetPLetivo($arMatric["TURMAOFE_ID"]) . " (".$arMatric[STATE_NOME].")";					
				$html .= $this->CloseDiv();
				
				
				
			$html .= $this->CloseDiv();
			
			
			return $html;
			
			
			
		}
		
		
		public function GetInfoDocente($value="")
		{
				
			if(!is_numeric($value)) return false;
			
				
			$row = $this->GetIdInfo($value);
			
			if($row[DOCENTE] != 'on') return "Não é Docente";
				
			$html = $this->Div(array("class"=>"boxInfoWPessoa"));
				
			$html .= $this->GetFoto($row[ID],array("class"=>"fotoInfoWPessoa"));
			$html .= $this->Div(array("class"=>"dadosInfoWPessoa"));
				$html .= "Nome: ".$this->Link($row[NOME],array("class"=>"openColorBox","href"=>"../box/wpessoa_iinfogeral.php?p_WPessoa_Id="._UrlEncrypt($row[ID]))).$this->Br();
				$html .= "CPF: ".$row[CPF].$this->Br();
				$html .= "Código: ".$row[CODIGOFUNC].$this->Br();
				$html .= "Usuário: ".$row[USUARIO].$this->Br();
				$html .= "Classificação: ".$row["CLASS_NOME"].$this->Br();
				$html .= "Reg. Trabalho: ".$row[REGTRAB_NOME];
			
			$html .= $this->CloseDiv();
		
		
		
			$html .= $this->CloseDiv();
				
			
			return $html;
		}
		
		
		
		
		public function GetInfoFuncionario($WPessoa_Id="")
		{
		
			if(!is_numeric($WPessoa_Id)) return false;
				
			$row = $this->GetIdInfo($WPessoa_Id);
			
			if($row["FUNCIONARIO"] == null) return "Não é Funcionário";
		
			$html = $this->Div(array("class"=>"boxInfoWPessoa"));
		
				$html .= $this->GetFoto($row[ID],array("class"=>"fotoInfoWPessoa"));
				$html .= $this->Div(array("class"=>"dadosInfoWPessoa"));
			
					$html .= "Nome: ".$this->Link($row[NOME],array("class"=>"openColorBox","href"=>"../box/wpessoa_iinfogeral.php?p_WPessoa_Id="._UrlEncrypt($row[ID]))).$this->Br();
					$html .= "CPF: ".$row[CPF].$this->Br();
					$html .= "Código: ".$row[CODIGOFUNC].$this->Br();
					$html .= "Usuário: ".$row[USUARIO].$this->Br();
					$html .= "Depto: ".$row[DEPART_NOME];
				
			
			
				$html .= $this->CloseDiv();
			$html .= $this->CloseDiv();
		

		
		
			return $html;
		}
		
		

		
		public function GetUsuario($WPessoa_Id)
		{
			$aReturn = $this->GetIdInfo($WPessoa_Id);
		
			return $aReturn['Usuario'];
		
		}
		
		
		public function GetInfoAlunoWeb($WPessoa_Id="")
		{
				
			require_once ('../model/Matric.class.php');
			require_once ('../model/TurmaOfe.class.php');
		
			$matric = new Matric($this->db);
			$turmaOfe = new TurmaOfe($this->db);
				
			$dbData = new DbData($this->db);
				
			if(!is_numeric($WPessoa_Id)) return false;
				
			$row = $this->GetIdInfo($WPessoa_Id);
				
			if($row[CODIGO] == NULL) return "Não é Aluno";
		
				
			$dbData->Get($matric->Query("qAlunoUltima",array("p_WPessoa_Id"=>$row[ID])));
		
			$rowMatric = $dbData->Row();
				
			$arMatric = $matric->GetIdInfo($rowMatric[ID]);
		
			$html .= $this->Div(array("class"=>"dadosInfoWPessoa"));
			$html .= "Nome: <strong>".$row[NOME]."</strong>".$this->Br();
			$html .= "RA: <strong>".$row[CODIGO]."</strong>".$this->Br();
			$html .= "Curso: ".$matric->GetCurso($rowMatric[ID]).$this->Br();
			$html .= $this->CloseDiv();
				
				
			return $html;
				
				
				
		}
		
		public function GetEndereco($vId)
		{
			require_once("../model/Lograd.class.php");
			
			
			$dbData = new DbData($this->db);
			$lograd = new Lograd($this->db);
			
			$aPessoa = $dbData->Row($dbData->Get("select nome,lograd_id,endernum from WPessoa where Id=$vId"));
			
			$aLograd = $lograd->GetEndereco($aPessoa[LOGRAD_ID]);
									
				
			if (is_array($aLograd))
			{
				$html  = _ShortName($aPessoa["NOME"],40) . $this->Br();
				$html .= _ShortName($aLograd["ENDERECO"],25) . ',' . $aPessoa["ENDERNUM"] . $this->Br() . $aLograd["BAIRRO"] .  $this->Br();
				$html .= $aLograd["CIDADE"] . ' - ' . $aLograd["UF"] . $this->Br() . $aLograd["CEP"];

			}
				
			return $html;
		}

		
		public function GetEnderecoCom($vId)
		{
			require_once("../model/Lograd.class.php");
			
				
			$dbData = new DbData($this->db);
			$lograd = new Lograd($this->db);
			
				
			$aPessoa = $dbData->Row($dbData->Get("select nome,lograd_com_id,endernumcom from WPessoa where Id=$vId"));
				
			$aLograd = $lograd->GetEndereco($aPessoa[LOGRAD_COM_ID]);
			
			if (is_array($aLograd))
			{
				$html  = _ShortName($aPessoa["NOME"],40) . $this->Br();
				$html .= _ShortName($aLograd["ENDERECO"],25) . ',' . $aPessoa["ENDERNUM"] . $this->Br() . $aLograd["BAIRRO"] .  $this->Br();
				$html .= $aLograd["CIDADE"] . ' - ' . $aLograd["UF"] . $this->Br() . $aLograd["CEP"];

			}
		
			return $html;
		}

		
		public function GetInfoFinan($WPessoa_Id="")
		{
				
			require_once ('../model/CCobConseq.class.php');
			require_once ('../model/WPesCobRest.class.php');
			require_once ('../model/Boleto.class.php');
			require_once ('../model/Cheque.class.php');
					
			$ccobConseq 	= new CCobConseq($this->db);
			$wpesCobRest	= new WPesCobRest($this->db);
			$boleto			= new Boleto($this->db);
			$cheque			= new Cheque($this->db);
			
			

			
			$dbData = new DbData($this->db);
				
			if(!is_numeric($WPessoa_Id)) return false;

			//Cheque Devolvido
			$vCheque = $this->IconFA("fa-square-o", array("style"=>"font-size:14px;color:#0000FF"));			
			$aCheque = $cheque->EmAberto($WPessoa_Id);
			if (is_array($aCheque))
			{
				$vCheque = $this->IconFA("fa-check-square-o", array("style"=>"font-size:14px;color:#FF0000"));
			}
			
			//Indivíduo no SCPC
			$aDados = $ccobConseq->GetSCPC($WPessoa_Id);
			
			$vSPC = $this->IconFA("fa-square-o", array("style"=>"font-size:14px;color:#0000FF"));
			if (is_array($aDados))
			{
				foreach ($aDados as $key => $row)
				{
					if (empty($aDados[$key]["DTEXCLUSAO"]))
					{
						$vSPC = $this->IconFA("fa-check-square-o", array("style"=>"font-size:14px;color:#FF0000"));
						break;
					}
				}				
			}
			//Boleto em Aberto
			$aBoleto = $boleto->GetBoletoState($WPessoa_Id,array('3000000000006','3000000000010'));
			$vBoleto = $this->IconFA("fa-square-o", array("style"=>"font-size:17px;color:#0000FF"));
			if (is_array($aBoleto))
			{
				$vBoleto = $this->IconFA("fa-check-square-o", array("style"=>"font-size:14px;color:#FF0000"));
			} 
			
			//Restrição de Cobrança
			$vRestricao = $this->IconFA("fa-square-o", array("style"=>"font-size:14px;color:#0000FF"));
			$aRestricao = $wpesCobRest->GetRestricao($WPessoa_Id);
			if (is_array($aRestricao))
			{

				foreach ($aRestricao as $key => $row)
				{
					if ($aRestricao["COBRESTACAO_ID"] == 173600000000004)
					{
						$vRestricao = $this->IconFA("fa-check-square-o", array("style"=>"font-size:14px;color:#FF0000"));
						break;
					}
				}
			}
				
			
			
			$row = $this->GetIdInfo($WPessoa_Id);
				
			if($row[CODIGO] == NULL) return "Não é Aluno";
		
			$html = $this->Div(array("class"=>"boxInfoWPessoa"));
				
			$html .= $this->GetFoto($row[ID],array("class"=>"fotoInfoWPessoa"));
			$html .= $this->Div(array("class"=>"dadosInfoWPessoa"));
			$html .= "Nome: ".$this->Link($row[NOME],array("class"=>"openColorBox","href"=>"../box/wpessoa_iinfogeral.php?p_WPessoa_Id="._UrlEncrypt($row[ID]))).$this->Br();
			$html .= "RA: ".$row[CODIGO].$this->Br();
			$html .= $vSPC .$this->Link(" SCPC",array("class"=>"openColorBox","href"=>"../box/ccobconseq_iinfo.php?p_WPessoa_Id="._UrlEncrypt($row[ID]))).$this->Br();
			$html .= $vBoleto . " Boletos ".$this->Br();
			$html .= $vCheque . $this->Link(" Cheque Devolvido",array("class"=>"openColorBox","href"=>"../box/cheque_iinfo.php?p_WPessoa_Id="._UrlEncrypt($row[ID]))).$this->Br();
			$html .= $vRestricao . $this->Link(" Restrição de Cobrança",array("class"=>"openColorBox","href"=>"../box/wpescobrest_iinfo.php?p_WPessoa_Id="._UrlEncrypt($row[ID]))).$this->Br();
			$html .= $this->CloseDiv();
		
		
			$html .= $this->CloseDiv();
				
				
			return $html;
				
		}
		
		// usar $sFinanceiro para matricula onde o Pronatec não é a prioridade.
		public function GetUltimaMatricula($WPessoa_Id="", $sFinanceiro = 'FALSE')
		{
		
			require_once ('../model/Matric.class.php');
		
			$matric = new Matric($this->db);
		
			$dbData = new DbData($this->db);
		
			if(!is_numeric($WPessoa_Id)) return false;
		
		
			$dbData->Get($matric->Query("qAlunoUltima",array("p_WPessoa_Id"=>$WPessoa_Id)));
		
			
			while ($aMatric = $dbData->Row())
			{
				if ($aMatric[CRIPROM_ID] <> 870000000006)
				{
					$aRet = $aMatric;
					break;
				}
				else
				{
					$aRet = $aMatric;						
				}
				if (! $sFinanceiro)
				{
					break;	
				}
			}		
		
			return $aRet;	
		
		
		}		
		
	}
?>