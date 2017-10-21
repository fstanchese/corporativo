<?php

//set_time_limit(600);

require_once ("../lib/general.php");

/**
 * Classe App 
 * Responsбvel por controlar cada aplicaзгo (pбgina) do sistema. 
 *		Verificar a versгo do navegador.
 * 		Verificar se o usuбrio estб logado.
 *		Verificar se possui permissгo para acessar a aplicaзгo.
 */
class App
{
	public $title; //Tнtulo da Aplicaзгo
	public $description; //Descriзгo da Aplicaзгo
	public $roles; //Lista de Roles da Aplicaзгo

	/**
	 * 	Construtor da classe App	
	 *	@param unknown $title
	 *	@param unknown $description
	 *	@param unknown $roles
	 *	@param unknown $user	 	
	 */
	public function __construct($title, $description, $roles, $user)
	{
		
		// Verifica o navegador do usuбrio. Caso o mesmo nгo tenha suporte a HTML 5 ou CSS 3,
		// uma mensagem de 'Navegador Invбlido' aparece na tela.
		$version = intval(trim(substr($_SERVER[HTTP_USER_AGENT], strpos("Mozilla", $_SERVER[HTTP_USER_AGENT]) + 8, 4)));
		
		if ($version < 5)
		{
			die("Navegador invбlido.");
		}		
		
		//Verifica se o usuбrio estб logado, ou seja, se passou pelo Login antes de acessar essa aplicaзгo. 
		//Caso nгo esteja logado, й direcionado para a tela de Login.
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
	 *  Mйtodo responsбvel por verificar o tipo de acesso.	
	 *  Sendo chamado no construtor da classe para verificar se o usuбrio possui uma ou mais Roles que a Aplicaзгo possui.	
	 *	@param array $roles
	 *	@return boolean	 
	 */
	public function CheckAccess($roles)
	{
		if(!is_array($roles)) 
		{
			return false; //Caso nгo possua nenhuma role
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
	 *  Mйtodo responsбvel por retornar as Roles da aplicaзгo.	
	 *	@return array roles	 
	 */	
	function GetRoles()
	{			
		return $this->roles;			
	}
	
}

?>