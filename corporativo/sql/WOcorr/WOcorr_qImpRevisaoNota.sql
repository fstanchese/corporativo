select
  WOcorrInf.Conteudo                      as WPessoa_Prof_Id,
  WPessoa_gsRecognize(WOcorrInf.Conteudo) as Professor,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)  as Aluno,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)     as Codigo_Aluno,
  WOcorr.Id                               as WOcorr_Id,
  WOcorr_gnNumOcorrencia(WOcorr.Id)       as NumOcorrencia,
  WOcorr.Campus_Id                        as Campus_Id,
  Campus_gsRecognize(WOcorr.Campus_Id)    as Campus_Recognize,
  WOcorrinf_gsRetConteudo(WOcorr.Id,8)    as GradAlu_Id
from
  WOcorr,
  WOcorrInf
where
  WOcorrInf.Informacao = 34
and
  WOcorr.Id = WOcorrInf.WOcorr_Id
and
  WOcorr.Id in 
  (      
    select 
      WOcorr_Id 
    from 
      WOcorrInf
    where
      Conteudo = to_char( p_HoraProva_CriAvalPDt_Id )
  )
and
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  (
    WOcorr.State_Id = p_State_Id
  or
    p_State_Id is null
  )
and
  WOcorrAss_Id = 5100000000017
order by 7,2,3
