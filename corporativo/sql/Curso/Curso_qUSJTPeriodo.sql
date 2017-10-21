select 
  curso.id,
  instens_id,
  curso_gsrecognize(curso.id) as recognize,
  curso_gncoordenador( curso.id ) as profid,
  WPessoa_gsRecognize(curso_gncoordenador( curso.id )) as profnome
from 
  Curso,
  Turma,
  TurmaOfe
where
  TurmaOfe.Turma_Id = Turma.Id
and
  (
    Turma.Periodo_Id = p_Periodo_Id
  or
    p_Periodo_Id is null
  )
and
  turma.Curso_Id = Curso.Id
and
  (
    p_CursoNivel_Id is null 
      or 
    CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
  )
and
  InstEns_Id = 8900000000001
group by curso.id,instens_id
order by
  Recognize
