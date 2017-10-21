<?php


class View
{
	
	public 	$arJs =	 array("jquery.js","jquery-ui.js","jquery.mask.js","funcoes.js","colorbox/jquery.colorbox.js","easyTooltip.js","jquery.cookie.js","timepicker.js","jquery.dataTables.js","jquery.multi-select.js","niceEdit/nicEdit.js","zebra.dialog.js","zebra.dialog.src.js","jquery-barcode.js","jquery.keyboard.min.js");
	public 	$arCSS = array("default.css","colorbox/colorbox.css","ui/ui.css","multi-select.css","font-awesome/css/font-awesome.css","zebra_dialog.css","keyboard.css");
	
	
	
	/**
	 *  M�todo respons�vel por colocar os atributos dentro da TAG 	 
	 *	@param unknown $param
	 *	@return string
	 */
	protected function SetAttr($param){
		if(is_array($param))
		{
			foreach($param as $atributo => $valor)
			{
				
				if(is_array($valor))
				{

					foreach($valor as $atributo2 => $valor2)
					{
						if($valor2 != "")
							$html .= $atributo2."=\"".$valor2."\" ";
					}		
					
				}else{
								
					if ($atributo != 'option' && $valor != "")
						$html .= $atributo."=\"".$valor."\" ";
				}
			}
		}
			
		return $html;
	}
	
	
	/**
	 *  M�todo respons�vel por criar a TAG IMG
	 *	@param string $param
	 */
	
	public function Img($param='')
	{
		
		return "<img ". $this->SetAttr($param)." >\n";
	}
	

	/**
	 * 	M�todo respons�vel por abrir a tag html <a>	 
	 *	@param unknown $desc
	 *	@param string $param
	 */
	public function Link($desc,$param='')
	{
		$html = "<a ".$this->SetAttr($param)." > ".$desc."</a>\n";
		return $html;
	}



	/**
	 *  M�todo respons�vel por abrir a tag <span>
	 *	@param string $param
	 */
	public function Span($param='')
	{
		$html = "<span ".$this->SetAttr($param)." >";
		return $html;
	}

	/**
	 *  M�todo respons�vel por fechar a tag <span>
	 */
	public function CloseSpan()
	{
		$html = "</span>\n";
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por abrir a tag <div>
	 *	@param string $param
	 */
	public function Div($param='')
	{
		$html =  "<div ".$this->SetAttr($param)." >";
		
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por inserir a tag </div>
	 */
	public function CloseDiv()
	{
		$html = "</div>\n";
		
		return $html;
	}

	/**
	 * M�todo respons�vel por adicionar a tag <br/> ao c�digo 
	 */ 
	public function Br()
	{
		$html =  "<br style='clear:both'>\n";
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por adicionar uma linha � p�gina, com a tag <hr>
	 */
	public function Hr()
	{
		$html =  "<hr>\n";
		
		return $html;
	}
	
	/**
	 *  M�todo respons�vel por adicionar um t�tulo <h1> ao c�digo
	 */
	public function H1($text,$param="")
	{
		$html =  "<h1 ".$this->SetAttr($param)." >".$text."</h1>";
	
		return $html;
	}
	
	
	/**
	 *  M�todo respons�vel por adicionar um t�tulo <h2> ao c�digo
	 */
	public function H2($text,$param="")
	{
		$html =  "<h2 ".$this->SetAttr($param)." >".$text."</h2>";
	
		return $html;
	}
	
	
	/**
	 *  M�todo respons�vel por adicionar um t�tulo <h3> ao c�digo
	 */
	public function H3($text,$param="")
	{
		$html =  "<h3 ".$this->SetAttr($param)." >".$text."</h3>";
	
		return $html;
	}
	
	
	/**
	 *  M�todo respons�vel por adicionar um t�tulo <h4> ao c�digo
	 */
	public function H4($text,$param="")
	{
		$html =  "<h4 ".$this->SetAttr($param)." >".$text."</h4>";
	
		return $html;
	}
	
	
	/**
	 *  M�todo respons�vel por adicionar um t�tulo <h5> ao c�digo
	 */
	public function H5($text,$param="")
	{
		$html =  "<h5 ".$this->SetAttr($param)." >".$text."</h5>";
	
		return $html;
	}
	

	/** 
	 *  M�todo respons�vel por iniciar um formul�rio com a tag <form>
	 *	@param string $param
	 */
	public function Form($param="")
	{
		$html = "<form ".$this->SetAttr($param). " enctype='multipart/form-data' >\n";
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por inserir a tag </form> � p�gina
	 */
	public function CloseForm()
	{
		$html = "</form>\n";
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por inserir uma 'unordered list' na p�gina a partir da tag <ul>
	 *	@param string $param
	 */
	public function Ul($param ="")
	{
		$html = "<ul ".$this->SetAttr($param)." >\n";
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por inserir uma 'list' na p�gina a partir da tag <li>
	 *	@param string $param
	 */
	public function Li($param="")
	{
		$html =  "<li ". $this->SetAttr($param). " >\n";
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por inserir a tag </ul>
	 */
	public function CloseUl()
	{
		$html = "</ul>\n";
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por inserir a tag </li>
	 */
	public function CloseLi()
	{
		$html =  "</li>\n";
		
		return $html;
	}

	/**
	 *  M�todo respons�vel por iniciar um novo par�grafo na p�gina
	 *	@param string $text
	 *	@param string $param
	 */
	public function P ($text, $param="")
	{
		$html = "<p ".$this->SetAttr ($param). ">".$text."</p>\n";
		
		return $html;
	}
	
	/**
	 *  M�todo respons�vel por iniciar uma tabela
	 *	@param string $param
	 */
	public function Table($param="")
	{
		$html = "<table ". $this->SetAttr ($param) . ">";
	
		return $html;
	}
	
	/**
	 *  M�todo respons�vel por inserir uma legenda na tabela
	 *	@param string $text
	 *	@param string $param
	 */
	public function Caption($txt,$param="")
	{
		
		$html = "<caption ". $this->SetAttr ($param) . ">".$txt."</caption>";
		
		return $html;
		
	}
	
	/**
	 *  M�todo respons�vel por fechar a tabela
	 */
	public function CloseTable()
	{
		$html = "</table>";
		return $html;
	}
	
	
	/**
	 *  M�todo respons�vel por demarcar o cabe�alho de uma coluna na tabela
	 *	@param string $text
	 *	@param string $param
	 */
	public function Th($txt,$param="")
	{
	
		$html = "<th " . $this->SetAttr ($param) . ">".$txt."</th>";
		return $html;
	
	}
	
	/**
	 *  M�todo respons�vel por adicionar uma coluna � tabela, pela tag <tr>
	 *	@param string $param
	 */
	public function Tr($param="")
	{
	
		$html = "<tr " . $this->SetAttr ($param) ." >";
		return $html;
	
	}
	
	/**
	 *  M�todo respons�vel por terminar uma coluna na tabela
	 */
	public function CloseTr()
	{
		$html = "</tr>";
		return $html;
	}
	
	/**
	 *  M�todo respons�vel por adicionar o conte�do da c�lula na tabela, pela tag <td>
	 *	@param string $param
	 */
	public function Td($param="")
	{
	
		$html =  "<td " . $this->SetAttr ($param) . ">";
		return $html;
	
	}
	
	/**
	 *  M�todo respons�vel por inserir a tag </td>
	 */
	public function CloseTd()
	{
		$html = "</td>";
		return $html;
	}
	
	/**
	 *  M�todo respons�vel por adicionar um texto em negrito
	 *  @param string $texto
	 *  @param string $param
	 */
	public function Strong($texto,$param="")
	{
		
		return "<strong ".$this->SetAttr($param).">".$texto."</strong>";
		
	}
	
	/**
	 *  M�todo respons�vel por adicionar um texto em it�lico
	 *  @param string $texto
	 *  @param string $param
	 */
	public function Italic($texto,$param="")
	{
	
		return "<em ".$this->SetAttr($param).">".$texto."</em>";
	
	}
	

	
	

	/**
	 *  M�todo respons�vel por 	
	 *	@param unknown $type
	 *	@param unknown $title
	 *	@param unknown $text
	 */
	public function MsgBox ($type, $title, $text)
	{
		$html = "<div style='width:100%;height:auto;'><div class='titleMsg'>".$title."</div></div><div class='msgBoxImage'><img src='../images/".$type.".png'></div><div class='msgBoxContent'><p>".$text."</p></div></div>";
			
		return "<script>$(document).ready (function () { $.colorbox ({html: \"".$html."\", overlayClose: false, close: 'OK'}); })</script>";
	}

	/**
	 *  M�todo respons�vel por 	 
	 *	@param unknown $type
	 *	@param unknown $text
	 */
	public function MsgPage($type,$text)
	{
			
		$html = "<div class='msgPage".$type."'>".$text."</div>";
			
		return "<script>$(document).ready (function () { $('section').prepend(\"".$html."\");  $('.msgPageSuccess, .msgPageError').delay(4000).fadeOut(2000); })</script>";
			
	}

	/**
	 *  M�todo respons�vel por adicionar uma imagem � tela. 
	 *  Se o par�metro for nulo, igual a '0' ou 'off', esta imagem ser� 'off'. 
	 *  Caso contr�rio, ela ser� 'on'.
	 *	@param string $type
	 *	@return string
	 */
	public function OnOff($type=NULL)
	{
		
		if(is_null($type) || $type == '0' || $type == "off")
		
			
			return "<i class='fa fa-times-circle onoffstylered'></i>";
		
		else
			
			return "<i class='fa fa-check-circle onoffstylegreen'></i>";
			
	}


	/**
	 *  M�todo respons�vel por adicionar um bot�o de edi��o � p�gina
	 *	@param unknown $obj
	 *	@param unknown $id
	 *	@return string
	 */
	public function Edit($obj,$id)
	{
		return "<i class='fa fa-pencil-square-o imgSelectItem' title='Editar' table='".$obj->table."' idEdit='".$id."'></i>";
	}


	/**
	 *  M�todo respons�vel por adicionar um bot�o de exclus�o
	 *	@param unknown $obj
	 *	@param unknown $id
	 *	@return string
	 */
	public function Delete($obj,$id)
	{
		return "<i class='fa fa-times-circle-o imgDelItem' title='Apagar'  table='".$obj->table."' idDel='".$id."'></i>";
		
	}

	/**
	 * 	M�todo para cria�ao de codigo jQuery padrao com bind em um determinado objeto.
	 *  On(acao, objeto, codigo, live false/true).	 
	 *	@param unknown $action
	 *	@param unknown $objID
	 *	@param unknown $code
	 *	@param string $live
	 *	@return string
	 */
	public function On($action, $objID, $code)
	{
		
		$ret = "<script type='text/javascript'>";

		$ret .= "$(document).on('$action', '$objID', function () { $code });";

		$ret .= "</script>";

		return $ret;
	}
	
	/**
	 * 	M�todo para cria��o de c�digo jQuery padr�o com bind em um determinado objeto.
	 *  Off(a��o, objeto, c�digo, live false/true).	 
	 *	@param unknown $action
	 *	@param unknown $objID
	 *	@param string $live
	 *	@return string
	 */
	public function Off($action, $objID)
	{
		$ret = "<script type='text/javascript'>";

		$ret .= "$(document).off('$action', '$objID');";

		$ret .= "</script>";

		return $ret;
	}

	/**
	 * 	M�todo respons�vel por adicionar c�digo Javascript 
	 *	@param unknown $code
	 */
	public function JS($code)
	{
		$ret = "<script type='text/javascript'>";
		$ret .= "$(document).ready(function(){";
		$ret .= "$code";
		$ret .= "});</script>";
		return $ret;
	}
	
	/**
	 * 	M�todo respons�vel por adicionar uma fun��o Javascript
	 *	@param unknown $code
	 */
	public function JSFunction($code)
	{
		
		$ret = "<script type='text/javascript'>";
		$ret .= $code;
		$ret .= "</script>";
		return $ret;
		
	}
	
	/**
	 * 	M�todo respons�vel por adicionar um subt�tulo � p�gina
	 *	@param string $txt
	 *  @param string $param
	 */
	public function SubTitle($txt,$param="")
	{
		
		return "<h2 ". $this->SetAttr ($param) . ">".$txt."</h2>";
		
	}

	/**
	 * 	M�todo respons�vel por definir os c�digos CSS dos elementos da p�gina
	 *	@param string $css
	 */
	public function SetCSS($css)
	{
		
		return "<style>".$css."</style>";
		
	}
	
	
	/**
	 * M�todo respons�vel por adicionar uma mensagem de erro � p�gina
	 *	@param string $text
	 */
	public function ErrorMsg ($text = "")
	{
		echo $this->MsgBox ("error", "Erro", $text);
	}
	
	/**
	 * M�todo respons�vel por adicionar uma mensagem informativa � p�gina
	 *	@param string $text
	 */
	public function InfoMsg ($text = "")
	{
		echo $this->MsgBox ("information", "Aviso", $text);
	}
	
	/**
	 * M�todo respons�vel por adicionar uma mensagem de alerta � p�gina
	 *	@param string $text
	 */
	public function AlertMsg ($text = "")
	{
		echo $this->MsgBox ("warning", "Aten��o", $text);
	}
	
	/**
	 * M�todo respons�vel por adicionar uma mensagem � p�gina
	 *	@param string $text
	 */
	public function OkMsg ($text = "")
	{
		echo $this->MsgBox ("confirmation", "Aten��o", $text);
	}
	
	
	
	/**
	 *	M�todo respons�vel por incluir o nome de um javascript espec�fico
	 *	@param $js = nome do arquivo javascript
	 *	@return
	 */
	function IncludeJS($arJs)
	{
		if(is_array($arJs))
		{
			foreach($arJs as $js)
				echo "<script type='text/javascript' src='../js/".$js."?id=".uniqid()."'></script>\n";
		}
		else
		{
			echo "<script type='text/javascript' src='../js/".$arJs."?id=".uniqid()."'></script>\n";
		}
	}
	
	/**
	 *	M�todo respons�vel por incluir um bot�o
	 *	@param string $type
	 *  @param string $param
	 *	@return
	 */
	public function Button($type,$param)
	{
		
		return "<input type='".$type."' ".$this->SetAttr($param)." >";	
	
	}
	
	
	/**
	 * M�todo respons�vel por incluir o nome de um CSS espec�fico
	 *	@param $arCSS = nome do arquivo CSS
	 */
	function IncludeCSS($arCSS)
	{
		if(is_array($arCSS))
		{
			foreach($arCSS as $css)
				echo "<link href=\"../css/".$css."?id=".uniqid()."\" rel=\"stylesheet\" type=\"text/css\" /> \n";
		}
		else
		{
			echo "<link href=\"../css/".$arCSS."?id=".uniqid()."\" rel=\"stylesheet\" type=\"text/css\" /> \n";
		}
	}
	
	
	/**
	 * M�todo respons�vel por incluir um bot�o de impress�o, com op��o de escond�-lo ao imprimir
	 */
	function BtImprimir()
	{
		return '<div class=\'noprint\' style=\'margin-bottom:35px\'><input type=button value="Imprimir" class="btnPrint" onClick="window.print();"></div>';
	}
	
	
	/**
	 * 
	 * Abre a caixa de Di�logo / Alert
	 * 
	 * Tipos: I -> Information, Q -> Question, E -> Error, C -> Confirmation, W -> Warning
	 * 
	 * Caixa de di�logo b�sica, com op��es b�sicas. Para op��es avan�adas consultar o Zebra Dialog.
	 * 
	 * ShowButton - TRUE ou FALSE | ShowClose - TRUE ou FALSE | CloseOverlay - TRUE ou FALSE | CloseKeyboard - TRUE ou FALSE
	 * 
	 */
	
	public function Dialog($type,$title,$msg,$showButton='true',$showClose='true',$closeOverlay='true',$closeKeyboard='true')
	{
		if($type == "") 			$type='I';
		
		$arType["I"] = "information";
		$arType["Q"] = "question";
		$arType["E"] = "error";
		$arType["C"] = "confirmation";
		$arType["W"] = "warnig";
		
		
		echo $this->JS("
						$.Zebra_Dialog( '".$msg."',
						{
							'type': '".$arType[$type]."',
							'title': '".$title."',
							'keyboard' : ".$closeKeyboard.",
							'overlay_close' : ".$closeOverlay.",
							'show_close_button' : ".$showClose.",
							'buttons':".$showButton."
						})");
		
		
	}
	
	
	/**
	 *  M�todo respons�vel por inserir um trecho de explica��o no �cone interroga��o"?" da p�gina
	 *	@param string $txt = texto a ser exibido
	 */
	public function Explain($txt = '')
	{
	
		if($txt == 'IUD')
		{
			$this->explain = "
					<div style='display:none'>
					<div id='boxHelpPage'>
					- Para incluir preencha os campos e clique em incluir.<br>
					- Para fazer uma altera��o, clique em um dos itens cadastrados (links), fa�a as altera��es e clique em 'alterar'.<br>
					- Para excluir clique no <img src='../images/del.png'> ao lado do item cadastrado.<br>
					- Os campos com borda em <span style='color:red'>vermelho</span> s�o de preenchimento obrigat�rio
					</div>
					</div>
	
					";
		}
		else if ($txt == 'iSel')
		{
			$this->explain = "
					<div style='display:none'>
					<div id='boxHelpPage'>
					- Preencha um ou mais atributos solicitados.<br>
					- Clique no Bot�o \"Procurar\".<br>
					- Clique sobre o item desejado para finalizar a sele��o e retornar a p�gina anterior.
					</div>
					</div>
	
					";
		}
	
		else
		{
			$this->explain = "<div style='display:none'><div id='boxHelpPage'>".$txt."</div></div>";
		}
	}
	
	/**
	 * M�todo respons�vel por incluir uma checkbox
	 *	@param string param
	 */
	public function CheckBox($param)
	{
		return "<input type=checkbox ".$this->SetAttr($param).">";
	}
	
	/**
	 * M�todo respons�vel por incluir um �cone � p�gina, obtido pelo site www.fortawesome.github.io/Font-Awesome/icons
	 *	@param string icon = nome do �cone
	 *  @param string param
	 */
	public function IconFA($icon,$param=null)
	{
			$param["class"] .= " fa ".$icon." ";
			
			return "<i ".$this->SetAttr($param)."> </i>";
		
	}
	
}

?>