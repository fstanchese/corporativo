select
  	WOcorrinf.*,
  	WOcorrinf_gsConteudo(conteudo,informacao) as Conteudo_Recognize,
  	WOcorrinf_gsInformacao(Informacao)        as Informacao_Recognize,
  	WOcorr_gnRetWOcorrAss(WOcorr_Id)          as WOcorrAss_Id
from
  	WOcorrinf
where
  	WOcorr_Id = p_WOcorr_Id 
order by
  	Informacao