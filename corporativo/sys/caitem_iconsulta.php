<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Consulta de Itens do C.A. que não passaram por Compras","Consulta de Itens do C.A. que não passaram por Compras",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CAItem.class.php");
	include("../model/CA.class.php");

	

	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	$caItem = new CAItem($dbOracle);
	$ca		= new CA($dbOracle);
	
	 	
	$view = new ViewPage($app->title);

	$view->Header($user,$nav);
	
	if($_GET[p_CAItem_Id] != "")
	{
		
		$dbData->Set("UPDATE caitem SET cancelado = 'on' WHERE id = '"._Decrypt($_GET[p_CAItem_Id])."'");
		$dbData->Commit();
		
	}
	
	
	echo $view->JS("
		
			$(document).on('click','.cancelItens',function(e)
			{
			
				e.preventDefault();
			
				$.post('../ajax/caitem.ajax.php?p_Action=CancelaItens&p_CA_Id='+$('#p_CA_Id').val(),function(e)
				{
			
					location.href='caitem_iconsulta.php';
			
				})
			
			});
		
			");
	
	
	

	$form = new Form();

		$form->Fieldset();
		
			
			$form->Input("C.A.",'select',	array("name"=>'p_CA_Id', "class"=>"size70", "required"=>'1',"option"=>$ca->Calculate('','','id desc'), "value"=>$_GET[p_CA_Id]));
			
			$form->Button ("button",array ("name"=>"consultar", "value"=>"Consultar","class"=>"search"));

			
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	if($_GET["p_O_Option"] == "search")
	{
	
		$dbData->Get("SELECT descricao, item, valor, id FROM caitem WHERE ca_id = '".$_GET[p_CA_Id]."' AND cancelado = 'off' ORDER BY item");
		
		if($dbData->Count() > 0)
		{
			
			echo $view->Link("Cancelar Todos os Itens",array("href"=>"#","class"=>"cancelItens","style"=>"color:red;")).$view->Br().$view->Br();

			
			$grid = new DataGrid(array("Item","Descrição","Valor","C. Custo","Editar",'Apagar'));
			
			while($row = $dbData->Row())
			{
	
				$grid->Content($row[ITEM],array('align'=>'left'));
				$grid->Content($row[DESCRICAO],array('align'=>'left'));
				$grid->Content(_FormatValor($row[VALOR]),array('align'=>'left'));
				
				//ccusto
				$dbData2 = new DbData($dbOracle);
				
				$dbData2->Get("SELECT ccusto.codigo, caitemcc.percentual FROM caitemcc, ccusto  WHERE ccusto.id = caitemcc.ccusto_id AND caitem_id = '".$row[ID]."'");
				
				$arCC = '';
				
				while($row2 = $dbData2->Row())
				{
					
					$arCC .= $row2[CODIGO]." - ".$row2[PERCENTUAL]."% - R$ "._FormatValor($row[VALOR]*(str_replace(",",".",$row2[PERCENTUAL])/100))."<br>";
					
				}
				
				
				$grid->Content($arCC);
				$grid->Content($view->Link("<i class='fa fa-pencil-square-o imgSelectItem'></i>",array("href"=>"caitem_iiud.php?p_CAItem_Id="._UrlEncrypt($row[ID]))));
				$grid->Content($view->Link("<i class='fa fa-times-circle-o imgDelItem'></i>",array("href"=>"caitem_iconsulta.php?p_O_Option=search&p_CA_Id=".$_GET[p_CA_Id]."&p_CAItem_Id="._UrlEncrypt($row[ID]))));
												  				
	
			}
		}
		
		unset($grid);
		
	}
	
	unset($view);	
	unset($Remessa);	
	unset($nav);		
	unset($dbData);	
	unset($dbOracle);	
	unset($app);	
	unset($user);

?>