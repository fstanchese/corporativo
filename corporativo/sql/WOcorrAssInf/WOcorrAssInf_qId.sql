
select
  WOcorrAssInf.*,
  WOcorrAssInf_gsRecognize(Id) as Recognize
from
  WOcorrAssInf
where
  Id = nvl( p_WOcorrAssInf_Id ,0)
