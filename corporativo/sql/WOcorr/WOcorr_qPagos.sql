select
  WOcorr.Id                               as Id,
  WOcorr_gnNumOcorrencia(WOcorr.Id)       as CodOcorr,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)     as Codigo,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)  as Nome,
  to_char(WOcorr.Dt,'dd/mm/yyyy hh24:mi') as DtSolicitacao,             
  Recebimento.DtPagto                     as DtPagto
from
  Recebimento,
  Boleto,
  WOcorr
where
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
and
  WOcorr.Boleto_Id = Boleto.Id
and
  Boleto.Id = Recebimento.Boleto_Id
and
  Recebimento.DtPagto between p_O_Data1 and p_O_Data2
order by wocorr.dt,nome