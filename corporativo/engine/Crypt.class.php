<?php

    class Crypt
    {
    	
    	public function __construct($db)
    	{
    	
    		$this->db = $db;
    		
    	}

    	
    	//Retorna um array com o primeiro elemento sendo a string com o Hash e o segundo elemento a data de geração.
    	public function GetHash($sTexto)
    	{
    		require_once('../engine/Db.class.php');
    		
    		$dbData = new DbData($this->db);
    		
    		$count = 0; 
    		$vshowHash = '';
    		while ($vHash == '')
    		{
    			$dData = date("d/m/Y H:i:s");
	    		$hash = hash_init ("md5");
    			hash_update ($hash, $sTexto . $dData);
    			$showHash = strtoupper(hash_final($hash));
    			
    			$dbData->Get("select count(*) as Qtde from AutDoc where Hash = '$showHash'");

    			$row = $dbData->Row();
    			if ($row["QTDE"] == 0)
    			{
    				$vHash = $showHash;
    				break;
    			}
    			
    			sleep(1);
    			
    			if ($count++ > 10) 
    				return NULL;    			
    		}
    		
    		$aHash["HASH"] = $vHash;
    		$aHash["DATA"] = $dData;
    		
    		return $aHash;
    		
    	}
    	
    }
    
?>
