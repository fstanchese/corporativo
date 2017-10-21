<?php

require_once ("../engine/View.class.php");

/**
 * Classe Form 
 *
 */
class Form extends View
{
	private $button = 0;
	private $openLI = 0;

	/**
	 *  Método responsável por	 
	 *	@param string $param
	 */
	public function __construct($param='')
	{
		if($param['name'] == '') 
		{
			$param['name'] = 'f1';
		}
		
		if($param['method'] == '') 
		{
			$param['method'] = 'POST';
		}
		
		if($param['id'] == '') 
		{
			$param['id'] = $param['name'];
		}
		
		if($param['action'] == '') 
		{
			$param['action'] = end(explode("/",$_SERVER[PHP_SELF]));
		}
			
		$return =  "<form ";
		$return .=  $this->SetAttr($param);
		$return .= " enctype='multipart/form-data' >\n";
		$return .= "	<input type='hidden' name='p_O_Option'>\n";

		echo $return;
	}


	/**
	 * 	Monta o fieldset da página	 
	 *	@param string $text = texto do legend
	 *	@param string $param = atributo do fieldset
	 *	@return
	 */
	public function Fieldset($text="", $param="")
	{
		$return .= "<fieldset".$this->SetAttr($param).">\n";
			
		if($text != "") $return .= "<legend>".$text."</legend>\n";
			
		$return .= "<ul class='form'>\n";
			
		echo $return;
	}

	/**
	 *  Método responsável por	 
	 */
	public function CloseFieldset()
	{
		$this->CheckOpenLI();
			
		if($this->button > 0) $return .= "</li>";
		
		$this->button = 0;

		$return .= "</ul>\n";
			
		$return .= "</fieldset>";
			
		echo $return;
			
	}

	/**
	 *  Método responsável por	 
	 *	@param string $tipo
	 *	@param unknown $param
	 *	@return string
	 */
	private function Field($tipo='text', $param=array())
	{
		
		
		
		//if(strtoupper(substr($param["name"],-3)) == "_ID")
		//	$html .= $this->Span(array("style"=>"Float:right")).$this->Link("Cadastrar").$this->CloseSpan();
		
		
		switch(strtoupper($tipo))
		{
			case 'TEXT':
			case 'HIDDEN':
			case 'PASSWORD':
			case 'RADIO':
			case 'CHECKBOX':
			case 'FILE':
			case 'IMAGE':
				//atributos novos do html 5
			case 'SEARCH':
			case 'EMAIL':
			case 'URL':
				//
				
				if($param["id"] == "" )	$param["id"] = $param["name"];
				
				if($param["checked"] == 'on')
				{ 
					$param["checked"] = 'TRUE';
				}
				else
				{
					unset($param["checked"]);
				}
				
				$html .= "<input type='".$tipo."' autocomplete='off' ";

				$html .= $this->SetAttr($param);

				$html .= ">\n";
				
				
				

				break;
			
			case "DATE":
				
				if($param["id"] == "" )	$param["id"] = $param["name"];
				
				$param["class"] = "datePicker";
				
				$html .= "<input type='text' autocomplete='off' ";
				
				$html .= $this->SetAttr($param);
				
				$html .= ">\n";
				
				break;

			case "DATETIME":
				
					if($param["id"] == "" )	$param["id"] = $param["name"];
				
					$param["class"] = "datetimePicker";
				
					$html .= "<input type='text' autocomplete='off' ";
				
					$html .= $this->SetAttr($param);
				
					$html .= ">\n";
				
					break;
					
			case "TIME":
			
				if($param["id"] == "" )	$param["id"] = $param["name"];
			
				$param["class"] = "timePicker";
			
				$html .= "<input  type='text' autocomplete='off' ";
			
				$html .= $this->SetAttr($param);
			
				$html .= ">\n";
			
				break;
						
			case "MULTISELECT":
				
				$param["class"] .= "multiSelect";
				
				if($param["id"] == "" )	$param["id"] = $param["name"];
				
				$option 	= $param[option];
				$selected 	= $param[value];
				
				unset($param[option]);
				unset($param[value]);
				
				$html .= "<select multiple='multiple' ";
				$html .= $this->SetAttr($param);
				$html .= " >";
				
				
				
				foreach($option as $valor => $label)
				{
					if($valor != "")
						$html .= "<option value='".$valor."' > ".$label." </option>";
				}
				
				
				
				
				if(is_array($selected))
				{
					foreach($selected as $valor => $label)
					{
						if($valor != "")
							$html .= "<option selected value='".$valor."' > ".$label." </option>";
					}
						
					
				}
				
				$html .= "</select>\n";
				
				
				
				break;
				
				
			break;
				
			case "SELECT":
				
				if($param["id"] == "" )
				{
					$param["id"] = $param["name"];
				}
				
				$option = $param[option];
				
				unset($param[option]);
				
				$html .= "<select ";
				$html .= $this->SetAttr($param);
				$html .= " >";

				
				
				foreach($option as $valor => $label)
				{
					if($valor == '')
					{
						$html .= "<option value=''";
					}
					else
					{
						$html .= "<option value='".$valor."'";
					}

					if($param[value] != '' && $param[value] == $valor) 
					{
						$html .= " selected ";
					}
					
					$html .= " > ".$label." </option>";
				}

				$html .= "</select>\n";
				break;

			case 'TEXTAREA':

				$html .= "<textarea ";
				$html .= $this->SetAttr($param);
				$html .= " >".$param[value]."</textarea>\n";
				
			break;
			
			
			case 'EDITOR':
				if($param[id] == "") $param[id] = $param[name];
				$html .= "<textarea ";
				$html .= $this->SetAttr($param);
				$html .= " >".$param[value]."</textarea>\n";
				
				$html .= "<script type='text/javascript'>
							bkLib.onDomLoaded(function() {
								new nicEditor().panelInstance('".$param[id]."');
							});
						</script>
						";
			
			break;
			
			
			
			case 'RANGE':
				
				if($param[id] == "") 		$param[id] 		= $param[name];
				if($param[min] == "")		$param[min] 	= 0;
				if($param[max] == "") 		$param[max] 	= 100;
				if($param[step] == "") 		$param[step] 	= 10;
				if($param[value] == "") 	$param[value] 	= 0;
				if($param[size] == "") 		$param[size] 	= 80;
				
				
				$html .= "
						<script>
							$(function() {
								$( '#".$param[id]."_slider' ).slider({
									value:".$param[value].",
									min: ".$param[min].",
									max: ".$param[max].",
									step: ".$param[step].",
									slide: function( event, ui ) {
										$( '.".$param[id]."' ).val( ui.value ).html(ui.value);
									}
								});
							$( '.".$param[id]."' ).val( $( '#".$param[id]."_slider' ).slider( 'value' ) ).html($( '#".$param[id]."_slider' ).slider( 'value' ));
						});
					</script>

					<input type='hidden' class='".$param[id]."' style='border:0' name='".$param[name]."'>
					<div class='".$param[id]."'></div>				
					<div id='".$param[id]."_slider' style='width:".$param[size]."%'></div>				
					";
				
						
				break;
			

			case 'ISEL':

				$labelLink = "Selecionar";

				if($param[value] != "")
				{
					$labelLink 		= $param[label];
					$valueHidden	= $param[value];

					$param[value] = "";
					$param[label] = "";
				}

				if($param["id"] == "" ) 
				{
					$param["id"] = $param["name"];
				}

				$html .= "<a class='isel' ";
				$html .= $this->SetAttr($param);

				$html .= " >".$labelLink."</a>\n
						<input type='hidden' id='".$param[name]."_Id' name='".$param[name]."_Id' value='".$valueHidden."'>\n
								<input type='hidden' id='".$param[name]."_Label' name='".$param[name]."_Label' value='".$labelLink."'>\n
										";
				break;
				
				case "LABEL":
				
					if(is_array($param))
					{
						foreach($param as $valor)
						{
							$html .= $valor."<br>";
						}
					}
					else 
					{
						$html .= $param;
					}
				
					
				break;
					
				case 'ONOFF':
					if($param[value] == "") $param[value] = 'off';
					
					$html .= "<i class='fa fa-check-circle onoffstylegreen imgOnOff' name='".$param[name]."' valReal='on'></i>
							  <i class='fa fa-times-circle onoffstylered imgOnOff' name='".$param[name]."' valReal='off'></i>
								<input type='hidden' name='".$param[name]."' value='".$param[value]."'>
										
								<script>
									$(document).ready(function(){
											$('.imgOnOff[valReal=".$param[value]."][name=".$param[name]."]').trigger('click');
										});		
								</script>		
							";
					
					
					
				break;
				
				
				
				case 'AUTOCOMPLETE':
				

					if($param["id"] == "" )	$param["id"] = $param["name"];
					$param[placeholder] = "Digite o nome ou parte dele...";
					
					if($param['class'] != "") $param['class'] .= " autocomplete"; else $param['class'] = "autocomplete";

					
					
					$param[name] = $param[name]."___AutoComplete";
					$param[id] = $param[id]."___AutoComplete";
					
					if($param[db] == "") $param[db] = "oracle";
							
	
					$html .= "<input type='text' value='".$param[label]."' autocomplete='off'";
					$html .= $this->SetAttr($param);
	
					$html .= " >\n	<input type='hidden' id='".str_replace("___AutoComplete","",$param[id])."' name='".str_replace("___AutoComplete","",$param[id])."' value='".$param[value]."'>\n";
						
						
						
					break;
				
				
		}
					
		return $html;
	}

	/**
	 *  Método responsável por	 
	 *	@param string $label
	 *	@param string $tipo
	 *	@param unknown $param
	 */
	public function Input($label='', $tipo='text', $param=array())
	{
		
		
		if($tipo != 'hidden')
		{
			
			if($label != "") $label .= " :";
			
			$this->checkOpenLI();

			$html .= "<li class='formLabel'>\n
					<label for='".$param[id]."'> ".$label."</label>\n
							</li>\n
							<li class='formField'>";

			$html .= $this->Field($tipo,$param);

			$html .= "</li>\n";
		}
		else
		{
			$html .= $this->Field($tipo,$param);
		}

		echo $html;
	}


	/**
	 *  Método responsável por	
	 *	@param string $tipo
	 *	@param unknown $param
	 */
	public function Button($tipo='submit', $param=array())
	{
		$this->checkOpenLI();
		if($this->button == 0)
		{
			$this->button = 1;
			$html .= "<li class='formButton'>\n";
		}

		$html .= "<input type='".$tipo."' ";
			
		$html .= $this->SetAttr($param);
			
		$html .= ">\n";
			
		echo $html;
	}

	/**
	 *  Método padrão para criação de botões de ações em um form	 
	 */
	public function IUDButtons ($flagConsulta=TRUE)
	{
		if($_POST[p_O_Option] == "select")
		{
			$this->Button ("submit",
					array ("name"=>"enviar", "value"=>"Alterar","class"=>"update"));
		}

		$this->Button ("submit",
				array ("name"=>"incluir", "value"=>"Incluir","class"=>"insert"));

		if($flagConsulta)
		{
		
			$this->Button ("button",
				array ("name"=>"consultar", "value"=>"Consultar","class"=>"search"));
		}

		$this->Button ("button",
				array ("name"=>"cancelar", "value"=>"Cancelar","class"=>"cancel"));
	}

	/**
	 * Método responsável por	 
	 *	@param unknown $label
	 */
	public function LabelMultipleInput($label)
	{
		if($label != "") $label .= " :";
		$return .= "<li class='formLabel'>\n
				<label> ".$label."</label>\n
						</li>\n<li class='formField'>\n";
		echo $return;
	}

	/**
	 * Método responsável por	 
	 *	@param string $label
	 *	@param string $tipo
	 *	@param unknown $param
	 */
	public function MultipleInput($label='', $tipo='text', $param=array())
	{
		$return = "<span>".$label." ".$this->Field($tipo,$param)." </span>";
			
		echo $return;

		$this->openLI=1;

	}
	
	
	public function MultipleSpan($label='')
	{
		$return = "<span>".$label." </span>";
			
		echo $return;
	
		$this->openLI=1;
	
	}
	

	/**
	 * Método responsável por	 
	 */
	private function CheckOpenLI()
	{
		if($this->openLI == 1)
		{
			$return .= "</li>";
			$this->openLI = 0;
		}
			
		echo $return;
	}

	/**
	 *  Método responsável por	 
	 */
	public function __destruct()
	{			
		$this->button = 0;
		$return = "</form>\n<br style='clear:both'>\n";	
				
		echo $return;
	}

}
?>