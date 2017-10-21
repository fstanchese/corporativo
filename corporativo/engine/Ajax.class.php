<?php 

	class Ajax
	{
		public function InputRequired($inputSrc,$inputDst,$evt,$query,$dependence="",$val="")
		{
			echo "\n
					<script>
						$(document).ready(function(){

								var selecionadoLabel = '';
								var selecionadoVal = '';
										
								$('#".$inputSrc."').on('".$evt."',function (){
									var arKey = new Array();
									var arValue = new Array();		
										
										
									if(selecionadoLabel == '')
									{
										selecionadoLabel = $('#".$inputDst." option:selected').text();
										selecionadoVal = $('#".$inputDst."').val();
									}
											
									if($(this).val() == '')
									{
												
										jQuery('#".$inputDst."').children('option').detach();
										$('#".$inputDst."').append(\"<option value='\"+selecionadoVal+\"'> \" + selecionadoLabel +\" </option>\");
										return false;		
									}
									
								";

								if($dependence != "")
								{
									
									foreach($dependence as $key => $valor)
									{
										
										echo "
												arKey.push('$key');
												arValue.push($('#".$valor."').val());
										
										";
										
									}
								}
			
								echo "	
									
								if ($(this).val() == '')
								{
									$('#".$inputDst."').val('');
								}
								else
								{
								
									$.ajax ({
										type: 'POST',
										url: '../ajax/system.ajax.php',
										data: 'p_action=InputReq&p_Query=".$query."&arKey='+arKey+'&arVal='+arValue,
										dataType: 'json',
										beforeSend: function(){ jQuery('#".$inputDst."').children('option').detach(); $('#".$inputDst."').append(\"<option value=''> Carregando... </option>\"); },
									   success: function(data){
												
												jQuery('#".$inputDst."').children('option').detach();
												$('#".$inputDst."').append(\"<option value=''> -- </option>\");
												for (var i=0; i<data.length; i++) {
														
												  	$('#".$inputDst."').append('<option value=\"' + data[i].id + '\" >' + data[i].recognize+ '</option>');
												}
												
												jQuery('#".$inputDst."').val('".$val."').trigger('change');
									   }
									});
								}
				 
							});
						";		
									echo "
											
											if(jQuery('#".$inputSrc."').val() != '')
											{	
												var valSel = $('#".$inputSrc."').val();		
												$('#".$inputSrc."').val(valSel).trigger('change');		
											}
											
											";

														
														
						echo "});";
								
					echo "</script>";
		}		
		
		public function GridRequired($query,$arCols,$dependence="",$idLabel="")
		{
			echo "\n
					<script>
						$(document).ready(function(){
		
								$('#searchISel').on('click',function (){
									var arKey = new Array();
									var arValue = new Array();
					
								";
		
			if($dependence != "")
			{
					
				foreach($dependence as $key => $valor)
				{							
					echo "
						arKey.push('$key');
						arValue.push($('#".$valor."').val());
		
						";
					
					}
									
				}
					
				echo "
						$.ajax ({
							type: 'POST',
							url: '../ajax/system.ajax.php',
							data: 'p_action=gridAjax&p_Query=".$query."&arKey='+arKey+'&arVal='+arValue+'&arCols=".implode("|||",array_keys($arCols))."+&arLabel=".implode("|||",$arCols)."+&idLabel=".$idLabel."',

						   success: function(data){
									
									if(data == '0')
									{
										var html = \"<div style='width:100%;height:auto;'><div class='titleMsg'>Atenção</div></div><div class='msgBoxImage'><img src='../images/information.png'></div><div class='msgBoxContent'><p>Foram localizados muitos itens na busca. Por favor, seja mais específico</p></div></div>\";
										$.colorbox ({html: html, overlayClose: false, close: 'OK'});
			
									}
									else
									{
									
										jQuery('.dataGrid').remove();
										jQuery('section').append(data);
									}
									
			

						   }
						});
		
				});
									
		})";
		
					echo "</script>";
			}
	}

?>