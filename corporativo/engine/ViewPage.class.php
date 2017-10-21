<?php

require_once ("View.class.php");

class ViewPage extends View
{
	public 		$pageName;
	public 		$explain = '';
	private 	$theme = array("azul.css"=>"Padrão","bronze.css"=>"Bronze","cinza.css"=>"Cinza","rosa.css"=>"Rosa","verde.css"=>"Verde");

	private $switchPageToBox = false;
	
	function __construct ($title, $description="")
	{
		if($_GET[switchPageToBox] == 1)
		{
			
			$this->switchPageToBox = true;
			require_once "../engine/ViewBox.class.php";
			
			$vb = new ViewBox($title, $description);
			
			$vb->Header();
			
			return;
			
		}	
		
		
		
		$this->pageName = $title;

		echo "<!DOCTYPE HTML>\n
				<html>\n
				<head>\n

				<title>".$title."</title>\n
						<meta http-equiv='CACHE-CONTROL' content='NO-CACHE'>
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n
						<meta name=\"description\" content=\"".$description."\" />\n";

		if($_SESSION["theme"] == "") $_SESSION["theme"] = "azul.css";

		echo "<link href='../css/".$_SESSION["theme"]."' rel='stylesheet' type='text/css' id='corEstilo' /> \n";
		echo "<link href='../css/page.css' rel='stylesheet' type='text/css'  /> \n";

		foreach($this->arCSS as $css){
			echo "<link href=\"../css/".$css."?id=".uniqid()."\" rel=\"stylesheet\" type=\"text/css\" /> \n";
		}

		foreach($this->arJs as $js){
			echo "<script type='text/javascript' src='../js/".$js."?id=".uniqid()."'></script>\n";
		}


		echo "	</head>\n

				<body>\n";
	}

	
	
	function __destruct ()
	{
		if($this->switchPageToBox) return;
		echo "
				<br style='clear:both'>
				<div class='divDetails'></div>
				<br style='clear:both'>
				</section>
				<footer>
				&copy; 2000/".date('Y')." - Universidade São Judas Tadeu.<br>
						Rua Taquari, 546 - Mooca/SP   -   Av. Vital Brasil, 1000 - Butantã/SP
						</footer>

						</body>\n</html><div style='display:none'><div id='boxErrorMsg'>Erro de usuário!</div></div>";
			
		if($this->explain != '')
		{
			echo $this->explain;
		}
	}



	function Header ($user = "",$nav="")
	{
		
		if($this->switchPageToBox) return;
		
		echo "<header>\n
				<div id='logo'></div>\n ";
			
		if ($user != "")
		{
			echo "<div class='headerOptions'>\n
					<h2>" . $user->GetUser() . " - " . $user->GetIpaddr() .  "<img src='../images/logout.png' title='Sair' id='btnLogout'>
							<img src='../images/bricks.png' title='Menu' id='btnMenu' width=20px></h2>
					
							\n
							<h3>
							<select name='p_Header_Dept'>\n
							";
			foreach($user->GetDept () as $key => $name)
			{
				echo "<option value='".$key."'";
					
				if($key == $user->GetCurrDept()) echo " selected ";
				echo "> ".$name." </option>\n";
			}

			echo "</select>\n<br style='clear:both'>\n";

			if (is_array($user->GetUnits))
			{
				foreach($user->GetUnits () as $key => $name)
				{
					echo "<span class='unitRadio'><input type='radio' name='p_Header_Unit' value='".$key."'";
					if($key == $user->GetCurrUnit()) echo " checked ";
					echo " > ".$name." </span>\n";
				}
			}
			echo " </h3>\n
					</div>\n
					";
		}
			
		echo "
		<h1>$this->pageName ";
			
		if($this->explain != '') echo "<a href='#boxHelpPage' class='btnHelp' title='Ajuda para essa Página'><img src='../images/help.png'></a>";
			
		echo " </h1>\n
					
				<div class='corTema'>";
		if($nav != "")
		{
			echo $nav->AppNav();
		}
		
		echo "		
				<img class='textSize' id='fontDown' title='Diminuir Fonte' src='../images/font_down.png'>
				<img class='textSize' id='fontNormal' title='Fonte Padrão' src='../images/font.png'>
				<img class='textSize' id='fontUp' title='Aumentar Fonte' src='../images/font_up.png'>
				
				";
			/*	
				<select name='corTema' id='corTema'>";
			
		foreach($this->theme as $name => $label)
		{
			echo "<option value='".$name."' ";
			if($name == $_SESSION["theme"]) echo "selected";

			echo " > ".$label." </option>";
		}
		</select>
			*/
			
		echo "
				</div>\n";
			
		
			
		echo "	</header>\n
					
				<section id='pageSection'>\n
					
					
				<br style='clear:both'>\n
				";
			
		if($nav != "")
		{
			echo $nav->UserNav();
		}

	}


	

	
	

}

?>