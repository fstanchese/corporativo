<?php

require_once ("../engine/View.class.php");

/**
 * 
 *
 */
class ViewKiosk extends View {

	
	public $pageName; 

	/**
	 * M�todo construtor da classe 	 
	 *	@param unknown $title
	 *	@param unknown $description
	 */
	function __construct ($title, $description)
	{
		$this->pageName = $title;
			
		//
		echo "<!DOCTYPE HTML>\n
				<html>\n
				<head>\n

				<title>".$title."</title>\n
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n
						<meta name=\"description\" content=\"".$description."\" />\n";
			
		
		$_SESSION["theme"] = "azul.css";
		
		
		echo "<link href='../css/".$_SESSION["theme"]."' rel='stylesheet' type='text/css' id='corEstilo' /> \n";
		echo "<link href='../css/kiosk.css' rel='stylesheet' type='text/css'  /> \n";
			
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
	 *  M�todo respons�vel por
	 */
	function __destruct ()
	{
		echo "</section>
				<footer class=noprint>
				&copy; 2000/".date('Y')." - Universidade S�o Judas Tadeu.<br>
						</footer>
							
						</body>\n</html>";
	}



	/**
	 *  M�todo respons�vel por	
	 */
	function Header ()
	{
		echo "<header>\n
		<div id='logo'></div>
		<h1>$this->pageName</h1>\n
		</header>\n

		<section>\n";
		
	}

	

}


?>