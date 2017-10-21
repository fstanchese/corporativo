select
	distinct(DiscEsp.PLetivo_Id),  
  	PLetivo_gsrecognize(PLetivo_Id) as inicio
from   
  	DiscEsp   
order by
  	1 desc