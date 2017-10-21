select
  Carimbo.*,
  Carimbo_gsRecognize(Id) as Recognize
from
  Carimbo
where
  Carimbo.Tipo = p_Carimbo_Tipo
order by Recognize