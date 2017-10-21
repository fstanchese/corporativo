<?php 

	include ("../engine/User.class.php");
	include ("../engine/App.class.php");

	$usuario = new User();
	$app = new App("Menu do Usuário", "Menu do Usuário", array('SOLSERVICO'), $usuario);

	
	include ("../engine/View.class.php");
	include ("../engine/Db.class.php");
	include ("../engine/ViewBox.class.php");	
	include ("../engine/Form.class.php");
	
		
	require_once ("../model/SisMenu.class.php");


	
	
	$dbOracle = new Db ($usuario);
	
	
	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	
	$vp = new ViewBox ("Menu do Usuário", "Menu do Usuário");
	$vp->IncludeJS (array ("menu.js"));
	$vp->IncludeCSS("menu.css");

	$vp->Header ();

	$sisMenu = new SisMenu($dbOracle);
	$sisMenuInt = new SisMenu($dbOracle);
	
	if ( $_POST[p_O_Option] == 'insert' && $_POST[p_Nome] != '' )
	{
		
		if ($_POST['p_Raiz'] == '')
		{
			$_POST['p_Raiz'] = 'off';
		}
		
		$dbData->Get($sisMenu->Query("qNome",array("p_WPessoa_Id"=>$usuario->GetId(),"p_SisMenu_Raiz"=>$_POST['p_Raiz'],"p_SisMenu_Nome"=>$_POST['p_Nome'])));
		$row = $dbData->Row ();
		
		if ($row[QTDE] == 0)
		{
			$sisMenu->IUD($_POST,$dbData);
		}
		else
		{
			print "<script>alert(\"Item já cadastrado, por favor verifique\");</script>" ;
		}
		$_POST['p_SisMenu_Raiz'] = '';
	
	}
	
	
	
?>

	<div class="mensagem"></div>
	
	
	<div class='leftSite' style='width:49%;float:left'>
	<h3>Crie Diretórios / Adicione Itens ao seu Menu</h3>
	
	<div name="IncItem" class="inclui"> 
				
		<form name='f1' id='f1' method='POST'>
			<input type='hidden' name='p_O_Option' id='p_O_Option' value=''>
			<input type='hidden' name='p_WPessoa_Id' value='<?php echo $usuario->GetId(); ?>'>
			<table class='tableForm'>
				<tr><td align=right> Nome do (Sub) Menu:</td><td><input type='text' name='p_Nome' class='size80'></td></tr>
				<tr><td align=right> Criar no Menu Principal:</td><td><input type='checkbox' name='p_Raiz' value='on'></td></tr>
				<tr><td colspan=2 align=center><input type='submit' value='Incluir' name='incluir' class='insert'></td></tr>
			</table>
		</form>
		
	</div><br>		
		
	<!-- Aqui eu trago todas as páginas que o usuário selecionou para o menu além das pastas do sub-menu -->
	

	<ul id="gallery" class="gallery">
		
	<?
	// Aqui trazemos as páginas que não estão em nenhum sub-menu 
	$dbData->Get($sisMenu->Query("qContainer",array("p_WPessoa_Id"=>$usuario->GetId())));

	while($row = $dbData->Row ())
	{
		
		if ( $row[NOME] != '' )
		{
			$vImg 	= 'pasta.png';
			$vGUI	= $vProc = $row[NOME];
		}
		else
		{
			$vImg 	= 'monitor.gif';
			$vProc = $row[PROCNAME];
			$vGUI  = $row[GUINAME];
		}
		$vLB = $vProc;
		
			echo "<li class='block' img='".$vImg."' proc='".$vProc."' id='".$row[ID]."'  gui='".$vGUI."' title='".$vGUI."'>
							<h5>".$vLB."</h5>
							<img src='../images/".$vImg."' class='tipo' /></img>
							<span class='nameGui'>".$vGUI."</span>
			
							<img class='delItemGallery' src='../images/cross.png' id='".$row[ID]."'>
							</li>";
		
	}
	?>
				</ul>
	</div>
	
	<div class='leftSite' style='width:50%;float:left;margin-left:1%'>
			<h3>Seu Menu</h3>
	
			<!-- Aqui traz a lista com todos os Menus root -->
			
			<div class="menuRoot">		
	<?
	        $dbData->Get($sisMenu->Query("qRaiz",array("p_WPessoa_Id"=>$usuario->GetId())));
			
			while($row = $dbData->Row ())
			{
				echo "<div class='drop' id='".$row[ID]."'>
							<h4><img src=../images/folder.png><img class='removeMenuRaiz' id='".$row[ID]."' src='/images/errado.png' title='Excluir Menu'>&nbsp;".$row[NOME]."</h4>
						<div class=\"lista\">
						";

				$vId = $row[ID];
				$dbData2 = new DbData($dbOracle);
				$dbData2->Get($sisMenuInt->Query("qMenu",array("p_WPessoa_Id"=>$usuario->GetId(),"p_SisMenu_Pai_Id"=>$vId)));
				while($rowInt = $dbData2->Row ())
				{
					$vClass = '';
					if ( $rowInt[NOME] != '' )
					{
						$vImg 	= 'pasta.png';
						$vGUI	= $vProc = $rowInt[NOME];
						$vClass = 'subdir';
					}
					else
					{
						$vImg 	= 'monitor.gif';
						$vGUI = $rowInt[GUINAME];
						$vProc  = $rowInt[PROCNAME];
					}
					echo "<div class='itemMenu' id='".$rowInt[ID]."'>
					<img width='13px' src='../images/".$vImg."' class='".$vClass."' proc='".$vProc."' id='dir_".$rowInt[ID]."' gui='".$vGUI."' idr='".$rowInt[ID]."'>
					<img class='removeMenu' id='".$rowInt[ID]."' src='/images/errado.png' title='Excluir Item' proc='".$vProc."'  gui='".$vGUI."' img='".$vImg."'>
					".$vGUI."</div>";
				}				
				
				echo "</div></div>";
			
			}
	?>
		
	</div>
			

		
<?php 	
	unset ($dbData);
	unset ($dbOracle);
	unset ($vp);	
	unset ($usuario)
?>