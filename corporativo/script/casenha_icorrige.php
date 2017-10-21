<?php

	require_once '../engine/User.class.php';
	require_once '../engine/Db.class.php';
	
	$user = new User();
	
	$db = new Db($user);
	
	$dbData = new DbData($db);


	$unidade = '';
	$curso = '';
	$habilitacao = '';
	$turno = '';
	$tipo_bolsa = '';
	$bolsa = '';


	$lista = false;

	
	$fd = fopen ("mo_prod.csv", "r");


while (!feof ($fd)) {
	$buffer = fgets($fd);
	
	
	
		//$unidade = 'B';
	
			
		
		//Curso
		if(eregi('Curso:',$buffer)){
			$curso = trim(str_replace("Curso:",'',$buffer));
			$aux = explode(";",$curso);
			$curso = trim(str_replace(";;;;;",'',$aux[2]));
		}
		
		
		
		//Habilitacao
		if(eregi('Habilita��o:',$buffer)){
			$habilitacao = trim(str_replace("Habilita��o:",'',$buffer));
			$habilitacao = trim(str_replace(";;;;;;;",'',$habilitacao));
			$habilitacao = trim(str_replace(";",'',$habilitacao));
			
		}
		
		
		
		//Turno
		if(eregi('Turno:',$buffer)){
			$turno = trim(str_replace("Turno:",'',$buffer));
			$turno = trim(str_replace(";;;;;;",'',$turno));
			$turno = trim(str_replace(";",'',$turno));
			
		}
		
		
		
		//Tipo de Bolsa
		if(eregi('Tipo de Bolsa:;',$buffer)){
			
			$tipo_bolsa = trim(str_replace("Tipo de Bolsa:;",'',trim($buffer)));
			
			$tipo_bolsa = trim(str_replace(";;;;;;;",'',$tipo_bolsa));
			$tipo_bolsa = trim(str_replace(";",'',$tipo_bolsa));
			
		}
		
		
		
		//Bolsa
		if(eregi('Resultado das Bolsas Destinadas �',$buffer)){
			$bolsa = trim(str_replace("Resultado das Bolsas Destinadas �",'',$buffer));
			$bolsa = trim(str_replace(";;;;;;;",'',$bolsa));
		}
		
		
		//if(trim($buffer) == 'Classif.;Op��o;Nome;Enem;Cpf;M�dia Enem;Matr�cula na IES?;Pr�-selecionado em Bolsa Adicional?;Situa��o'){
		if(trim($buffer) == 'Classif.;Op��o;Nome;Enem;Cpf;M�dia Enem;Matr�cula na IES?;Pr�-selecionado em Bolsa Adicional?;Situa��o'){
			$titulo = explode(";",$buffer);
			//echo "<table border=1><th>Campus</th><th>Curso</th><th>habilitacao</th><th>Turno</th><th>Tipo de Bolsa</th><th>Bolsa</th>";
			//foreach($titulo as $v){
			//	echo "<th>".$v."</th>";
			//}
			
			$lista = true;
			$cont=0;
		}
		
		
		if($lista){
			
			if($cont >0){
				
				if(eregi(";;;;;;;",$buffer)){
					$lista = false;
					//echo "</table><br><br>";
				}else{
					$aluno = explode(";",$buffer);
					
					
					if(trim($aluno[8]) == "Pr�-Selecionado em 1� Chamada")
					{
					
						//verificar se est� no wpessoa
						$wpessoa = $dbData->Row($dbData->Get("SELECT cawpesdet.id FROM cawpesdet,caevxwpes,wpessoa WHERE cawpesdet.nome='Nota do ENEM' 
																	and cawpesdet.caevxwpes_id = caevxwpes.id and caevxwpes.wpessoa_id = wpessoa.id and cpf= '".trim($aluno[4])."' order by 1"));
						
						
						
						if($wpessoa[ID] != "")
						{
							
							echo $wpessoa[ID] . "<br>";
							
							
							$dbData->Set("update cawpesdet set valor='".trim($aluno[3])."' where id=".$wpessoa[ID] );
							
							/*
							//inserir na caevxwpes
							
							$CAEvXWPes_Id		 	= $dbData->GetInsertedId("caevxwpes_id");
							
							$ar["Curso"]	 		= trim($curso);
							$ar["Campus"]	 		= trim($unidade);
							$ar["Habilita��o"]	 	= trim($habilitacao);
							$ar["Per�odo"]	 		= trim($turno);
							$ar["Tipo de Bolsa"]	= trim($tipo_bolsa);
							$ar["Classifica��o"]	= trim($aluno[0]);
							$ar["Op��o"]	 		= trim($aluno[1]);
							$ar["Nota do ENEM"]	 	= trim($aluno[3]);
							$ar["M�dia do ENEM"]	= trim($aluno[5]);
							$ar["Matr�cula"]	 	= trim($aluno[6]);
							$ar["Bolsa Adicional"]	= trim($aluno[7]);
							$ar["Situa��o"]	 		= trim($aluno[8]);
							$ar["Cota"]	 			= trim($bolsa);
							
							
							//pegar o tipo de bolsa
							
							if($ar["Bolsa Adicional"] == "Sim")
								$descBolsa = "Normal";
							else
								$descBolsa = "Obrigat�ria";
						
							$tipoBolsa = $dbData->Row($dbData->Get("SELECT casenhati.id as id FROM casenhati WHERE caassunto_id in ( SELECT id FROM caassunto WHERE caevento_id = '199700000000013') AND casenhati.descricao = '".$descBolsa."'"));
							
							$ar["CASENHATI_ID"] = $tipoBolsa[ID];
							
							
							foreach($ar as $key => $valor)
							{
								
								$dbData->Set("INSERT INTO cawpesdet (caevxwpes_id, nome, valor) VALUES (".$CAEvXWPes_Id.", '".$key."', '"._NVL($valor)."')");
								
							}
							
							*/
						
						}
						else 
						{
							echo $count++ . ' j� tenho cadastro<br>';
						}
						
				
					}
					
					

		

				
			
				}
			}
			$cont++;
		
		}
	
}

$dbData->Commit();

fclose ($fd);
?>