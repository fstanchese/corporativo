select
	CASenhaRegra.*,
	CASenhaRegra_gsRecognize(CASenhaRegra.Id) as Recognize,
	CAEvento_gsRecognize(CAEvento_Id) || ' - ' || CASenhaTi_gsRecognize(CASenhaRegra.CASenhaTi_Id) as CASenhaTi_Recognize
from
	CASenhaRegra,
	CASenhaTi,
	CAAssunto
where
	CASenhaTi.CAAssunto_Id = CAAssunto.Id
and
	CASenhaRegra.CASenhaTi_Id = CASenhaTi.Id
and
	(
		CASenhaTi_Id = p_CASenhaTi_Id
	or
		p_CASenhaTi_Id is null
	)
order by 
	CASenhaTi_Recognize,Sequencia