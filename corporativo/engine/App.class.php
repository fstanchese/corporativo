<?php

//set_time_limit(600);

require_once ("../lib/general.php");

/**
 * Classe App 
 * Respons�vel por controlar cada aplica��o (p�gina) do sistema. 
 *		Verificar a vers�o do navegador.
 * 		Verificar se o usu�rio est� logado.
 *		Verificar se possui permiss�o para acessar a aplica��o.
 */
class App
{
	public $title; //T�tulo da Aplica��o
	public $description; //Descri��o da Aplica��o
	public $roles; //Lista de Roles da Aplica��o

	/**
	 * 	Construtor da classe App	
	 *	@param unknown $title
	 *	@param unknown $description
	 *	@param unknown $roles
	 *	@param unknown $user	 	
	 */
	public function __construct($title, $description, $roles, $user)
	{
		
		// Verifica o navegador do usu�rio. Caso o mesmo n�o tenha suporte a HTML 5 ou CSS 3,
		// uma mensagem de 'Navegador Inv�lido' aparece na tela.
		$version = intval(trim(substr($_SERVER[HTTP_USER_AGENT], strpos("Mozilla", $_SERVER[HTTP_USER_AGENT]) + 8, 4)));
		
		if ($version < 5)
		{
			die("Navegador inv�lido.");
		}		
		
		//Verifica se o usu�rio est� logado, ou seja, se passou pelo Login antes de acessar essa aplica��o. 
		//Caso n�o esteja logado, � direcionado para a tela de Login.
		if($user->GetUser() == NULL || $_SESSION[user] == "")
		{			
			
			$path = explode("/",$_SERVER[PHP_SELF]);
			
			if($_SERVER[QUERY_STRING] != "")
			{
				$pQueryString = "?".$_SERVER[QUERY_STRING];
				
			}
			
			header("Location:../sys/login.php?p_url=".urlencode($path[count($path)-2]."/".reset(explode(".",$path[count($path)-1])).".php".$pQueryString));
			
			return false;
		}
			
		$this->title = $title;
			
		$this->description = $description;
			
		$this->roles = $roles;					
			
		if(!$this->CheckAccess($user->GetRoles()))
		{
			header("Location:./busca.php");
			return false;
		}			
			
	}

	/**
	 *  M�todo respons�vel por verificar o tipo de acesso.	
	 *  Sendo chamado no construtor da classe para verificar se o usu�rio possui uma ou mais Roles que a Aplica��o possui.	
	 *	@param array $roles
	 *	@return boolean	 
	 */
	public function CheckAccess($roles)
	{
		if(!is_array($roles)) 
		{
			return false; //Caso n�o possua nenhuma role
		}

		foreach($roles as $role)
		{
			if(array_search($role, $this->roles) !== FALSE)
			{
				return true; //Caso possua pelo menos uma role
			}
		}
			
		return false;
	}	
	
	/**
	 *  M�todo respons�vel por retornar as Roles da aplica��o.	
	 *	@return array roles	 
	 */	
	function GetRoles()
	{			
		return $this->roles;			
	}
	
}

?>