select
	CriAvalNota.*
from
	CriAvalNota
where
	CriAvalNota.CriAval_Id = p_CriAval_Id
and
	CriAvalNota.NotaTi_Id = p_NotaTi_Id
order by 
	Atributo