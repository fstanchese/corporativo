<?php

require_once ("../engine/View.class.php");

/**
 * Classe Db
 * Classe de conexï¿½o com o Banco de Dados (db layer).
 * Cada instï¿½ncia do objeto armazena uma conexï¿½o com um banco de dados. 
 * 
*/
class Db
{
	public $cn; // @var Resource. Conexï¿½o do banco de dados
	public $type = 'oracle'; //@var string  Indica a qual banco serï¿½ feita a conexï¿½

	/**
	 * 	Construtor da classe Db responsï¿½vel por verificar o tipo de banco de dados e abrir a conexï¿½o com o mesmo.	
	 *	@param object $user = Objeto User
	 *	@param string $type	= tipo de banco
	 */
	public function __construct ($user,$type = '',$paramConn="")
	{
		
		$this->type = $type;
		
		if ($this->type == "mysql")
		{

			$paramConn = explode("|",$paramConn);
			
			
			$this->cn = mysql_connect ($paramConn[0], $paramConn[1], $paramConn[2]);

			if(!mysql_select_db ($paramConn[3], $this->cn))
				{
					echo "Erro de conexão MySQL";
					exit (0);
				}
				
				
			
		}
		else if($this->type == "sqlserver")
		{
			$this->cn = mssql_connect($arParamCon["HOST"], $arParamCon["USER"], $arParamCon["PASS"]);
			
			if(!mssql_select_db ($arParamCon["DB"], $this->cn))
				{
					echo "Erro de conexão SQL SERVER!";
					exit (0);
				}
			
			
				
		}
		else
		{
			
			$db = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP) (HOST = dbcorp.usjt.br)(PORT = 1521)) (CONNECT_DATA= (SID = dbcorp)))";
				
			
			if($paramConn[USER] != "")
			{
				if (!$this->cn = ocilogon ($paramConn[USER], $paramConn[PASS], $db))
				{
					echo "Erro de conexão Oracle";
					exit (0);
				}
			}
			else 
			{
				if (!$this->cn = ocilogon ($user->GetUser(), $user->GetPass(), $db))
				{
					echo "Erro de conexão Oracle";
					exit (0);
				}
			}
			
			
		}
	}

	/**
	 *  Mï¿½todo responsï¿½vel por fechar a conexï¿½o com o banco de dados.	 
	 */
	public function __destruct()
	{
		if ($this->type == "" )
			ocilogoff($this->cn);
	}
}



/**
 * Classe DbData
 * Classe de execuï¿½ï¿½o dos comandos DDL no banco de dados (db layer).
 * Cada instï¿½ncia do objeto armazena uma conexï¿½o com um banco de dado. 
 *
 */
class DbData extends View
{
	public $db; //Recebe o Objeto Db @var Db Object Type
	public $row;
	public $pageQte = 30; //@var int Define a quantidade de registros na paginaï¿½ï¿½o
	public $numRows = 0; //@var int Quantidade de linhas na consulta SELECT
	private $arReturnQuery = array(); //Recebe um array de resultados da query Utilizado para Paginaï¿½ï¿½o
	private $currPage = 1; //@var int Pï¿½gina atual da Grid, quando utilizado a Paginaï¿½ï¿½o
	private $queryReady = ''; // @var string Armazena a instruï¿½ï¿½o SQL recebida no Get ou Set
	private $countLine = -1; // Utilizado para controlar a quebra do array na paginaï¿½ï¿½o. Quebra de acordo com a pï¿½gina atual e a quantidade de linhas por pï¿½gin
	private $arError = array(); //Utilizado para Debugar
	static $flagMsgError = 1;
	private $arRetorno = array();
	private $insertedId;

	/**
	 * 	Construtor da classe Db. Recebe a conexï¿½o Db @obj	 
	 *	@return
	 */
	function __construct ($dbb)
	{
		
	
		
		if (!is_resource ($dbb->cn)) exit ("DB Error");
		$this->db = $dbb;
		

	}

	
	/**
	 * Mï¿½todo responsï¿½vel por executar a query do tipo SELECT no banco de dados.
	 * Recebendo a instruï¿½ï¿½o SQL e atribuindo quantidade de linhas.	 
	 *	@param unknown $sql
	 *	@return
	 */
	public function Get ($sql)
	{
		$this->queryReady = $sql;
			
		if ($this->db->type == "mysql")
		{
			if(!$this->row = mysql_query ($this->queryReady))
			{
							
				if(strpos($_SERVER[PHP_SELF],"/gm/") !== FALSE)
				{
					
					if(self::$flagMsgError)
					{
						echo parent::MsgBox('error',"Erro MySQL","Erro de Banco de Dados. Informe ao TI");
					}
					$this->ReportError("GM","Erro no SELECT do MySQL",mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
					die();
				}
				else 
				{
					if(strpos($_SERVER[PHP_SELF],"/rc/") !== FALSE)
					{
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("RC","Erro no SELECT do MySQL",mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
					}
					else 
					{
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("TELA","Erro no SELECT do MySQL",mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
						die();
					}
				}
			}
			else
			{
				$this->numRows = mysql_num_rows($this->row);
			}
		}
		
		else if ($this->db->type == "sqlserver")
		{
			if(!$this->row = mssql_query ($this->queryReady))
			{
							
				if(strpos($_SERVER[PHP_SELF],"/gm/") !== FALSE)
				{
					
					if(self::$flagMsgError)
					{
						echo parent::MsgBox('error',"Erro SQL Server","Erro de Banco de Dados. Informe ao TI");
					}
					$this->ReportError("GM","Erro no SELECT do SQL Server",mssql_errno($this->db->cn) . ": " . mssql_error($this->db->cn));
					die();
				}
				else 
				{
					if(strpos($_SERVER[PHP_SELF],"/rc/") !== FALSE)
					{
						$this->arError[] = mssql_errno($this->db->cn) . ": " . mssql_error($this->db->cn);
						$this->ReportError("RC","Erro no SELECT do SQL Server",mssql_errno($this->db->cn) . ": " . mssql_error($this->db->cn));
					}
					else 
					{
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("TELA","Erro no SELECT do SQL Server",mssql_errno($this->db->cn) . ": " . mssql_error($this->db->cn));
						die();						
					}
				}
			}
			else
			{
				$this->numRows = mssql_num_rows($this->row);
			}
		}
		
		else
		{
			$stmt = oci_parse($this->db->cn, $sql);

			if(!$stmt)
			{
				$e = oci_error($stmt);
				
				if(strpos($_SERVER[PHP_SELF],"/gm/") !== FALSE)
				{
					
					if(self::$flagMsgError)
					{
						echo parent::MsgBox('error',"Erro Oracle","Erro de Banco de Dados. Informe ao TI");
					}
					
					$this->ReportError("GM","Erro no EXECUTE do SELECT no ORACLE",htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
					die();
					
					
				}
				else 
				{		
					if(strpos($_SERVER[PHP_SELF],"/rc/") !== FALSE)
					{
						$this->arError[] = htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext'])."\n";
						$this->ReportError("RC","Erro no EXECUTE do SELECT no ORACLE",htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
					}
					else
					{
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("TELA","Erro no EXECUTE do SELECT no ORACLE",htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
						die();
					}
						
				}
				
			}

			
			

			if(!oci_execute($stmt))
			{
				$e = oci_error($stmt);
					
				if(strpos($_SERVER[PHP_SELF],"/gm/") !== FALSE)
				{
				
					if(self::$flagMsgError)
					{
						echo parent::MsgBox('error',"Erro Oracle","Erro de Banco de Dados. Informe ao TI");
						
						
					}

					$this->ReportError("GM","Erro no EXECUTE do SELECT no ORACLE",htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
					die();
				}
				else 
				{
					if(strpos($_SERVER[PHP_SELF],"/rc/") !== FALSE)
					{							
						$this->arError[] = htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext'])."\n";
						$this->ReportError("RC","Erro no EXECUTE do SELECT no ORACLE",htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));					
					}
					else
					{
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("TELA","Erro no EXECUTE do SELECT no ORACLE",htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));					
						die();
					}
				}				
				
			}
			else
			{
				oci_fetch_all($stmt, $array);
				unset($array);
					
				$this->numRows = oci_num_rows($stmt);
				oci_free_statement($stmt);
					
				$parse = oci_parse ($this->db->cn, $sql);
				oci_execute ($parse);

				$this->row = $parse;
			}
		}
	}
	

	/**
	 * Mï¿½todo responsï¿½vel por 	 
	 */
	public function ShowError()
	{
		parent::Div("",array("class"=>"errorLog"));
			
		parent::Ul();
			
		foreach($this->arError as $erro)
		{
			echo parent::Li().$erro.parent::CloseLi();
		}
			
		parent::CloseUl();
		parent::CloseDiv();
			
	}

	/**	 
	 *	@param unknown $db
	 *	@return
	 */
	static function SetDb ($db)
	{
		$this->db = $db;
	}


	/**
	 *	 
	 *	@param unknown $msgError
	 *	@return
	 */
	static function ShowMsgError ($msgError)
	{
		self::$flagMsgError = $msgError;
	}

	/**
	 *  Mï¿½todo responsï¿½vel por retornar um array pronto para um Form tipo Select	 
	 *	@param unknown $sql = instruï¿½ï¿½o SQL
	 *	@return string = array com chave sendo ID e o valor sendo RECOGNIZE.
	 *  A query recebida obrigatoriamente deve ter ID e RECOGNIZE
	 */
	public function GetArray($sql)
	{
		$this->Get($sql);
			
		$arReturn[''] = ' Selecione ';
			
		while ($row = oci_fetch_assoc($this->row))
		{
			$arReturn[$row[ID]] = $row[RECOGNIZE];
		}
			
		return $arReturn;
	}

	/**
	 * 	Mï¿½todo responsï¿½vel por retornae a instruï¿½ï¿½o que foi executada. Debug da Query	 
	 *	@return
	 */
	public function ShowQuery()
	{
		echo "<pre>".str_replace("   ","<br>",$this->queryReady)."</pre>";
	}

	/**
	 * 	Mï¿½todo responsï¿½vel por executar a query do tipo INSERT, UPDATE, DELETE no banco de dados.	 
	 *	@param unknown $sql = instruï¿½ï¿½o SQL
	 *	@return boolean
	 *	@return
	 */
	public function Set ($sql)
	{
		$this->queryReady = $sql;

		if ($this->db->type == "mysql")
		{
			if(!$this->row = mysql_query ($this->queryReady, $this->db->cn))
			{
				
				if(strpos($_SERVER[PHP_SELF],"/gm/") !== FALSE)
				{
				
					if(self::$flagMsgError)
					{
						echo parent::MsgBox('error',"Erro MySQL","Erro de Banco de Dados. Informe ao TI");						
					}
					$this->ReportError("GM","Erro IUD MySQL", mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
					
					die();
				}
				else 
				{	
					if(strpos($_SERVER[PHP_SELF],"/rc/") !== FALSE)
					{							
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("RC","Erro IUD MySQL", mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
					}
					else
					{
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("TELA","Erro IUD MySQL", mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
						die();
					}						
				}
			}
			else
			{
				$this->insertedId = mysql_insert_id();					
			}

		}
		
		else if ($this->db->type == "sqlserver")
		{
			if(!$this->row = mssql_query($this->queryReady, $this->db->cn))
			{
				
				if(strpos($_SERVER[PHP_SELF],"/gm/") !== FALSE)
				{				
					if(self::$flagMsgError)
					{
						echo parent::MsgBox('error',"Erro SQL Server","Erro de Banco de Dados. Informe ao TI");
						
					}
					
					$this->ReportError("GM","Erro IUD SQL Server", mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
					die();
				}
				else
				{
					if(strpos($_SERVER[PHP_SELF],"/rc/") !== FALSE)
					{							
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("RC","Erro IUD SQL Server", mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
					}
					else
					{
						$this->arError[] = mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn);
						$this->ReportError("TELA","Erro IUD SQL Server", mysql_errno($this->db->cn) . ": " . mysql_error($this->db->cn));
						die();
					}						
				}					
			}
			else 
			{
				$result = mssql_fetch_assoc(mssql_query("select @@IDENTITY as id"));
				$this->insertedId = $result['id'];
			}

		}
		
		else
		{
			echo  $this->queryReady; 
			$parse = oci_parse ($this->db->cn, $this->queryReady);

			if(!$parse)
			{
				$e = oci_error($stmt);

				if(strpos($_SERVER[PHP_SELF],"/gm/") !== FALSE)
				{
				
					if(self::$flagMsgError)
					{
						echo parent::MsgBox('error',"Erro Oracle","Erro de Banco de Dados. Informe ao TI");
					}
					
					$this->ReportError("GM","Erro no PARSE do ORACLE",htmlentities("Cï¿½digo: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
					die();
				}
				else 
				{
					if(strpos($_SERVER[PHP_SELF],"/rc/") !== FALSE)
					{							
						$this->arError[] = htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext'])."\n";					
						$this->ReportError("RC","Erro no PARSE do ORACLE",htmlentities("Cï¿½digo: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
					}
					else
					{
						$this->arError[] = htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext'])."\n";					
						$this->ReportError("TELA","Erro no PARSE do ORACLE",htmlentities("Cï¿½digo: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
						die();
					}						
				}
				return FALSE;
				
			}
			else
			{
				if(!oci_execute ($parse))
				{
					$e = oci_error($stmt);

					if(strpos($_SERVER[PHP_SELF],"/gm/") !== FALSE)
					{
					
						if(self::$flagMsgError)
						{
							echo parent::MsgBox('error',"Erro Oracle","Erro de Banco de Dados. Informe ao TI");
						}
						
						$this->ReportError("GM","Erro no EXECUTE do ORACLE",htmlentities("Cï¿½digo: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
						die();
					}
					else
					{
						if(strpos($_SERVER[PHP_SELF],"/rc/") !== FALSE)
						{						
							$this->arError[] = htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext'])."\n";						
							$this->ReportError("RC","Erro no EXECUTE do ORACLE",htmlentities("Cï¿½digo: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
						}
						else
						{
							$this->arError[] = htmlentities("Código: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext'])."\n";						
							$this->ReportError("TELA","Erro no EXECUTE do ORACLE",htmlentities("Cï¿½digo: ".$e[code]." - ".$e['message'])."<br>".htmlentities($e['sqltext']));
							die();
						}							
					}
					return FALSE;
					//
				}
				else
				{
					$this->row = $parse;
				}
			}
		}
			
		return true;
	}

	/**
	 *	
	 *	@param string $sequence
	 *	@return number|Ambigous <>
	 */
	public function GetInsertedId($sequence = "")
	{
		if($this->insertedId != "")
		{
			return $this->insertedId;
		}

		$this->Get("SELECT usjt.".$sequence.".currval AS Id FROM dual");

		$row = $this->Row();

		return $row[ID];
	}

	/**
	 *  Mï¿½todo responsï¿½vel por retorna a quantidade de linhas.	 
	 *	@return number
	 *	@return
	 */
	public function Count ()
	{
		return $this->numRows;
	}

	/**
	 *	
	 *	@return multitype:
	 *	@return
	 */
	public function Row ()
	{
		if ($this->db->type == "mysql")
		{
			
			return mysql_fetch_assoc($this->row);
			
		}
		else if ($this->db->type == "sqlserver")
		{
			return mssql_fetch_assoc($this->row);
			
		}
		else 
		{
			return oci_fetch_assoc($this->row);
		}
	}

	/**
	 *	
	 *	@param number $page
	 *	@param string $limit
	 *	@return multitype:
	 *	@return
	 */
	public function RowLimit ($page=1,$limit="")
	{
		
		if($limit != "")
		{
			$this->pageQte = $limit;
		}
			
			
		if(is_numeric($page))
		{
			$this->currPage = $page;
		}
			
		if($this->arReturnQuery[0] == '')
		{
			
			if ($this->db->type == "mysql")
			{
				while ($row = mysql_fetch_assoc($this->row))
				{
				
					$this->arReturnQuery[] = $row;
				
				}	
				
			}
			else if ($this->db->type == "sqlserver")
			{
				while ($row = mssql_fetch_assoc($this->row))
				{
				
					$this->arReturnQuery[] = $row;
				
				}	
				
			}
			else 
			{
			
			
				while ($row = oci_fetch_assoc($this->row))
				{
	
					$this->arReturnQuery[] = $row;
	
				}
			}
		}
 
		if($this->countLine == -1)
		{
			$this->arRetorno = array_slice($this->arReturnQuery, $this->currPage*$this->pageQte - $this->pageQte,$this->pageQte);

		}
		$this->countLine++;

		
		return $this->arRetorno[$this->countLine];
			
	}

	/**
	 * Mï¿½todo responsï¿½vel por 
	 *
	 */
	public function Commit()
	{
		if ($this->type == "oracle")
		{
			oci_commit($this->db->cn);
		}
	}


	/**
	 *  Mï¿½todo responsï¿½vel por realizar a paginaï¿½ï¿½o de conteï¿½do de tabelas html.		 
	 */
	public function Pagination()
	{

		
		
		$total_pages = ceil($this->numRows/$this->pageQte);

		if($_SERVER[QUERY_STRING] != "")
		{
			$aux = explode("&",$_SERVER[QUERY_STRING]);

			for($z=0;$z<count($aux);$z++)
			{
				if(!eregi("page",$aux[$z]))
				{
					$query .= "&".$aux[$z];
				}
			}
		}

		$html .= parent::Br();
			
		
		
		$html .= parent::Div(array("class"=>"divPagination"));

		if ( $this->currPage > 1 )
		{
			$html .= parent::Link("<<<",array('href'=>"$url?page=1$query"));
		}

			
		for( $i = ($this->currPage-5); $i <= $this->currPage+5; $i++ )
		{
			if ($i < 1)
			{
				continue;
			}

			if ( $i > $total_pages )
			{
				break;
			}

			if ( $i != $this->currPage )
			{
				$html .= parent::Link($i,array('href'=>"$url?page=$i$query"));
			}

			else
			{
				
				$html .= parent::Span(array("class"=>"pag_ativa")).$i.parent::CloseSpan();
			}
		}
			
			
		if ( $this->currPage < $total_pages )
		{
			$html .= parent::Link(">>>",array('href'=>"$url?page=$total_pages".$query));
		}
			
		$html .= parent::CloseDiv();
		
		echo $html;
	}
	
	
	public function ReportError($to,$subject,$msg)
	{
		
		$arEmail["GM"] = "framework.ti.gm@usjt.br";
		$arEmail["RC"] = "framework.ti.rc@usjt.br";
		
		$msg .= "<br> 
					IP: ".$_SESSION[ipaddr].$this->Br()."
				<br>
					Página: ".$_SERVER[PHP_SELF]."
				<Br>
					Data: ".date('d/m/Y H:i')."
				<br>
					Usuário: ".$_SESSION[user]."
				<br><br>
					Dados do Navegador: ".$_SERVER[HTTP_USER_AGENT]."
				<br><br>
					Print do Array enviado:
				<br><br>
					<pre>".print_r($_REQUEST,true)."</pre>
				";
		
		if ($to == "TELA")
		{
			echo $msg . ' <BR>';				
			$to = "RC";
		}

		_SendMail($arEmail[$to],$subject,$msg,'framework@usjt.br');
		
		die();
		
		
	}
	
	
	
	

}
?>
