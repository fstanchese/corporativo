<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("Criaчуo / Impressуo de Etiquetas Pimaco","Criaчуo / Impressуo de Etiquetas Pimaco",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/Navigation.class.php");
	
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");
		
	include("../model/CASenha.class.php");
	include("../model/CAEvento.class.php");
	
	
	
	
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);
	$nav 		= new Navigation($user, $app,$dbData);
	$view 		= new ViewPage($app->title,$app->description);
	
	

	
	
	$view->Header($user);
	

		if($_POST[p_Modelo] == "")
		{
			//Instanciar formulсrio
			$form = new Form();
		
				$form->Fieldset("Modelo da Etiqueta");
		
					$form->Input("Modelo","text",array("name"=>"p_Modelo","required"=>1));
					
					$form->Button("submit",array("class"=>"update","value"=>"Prosseguir"));
					
				$form->CloseFieldset ();
		
			//fecha formulсrio
			unset ($form);
		}
		else
		{
			
			echo $view->JS("
					
					
					
					$('.nicEdit-main').live('keyup',function()
					{

						$('#preview').html($(this).html());
					
					});					
					
				");
			
			
			include("../engine/EtqPimaco.class.php");
				
			$etq 		= new EtqPimaco($_POST[p_Modelo]);
			$medidas 	= $etq->GetMedidas();	

			$form = new Form(array("action"=>"../rep/etiqueta_impressao.php"));
			if (!empty($medidas[linhaspagina]))
			{
				//Instanciar formulсrio
					
				$form->Fieldset("Personalizar Etiqueta");
					
				$form->Input("","hidden",array("name"=>"p_Modelo","value"=>$_POST[p_Modelo]));
				
				$form->Input("Tipo","label",array("value"=>$_POST[p_Modelo]." - ".($medidas[linhaspagina]*$medidas[celulaslinha])." etiquetas por pсgina"));

				$form->Input("Quantidade de Etiquetas","text",array("name"=>"p_QtdeEtq","id"=>"p_QtdEtiq","required"=>1));
				
				
				$form->Input("Orientaчуo da Pсgina","select",array("name"=>"p_Orientacao","id"=>"p_Orientacao","option"=>array("P"=>"Retrato","L"=>"Paisagem")));
				
				
				$form->Input("Texto","editor",array("name"=>"p_Texto","id"=>"p_Texto","style"=>"width:100%;height:250px"));
				
								
				$form->CloseFieldset ();
			}
			else
			{
				$view->Dialog('E', 'Criaчуo de Etiquetas', 'Atenчуo, tipo de etiqueta nуo localizado.');
			}
			
			

			$form->Fieldset();
			$form->Button("submit",array("name"=>"btGerar","value"=>"Gerar"));
			$form->Button("reset",array("name"=>"btCancel","value"=>"Cancelar","class"=>"cancel"));
			$form->CloseFieldset ();
			
			//fecha formulсrio
			unset ($form);

			
			echo $view->Div()."Preview da Etiqueta".$view->Div(array("style"=>"text-transform:uppercase;border:1px solid #777;padding:6px;width:".$medidas[comprimento]."px;height:".$medidas[altura]."px;font-size:10px","id"=>"preview")).$view->CloseDiv().$view->CloseDiv();
			
			
		}
		
		
		
		
		
	
	unset($wp);
	unset($dbData);
	unset($dbOracle);
	unset($user);

?>