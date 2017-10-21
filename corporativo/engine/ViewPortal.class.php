<?php

require_once ("../engine/View.class.php");

/**
 * 
 *
 */
class ViewPortal extends View {

	
	public $pageName; 
	//private $theme = 'default';

	/**
	 * Método construtor da classe ViewPortal	 
	 *	@param unknown $title
	 *	@param unknown $description
	 */
	function __construct ($title, $description)
	{
		$this->pageName = $title;


		echo "<!DOCTYPE HTML>\n
				<html>\n
				<head>\n

				<title>".$title."</title>\n
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n
						<meta name=\"description\" content=\"".$description."\" />\n";
			
		if($_SESSION["theme"] == "") 			
		{
			$_SESSION["theme"] = "azul.css";
		}
		
		echo "<link href='../css/".$_SESSION["theme"]."' rel='stylesheet' type='text/css' id='corEstilo' /> \n";
			
		foreach($this->arCSS as $css)
		{
			echo "<link href=\"../css/".$css."\" rel=\"stylesheet\" type=\"text/css\" /> \n";
		}
			
		foreach($this->arJs as $js)
		{
			echo "<script type='text/javascript' src='../js/".$js."'></script>\n";
		}			
			
		echo "	</head>\n
					
				<body>\n";
	}

	/**
	 *  Método responsável por
	 */
	function __destruct ()
	{
		echo "</section>
				<footer class='footerPortal noprint'>
				&copy; 2000/".date('Y')." - Universidade São Judas Tadeu.<br>
						</footer>
							
						</body>\n</html>";
	}



	/**
	 *  Método responsável por	
	 */
	function Header ()
	{
		echo "<header class='headerPortal'>\n
		<h1>$this->pageName</h1>\n
		</header>\n

		<section>\n";
		
		
		//Verifica se existe o COOKIE da Página
				
		if(isset($_COOKIE[str_replace(".","_",end(explode("/",$_SERVER[PHP_SELF])))."_Id"])){

				echo "<p class='cookieSelected'>Último Selecionado: <br> <a href='#' class='iselCookie' idSel='".$_COOKIE[str_replace(".","_",end(explode("/",$_SERVER[PHP_SELF])))."_Id"]."'>".utf8_decode($_COOKIE[str_replace(".","_",end(explode("/",$_SERVER[PHP_SELF])))."_Label"])."</a></p>";
		
		}
		
	}

	

}


?>