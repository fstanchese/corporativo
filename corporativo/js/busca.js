$(document).ready(function(){
	
	$(".addToMenu").css("cursor","pointer");
	
	$(".addToMenu").bind("click",function(){
		
		var indexgui = $(this).attr("idr");
		var $obj = $(this);
		
		$.ajax ({
			type: 'POST',
			url: "../ajax/busca.ajax.php",
			data: "indexgui=" + indexgui,
			success:
					function (ret)
					{
						$obj.closest("td").html("Adicionado");
					}
		});
		
	
	});
	
	$(document).on("change","#p_hist",function(){
		
		
		location.href=$(this).val();
		
	})
	
	
})