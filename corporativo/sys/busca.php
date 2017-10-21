<?php

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user 			= new User ();
	$app = new App("Busca do Sistema","Utilize essa página para buscar Páginas",array('LOGIN'), $user);
	
	include("../engine/Db.class.php");
	
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
	include("../engine/Navigation.class.php");




	//Conectar o usuário ao Banco de Dados
	$dbOracle 		= new Db ($user);
	
	
	//Instanciar a DbData
	$dbData 		= new DbData ($dbOracle);
	

	/**
	 * Quando cria o objeto View  necessïário passar o Titulo da Página
	 */
	
	$vp = new ViewPage($app->title,$app->description);
	$vp->IncludeJS ("busca.js");
	$vp->Explain('IUD');

	//Instanciar a Navegação da Página
	$nav = new Navigation($user, $app,$dbData);
	
	
	$vp->Header($user,$nav);
	
	

	
	
?>

	
	
<?php 
	$dbData->Get("select * from  ( select indexGUI.procname, indexGUI.guiname, indexGUI.guidescription, path from indexGUI, userHist where upper(userHist.page) = upper(indexGUI.procname) and userHist.username='".strtoupper($user->GetUser())."' order by times desc) where  rownum <=10");
	
	
	
	
	$arHist[''] = " --- ";
	
	while($row = $dbData->Row ())
	{
		
		$path = $nav->url."private/";
		if($row[PATH] != "") $path = $nav->url.$nav->pathURL.$row[PATH]."/";
		
		$arHist[$path.$row[PROCNAME].".php"] = $row[GUINAME];
		
	}

	
	
	$form = new Form();
		$form->Fieldset();
			$form->Input("Histórico",'select',array('name'=>'p_hist','option'=>$arHist));
			$form->Input("Procurar Por",'text',array('name'=>'p_search','value'=>$_POST[p_search]));
			$form->Button("submit",array('name'=>'p_buscar','value'=>'Procurar'));
		$form->CloseFieldset();
	unset($form);
	
	
	$vp->On("change", "select[name=p_hist]", "window.open($(this).val());");
	
	
	if($_POST[p_search] != '')
	{
		
		if(strlen($_POST[p_search])<3)
		{
			$vp->AlertMsg ("Digite pelo menos 3 letras para buscar.");
		}
		else 
		{
		
			$dbData->Get("select  indexgui.id, procname,  guiname, indexgui.producao,  replace(guidescription,'()','') as GUIDESCRIPTION, path,  SECURITYGROUPS from   indexGUI where   upper(guiname||' '||guidescription) like '%'||replace(upper( '$_POST[p_search]' ),' ','%')||'%' and  trim( '$_POST[p_search]' ) is not null order by  guiname");
			
			echo "Total de linhas: ".$dbData->Count ();
			
			$grid = new DataGrid(array("Nome","Descrição","Menu"));
			
			while($row = $dbData->Row ())
			{
				
				$arRoles = array_intersect(explode(" ",$row[SECURITYGROUPS]),$user->GetRoles());
					
				
				if(is_array($arRoles) && !@eregi("_iaj",$row[PROCNAME]))
				{
				

					$dbData2 		= new DbData ($dbOracle);
					$dbData2->Get("SELECT id FROM sismenu WHERE indexgui_id = '".$row[ID]."' AND wpessoa_id = '".$_SESSION["p_WPessoa_Id"]."'");
					$menuId = $dbData2->Row();
					
					
					$path = $nav->url."private/";
					if($row[PRODUCAO] != "") $path = $nav->url.$nav->pathURL.$row[PATH]."/";
					
					
					$grid->Content($vp->Link($row[GUINAME],array("href"=>$path.$row[PROCNAME].".php","target"=>"_blank")));
					$grid->Content($vp->Link($row[GUIDESCRIPTION],array("href"=>$path.$row[PROCNAME].".php","target"=>"_blank")));
					
					
					if($menuId[ID] != "")
						$grid->Content("-",array('align'=>'center','width'=>'5%'));
					else 
						$grid->Content($vp->Img(array("src"=>"../images/add.png","class"=>"addToMenu","idr"=>$row["ID"],"title"=>"Adicionar ao Menu")),array('align'=>'center','width'=>'5%'));
					
					unset($dbData2);
				}
				
				
			}
			
			unset($grid);
		}

	}

	unset($dbData);
	unset($dbOracle);
	unset($vp);

?>