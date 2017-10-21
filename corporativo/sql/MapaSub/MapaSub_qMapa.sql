select
	MapaSub.*,
	MapaSub.Nome as Recognize
from
	MapaSub
where
	MapaSub.Mapa_Id = p_Mapa_Id 
order by
	MapaSub.Nome