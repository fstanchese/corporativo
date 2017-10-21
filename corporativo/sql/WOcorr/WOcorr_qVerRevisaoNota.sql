select
  WOcorr_Id,
  WOcorrAss_Id,
  Conteudo
from
  WOcorrinf,
  WOcorr
where
  WOcorr.State_Id <> 3000000011005
and
  WOcorr.Id = WOcorrInf.WOcorr_Id
and
  WOcorr.WPessoa_Id = p_WPessoa_Id
order by wocorr_id,conteudo desc