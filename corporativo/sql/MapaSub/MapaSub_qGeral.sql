select
	MapaSub.*,
	Mapa.Nome || ' - ' || MapaSub.Nome as Recognize
from
	Mapa,
	MapaSub
where
	Mapa.Id = MapaSub.Mapa_Id
order by Recognize