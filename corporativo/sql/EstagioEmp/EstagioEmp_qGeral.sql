select
  EstagioEmp.*,
  EstagioEmp_gsRecognize(id) as Recognize
from
  EstagioEmp
order by
  Recognize