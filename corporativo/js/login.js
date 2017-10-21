// Verifica usuário/senha

$(document).ready (
	function ()
	{
		$("#btnLogin").click (function(){
			
				var str = $("input[name=p_user]").val();
				var str = str.replace('.','_');
			
				$.ajax ({
			  		type: 'POST',
					url: "../ajax/login.ajax.php",
			  		data: "p_user=" + str + "&p_pass=" + $("input[name=p_pass]").val() + "&p_url="+$("input[name=p_url]").val() + "&p_ipaddr="+$("input[name=p_ipaddr]").val(),
			  		dataType: "json",
			  		success:
			  		function (jsonRet)
			  		{
						if (jsonRet.login == "1")
						{
							$.colorbox ({html: jsonRet.html, overlayClose: false, close: ""});
						}
						else
						{
							$.colorbox ({html: jsonRet.html, overlayClose: false, close: "Fechar"});
						}
					}
			});
		});
		
		// Endereço IP na rede local, se disponível
		$("#inputIpaddr").ready (
			function()
			{
				$.ajax ({
					url: "http://10.1.1.140/__system/localipaddr.php",
					dataType: "jsonp",
					success: function (ret)
					{
						 $.each(ret.success, function(i,item){
                			$("#inputIpaddr").val(item.ipaddr);
            			});
					}
				})
			}
		)
		
		
		
		/**
		 * 
		 * Botao de ENTRAR - Depois que seleciona o Depto
		 * 
		 */
		
		$(".btnSelDept").live("click",function(){
				var elements = $("#flogin").serialize();
			
				$.ajax ({
			  		type: 'POST',
					url: "../ajax/login_session.ajax.php",
			  		data: elements,
			  		success:function(url){
			  			location.href = url;
			  		}
				});
		});
	});

/*
$(document).ready (
	function ()
	{
		$('input[name=p_pass]').keyup(function(e){
		if(e.keyCode == 13)
		{
  			$("#btnLogin").click ();
		}
		});
	}
);
*/