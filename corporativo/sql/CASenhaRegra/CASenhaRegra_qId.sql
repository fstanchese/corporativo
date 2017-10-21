select
	CASenhaRegra.*,
	CASenhaTi_gsRecognize(CASenhaRegra.CASenhaTi_Id) as CASenha_Recognize
from
	CASenhaRegra
where
	CASenhaRegra.Id = p_CASenhaRegra_Id 
