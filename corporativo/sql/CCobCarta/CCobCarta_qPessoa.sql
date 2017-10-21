select
	CCobCarta.*,
	WPessoa_gsRecognize(CCobCarta.WPessoa_Id) as Pessoa,
	WPessoa_gsRecognize(CCobCarta.WPessoa_Id) || ' - ' || (CCobCarta.Id - 208600000000000) || ' - ' || CCobCarta.Dt  as Recognize
from
	CCobCarta
where
	CCobCarta.WPessoa_Id = p_WPessoa_Id
order by
	Recognize