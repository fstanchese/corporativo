select  
	id, 
	procname,  
	guiname,  
	replace(guidescription,'()','') as GUIDESCRIPTION,  
	SECURITYGROUPS 
from
	indexGUI 
where
	upper(guiname||' '||guidescription) like '%'||replace(upper( p_O_Search ),' ','%')||'%' 
and
	trim( p_O_Search ) is not null 
order by  
	guiname