select
  WOcorrFluxo.*,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)   as Aluno,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)      as Codigo,
  to_char(WOcorr.Dt,'dd/mm/yyyy hh24:mi')  as DataHora,
  WOcorr_gnNumOcorrencia(WOcorr.Id)        as NumOcorrencia
from
  WOcorrFluxo,
  WOcorr
where
  WOcorrFluxo.WOcorr_Id = WOcorr.Id
and
  WOcorrFluxo.Id = nvl( p_WOcorrFluxo_Id ,0) 