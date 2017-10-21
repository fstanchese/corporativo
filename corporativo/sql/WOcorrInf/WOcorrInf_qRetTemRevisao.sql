select
  count(*) as qtde
from
  WOcorrInf,
  WOcorr
where
  WOcorr.State_Id in (3000000011002,3000000011006)
and
  WOcorr.WOcorrAss_Id in (5100000000017,5100000000089)
and
  WOcorr.Id = WOcorrInf.WOcorr_Id
and
  WOcorrInf.Conteudo = p_WOcorrinf_Conteudo
and
  WOcorrInf.Informacao = 7
and
  WOcorrInf.WOcorr_Id in (
select
  WOcorrInf.WOcorr_Id
from
  WOcorrInf
where
  WOcorrInf.Conteudo= p_O_Option 
)