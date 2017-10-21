
select 
  Curso.Id,
  Instens_Id,
  Curso_gsRecognize(Curso.Id) as Recognize,
  curso_gncoordenador( curso.id ) as profid,
  WPessoa_gsRecognize(curso_gncoordenador( curso.id )) as profnome
from 
  Curso
where 
  InstEns_id = nvl( p_InstEns_Id ,0)
and
  CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
order by
  Curso.Nome
