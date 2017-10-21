select
 	CriAvalNota.*,
	NotaTi_gsRecognize(NotaTi_Id) as NotaTi_Recognize,
	CriAval_gsRecognize(CriAval_Id) as CriAval_Recognize
from
	CriAvalNota
order by CriAval_Recognize,Atributo