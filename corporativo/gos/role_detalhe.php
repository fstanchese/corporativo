<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GOS - Detalhes da Role","GOS - Detalhes da Role",array('ADM','CPD'),$user);
	
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
	$nav = new Navigation($user, $app, $dbData);
	
	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	$view->Header($user,$nav);

	$view->SubTitle("Role: ".$_GET[role]);
	
	?>
			
	
		<ul class='tabs'>
			<li idr='1' class='bgGeneral tabsHover'>PRIVILÉGIOS</li>
			<li idr='2' class='bgGeneral'>USUÁRIOS</li>
			<li idr='3' class='bgGeneral'>ROLES</li>
			<li idr='4' class='bgGeneral'>ATRIBUIR ROLE</li>
		</ul>
		
		<div class='tabContent' idr='1'>
			
			<?php 
			
					$dbData->Get("select   table_name,   LISTAGG(privilege, ',') WITHIN GROUP (ORDER BY privilege)  as privilege FROM   dba_tab_privs WHERE grantee = '".$_GET[role]."' AND owner = 'USJT' AND grantor = 'USJT' Group By table_name order by table_name");
	
					
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
		
		
		<div class='tabContent' idr='2'>
			
			
			<?php 
			
					$dbData->Get("select grantee from dba_role_privs, dba_users where granted_role = '".$_GET[role]."' and dba_users.username = dba_role_privs.grantee  order by 1");
	
					
					//Se a consulta possuir resultados
					if($dbData->Count () > 0)
					{
						//Instancia o DataGrid passando as colunas
						$grid = new DataGrid(array("","","","",""),"Usuários que Possuem a ROLE");
						$cont = 0;
						
						//Obtêm as linhas da execução do arquivo .sql
						while($row = $dbData->Row ())
						{
							$grid->Content("<a href='user_detalhe.php?user=".$row[GRANTEE]."'>".$row[GRANTEE]."</a>",array("width"=>"20%"));
					
						}
					}
					
					//fecha grid
					unset($grid);
			
			
			
			?>
			
		</div>
		
		<div class='tabContent' idr='3'>
			
			
			<?php 
				
				$dbData->Get("select * from dba_role_privs where grantee = '".$_GET[role]."' and not exists (select * from dba_users WHERE dba_users.username = dba_role_privs.grantee)");
				
	
					
					//Se a consulta possuir resultados
					if($dbData->Count () > 0)
					{
							
						//Instancia o DataGrid passando as colunas
						$grid = new DataGrid(array("","","","",""),"ROLES que Possuem a ROLE");
						$cont = 0;
						
						//Obtêm as linhas da execução do arquivo .sql
						while($row = $dbData->Row ())
						{
							$arRoles[] = $row[GRANTED_ROLE];
							$grid->Content($row[GRANTED_ROLE],array("width"=>"20%"));
					
						}
					}
					
					//fecha grid
					unset($grid);
			
			
			
			?>
			
		</div>
		<div class='tabContent' idr='4'>
		
			<?php 
			
				
				
			
			
				$dbData->Get("select role FROM dba_roles order by role");
			
			
				//Obtêm as linhas da execução do arquivo .sql
				while($row = $dbData->Row ())
				{
					
					$arRolesGeneral[] = $row[ROLE];
					
				}
				

				if(is_array(arRoles) && is_array($arRolesGeneral)){
					$arRolesGeneral = array_diff($arRolesGeneral,arRoles);
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