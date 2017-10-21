
select 
  curso.id,
  curso.instens_id,
  curso_gsrecognize(curso.id)     as recognize,
  curso_gncoordenador( curso.id ) as profid,
  WPessoa_gsRecognize(curso_gncoordenador( curso.id )) as profnome,
  instens_gsrecognize(instens_id) as instens_recognize 
from 
  curso,
  wpessoa 
where 
  wpessoa.id (+) = curso.wpessoa_coordenador_id
and
  instens_id = nvl( p_InstEns_Id ,0)
order by  6