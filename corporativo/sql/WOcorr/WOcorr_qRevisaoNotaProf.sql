select
  WPessoa_gsRecognize(WOcorrInf.Conteudo)                       as Professor,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)                        as Aluno,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                           as Codigo,
  WOcorr.Id                                                     as WOcorr_Id,
  WOcorr.Campus_Id                                              as Campus_Id,
  Campus_gsRecognize(WOcorr.Campus_Id)                          as Campus_Nome,
  WOcorr.State_Id                                               as State_Id,
  CriAvalPDt_gsRecognize(WOcorrInf_gsRetConteudo(Wocorr.Id,7))  as Semestre,
  WOcorr.WPessoa_Id                                             as WPessoa_Aluno_Id
from
  WOcorr,
  WOcorrInf
where
  (
    WOcorr.State_Id = p_State_Id
  or
    p_State_Id is null
  )
and
  (
    WOcorrInf.Conteudo = nvl( p_WPessoa_Id , 0 )
  or
    p_WPessoa_Id is null
  )
and
  WOcorrInf.Informacao = 34
and
  WOcorr.Id = WOcorrInf.WOcorr_Id
and
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  WOcorr.Id in 
  (      
    select 
      WOcorr_Id 
    from 
      WOcorrInf
    where
      Conteudo = p_CriAvalPDt_Id 
  )
and
  WOcorrAss_Id = p_WOcorrAss_Id
order by Campus_Id, Professor, Aluno