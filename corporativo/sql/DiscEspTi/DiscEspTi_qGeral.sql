select
	DiscEspTi.*,
  	DiscEspTi_gsRecognize(Id) as recognize
from
	DiscEspTi
order by
	Recognize