select
  WOcorr.Id                                    as WOcorr_Id,
  WOcorr.Boleto_Id                             as Boleto_Id,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)       as Aluno
from
  WOcorrAss,
  WOcorr
where
  (
    nvl( WOcorr.Campus_Id ,6400000000001) = nvl ( p_Campus_Id ,0)
  or
    p_Campus_Id is null
  )
and
  (
    WOcorrAss.Id = nvl( p_WOcorrAss_Id ,0)
  or
    p_WOcorrAss_Id is null
  )
and
  WOcorrAss.Id = WOcorr.WOcorrAss_Id
and
  WOcorr.State_Id = 3000000011001
order by 
  Aluno



