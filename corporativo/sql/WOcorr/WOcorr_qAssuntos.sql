select
  WOcorr.Id                                                                          as Id,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)                                             as WPessoa_Recognize,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                                                as WPessoa_Codigo,
  to_char(WOcorr.Dt,'dd/mm/yyyy HH24:mi')                                            as Data,
  WOcorr.Us                                                                          as Usuario,
  State_gsRecognize(WOcorr.State_id)                                                 as Situacao,
  nvl(Num,WOcorr_gnNumOcorrencia(WOcorr.Id))                                         as Ocorrencia,
  Recebimento.DtPagto                                                                as DtPagto,
  WOcorr_gsRetDeferimento(WOcorr.Id)                                                 as Deferimento,
  matric_gnRetCurso(wocorr_gsretmatricula(WOcorr.Id))                                as Curso_Id,
  shortname(curso_gsRetNome(matric_gnRetCurso(wocorr_gsretmatricula(WOcorr.Id))),30) as Curso_Recognize
from
  WOcorr,
  Recebimento,
  Boleto
where
  Boleto.Id = Recebimento.Boleto_Id (+)
and
  WOcorr.Boleto_Id = Boleto.Id (+)
and
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  (
    WOcorr.State_Id =  p_O_Check1
  or
    p_O_Check1 is null
  )
and
  trunc(WOcorr.Dt) between p_O_Data1 and p_O_Data2
and
  WOcorrass_Id = p_WOcorrAss_Id
order by
  WPessoa_Recognize
