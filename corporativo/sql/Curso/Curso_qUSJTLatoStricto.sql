select 
  curso.*,
  instens_id,
  curso_gsrecognize(curso.id) as recognize,
  curso_gncoordenador( curso.id ) as profid,
  WPessoa_gsRecognize(curso_gncoordenador( curso.id )) as profnome
from 
  curso
where 
  instens_id = 8900000000001
and
  cursonivel_id in ( 6200000000002 , 6200000000008 )
order by
  curso.cursonivel_id desc , curso.nome