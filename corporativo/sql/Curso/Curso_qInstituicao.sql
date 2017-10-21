
select 
  curso.id,
  instens_id,
  curso_gsrecognize(curso.id) as recognize,
  curso_gnCoordenador(curso.id) as profid,
  wpessoa_gsrecognize( curso_gnCoordenador(curso.id) ) as profnome
from 
  curso
where 
  instens_id = 8900000000001
and
  ( cursonivel_id = nvl( p_CursoNivel_Id ,0) or cursonivel_id = 6200000000010 )
order by
  cursonivel_id,curso.nome