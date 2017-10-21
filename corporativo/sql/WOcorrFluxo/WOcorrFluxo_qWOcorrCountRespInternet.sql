select
  count(WOcorrFluxo.Id) as QtdeRespostas
from
  WOcorrFluxo,
  WOcorrAssReP,
  WPessoa
where
  lower(WOcorrFluxo.US) = WPessoa.Usuario (+)
and
  WOcorrFluxo.WOcorrAssReP_Id = WOcorrAssReP.Id (+)
and
  WOcorrFluxo.RespInternet = 'on'
and
  WOcorrFluxo.WOcorr_Id = p_WOcorr_Id 
