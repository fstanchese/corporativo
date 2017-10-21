select
	AutDocElem.Valor
from
	AutDocElem
where
	AutDocElem.Tag = p_AutDocElem_Tag
and
	AutDocElem.AutDoc_Id = p_AutDocElem_AutDoc_Id 