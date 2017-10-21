select
  WPessoa.Nome                                                                  as Usuario,
  Depart_gsRecognize(WPessoa.Depart_Id)                                         as Departamento,
  to_char(WOcorrFluxo.Dt,'DD/MM/YYYY HH24:MI:SS')                               as DtHora,
  WOcorrFluxo.Id                                                                as WOcorrFluxo_Id,
  WOcorrFluxo.Texto                                                             as TextoDigitado,
  WOcorrAssReP.Descricao                                                        as RespostaPadrao,
  SimNao_gsRecognize(SimNao_Defer_Id)                                           as DEFERIDO,
  WOcorrFluxo.Depart_Id                                                         as DepartamentoAtual,
  nvl(Depart_gsRecognize(Depart_Resp_Id),Depart_gsRecognize(WPessoa.Depart_Id)) as DepartamentoResp,
  DtAnexo                                                                       as DtAnexo,
  WOcorrFluxo.RespInternet                                                      as RespInternet,
  WOcorrFluxo.Us                                                                as WOcorrFluxo_Us,
  WOcorrFluxo.DtAnexo                                                           as DtAnexo,
  WOcorrFluxo.UsAnexo                                                           as UsAnexo,
  WOcorrFluxo.Inativo                                                           as Inativo 
from
  WOcorrFluxo,
  WOcorrAssReP,
  WPessoa
where
  lower(WOcorrFluxo.US) = WPessoa.Usuario (+)
and
  WOcorrFluxo.WOcorrAssReP_Id = WOcorrAssReP.Id (+)
and
  (
    WOcorrFluxo.Inativo = p_WOcorrFluxo_Inativo
  or
    p_WOcorrFluxo_Inativo is null
  )
and
  WOcorrFluxo.WOcorr_Id = p_WOcorr_Id 
order by
  WOcorrFluxo.Dt