select
  Empresa.id,
  Empresa_gsRecognize(Empresa.id) as Recognize 
from
  Empresa
where
  CobrancaUSJT is not null
order by
  Recognize