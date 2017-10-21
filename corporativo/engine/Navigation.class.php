<?php 

	

	class Navigation
	{
		
		private $user;
		private $app;
		public $id;
		
		public $url 		= "http://dbnet.usjt.br/";
		public $pathURL 	= "";
		
		
		private $dbData; 
		
		
		public function __construct($user,$app,$dbData)
		{
			
			$this->dbData = $dbData;
			
			$this->user = $user;
			$this->app = $app;
			
			
			
			$aux = explode("/",$_SERVER[PHP_SELF]);
			
			
			
			
			$this->pathURL = $aux[1]."/";
			
			//apaga a página
			unset($aux[count($aux)-1]);
			//apaga o /
			unset($aux[0]);
			//apaga o 
			unset($aux[1]);
			
			sort($aux);
			
			$path = implode($aux);
			
				$this->dbData->Get("SELECT id, path, securitygroups, guiname FROM indexgui WHERE procname = '".str_replace(".php","",end(explode("/",$_SERVER["PHP_SELF"])))."'");
				$indexGui = $this->dbData->Row();
				
				if($indexGui[ID] == "")
				{
					
						$this->dbData->Get("SELECT procname FROM indexgui WHERE guiname = '".$this->app->title."'");
						$pageExists = $this->dbData->Row();
						
						if($pageExists["PROCNAME"] != "")
								die("<h1>Já existe uma página com esse Título. Página: ".$pageExists["PROCNAME"]."</h1>");
					
						$sql = "INSERT INTO indexgui 
									(procname, guiname, guidescription, securitygroups, path ) 
								VALUES 
								('".str_replace(".php","",end(explode("/",$_SERVER["PHP_SELF"])))."',
										'". $this->app->title."',
										'". $this->app->description."',
										'".implode(" ",$this->app->GetRoles())."',
										'".$path."'
										
								)";
						$this->dbData->Set($sql);
						
						$this->id = $this->dbData->GetInsertedId("indexgui_id"); 
						
						$this->dbData->Commit();
					
				}
				else 
				{
					
					$this->id = $indexGui[ID];
					
					if($indexGui[PATH] == "")
					{
						
						$this->dbData->Set("UPDATE indexgui SET path = '".$path."' WHERE id = '".$this->id."'");
						
					}
					
					if($indexGui["SECURITYGROUPS"] != implode(" ",$this->app->GetRoles()))
					{
						
						$this->dbData->Set("UPDATE indexgui SET securitygroups = '".implode(" ",$this->app->GetRoles())."' WHERE id = '".$this->id."'");
						
					}
					
					$this->dbData->Commit();
					
				}
				
		}
		
				
		
		private function MenuLevel($menuId,$cont=0)
		{
			
			require_once ("../model/IndexGUI.class.php");
			$indexGUI = new IndexGUI($this->dbData->db);
			
			$cont++;
			
			${"dbData".$cont} = clone $this->dbData;
			
			
			$sql = "SELECT sismenu.*, indexgui.procname, indexgui.guiname, indexgui.path
					FROM sismenu, indexgui
   					WHERE sismenu.indexgui_id = indexgui.id  (+)  and  sismenu_pai_id = '".$menuId."'";
			
			
			${"dbData".$cont}->Get($sql);
				
			if(${"dbData".$cont}->numRows > 0)
			{
				echo "<ul>";
			
			
				while($row = ${"dbData".$cont}->Row($sql))
				{
					$nameShow = $row[GUINAME];
					if($row[GUINAME] == "") $nameShow = $row[NOME];
					
					$submenu = '';
					if($row[NOME] != "" && $row[RAIZ] == 'off')
					{ 
						$submenu = "isSubMenu";
						
						$link = "<a href='#'>".$nameShow."</a>";
						
					}
					else
					{
					
						$link = $indexGUI->GetLink($row[INDEXGUI_ID]);
					
					}
					
			
					echo "<li class='".$submenu."'>".$link;
					echo $this->MenuLevel($row[ID],$cont);
					echo "</li>\n";
						
				}
			
				echo "</ul>\n";
			}
				
			unset(${"dbData".$cont});
			unset($indexGUI);
			
		}
		
		
		public function UserNav()
		{
			$userId = $this->user->GetId();
			
			$sql = "SELECT * FROM sismenu WHERE wpessoa_id = '$userId' AND raiz = 'on'";
  				
			$dbData2 = clone $this->dbData;
			
			$dbData2->Get($sql);
			
			if($dbData2->numRows > 0)
			{
				echo "<ul id='nav'>\n";
				
				
				while($row = $dbData2->Row($sql))
				{
					
					echo "<li><a href='#'>".$row[NOME]."</a>";
					echo $this->MenuLevel($row[ID]);
					echo "</li>\n";
					
				}
				
				echo "</ul>\n";
				echo "<br style='clear:both'><br>";
			}
			
		}
					
					
		public function AppNav()
		{
			
			require_once ("../model/IndexGUI.class.php");
			$indexGUI = new IndexGUI($this->dbData->db);
			
			$sql = "
					SELECT distinct(procname) as procname, guiname, securitygroups, path, id FROM (
					
					SELECT procname, guiname, securitygroups , path, indexgui.id
					FROM indexgui, sismenurel 
					WHERE sismenurel.indexgui_link_id = indexgui.id
					AND sismenurel.indexgui_id = '".$this->id."'
							
					UNION
							
					SELECT procname, guiname, securitygroups, path , indexgui.id
					FROM indexgui, sismenurel 
					WHERE sismenurel.indexgui_link_id = indexgui.id
					AND sismenurel.indexgui_link_id = '".$this->id."'
					)
							
					";
			
			
			
			$this->dbData->Get($sql);
			
			
			if($this->dbData->Count() > 0)
			{
				echo "
						<div class='menuPage'>\n
							<span><img src='../images/menu_pagina.png' title='Menu da Página'>\n
								<ul>\n";
			
				while($row = $this->dbData->Row())
				{
			
					$roles = explode(" ",$row["SECURITYGROUPS"]);
	
					$arRoles = array_intersect($roles,$this->user->GetRoles());
					
					if(is_array($arRoles))
					{
						$link = $indexGUI->GetLink($row[ID]);
						
						echo "<li>".$link."</li>\n";
					
					}
				}
					
					
					
				
				
				echo "
									</ul>\n
								</span>\n
							</div>\n
							";
			
		}	
		
		
	}
}


?>