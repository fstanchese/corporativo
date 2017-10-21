select
  WOcorrAssReP.*,
  WOcorrAssReP_gsRecognize(WOcorrAssRep.Id) as Recognize
from
  WOcorrAssReP
where
  Depart_Id = nvl( p_Depart_Id ,0)
order by
  Recognize