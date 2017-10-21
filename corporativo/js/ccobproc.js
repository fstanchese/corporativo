
//impress�o de carta
$(document).on('click','.btnPrintCarta',function(e)
{
	e.preventDefault();
	
	var url = $(this).attr("link");
	
	var md = $.Zebra_Dialog( 'Deseja imprimir as cartas? Ao clicar em SIM, a data de emiss�o ser� atualizada para a data atual.', 
			{
	    	'type': 'question',
	    	'title': 'Confirmar Impress�o',
			'keyboard' : false,
			'overlay_close' : false,
			'show_close_button' : false,			
	    	'buttons': 
			[
	            { caption:'Sim', callback:function() { window.open(url); md.close; }	},
	            { caption: 'N�o', callback: function() { md.close; } }
	    	] 
	});
	
				
			
});



$(document).on('click','#btnGerarProcesso',function(e)
		{
	
	
	var $obj = $(this);
	e.preventDefault();
	
	var md = $.Zebra_Dialog( 'Confirmar a gera��o do processo?', 
			{
	    	'type': 'question',
	    	'title': 'Confirmar Gera��o do Processo',
			'keyboard' : false,
			'overlay_close' : false,
			'show_close_button' : false,			
	    	'buttons': 
			[
	            { caption:'Sim', callback:function() { 
	            	
	            	md.close;
	            	
	            	window.setTimeout(function(){
	            	
	            	$.ajax ({
	    				type: 'POST',
	    				url: '../ajax/ccob.ajax.php',
	     				data: 'p_Action=setProcessoOracle&p_Proc='+$obj.attr('critSession'),
	    				beforeSend:function()
	    					{
	    		
	    						$.Zebra_Dialog( 'Gerando Cartas de Cobran�a',
	    						{
	    							'type': 'information',
	    							'title': 'Aguarde...',
	    							'keyboard' : false,
	    							'overlay_close' : false,
	    							'show_close_button' : false,
	    							'buttons':false
	    						})
	    		
	    				},
	    				success:function(data)
	    				{


	    					$('.ZebraDialogOverlay').hide(1);
	    					$('.ZebraDialog').hide(1);
	    					
	    					if(data == 'Ocorreu um erro. Tente novamente.')
	    					{
	    						$.Zebra_Dialog(  data,
	    						{
	    							'type': 'error',
	    							'title': 'Erro na Gera��o',
	    							'keyboard' : false,
	    							'overlay_close' : false,
	    							'show_close_button' : false,
	    															
	    						});
	    					}
	    					else
	    					{
	    		
	    						$.Zebra_Dialog(  data,
	    						{
	    							'type': 'confirmation',
	    							'title': 'A��o Efetuada com Sucesso',
	    							'keyboard' : false,
	    							'overlay_close' : false,
	    							'show_close_button' : false,
	    							'buttons': 	[{ caption:'Ok', callback:function(){location.href='ccobproc_igeracao.php'}}] 
	    								
	    						});
	    					}
	    					
	    				}

	    			});
	            	
	            	},500);
	            
	            
	            
	            },
	            },
	            { caption: 'N�o', callback: function() { md.close; } }
	    	] 
	});
	
	
	

			
		
		
		});

