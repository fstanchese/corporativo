<?php
	include("../engine/User.class.php");
	include("../engine/App.class.php");
	
	$user = new User ();
	$app = new App("GOS - Importação de SDL para Model","GOS - Importação de SDL para Model",array('ADM','CPD'),$user);
	
	include("../engine/Db.class.php");
	include("../engine/DataGrid.class.php");
	include("../engine/Navigation.class.php");
	include("../engine/ViewPage.class.php");
	include("../engine/Form.class.php");

	//Conectar o usuário ao Banco de Dados
	$dbOracle = new Db ($user);

	//

	//Instanciar a DbData
	$dbData = new DbData ($dbOracle);
	
	//Instanciar a Navegação da Página
	$nav = new Navigation($user, $app,$dbData);
	
	//Quando cria o objeto View é necessário passar o Titulo da Página
	$view = new ViewPage($app->title,$app->description);
	
	
	//Para montar o Header precisa passar o nome do Usuário e os Departamentos dele
	//Opcional $nav
	$view->Header($user,$nav);

	
	$view->JS("$('.openColorbox').colorbox({iframe:true, width:'60%', height:'80%'});");

	//Instanciar formulário
	$form = new Form(array("method"=>"POST"));

		$form->Fieldset();
	
			$form->Input("Nome da Tabela",'text', array("name"=>'nome', "class"=>"size60", "value"=>$_POST[nome]));
			$form->Button("submit",array("name"=>"buscar", "value"=>"Buscar"));
			
		$form->CloseFieldset ();	
		
	//fecha formulário
	unset ($form);
	
	echo "<style>
			 code { font-size:11px;padding:15px;}
			</style>";
	
	
	
	if($_POST[nome] != "")
	{
		
			echo $view->H4("Verifique se todos os atributos estão corretos. Erros de leitura no arquivo .sdl podem ocorrer.");
			
			//

			echo $view->Br();
			
		
		
			$path = "/oracle/system/osystem/sdl";
			$d = dir($path);
			while(false !== ($file = $d->read())){
				if(($file{0} != '.') && ($file{0} != '~') && (substr($file, -3) != 'LCK') && ($file != basename($_SERVER['PHP_SELF']))) {
					$ponteiro  = opendir($path."/".$file);
					while ($nome_itens = readdir($ponteiro)) {
						if ($nome_itens!="." && $nome_itens!=".."){
							$dirs[$file][] = $nome_itens;
						}
					}
				}
			}
			$d->close();
			ksort($dirs);
		
		
			foreach ($dirs as $dir_name => $values) {
		
				if(strtolower($dir_name) == strtolower($_POST[nome])){
		
					$ponteiro  = opendir($path."/".$dir_name);
					while ($files = readdir($ponteiro)) {
						if ($files!="." && $files!=".."){
							if(strtolower($files) == strtolower($dir_name).".sdl"){
									
								echo "<h3>".$files."</h3>";
									
								$conteudo = file_get_contents($path."/".$dir_name."/".$files);
									
								$aux = explode("\n",$conteudo);
									
									
									
								$cont = 0;
								foreach($aux as $linha){

									if(trim($linha) != "" && @eregi("oRows",trim($linha))) {
										$qteLinhas = trim(str_replace(")","",str_replace("(","",str_replace("oRows","",$linha))));
										
									
									
									}
										
									if(trim($linha) != "" && !@eregi("oRows",trim($linha)) && !@eregi("insert",trim($linha)) && !@eregi("oDoc",trim($linha)) ){
										if(@eregi("oAttribute",$linha)){
											$cont++;
										}
											
										if(@eregi("oCalculate",$linha)){
											break;
										}
											
										$arAttr[$cont][] = str_replace("(","",str_replace(")","",trim(str_replace("oAttribute (","",$linha))));
			
									}
										
								}
								
								
							$html =  "
<?php
		
	require_once (\"../engine/Model.class.php\");
		
	class ".$dir_name." extends Model
	{
		
		//Mapeamento da tabela do Banco de Dados
		public \$table = '".$dir_name."'; \n
		
		public \$attribute 	= array();
		public \$calculate 	= array();
		public \$query		= array();\n		

		public \$rows;

				
		public function __construct(\$db)
		{\n
			\$this->db = \$db;\n
			\$this->rows = ".$qteLinhas.";\n\n";
							
		
								
													$arRec = "";
													foreach($arAttr as $key => $value){
														$first = true;
														$coluna = "";
														$coluna2 = "";
															
								
														foreach($value as $key2 => $valor2){
															if($first){
																$coluna = $valor2;
																$first = false;
								
															}else{
																$aux2 = explode("=",$valor2);
																	
																if($coluna2 != $coluna){
																	$html .= "\n";
																	$coluna2 = $coluna;
								
																}
																	
								
																if(trim($aux2[0]) != ""){
								
																		
																		
																	if(@eregi("number",trim($aux2[1]))){
																		$html .= "\t\t\t\$this->attribute['".$coluna."']['".ucfirst(trim($aux2[0]))."'] = 'number';\n";
																		$html .= "\t\t\t\$this->attribute['".$coluna."']['Length'] = ".str_replace(",",".",str_replace("number","",trim($aux2[1]))).";\n";
																	}
																	elseif(@eregi("string",trim($aux2[1]))){
																		$html .= "\t\t\t\$this->attribute['".$coluna."']['".ucfirst(trim($aux2[0]))."'] = 'varchar2';\n";
																		$html .= "\t\t\t\$this->attribute['".$coluna."']['Length'] = ".str_replace(",",".",str_replace("string","",trim($aux2[1]))).";\n";
																	}else{
																			
																		if(ucfirst(trim($aux2[0])) == "NotNull"){
																			$html .= "\t\t\t\$this->attribute['".$coluna."']['NN'] = 1;\n";
																		}else{
																			if(ucfirst(trim($aux2[0])) != "Input" && ucfirst(trim($aux2[0])) != "Relation" && ucfirst(trim($aux2[0])) != "Query" && ucfirst(trim($aux2[0])) != "Link" && ucfirst(trim($aux2[0])) != "Recognize")
																				$html .= "\t\t\t\$this->attribute['".$coluna."']['".ucfirst(trim($aux2[0]))."'] = '".trim($aux2[1])."';\n";
																			
																			if(ucfirst(trim($aux2[0])) == "Recognize")
																				$arRec[] = $coluna;
																		}
																	}
																		
																}
								
								
								
								
								
															}
																
																
								
														}
															
								
															
													}
								
								
								
								
													$cont = 0;
													foreach($aux as $linha){
															
															
														if(trim($linha) != "" && !@eregi("oRows",trim($linha)) && !@eregi("oDoc",trim($linha)) ){
																
															if(@eregi("oAttribute",$linha)){
																$ok = false;
															}
																
															if(@eregi("oCalculate",$linha)){
																$ok = true;
																$cont++;
								
															}
																
															if($ok)
																$arCalc[$cont][] = str_replace("(","",str_replace(")","",trim(str_replace("oCalculate (","",$linha))));
								
																
								
														}
															
													}
													
													
													$cont = 0;
													foreach($aux as $linha){
															
															
														if(trim($linha) != "" && !@eregi("oRows",trim($linha)) && !@eregi("oDoc",trim($linha)) && !@eregi("oC",trim($linha)) ){
													
															if(@eregi("oAttribute",$linha) || @eregi("oCalculate",$linha)){
																$ok = false;
															}
													
															if(@eregi("oIndex",$linha)){
																$ok = true;
																$cont++;
													
															}
													
															if($ok)
																$arIdx[$cont][] = trim(str_replace("(","",str_replace(")","",trim($linha))));
													
													
													
														}
															
													}
													
													
													
								
								
													$html .= "\n\t\t\t//Calculates para a criação de querys no diretório SQL\n";
													if(is_array($arCalc)){
														foreach($arCalc as $key => $valor){
															$first = true;
															$coluna = "";
															$coluna2 = "";
								
																
															foreach($valor as $key3 => $valor3){
																if($first){
																	$coluna = $valor3;
																	$first = false;
																		
																}else{
																	if(strtolower($coluna) != "id"){
																		$aux3 = explode("=",$valor3);
																			
																			
																		if(trim($aux3[0]) == 'query'){
																				
																			$sep = explode("_",trim($aux3[1]));
																			if($sep[0] == $dir_name)
								
																				$html .= "\t\t\t\$this->calculate['".$coluna."'] = '".trim($aux3[1])."';\n";
																			else
																				$calcFora[] = $coluna." ===> ".trim($aux3[1]);
								
																				
																				
																		}
																	}
																		
								
																}
								
								
															}
														}
													}
													
													
													$html .= "\n\n\t\t\t//Recognizes\n";
													
													if(is_array($arRec))
													{
														
														$html .= "\t\t\t\$this->recognize['Recognize'] = '".implode(",",$arRec)."';\n";
														
													}
													
													
													
													
													$html .= "\n\t\t\t//Índices\n";
													
													
													if(is_array($arIdx)){
														foreach($arIdx as $key => $valor){
															$first = true;
															$coluna = "";
															$coluna2 = "";
													
													
															foreach($valor as $key3 => $valor3){
																
																
																if(@eregi("oIndex",$valor3))
																{
																	$nameIdx = trim(str_replace("oIndex","",$valor3));
																	$html .= "\t\t\t\$this->index['".$nameIdx."']['Cols']";
																	
																}
																else if(@eregi("attributes=",$valor3))
																{
																 	$html .= " = \"".str_replace("attributes=","",$valor3)."\";\n";
																}
																else 
																{
																	if(@eregi("unique",$valor3))
																		$html .= "\t\t\t\$this->index[\"".$nameIdx."\"][\"Unique\"] = 1;\n\n";
																	else
																		$html .= "\t\t\t\$this->index[\"".$nameIdx."\"][\"Unique\"] = 0;\n\n";
																	
																}
																
																
																
													
													
															}
														}
													}
													
													
													
													
								
		
													}
									
												}
											}
										}
									
									
									
									}
		
		
		$html .= "\n\t\t\t//Todas as Queries da classe\n";
		foreach ($dirs as $dir_name => $values) {
		
			if(strtolower($dir_name) == strtolower($_POST[nome])){
		
				$ponteiro  = opendir($path."/".$dir_name);
				while ($files = readdir($ponteiro)) {
					if ($files!="." && $files!=".."){
		
						while ($files = readdir($ponteiro)) {
							if ($files!="." && $files!=".."){
								if(@eregi($dir_name."_q",$files)){
										
									$arquivo = str_replace(".sdl","",$files);
										
										
									$html .= "\t\t\t\$this->query['q".substr(end(explode("_",$arquivo)),1)."'] = '".$arquivo."';\n";

		
		
		
								}
							}
						}
					}
				}
			}
		}
		
		$html .= "
				
		}
}
?>
			";
		
		highlight_string($html);
		
		
		
		
		
		// QUERIES
			
			
		
		echo "<br><br><h3>QUERIES (Clique para Acessar)</H3>";
		
		foreach ($dirs as $dir_name => $values) {
		
			if(strtolower($dir_name) == strtolower($_POST[nome])){
		
				$ponteiro  = opendir($path."/".$dir_name);
				while ($files = readdir($ponteiro)) {
					if ($files!="." && $files!=".."){
		
						while ($files = readdir($ponteiro)) {
							if ($files!="." && $files!=".."){
								if(@eregi($dir_name."_q",$files)){
										
									$arquivo = str_replace(".sdl","",$files);
										
										
		
									echo "<a class='openColorbox' href='import_query.php?dir=".$dir_name."&file=".$arquivo."' target='_blank'>".$arquivo."</a><br>";
		
		
		
		
								}
							}
						}
					}
				}
			}
		}
		
		
		
		
		
		
		if(is_array($calcFora)){
			echo "<br><br><h3>CALCULATES QUE ESTÃO EM OUTRO DIRETÓRIO</H3>";
				
			foreach($calcFora as $valor){
					
					
				echo $valor."<br>";
					
			}
		}
		
		
		}
		
		
	
	
	
	
	
	unset($dbData);
	unset($dbOracle);
	unset($user);
	unset($app);

?>