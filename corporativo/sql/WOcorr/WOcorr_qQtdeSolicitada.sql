select
  count(WOcorr.Id)     as Qtde,
  WOcorrAss.NomeNet    as Nomenet,
  WOcorrAss.Id         as WOcorrAss_Id
from
  WOcorrAss,
  WOcorr
where
  upper(wocorr.us) <> 'ALUNO'
and
  WOcorr.WOcorrAss_Id = WOcorrass.Id
and
  (
    WOcorr.Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null
  )
and
  WOcorr.Dt between p_O_Data1 and to_date ( p_O_Data2 , 'dd/mm/yyyy hh24:mi:ss')
group by NomeNet, WOcorrAss.Id
order by NomeNet
