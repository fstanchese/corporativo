select
  WPessoa_gsRecognize(WOcorrInf.Conteudo) as Professor,
  count(wocorrinf.conteudo)               as qtde,
  WOcorr.State_Id                         as State_Id
from
  WOcorr,
  WOcorrInf
where
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
  (
    WOcorr.State_Id = p_State_Id
  or
    p_State_Id is null
  )
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
  WOcorrAss_Id = 5100000000017
group by WOcorrInf.Conteudo,WOcorr.State_Id
order by $v_OrderBy
