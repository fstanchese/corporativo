<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GOS - Detalhes do Usuário","GOS - Detalhes do Usuário",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);


	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navegação da Página
	$nav = new Navigation($user, $app,$dbData);
	
	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);

	
	$view->SubTitle("Usuário: ".$_GET[user]);
	
	?>
			
	
		<ul class='tabs'>
			<li idr='1' class='bgGeneral tabsHover'>ROLES</li>
			<li idr='2' class='bgGeneral'>TABLES</li>
			<li idr='3' class='bgGeneral'>ATRIBUIR ROLE</li>
		</ul>
		
		<div class='tabContent' idr='1'>
			
			<?php 
			
					$dbData->Get("select granted_role from dba_role_privs where grantee ='".strtoupper($_GET[user])."' order by 1");
	
					
					//Se a consulta possuir resultados
					if($dbData->Count () > 0)
					{
							
						//Instancia o DataGrid passando as colunas
						$grid = new DataGrid(array("","",""),"Roles do Usuário");
						$cont = 0;
						
						//Obtêm as linhas da execução do arquivo .sql
						while($row = $dbData->Row ())
						{
							$arUserRoles[] = $row[GRANTED_ROLE]; 
							$grid->Content("<a href='role_detalhe.php?role=".$row[GRANTED_ROLE]."'>".$row[GRANTED_ROLE]."</a>",array("width"=>"30%"));
					
						}
					}
					
					//fecha grid
					unset($grid);
			
			
			
			?>
			
			
		</div>
		<div class='tabContent' idr='2'>
			
			
			<?php 
			
					$dbData->Get("select dba_tab_privs.table_name, LISTAGG(dba_tab_privs.privilege, ',') WITHIN GROUP (ORDER BY dba_tab_privs.privilege) AS privilege from dba_tab_privs, dba_objects where dba_objects.OBJECT_NAME = dba_tab_privs.TABLE_NAME and dba_objects.OBJECT_TYPE = 'TABLE' AND dba_tab_privs.owner = 'USJT' and dba_tab_privs.grantor='USJT' AND dba_tab_privs.grantee = '".$_GET[user]."' GROUP BY dba_tab_privs.table_name");
	
					
					//Se a consulta possuir resultados
					if($dbData->Count () > 0)
					{
							
						//Instancia o DataGrid passando as colunas
						$grid = new DataGrid(array("Tabela","Privilégio"));
						$cont = 0;
						
						//Obtêm as linhas da execução do arquivo .sql
						while($row = $dbData->Row ())
						{
							
							$grid->Content($row[TABLE_NAME],array("width"=>"30%"));
							$grid->Content($row[PRIVILEGE],array("width"=>"30%"));
					
						}
					}
					
					//fecha grid
					unset($grid);
			
			
			
			?>
			
		</div>
		<div class='tabContent' idr='3'>
		
			<?php 
			
				$dbData->Get("select role FROM dba_roles order by role");
			
			
				//Obtêm as linhas da execução do arquivo .sql
				while($row = $dbData->Row ())
				{
					
					$arRolesGeneral[] = $row[ROLE];
					
				}
				

				if(is_array($arUserRoles) && is_array($arRolesGeneral)){
					$arRolesGeneral = array_diff($arRolesGeneral,$arUserRoles);
					sort($arRolesGeneral);
				}
				
				
				$grid = new DataGrid(array("","","",""),"Roles do Sistema");
				foreach($arRolesGeneral as $value)
				{
					
					$grid->Content("<input type='checkbox'> ".$value,array("width"=>"25%"));
				}
				
				//fecha grid
				unset($grid);
			?>
		
		</div>
		
		
<?php 
	
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);

?>