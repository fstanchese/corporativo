select 
	Id,
	Nome,
	DiscCat_gsRecognize(Id) as recognize
from 
  	DiscCat 
order by
	Nome