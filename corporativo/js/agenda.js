
$(document).ready(function(){

	$(".OpenAgenda").click(function(){
		var vData = $(this).attr("id");
		
		$.ajax ({
	  		type: 'POST',
	  		success:function(url){
	  			$.colorbox ({href: "../ajax/agenda.ajax.php?dt="+ vData, overlayClose: true, close: "Fechar"});
	  			
	  			//location.href = url;
	  		}
		});
		
	});
	
});


