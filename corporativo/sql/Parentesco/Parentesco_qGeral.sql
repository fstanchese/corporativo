select
  Parentesco.*,
  Parentesco_gsRecognize(id) as Recognize
from
  Parentesco
order by
  Nome
