select
  DivDisc.*,
  CurrxDisc_gsRecognize(DivDisc.CurrXDisc_Id) ||' - '|| DivDisc.nome as Recognize
from
  DivDisc
order by 2