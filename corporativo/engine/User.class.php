<?php

session_name ("optimizer");
session_start ();


require_once ("../lib/general.php");

/**
 * Classe User 
 *
 */
class User
{
	private $id;
	private $user;
	private $name;
	private $pass;
	private $dept;
	private $currDept;
	private $roles;
	private $currUnit;
	private $unit;
	private $ipaddr;

	/**
	 * 	Construtor da classe User	 
	 *	@param string $user = usuário
	 *	@param string $pass = senha
	 *	@param string $dept	= departamento
	 */
	function __construct($user = "", $pass = "", $dept = "")
	{
		if ($user != "")
		{
			$this->user 	= $user;
			$this->pass 	= $pass;
			$this->currDept = $dept;
		}
		else
		{
			if ($_SESSION[p_WPessoa_Id] != "")
			{
				
				if($_SESSION[ipaddr] == "")
				{
					
					header("Location:../sys/logoff.php");
					exit(0);
					
				}
				
				$this->id 			= $_SESSION[p_WPessoa_Id];
				$this->name 		= $_SESSION[nome];
				$this->user 		= $_SESSION[user];
				$this->pass 		= $_SESSION[pass];
				$this->dept 		= $_SESSION[dept];
				$this->roles 		= explode("  ",trim($_SESSION[groups]));
				$this->currDept 	= $_SESSION[Depart_Id];
				$this->currUnit 	= $_SESSION[unidade_atual];
				$this->unit 		= $_SESSION[unidades];
				$this->ipaddr 		= $_SESSION[ipaddr];
			}
		}
				
	}


	function GetUser()
	{
		return $this->user;
	}

	function GetPass()
	{
		return $this->pass;
	}

	function GetDept()
	{
		return $this->dept;
	}

	function GetName()
	{
		return $this->name;
	}

	function GetIpaddr()
	{
		return $this->ipaddr;
	}

	function GetRoles(){
			
		return $this->roles;
			
	}

	function GetCurrUnit()
	{
		return $this->currUnit;
	}

	function GetUnits()
	{
		return $this->unit;
	}

	function GetCurrDept()
	{
		return $this->currDept;
	}

	function GetId()
	{
		return $this->id;
	}

}
?>