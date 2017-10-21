<?php 

	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user 			= new User ();
	$app = new App("Mapa do Sistema","Mapa do Sistema",array('ADM','CPD','MENU'),$user);
	
	include("../engine/View.class.php");
	include("../engine/Db.class.php");
	

	include("../engine/ViewPage.class.php");
	include("../engine/Navigation.class.php");
	
	include("../model/MapaSub.class.php");
	


	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	
	$mapaSub = new MapaSub($dbOracle);
	
	$_GET[p_MapaSub_Id] = 204800000000000+$_GET[p_MapaSub_Id];
	
	$dadosMapa = $mapaSub->GetIdInfo($_GET[p_MapaSub_Id]);
	

	
	$view = new ViewPage($app->title,$app->description);
	$view->Header($user);
	
	
	
	$dbData->Get("SELECT indexgui.path, indexgui.procname||'.php' as procname, indexgui.guiname, indexgui.securitygroups, linkbox
			FROM mapagui, indexgui 
			WHERE indexgui.id = mapagui.indexgui_id
			AND mapagui.mapasub_id = ". $_GET[p_MapaSub_Id]." ORDER BY guiname");
	
	
	
	while($row = $dbData->Row())
	{
		foreach($user->GetRoles() as $role)
		{
	
			if(strpos($row[SECURITYGROUPS],$role) !== FALSE)
			{
				$key = "SYS";
				
				if($row[PATH] == "rep")
					$key = "REL";
				
				if(strpos($row[PROCNAME],"_iiud.php") !== FALSE)
					$key = "IUD";
				
				
				
				
				if($row[LINKBOX] == 'on') $arPag[$key][CLASSLINK][] = "1"; else $arPag[$key][CLASSLINK][] = "0";
				
				$arPag[$key][LINK][]				= "../".$row[PATH]."/".$row[PROCNAME];
				$arPag[$key][GUINAME][] 			= $row[GUINAME];
				$arPag[$key][SECURITYGROUPS][] 		= $row[SECURITYGROUPS];
				$arPag[$key][TIPOLINK][]		 	= $row[TIPOLINK];
				
				break;
				
			}
			
		}
		
	}

	$arCor 			= array('#084e8a','#0a73cb','#449de9','#0d2539','#00284a','#63b6fc','#005e12','#08c32c','#5edb76','#468e54','#1a4622','#006295');
	$arCorTexto 	= array('#fff','#222','#222','#fff','#fff','#222','#fff','#222','#222','#222','#fff','#fff');
	
	if(is_array($arPag[REL][LINK]))
	{
		$tamanhoREL 	= (100/count($arPag[REL][LINK]))-1;
		$marginREL 		= ((100-($tamanhoREL* count($arPag[REL][LINK])))/count($arPag[REL][LINK]))/2;
		
		if($tamanhoREL < 15.5) $tamanhoREL = 15.6666666667;
	}
	
	
	if(is_array($arPag[IUD][LINK]))
	{
		$tamanhoIUD 	= (100/count($arPag[IUD][LINK]))-1;
		$marginIUD 		= ((100-($tamanhoIUD* count($arPag[IUD][LINK])))/count($arPag[IUD][LINK]))/2;
		
		if($tamanhoIUD < 15.5) $tamanhoIUD = 15.6666666667;
		
	}
	
	
	if(is_array($arPag[SYS][LINK]))
	{
		$tamanhoSYS 	= (100/count($arPag[SYS][LINK]))-1;
		$marginSYS 		= ((100-($tamanhoSYS* count($arPag[SYS][LINK])))/count($arPag[SYS][LINK]))/2;
		
		if($tamanhoSYS < 15.5) $tamanhoSYS = 15.6666666667;
		
	}
	
	echo $view->JS("

			$(document).on('click','.boxItem',function()
			{
			
				if($(this).attr('isColoBox') == '1')
				{
					
					if($(this).attr('link').indexOf('?') > 0)
						var compl = '&switchPageToBox=1';
					else
						var compl = '?switchPageToBox=1';
			
					$.colorbox({
						iframe:true, 
						width:'95%', 
						height:'95%',
						href:$(this).attr('link')+compl
					})
			
				}
				else
				{
					window.open($(this).attr('link'));
				}
			
			
			});
			
			
			
			");
	
	
	 
	
		
	echo "
			<style>
				.boxItem { cursor:pointer;float:left;height:120px!important;position:relative}
				.boxItem:hover { opacity:0.85; -webkit-transition: opacity 1s ease-in-out;
  -moz-transition: opacity 0.2s ease-in-out;
  -ms-transition: opacity 0.2s ease-in-out;
  -o-transition: opacity 0.2s ease-in-out;
  transition: opacity 0.2s ease-in-out;}
			
			.boxItem em { position:absolute;top:10px;font-size:50px;width:100%;text-align:center;z-index:1;color:#444 }
			.boxItem strong { position:absolute;top:65px;width:100%;z-index:2;text-align:center;color:#222}
			
			.titulo { color: #bbb;text-shadow: 0px 2px 3px #666;width:100%;padding:20px 0;background:#474747;text-align:center;margin:1% 0;font-size:37px;text-transform:uppercase}
			</style>
		";	
		

	echo $view->Div(array("style"=>"width:98%;margin:0 auto;")).
			$view->Div(array("class"=>"titulo")).$dadosMapa[NOME].$view->CloseDiv();
	
		
		if(is_array($arPag[IUD][LINK]))
		{
			$cont=0;
			foreach($arPag[IUD][LINK] as $key => $link)
			{	
				$rand = rand(0,11);
				
				echo $view->Div(array("class"=>"boxItem","style"=>"margin:".$marginIUD."%;background:".$arCor[$rand].";width:".$tamanhoIUD."%","isColoBox"=>$arPag[IUD][CLASSLINK][$key],"title"=>$arPag[IUD][LINK][$key],"link"=>$arPag[IUD][LINK][$key])).
						$view->Italic("",array("class"=>"fa fa-file-text","style"=>"color:".$arCorTexto[$rand])).
						$view->Strong(str_replace(" - ".$dadosMapa[NOME],"",$arPag[IUD][GUINAME][$key]),array("style"=>"color:".$arCorTexto[$rand])).
					$view->CloseDiv();
				
				if($cont++ == 5)
				{
					echo $view->Br();
					$cont = 0;
					
				}
			}
			
			echo $view->Br();
		}
		
		if(is_array($arPag[SYS][LINK]))
		{
			$cont=0;
			foreach($arPag[SYS][LINK] as $key => $link)
			{	
				$rand = rand(0,11);
				
				echo $view->Div(array("class"=>"boxItem","style"=>"margin:".$marginSYS."%;background:".$arCor[$rand].";width:".$tamanhoSYS."%","isColoBox"=>$arPag[SYS][CLASSLINK][$key],"title"=>$arPag[SYS][LINK][$key], "link"=>$arPag[SYS][LINK][$key])).
						$view->Italic("",array("class"=>"fa fa-pencil-square-o","style"=>"color:".$arCorTexto[$rand])).
						$view->Strong(str_replace(" - ".$dadosMapa[NOME],"",$arPag[SYS][GUINAME][$key]),array("style"=>"color:".$arCorTexto[$rand])).
					$view->CloseDiv();
				
				if($cont++ == 5)
				{
					echo $view->Br();
					$cont = 0;
					
				}
			}
			
			echo $view->Br();
		}
		
		if(is_array($arPag[REL][LINK]))
		{
			
			$cont=0;
			foreach($arPag[REL][LINK] as $key => $link)
			{	
				$rand = rand(0,11);
				
				echo $view->Div(array("class"=>"boxItem","style"=>"margin:".$marginREL."%;background:".$arCor[$rand].";width:".$tamanhoREL."%","isColoBox"=>$arPag[REL][CLASSLINK][$key], "title"=>$arPag[REL][LINK][$key], "link"=>$arPag[REL][LINK][$key])).
						$view->Italic("",array("class"=>"fa fa-table","style"=>"color:".$arCorTexto[$rand])).
						$view->Strong(str_replace(" - ".$dadosMapa[NOME],"",$arPag[REL][GUINAME][$key]),array("style"=>"color:".$arCorTexto[$rand])).
					$view->CloseDiv();
				
				if($cont++ == 5)
				{
					echo $view->Br();
					$cont = 0;
					
				}
			}
			
			echo $view->Br();
		}
	
	echo $view->Br().$view->CloseDiv();
	
?>