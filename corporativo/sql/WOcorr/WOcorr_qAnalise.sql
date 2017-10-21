select
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)       as Aluno,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)          as Codigo,
  WOcorrAss.NomeNet                            as Assunto,
  to_char(WOcorr.Dt,'DD/MM/YYYY HH24:MI:SS')   as DtHora,
  WOcorrAss.TempoResposta                      as Prazo,
  WOcorr.Id                                    as WOcorr_Id,
  WOcorr.US                                    as Usuario,
  WOcorrAss.Id                                 as WOcorrAss_Id,
  WOcorr.Boleto_Id                             as Boleto_Id,
  WOcorr_gnNumOcorrencia(Wocorr.Id)            as NumOcorrencia
from
  WOcorrAss,
  WOcorr
where
  WOcorrAss.Id = WOcorr.WOcorrAss_Id
and
  WOcorr.Id in $v_WOcorr_Grupo_Id
order by
  Aluno


