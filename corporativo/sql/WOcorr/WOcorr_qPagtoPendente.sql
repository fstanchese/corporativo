select
  WOcorr.Id                               as Id,
  WOcorr.WOcorrAss_Id                     as WOcorrAss_Id,
  WOcorr_gnNumOcorrencia(WOcorr.Id)       as CodOcorr,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)     as Codigo,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)  as Nome,
  to_char(WOcorr.Dt,'dd/mm/yyyy hh24:mi') as DtSolicitacao
from
  Boleto,
  WOcorr
where
  WOcorr.Dt between p_O_Data1 and p_O_Data2
and
  Boleto.State_Base_Id = 3000000000006
and
  WOcorr.Boleto_Id = Boleto.Id
and
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  (
    WOcorr.WOcorrAss_Id = p_WOcorrAss_Id
  or
    p_WOcorrAss_Id is null
  )
order by nome, wocorr.dt
