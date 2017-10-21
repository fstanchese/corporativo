select   
	DiscEsp.Id,  
	DiscEsp.PLetivo_Id,  
	DiscEsp_gsrecognize(DiscEsp.Id) as recognize
from   
  	DiscEsp   
where
  	DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by
	DiscEsp.Nome