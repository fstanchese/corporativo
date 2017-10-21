select 
  curso.id,
  instens_id,
  curso_gsrecognize(curso.id) as recognize,
  curso_gncoordenador( curso.id ) as profid,
  WPessoa_gsRecognize(curso_gncoordenador( curso.id )) as profnome
from 
  curso
where 
  instens_id = 8900000000001
order by
  recognize