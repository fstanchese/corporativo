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
  WOcorr,   
  WOcorrAss   
where   
  (   
    WOcorr.Campus_Id = p_Campus_Id   
  or   
    p_Campus_Id is null   
  )   
and   
  (   
    WOcorrAss.Id = p_WOcorrAss_Id   
  or   
    p_WOcorrAss_Id is null   
  )   
and   
  WOcorrAss.Nuprajur is null
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id   
and   
  WOcorr.State_Id = 3000000011006   
order by Aluno