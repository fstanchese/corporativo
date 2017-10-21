<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GOS - Criação de Tabela a partir de Model","GOS - Criação de Tabela a partir de Model",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user,"oracle",array("USER"=>"usjt","PASS"=>"oracle92"));


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//
	
	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	//Opcional $nav
	$view->Header($user);
	
	
	
	//Instanciar formulário
	$form = new Form();
	
	$form->Fieldset("Informe a Model");
	
	$form->Input("Model",'text', array("name"=>'model_name', "class"=>"size50", "value"=>$_POST[model_name]));
		
	$form->Button("submit",array("name"=>"buscar", "value"=>"Prosseguir"));
		
	$form->CloseFieldset ();
	
	//fecha formulário
	unset ($form);
	

	
	if($_POST[model_name] != "")
	{

		//VERIFICAR SE A MODEL EXISTE
		if(!is_file('../model/'.$_POST[model_name].".class.php"))
		{
			
			echo "Essa Model não Existe";
			exit(0);
			
		}
		
		
		
		
		require_once '../model/'.$_POST[model_name].".class.php";
		
		
		$tableCreated = $dbData->Row($dbData->Get("SELECT object_id FROM user_objects WHERE object_name ='".strtoupper($_POST[model_name])."'"));
		
		
		
		if($tableCreated[OBJECT_ID] != "")
		{
			
			//echo "Tabela já criada";
			//exit(0);
			
		}
		
		
		
		$idSeq = $dbData->Row($dbData->Get("SELECT count(*)+50 as qte FROM user_objects WHERE object_type='TABLE'"));
		$model = new $_POST[model_name] ($dbOracle);
		
		if($model->rows == "")
		{
			
			echo "Informe o 'rows' da Model";
			exit(0);
			
		}
		

		$numRows = $model->rows;
		
		if($numRows == '') $numRows = 100;
		
		$calc = ceil($model->rows*0.0732);
		if($calc < 10) $calc = 10;
		
		if(count($model->attribute) > 1)
			$calc = ceil($calc + $calc * ((count($model->attribute)/100)));
		
		$next = ceil($calc * 0.1);
		if ($next < 10)
			$next = 10;
		
		
		
		
		echo "  CREATE TABLE USJT.".strtoupper($model->table)." ( <br>
				
				ID NUMBER(15,0), <br>
				DT DATE DEFAULT (sysdate), <br>
				LUPD DATE, <br>
				LTXT DATE, <br>
				US VARCHAR2(30 BYTE) DEFAULT (USER),<br> 
				
				";

		foreach($model->attribute as $coluna => $dados)
		{
			
			$complLen = "";
			
			if($dados[NN] == '1') $nn = " NOT NULL "; else $nn =  " NULL ";
			
			if($dados[Type] == 'varchar2') $complLen = "byte"; 
			
			if($dados[Type] == 'date' || $dados[Type] == 'clob') 
				$arCol[] = $coluna." ".$dados[Type]. $nn."<br>";
			
			else 
				$arCol[] = $coluna." ".$dados[Type]. " ( ".$dados[Length]." ".$complLen." ) ".$nn."<br>";
						
		}
		
		echo implode(', ',$arCol);
		
		echo ") pctfree 10   pctused 90   tablespace DATA001 
 				 storage ( initial ".$calc."K next ".$next."K maxextents unlimited pctincrease 0 )
				
				;<br><br>";
		
		echo "ALTER TABLE USJT.".strtoupper($model->table)." ADD CONSTRAINT ".strtoupper($_POST[model_name])."PK PRIMARY KEY (ID)<br>
				using index storage ( initial 10K next 10K ) tablespace INDX001;<br>";
		
		echo "CREATE public synonym ".strtoupper($model->table)." FOR USJT.".strtoupper($model->table).";<br><br>";
		
		
		
		echo "CREATE sequence USJT.".strtoupper($model->table)."_Id START WITH ".(str_pad($idSeq[QTE],15,0)+1)." NOCACHE;<br><br>";
		
		
		foreach($model->attribute as $coluna => $dados)
		{
				
			if(strtolower(substr($coluna,-3)) == '_id')
			{
				
				echo "ALTER TABLE USJT.".$model->table." ADD CONSTRAINT ".$model->table.$coluna."_FK FOREIGN KEY ( ".$coluna." ) references ".reset(explode("_",$coluna))." (id); <br><br>";
				
			}
				
				
				
				
				
		}
		
		
		
		//criacao dos indices
		if (is_array($model->index))
		{		
			foreach($model->index as $nome => $dados)
			{
					
				$unique = "";				
				if($dados["Unique"] == 1) $unique = " UNIQUE ";
					
				
				echo "CREATE ".$unique." INDEX USJT.".strtoupper($model->table)."_".strtoupper($nome)." ON USJT.".strtoupper($model->table)." (".$dados[Cols].")<br>
						storage ( initial 100K next 100K ) tablespace INDX001;<br><br>";
				
			}
		}		
		
		
		echo "
				
				
				  CREATE TABLE USJT.".strtoupper($_POST[model_name])."HI <br> 
				   (	".strtoupper($_POST[model_name])."_ID NUMBER(15,0) NOT NULL ENABLE, <br> 
					DT DATE DEFAULT (sysdate) NOT NULL ENABLE, <br>
					US VARCHAR2(30 BYTE) DEFAULT (USER) NOT NULL ENABLE, <br> 
					COL VARCHAR2(30 BYTE) NOT NULL ENABLE,  <br>
					OLD VARCHAR2(500 BYTE), <br>
					NEW VARCHAR2(500 BYTE) <br>	
				   )
 					 pctfree 10   pctused 90   tablespace DATA001 
					 storage ( initial 1260K next 126K maxextents unlimited  pctincrease 0 ); <br>
				
				  CREATE INDEX USJT.".strtoupper($_POST[model_name])."HI_".strtoupper($_POST[model_name])."_IDIX ON USJT.".strtoupper($_POST[model_name])."HI (".strtoupper($_POST[model_name])."_ID); <br><br><br>

				  		
				  		
				";
		
		echo "CREATE public synonym ".strtoupper($model->table)."hi FOR USJT.".strtoupper($model->table)."hi;<br><br>";
		
		
		
		echo "
				create or replace TRIGGER USJT.".($model->table)."TRBIID <br> 
 				before insert on ".($model->table)."  <br>
 				for each row  <br>
				declare  wID number(15); <br>
 				cursor c1 is select ".($model->table)."_id.nextval from dual; <br>
 				begin <br>
   					if ( :new.id is null ) then <br> 
     					open c1; fetch c1 into wID; close c1; <br>
     					:new.id := wID;  <br>
   					end if; <br>
 				end;<br>  <br>
				";
		
		
		//procedure
		
		
		echo "create or replace procedure USJT.".($model->table)."_sIUD 
				( 
				p_O_Option                     in  varchar2  default(null),
				p_".($model->table)."_Id                      in  number    default(null),
				";
		

		foreach($model->attribute as $coluna => $dados)
		{
			
			$arProcCol[] = "p_".$model->table."_".$coluna." in ".$dados[Type]. " default(null)";
			$arAttrProc[] = "p_".$model->table."_".$coluna;
			
		}
		
		echo implode(",",$arProcCol);
		
		echo " ) is <br>
				
				cursor c ( pId in number ) is select * from ".$model->table." where id=pId;<br>
				r ".($model->table)."%rowtype;<br>
				ddt date := sysdate;<br>
				begin<br>
				  if ( p_O_Option = 'insert' ) then<br>
				    insert into ".$model->table."<br>
				    ( ".implode(", ",array_keys($model->attribute))." ) values ( ".implode(", ",$arAttrProc)." ); end if;<br>
				    		
				    		
				    		
				    if ( p_O_Option = 'update' or p_O_Option = 'updateNoLog' ) then<br>
				    open c(p_".($model->table)."_Id); fetch c into r; close c;<br>
				    update ".$model->table." set<br>
				    LUPD = sysdate,<br>
				    		
				    		
				    		";
		
		foreach($model->attribute as $coluna => $dados)
		{
			
			$arUpd[] = $coluna." = nvl(p_".$model->table."_".$coluna.",r.".$coluna.") <br>";
		}
		
		
		echo implode(", ",$arUpd)." where id = p_".$model->table."_Id; <br>
				
				if ( r.id is not null and p_O_Option = 'update' ) then <br>
				";
		
		foreach($model->attribute as $coluna => $dados)
		{
				
			echo "if ( r.".$coluna."<>p_".$model->table."_".$coluna." and p_".$model->table."_".$coluna." is not null ) then<br>";
						//if ( p_".$model->table."_".$coluna." = 'NULL' ) then p_".$model->table."_".$coluna." := null; end if; <Br>
			echo "        insert into ".$model->table."hi (dt,".$model->table."_Id,col,old,new) values (ddt,p_".$model->table."_Id,'".$coluna."',r.".$coluna.",p_".$model->table."_".$coluna.");<br>
				      end if; <br>";
		}
		
		echo " end if;<br>
				  end if;<br>
				  if ( p_O_Option = 'delete' ) then<Br>
				    delete ".$model->table." where id = p_".$model->table."_Id;<Br>
				  end if;<Br>
				end;<br><br>";
		
		if (is_array($model->recognize))
		{
			foreach($model->recognize as $nomeRec => $cols)
			{
				unset($aux);
				unset($aux2);
				$aux = explode(",",$cols);
				foreach($aux as $coluna)
				{
					if(strtolower(substr($coluna,-3)) == '_id')
					{
						$aux2[] = " s.x(".reset(explode("_",$coluna))."_gsRecognize(".$coluna.")) ";
					}
					else
					{
						$aux2[] = "s.x(".$coluna.") ";
					}
				}
			
			
			
				echo "create or replace function USJT.".$model->table."_gs".$nomeRec."<Br>
						(<Br>
							p_".$model->table."_id                     in number<Br>
						) return varchar2 is<Br>
					
						cursor c1(cpid in number ) is<Br>
						select ".implode("|| ' - '||",$aux2)." from ".$model->table." where id=cpid;<Br>
						sRet varchar2(300) := null;<Br>
						begin<Br>
						open  c1( p_".$model->table."_id );<Br>
						fetch c1 into sRet;<Br>
						close c1;<Br>
						return replace(sRet,'-  -','-');<Br>
						end;<Br><br>
											
						create public synonym ".$model->table."_gs".$nomeRec." for USJT.".$model->table."_gs".$nomeRec.";<br>
						";
			
			}
		}
	
		
		
		
	}
	
	
	
	
	unset($view);
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);

?>