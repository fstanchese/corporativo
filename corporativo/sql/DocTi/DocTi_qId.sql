select
	DocTi.*,
	DocTi.Nome as Recognize
from
	DocTi
where
	DocTi.Id = p_DocTi_Id 