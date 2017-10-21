
select 
  Curso.Id,
  Curso.InstEns_Id,
  Curso.Nome || ' - ' || CursoNivel.NomeCompleto|| ' -  ' || InstEns.Codigo  as Recognize,
  curso_gncoordenador( curso.id ) as profid,
  WPessoa_gsRecognize(curso_gncoordenador( curso.id )) as profnome,
  InstEns_gsRecognize(InstEns_Id) as InstEns_Recognize 
from 
  cursonivel,
  curso,
  InstEns
where 
  curso.cursonivel_id=cursonivel.id
and
  InstEns.Id = Curso.InstEns_Id
and
  InstEns_Id = nvl( p_InstEns_Id ,0)
order by
  Curso.Nome