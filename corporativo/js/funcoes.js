var iSelName = '';
var fontSize = 0;

$(document).ready(function(){

	/**
	 * 
	 * Qualquer página que precise abrir no Colorbox
	 * Elemento deve ter a classe openColorBox
	 * 
	 */
	
	$(".openColorBox").colorbox({
		iframe:true, 
		width:"80%", 
		height:"80%"			
	});
	
	
	
	if($.cookie("pageFontSize") != null)
	{
		fontSize = $.cookie("pageFontSize");
		$("body").css("font-size",fontSize+"%");
	}
	else
	{
		fontSize = 73;
		$("body").css("font-size",fontSize+"%");
	}
	
	
	
	
	$('.tbDetail').easyTooltip();
	
	$('.multiSelect').multiSelect();
	
	
	$(" #nav ul ").css({display: "none"});
	
	$(" #nav li").hover(
		function(){
			$(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown(200);
		},
		function(){
			$(this).find('ul:first').css({visibility: "hidden"}).slideUp(200);
		});
	

	$(".dataGrid tr").hover(function(){
		
			$(this).find("td").addClass("tdHover");
		
	},function(){
		
		$(this).find("td").removeClass("tdHover");
	
		
	})
	
	
/**
	mascarar campos
	data -> 	classe data
	telefone -> classe telefone ????
	cpf -> 		classe cpf
	cnpj -> 	class cnpj
	cep -> 		classe cep
**/
	$(".data").mask("99/99/9999");
	$(".cpf").mask("999.999.999-99");
	$(".cnpj").mask("999.999/9999-99");
	$(".cep").mask("99999-999");
	$(".hash").mask("****-****-****-****-****-****-****-****");
	$(".fone").mask("(99) 9999-9999");
	$(".competencia").mask("99/9999");
	


/**
	Select para trocar o tema da ViewPage
**/
	$("select[name=corTema]").change(function(){
		
		var tema = $(this).val();
		
		$.ajax ({
	  		type: 'POST',
			url: "../ajax/system.ajax.php",
	  		data: "p_action=changeTheme&theme=" + tema,
	  		dataType: "json",
	  		success:
	  		function (jsonRet)
	  		{
	  			$("#corEstilo").attr('href',"../css/"+tema);	
			}
		});
		
		
	});
	

	

/**
	criação do ISEL.
	o elemento do tipo Link precisa ter a classe "isel"
	o href será a página onde será selecionado
	precisa ter um atributo "name"
	ex: <a href='wpessoa_iselfunc.php' name='wpessoa_id' class='isel'> ... 
	
**/	

	$(".isel").bind('click',function(){
	
		iSelName = $(this).attr('name');
		$(this).colorbox({
					iframe:true, 
					width:"80%", 
					height:"80%"			
		});
	});
	
	
	$(document).on('click',".colSelId",function(){
		
		
		var url = document.URL;
		
		url = url.split("/");
				
		$.cookie(url[url.length-1]+"_Id", null, {path: '/'});
		$.cookie(url[url.length-1]+"_Label", null, {path: '/'});
		
		
		$.cookie(url[url.length-1]+"_Id", $(this).attr('idIsel'), { expires: 15 , path: '/' });
		$.cookie(url[url.length-1]+"_Label", $(this).text(), { expires: 15 , path: '/' });
		
				
		parent.$("#"+parent.iSelName+"_Id").val($(this).attr('idIsel'));
		parent.$("#"+parent.iSelName+"_Label").val($(this).text());
		parent.$("a[name="+parent.iSelName+"]").text($(this).text());
		
		
		if(parent.$("#"+parent.iSelName).attr("submit") == "true")
		{
			var $obj = parent.$("#"+parent.iSelName+"_Id").closest("form").find(".search");
			$obj.trigger("click");
		}
		else
		{
			parent.$.colorbox.close();
		}
		
		
	
	});
	
	
	/**
	 * 
	 * COOKIE DO ISEL
	 * 
	 * 
	 */
	
	$(".iselCookie").bind('click',function(){

		parent.$("#"+parent.iSelName+"_Id").val($(this).attr('idsel'));
		parent.$("#"+parent.iSelName+"_Label").val($(this).text());
		parent.$("a[name="+parent.iSelName+"]").text($(this).text());
		
		
		if(parent.$("#"+parent.iSelName).attr("submit") == "true")
		{
			
			var $obj = parent.$("#"+parent.iSelName+"_Id").closest("form").find(".search");
			$obj.trigger("click");
		}
		else
		{
			parent.$.colorbox.close();
		}
		
		
	
	});
	

/**

	Botões com class :
	- insert
	- update
	- delete
	- cancel
	- search


**/
	$(".insert, .update, .delete, .search").bind("click",function(){
	
		var $form = $(this).closest("form");
		
		$("#"+$form.attr('id')+" input[name=p_O_Option]").val($(this).attr("class"));
	
	});
	
	
	
	$(".cancel").bind("click",function(){
		
		
		location.href=location.protocol + '//' + location.host + location.pathname;
	
	});
	
	
	
	$(".search").bind("click",function(){
		
		
		var $form = $(this).closest("form");
		
		$("#"+$form.attr('id')+" input[name=p_O_Option]").val("search");
		$form.attr("method","GET");
		$form.submit();
	
	});
	
	
	
/**
 * 
 * Validação de campos obrigatórios
 * (caso não esteja usando FF ou Chrome)
 * 
 */	
	
	$(".btnSubmit, input[type=submit]").bind("click",function(){
		if(navigator.appName=='Microsoft Internet Explorer')
		{
			var ok = true;
			var $form = $(this).closest("form");
			
			$("#"+$form.attr('id')+" input, #"+$form.attr('id')+" select, #"+$form.attr('id')+" textarea").each(function(){
				//alert($(this).attr('required'));
				if($(this).attr('required') != undefined && $(this).val() == ''){
					
					$(this).addClass('required');
					ok = false;
					
				}else{
					$(this).removeClass('required');
				}
				
				
			});
			
			//alert(ok);
			if(!ok) return false;
			else $("#"+$form.attr('id')).submit();
		}
	
	});
	
	
	/**
	 * Botão de Ajuda da página
	 * Abre um Colorbox
	 */
	
	$(".btnHelp").colorbox({inline:true,width:"50%"});


	/**
	 * Padrão para mensagens de erro
	 */
	
	$(".errorMsg").colorbox({inline:true,width:"50%"});
	
	
	/**
	 *  Combo de Deptos do Usuário 
	 *  Faz a troca na session do depart
	 */
	
	$("select[name=p_Header_Dept]").change(function(){
		
		$.ajax ({
	  		type: 'POST',
			url: "../ajax/login_session.ajax.php",
	  		data: "p_DeptChosen="+$(this).val(),
	  		success: function(){
	  			
	  			location.href = document.URL;
	  			
	  		}
		});
		
	});
	
	
	/**
	 * Radio Button de Unidades
	 * Troca Na SESSION a Unidade
	 */
	
	$("input[name=p_Header_Unit]").click(function(){

		$.ajax ({
	  		type: 'POST',
			url: "../ajax/login_session.ajax.php",
	  		data: "p_UnitChosen="+$(this).val(),
	  		success: function(){
	  			
	  			location.href = document.URL;
	  			
	  		}
		});
		
	})
	
	
	
	/**
	 * 
	 * Botao de Sair do Sistema
	 * Redireciona para Login
	 * 
	 */
	
	$("#btnLogout").bind("click",function(){
		
		$.ajax ({
	  		type: 'POST',
			url: "../ajax/login_session.ajax.php",
	  		data: "action=logout",
	  		success: function(){
	  			
	  			location.href = "../sys/login.php";
	  			
	  		}
		});
		
	});
	
	
	
	/**
	 * 
	 * Icone de Exclusão de Linha
	 * Precisa ter 2 parametros
	 * table -> nome da tabela
	 * idDel -> Id da linha que será excluída
	 *  
	 */
	
	$(".imgDelItem").bind("click",function(){
		
		if(!confirm("Confirma a exclusão do item?")) return false;
		
		$obj = $(this);
				
		
		$.ajax ({
	  		type: 'POST',
			url: "../ajax/system.ajax.php",
	  		data: "action=deleteItem&table="+$(this).attr('table')+"&idDel="+$(this).attr('idDel'),
	  		beforeSend:_ShowLoading,
	  		success: function(msg){
	  			
	  			_HideLoading();
	  			
	  			if(msg == "1")
	  			{
	  				$obj.closest("tr").hide(1);	
	  			}
	  			else
	  			{
	  				$.colorbox({ html: msg,	width:"80%", height:"80%" });			
	  			}
	  			
	  		}
		});
		
		
	});
	
	
	
	/**
	 * 
	 * Icone de Select de Linha
	 * Precisa ter 2 parametros
	 * table -> nome da tabela
	 * idDel -> Id da linha que será excluída
	 *  
	 */
	
	$(".imgSelectItem").bind("click",function(){
		
		
		
		var $form = $("input[name="+$(this).attr('table')+"_Id], input[name=p_"+$(this).attr('table')+"_Id] ").closest("form"); 
		
		$("input[name="+$(this).attr('table')+"_Id], input[name=p_"+$(this).attr('table')+"_Id] ").val($(this).attr('idEdit'));
		
		$form.find("input[name=p_O_Option]").val("select");
		
		$form.submit();
		
		
	});
	
	
	
	$(".menuPage span").click(function(){
	
		$(".menuPage ul").slideToggle(400);
	});
	
	$(document).on("mouseleave",".menuPage ul",function(){
		$(this).slideUp(400);
		
	});
	

	
	
	/**
	 * 
	 * Ajuste no tamanho da Fonte do sistema
	 * 
	 */
	
	$("#fontUp").bind("click",function(){
		
		if(fontSize >= 85) return false;
		
		fontSize++;
		
		$.cookie("pageFontSize", null, {path: '/'});
		$.cookie("pageFontSize", fontSize, { expires: 95 , path: '/' });
		
		$("body").css("font-size",fontSize+"%");
		
	});
	
	$("#fontDown").bind("click",function(){
		
		if(fontSize <= 60) return false;
		
		fontSize--;
		
		$.cookie("pageFontSize", null, {path: '/'});
		$.cookie("pageFontSize", fontSize, { expires: 95 , path: '/' });
				
		$("body").css("font-size",fontSize+"%");
		
	});
	
	
	$("#fontNormal").bind("click",function(){
		
		if(fontSize == 73) return false;
		
		fontSize = 73;
		
		$.cookie("pageFontSize", null, {path: '/'});
		$.cookie("pageFontSize", fontSize, { expires: 95 , path: '/' });
				
		$("body").css("font-size",fontSize+"%");
		
	});
	
	
	$("#btnMenu").colorbox({
				href:"../sys/menu.php",
				iframe:true, 
				width:"95%", 
				height:"100%"			
	});

	

	/**
	 * 
	 * ON e OFF
	 * 
	 */
	
	$(document).on("click",".imgOnOff",function(){
		
		var nome = $(this).attr("name");
		
		$("i[name='"+nome+"']").removeClass('imgOnOffSelected');
		
		$("input[name="+$(this).attr("name")+"]").val($(this).attr("valReal"));
		
		$(this).addClass("imgOnOffSelected");
	
	})

	
	
	/**
	 * 
	 * autocompletar
	 */
	
	$(document).on("keyup",".autocomplete",function(){
		
		$(".autoComplete, #autocomplete").remove();
		$obj = $(this);
		
		if($obj.val() == '' || $obj.val().length < 3) 
		{	
			var aux = $obj.attr("id").split("___");
			
			$("#"+aux[0]).val("");
			
			return false;
		}	
		
		
		var position = $obj.position();
		
		
		
		delay(function(){
			
			
			
			$.ajax ({
		  		type: 'POST',
				url: "../ajax/system.ajax.php",
		  		data: "p_action=autoComplete&val=" + $obj.val()+"&idInput="+$obj.attr('id')+"&execute="+$obj.attr('execute')+"&db="+$obj.attr('db'),
		  		beforeSend: function(){ $obj.addClass('autCompleteLoading');$obj.attr("disabled",true)},
		  		success:
		  		function (data)
		  		{
		  			
		  			$obj.attr("disabled",false);
		  			
		  			data = $.trim(data);
		  			
		  			$obj.removeClass('autCompleteLoading');
		  			
		  			if(data == '0')
					{
						
		  				$('section').append("<div id='autocomplete' style='top:"+(position.top+25)+"px;left:"+(position.left)+"px;width:"+$obj.width()+"px'><br>Sua busca retornou muitos resultados. Seja mais específico.</div>");

					}
		  			else if(data == '1')
		  			{
		  				
		  				$('section').append("<div id='autocomplete' style='top:"+(position.top+25)+"px;left:"+(position.left)+"px;width:"+$obj.width()+"px'><br>Nenhum resultado encontrado.</div>");
		  				
		  			}
		  			else	
		  			{
		  			
		  				
		  				$('section').append("<div id='autocomplete' style='top:"+(position.top+25)+"px;left:"+(position.left)+"px;width:"+$obj.width()+"px'>"+data+"</div>");
		  				
		  			}
		  			
		  			$("#autocomplete").append("<div class='btnCloseAutoComplete'>Fechar</div>");
		  			
		  				
				}
			});

			
			
		    }, 1600 );
		
	
	});
	
	
	$(document).on("click",".autoComplete li",function(){
		$("#"+$(this).parent("ul").attr('idInput')).val($(this).attr('nomeExibicao'));
		$("#"+$(this).parent("ul").attr('idInput').replace("___AutoComplete","")).val($(this).attr('idr'));
		
		$(".autoComplete, #autocomplete").remove();
		
	});
	
	
	$(document).on("click",".btnCloseAutoComplete",function(){
		$(".autoComplete, #autocomplete").remove();
		
	});
	
	
	
	var delay = (function(){
		  var timer = 0;
		  return function(callback, ms){
		    clearTimeout (timer);
		    timer = setTimeout(callback, ms);
		  };
		})();
	
	
	/**
	 * 
	 * 
	 * DATEPICKER
	 * TIMEPICKER
	 * DATE AND TIME PICKER
	 * 
	 */
	
	
	$(".timePicker").timepicker();
	$(".datePicker").datepicker();
	$(".datetimePicker").datetimepicker();
	
	
	/**
	 * Abas 
	 */
	
	$(".tabContent[idr=1]").show(1);
	
	$(".tabs li").bind("click",function(){
		
		$(".tabs li").removeClass("tabsHover");
		
		$(this).addClass("tabsHover");
		
		$(".tabContent").css("display","none").hide(1);
		
		$(".tabContent[idr="+$(this).attr("idr")+"]").css("display","block").show(1);
		
	});
	
	
	

	
	
	
	$(".btAutentica").bind("click",function(){
		
		$(this).colorbox({
			href:"atestado.php?p_Hash="+document.f1.p_Hash.value,
			iframe:true, 
			width:"65%", 
			height:"65%"			
		});
	});

	$(".btGeraAtestado").bind("click",function(){
		
		$(this).colorbox({
			href:"../pub/autdoc_iatestado.php?p_Matric_Id="+document.f1.Curso_Id.value,
			iframe:true, 
			width:"65%", 
			height:"65%"			
		});
	});
	
	
	/**
	 * 
	 *  FUNCÇÃO PARA ACEITAR SOMENTE NUMEROS
	 * 
	*/
	$(".onlyNumber").keydown(function(event) {
		// Allow only backspace and delete

		if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 13 || event.keyCode == 9 || event.keyCode == 110 || event.keyCode == 39 || event.keyCode == 37 || event.keyCode == 40 || event.keyCode == 38 || event.keyCode == 108 || event.keyCode == 190) {
			// let it happen, don't do anything
		}
		else {
			// Ensure that it is a number and stop the keypress
			if ( ( event.keyCode < 48 || event.keyCode > 57 )  && ( event.keyCode < 96 || event.keyCode > 105 ) ) {
				event.preventDefault();	
			}	
		}
	});
	
	
	
	/**
	 * 
	 *  ATIVAR O TECLADO VIRTUAL
	 * 
	*/
	$(".virtualKeyboard").keyboard({
		  layout   : 'qwerty',
		  lockInput: true // prevent manual keyboard entry
		 })	
	
	/**
	 * 
	 * Glower
	 * 
	 */
	
	var glower = $('.glower');
	if(glower != undefined || glower != "")
	{
		window.setInterval(function() {  
			glower.toggleClass('active');
		}, 300);
	}
	
});



jQuery.fn.center = function () {
    this.css("position","fixed");
	
    this.css("top", "250px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +  $(window).scrollLeft()) + "px");
												
    return this;
}


function _ShowLoading()
{
	$("body").append("<div class='hideLoading'></div><div class='loading'></div>");
	
	$(".hideLoading").css({
		
		width:$(document).width()+"px",
		height:$(document).height()+"px",
		display:'block'
	
	});
	
	
	$(".loading").center().html("Aguarde...").show(1);
	
	
}

function _HideLoading()
{
	window.setTimeout(function(){
		

		$(".loading").hide(1);
		$(".hideLoading").hide(1);
	},300)
	
}


function setCookie(nome,valor,expira)
{

	if (valor != '')
	{
		if(expira == "" || expira == undefined)
			expira = 15000;
		
		$.cookie(nome, valor, { expires: expira , path: '/' } );
	}
	
}

/**
 * 
 * FUNÇÃO PARA BLOQUEAR O F5 
 *
 */
function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };



function _CheckRequired(formId)
{
	var ok = true;
	
	$("#"+formId+" input").each(function(){
		
		if($(this).attr("required") != undefined && $.trim($(this).val()) == "")
			ok = false;
			
	});
	
	
	$("#"+formId+" select").each(function(){
		
		if($(this).attr("required") != undefined && $.trim($(this).val()) == "")
			ok = false;
			
	});
	
	
	$("#"+formId+" textarea").each(function(){
		
		if($(this).attr("required") != undefined && $.trim($(this).val()) == "")
			ok = false;
			
	});
	
	
	if(ok)
	{
		
		return true;
	}
	else
	{
		
		$.Zebra_Dialog( 'Os campos em vermelho devem ser preenchidos.',
		{
			'type': 'error',
			'title': 'Campos Obrigatórios'
		});
		
		return false;
	}
		

	
}

function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}