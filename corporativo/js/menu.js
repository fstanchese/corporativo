	(function ($) {
		$.fn.liveDraggable = function (opts) {
			this.live("mouseover", function() {
				if (!$(this).data("init")) {
					$(this).data("init", true).draggable(opts);
				}
			});	
		return this;
		};
	}(jQuery));

	 
    $(document).ready(function(){
		var vId 
		var $vObj = '';

		$(".block").liveDraggable( { 
				cancel: "a.ui-icon", 
				revert: "invalid", 
				containment: "document",
				helper: "clone",
				cursor: "move",
				drag: function () { $vObj = $(this);  } 
	        });

			var dropOpt = {
					
				accept: ".block",
				activeClass: 'droppable-active',
				hoverClass: 'droppable-hover',
				revert:true,
				greedy: true,
				tolerance: 'pointer',
				drop: function(ev, ui) {
					$vObj.hide();
										
					$vObj2 = $(this);

					$(".mensagem").load("../ajax/menu.ajax.php?vTipo=DropMenu&vId="+$(this).attr("id")+"&vIdOrigem="+$vObj.attr("id"),function(){
					
						$vObj2.find(".lista").append("<div class=\"itemMenu\" id=\""+$vObj.attr("id")+"\"><img id=dir_"+$vObj.attr("id")+" idr="+$vObj.attr("id")+" width=13px class=\"subdir\" proc=\""+$vObj.attr("proc")+"\" gui=\""+$vObj.attr("gui")+"\"  src=\"/images/"+$vObj.attr("img")+"\">&nbsp;<img class=\"removeMenu\" id=\""+$vObj.attr("id")+"\" style=\"cursor:pointer\" img=\""+$vObj.attr("img")+"\" src=\"/images/errado.png\" proc=\""+$vObj.attr("proc")+"\" gui=\""+$vObj.attr("gui")+"\" title=\"Excluir Item\">&nbsp;"+$vObj.attr("gui")+"</div>");
						
					});
			
				}
			};
			
		$(".drop").droppable(	dropOpt );
			
		
		$(".delItemGallery").live ("click",  
			function () { vId = $(this).attr("id"); $vObj = $(this);
			
				if ( confirm("Confirma exclusão do item do Menu?"))
				{
					$(".mensagem").load("../ajax/menu.ajax.php?vTipo=cancRepos&vId="+vId);
					$(".mensagem").css({"width" : "60%","background" : "#cccccc"});
					$(".mensagem").fadeOut(3000);
					$vObj.closest('li').fadeOut(2000) ; 
				}

		});

		
		$(".removeMenu").live ("click",		
			function () {  $vObj = $(this); 
			
				if ( confirm("Atenção, caso a exclusão seja de um sub-Menu todas os links dentro dele serão excluídos também.\n\nConfirma exclusão do item do Menu?"))
				{
					$(".mensagem").load("../ajax/menu.ajax.php?vTipo=removeMenu&vId="+$(this).attr("id") );
					$(".mensagem").css({"width" : "60%","background" : "#cccccc"});
					$(".mensagem").fadeOut(1000);
					$vObj.closest('div').fadeOut(1000) ; 
					vProc = $(this).attr("proc");
					if ( $(this).attr("proc").length > 17)
						vProc = $(this).attr("proc");
					var vAppend = "<li class=\"block\" img=\""+$(this).attr("img")+"\" proc=\""+$(this).attr("proc")+"\" id=\""+$(this).attr("id")+"\" gui=\""+$(this).attr("gui")+"\" title=\""+$(this).attr("gui")+"\">";
					vAppend += "<h5>"+vProc+"</h5>";
					vAppend += "<img border=0 src=\"/images/"+$(this).attr("img")+"\" class=\"tipo\" />";
					vAppend += "<span class='nameGui'>"+$(this).attr("gui")+"</span>";
					vAppend += "<img class='delItemGallery' src='../images/cross.png' id='"+$(this).attr("id")+"'></div></li>";
					
					$("#gallery").append(vAppend); 
				}
		});
		
		
		
		$(".drop h4").live("click",function(){
			
			$(this).next("div").slideToggle();
		});
		
		$(".drop h5").live("click",function(){
			
			$(this).parent("div").hide();
			
			$("#dir_"+$(this).parent("div").attr("id")).addClass("subdir");
			
		});
		

		$(".subdir").live("click",
		
			function(){

					$obj  = $(this);
					
			
					$.post("../ajax/menu.ajax.php?vTipo=ListMenu&vId="+$obj.attr("idr"),function(retorno){
					
						var vAppend  = "<div class='drop ui-droppable' style='width:100%;height:auto;z-index:1000;' id='"+$obj.attr("idr")+"'>";
						vAppend += "<h5><img src=../images/folder.png>&nbsp;"+$obj.attr("gui")+"</h5><div class=\"lista\">"+retorno+"</div></div>";
						$obj.closest("div").append( vAppend );
						$(".drop").droppable(dropOpt);
						$obj.removeClass("subdir");
			
			
					});
				});
		
		
    });
     
	function fInclusao()
	{
	  document.f1.p_O_Option.value="insert";
	  document.f1.submit();
	}
	
	
	$(".removeMenuRaiz").live ("click",		
			function () {  $vObj = $(this); 
			
				if ( confirm("Atenção, todas os links dentro desse serão excluídos também.\n\nConfirma exclusão do item do Menu?"))
				{
					$(".mensagem").load("../ajax/menu.ajax.php?vTipo=removeMenuRaiz&vId="+$(this).attr("id") );
					$(".mensagem").css({"width" : "60%","background" : "#cccccc"});
					$(".mensagem").fadeOut(1000);
					$vObj.closest('div').fadeOut(1000) ; 
				}
		});
