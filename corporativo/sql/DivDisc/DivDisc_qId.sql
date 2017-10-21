select
  DivDisc_gsRecognize(id) as Recognize,
  DivDisc.*
from
  DivDisc
where
  DivDisc.Id = nvl( p_DivDisc_Id ,0)
