select
	CAEvento.*,
	to_char(CAEvento.DtInicio,'dd/mm/yyyy hh24:mi') as DtInicio_Format,
	to_char(CAEvento.DtTermino,'dd/mm/yyyy hh24:mi') as DtTermino_Format
from
	CAEvento
where
	CAEvento.Id = p_CAEvento_Id 
