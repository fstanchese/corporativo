select
  WOcorrAssTP.*,
  WOcorrAss.Nomenet || ' - ' || WOcorrAssTP.Referencia as Recognize,
  WOcorrAss.NomeNet                                    as Nomenet
from
  WOcorrAssTP,
  WOcorrAss
where
  WOcorrAssTP.WOcorrAss_Id = WOcorrAss.Id
order by 
  Recognize