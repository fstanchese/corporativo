<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Cadastro de Item do CA sem Ordem de Compras","Cadastro de Item do CA sem Ordem de Compras",array('ADM','CPD'),$user);
	
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	include("../model/CA.class.php");
	include("../model/CAItem.class.php");
	include("../model/CAItemCC.class.php");
	include("../model/CCusto.class.php");

	

	$dbOracle 		= new Db ($user);
	$dbData 		= new DbData ($dbOracle);
	$nav 			= new Navigation($user, $app,$dbData);

	$ca 		= new CA($dbOracle);
	$caItem 	= new CAItem($dbOracle);
	$caItemCC 	= new CAItemCC($dbOracle);
	$ccusto 	= new CCusto($dbOracle);
	
	
	
	

	if($_POST[p_O_Option] == "select")
	{		
		$dbData->Get($banco->Query("qId",array("p_Banco_Id"=>$_POST[p_Banco_Id])));
		$linhaSelected = $dbData->Row();
	}
	
	if($_GET["p_Banco_Id"] != "") $linhaSelected[ID] = $_GET["p_Banco_Id"]; 
	
	
	$view = new ViewPage($app->title,$app->description);
	
	
	
	if($_POST[p_O_Option] == 'insert' || $_POST[p_O_Option] == 'update')
	{
		$arIns["p_CAItem_Id"] 	= $_POST[p_CAItem_Id];
		$arIns["p_O_Option"] 	= $_POST[p_O_Option];
		$arIns['p_CA_Id'] 		= $_POST[p_CA_Id];
		$arIns['p_Item'] 		= $_POST[p_Item];
		$arIns['p_Valor'] 		= strtr($_POST[p_Valor],",",".");
		$arIns['p_Descricao']	= $_POST[p_Descricao];
		$arIns['p_Cancelado']	= 'off';
		
		
		$caItem->IUD($arIns,FALSE);

		if($_POST[p_O_Option] == 'insert')
			$caItemId = $dbData->GetInsertedId("caitem_id");
		else 
			$caItemId = $_POST[p_CAItem_Id];
			
		
		unset($arIns);
		
		
		if(is_array($_POST[p_CC_Id]))
		{
			foreach($_POST[p_CC_Id] as $key => $value)
			{
				if($value != "" && $_POST[p_Perc][$key] != "")
				{
				
					$arIns["p_O_Option"] 	= 'insert';
					$arIns["p_CAItem_Id"] 	= $caItemId;
					$arIns["p_Percentual"] 	= strtr($_POST[p_Perc][$key],",",".");
					$arIns["p_CCusto_Id"]	= $value;
					
					$caItemCC->IUD($arIns);
				}
				
			}
		}
		
		
		if(is_array($_POST[p_CAItemCC_Id]))
		{
			
			unset($arIns);
			
			
			foreach($_POST[p_CAItemCC_Id] as $key => $value)
			{
				if($_POST[p_CC_Id_Alt][$key] != "" && $_POST[p_Perc_Alt][$key] != "")
				{
		
					$arIns["p_O_Option"] 	= $_POST[p_O_Option];
					$arIns["p_CAItem_Id"] 	= $caItemId;
					$arIns["p_Percentual"] 	= strtr($_POST[p_Perc_Alt][$key],",",".");
					$arIns["p_CCusto_Id"]	= $_POST[p_CC_Id_Alt][$key];
					$arIns["p_CAItemCC_Id"]	= $value;
						
					$caItemCC->IUD($arIns);
				}
		
			}
		}
		
		
		
		
	}
	
	$view->Explain ("IUD");	
		

	echo $view->JS("
			
			$(document).on('click','.addCC',function()
			{
				var numero = parseInt($('#p_Controle').val())+1;
				$('#divRateio_'+numero).show(1);
			
				$('#p_Controle').val(numero);
			});
			
			
			$(document).on('click','.delCCItem',function(e)
			{
			
				e.preventDefault();
			
				var \$obj = $(this);
			
				$.post('../ajax/caitem.ajax.php?p_Action=DelCC&p_CAItemCC_Id='+$(this).attr('idr'),function(msg)
				{
			
					location.reload();
			
				})
			
			});
			
			$(document).on('keyup','.pPerc',function(e)
			{
			
				e.preventDefault();
			
				if($(this).val() > 100) $(this).val(100);
				if($(this).val() < 0) $(this).val(0);
			
				var total = 0;
			
				$('.pPerc').each(function()
				{
					if($(this).val() == '') $(this).val(0);
					
					total += parseFloat($(this).val().replace(',','.'));
			
			
				});
			
			
				$('#totalRateio').html(total.toFixed(2));
			
				if(total != 100)
				{
					$('#divBtn').hide(1)
					$('#divAviso').show(1); 
				}
				else
				{
					$('#divBtn').show(1)
					$('#divAviso').hide(1);
				}
			
			});
			
			
			
			
			
			
			");
	
	
	if($_GET[p_CAItem_Id] != "")
	{
		$_POST[p_O_Option] = 'select';
		$linha = $caItem->GetIdInfo(_Decrypt($_GET[p_CAItem_Id]));
		
	}
	
	

	$view->Header($user,$nav);

	$form = new Form();

		$form->Fieldset("Cadastro de Itens");
		
			$form->Input('',		'hidden',			array("id"=>'p_Controle',"value"=>1));
		
			$form->Input('',		'hidden',			array("name"=>'p_CAItem_Id',"value"=>$linha[ID]));
			
			
			
			$form->Input("C.A.",'select',	array("name"=>'p_CA_Id', "class"=>"size70", "required"=>'1',"option"=>$ca->Calculate('','','id desc'),"value"=>$linha[CA_ID]));
			
			$form->Input('Item','text',	array("name"=>'p_Item', "class"=>"size10", "required"=>'1', "maxlenght"=>10, "value"=>$linha[ITEM]));
			
			$form->Input('Descrição','text',	array("name"=>'p_Descricao', "class"=>"size50", "required"=>'1', "maxlenght"=>50, "value"=>$linha[DESCRICAO]));
			
			$form->Input('Valor','text',	array("name"=>'p_Valor', "class"=>"size30 onlyNumber", "required"=>'1', "maxlenght"=>15, "value"=>$linha[VALOR]));
			
			
		$form->CloseFieldset ();
		
		$form->Fieldset("Rateio de Centro de Custo");
			
		
			$dbData->Get("SELECT ccusto_id, percentual, id FROM caitemcc WHERE caitem_id = '".$linha[ID]."'");
			
			while($row = $dbData->Row())
			{
				
				$form->LabelMultipleInput("Centro de Custo");
				
				$form->MultipleInput("","select",array("name"=>'p_CC_Id_Alt[]',  "class"=>"size50", "option"=>$ccusto->Calculate("Geral"),"value"=>$row[CCUSTO_ID]));
				$form->MultipleInput("%","text",array("name"=>'p_Perc_Alt[]', "class"=>"size10 onlyNumber pPerc","value"=>$row[PERCENTUAL]));
				$form->MultipleSpan("<i class='fa fa-times delCCItem' idr='"._UrlEncrypt($row[ID])."' style='color:red;cursor:pointer'></i>");
				$form->MultipleInput("","hidden",array("name"=>'p_CAItemCC_Id[]', "value"=>$row[ID]));
				
				echo $form->CloseLi();
				
				
				$pTotPerc += str_replace(",",".",$row[PERCENTUAL]);
			}
		
		
		
			for($x=1;$x<=40;$x++)
			{
		
				if($x==1) $display='block'; else $display='none';
				echo $view->Div(array("id"=>"divRateio_".$x,"style"=>"display:".$display));
					 $form->LabelMultipleInput("Centro de Custo");
					 $form->MultipleInput("","select",array("name"=>'p_CC_Id[]',  "class"=>"size50", "option"=>$ccusto->Calculate("Geral")));
					 $form->MultipleInput("%","text",array("name"=>'p_Perc[]', "class"=>"size10 onlyNumber pPerc","value"=>'0'));
					 echo $form->CloseLi();
				echo $view->CloseDiv();
			}
			
			
			$form->LabelMultipleInput("");
			$form->MultipleSpan($view->Button("button", array("class"=>"addCC","value"=>"Adicionar +")));
			
			$form->LabelMultipleInput("Total Rateado %");
			$form->MultipleSpan("<span id='totalRateio'>"._FormatValor($pTotPerc)."</span>");
			
		
		
		
		$form->CloseFieldset ();
		
		
		$form->Fieldset();
			echo $view->Div(array("id"=>"divBtn","style" => "display:none")); 
				$form->IUDButtons(FALSE);
			echo $view->CloseDiv();
			
			echo $view->Div(array("id"=>"divAviso","style" => "display:block;text-align:center;width:100%;color:red"))."O total do rateio deve ser 100%.".$view->CloseDiv();

			
			if($pTotPerc == 100)
			{
				
				echo $view->JS("$('#divAviso').hide(1); $('#divBtn').show(1)");
				
			}
			
			
			
		$form->CloseFieldset ();	
		
	unset ($form);
	
	
	
	
	unset($view);	
	unset($nav);		
	unset($dbData);	
	unset($dbOracle);	
	unset($app);	
	unset($user);

?>