
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
and
  cursonivel_id = 6200000000001
and
  (
    p_Facul_Id is null 
    or 
    Facul_Id = nvl( p_Facul_Id ,0)
  )
order by
  curso.nome