select
	StateTi.*,
	StateTi.Nome as Recognize
from
	StateTi
where
	StateTi.Id = p_StateTi_Id 