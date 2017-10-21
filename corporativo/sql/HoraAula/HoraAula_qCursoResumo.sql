select
  curso_gsrecognize(curso.id) as NomeCurso,
  curso.id as curso_id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Horario,
  Curso
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  Turma.Curso_Id = Curso.Id
and
  (  
    Curso.CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
      or
    p_CursoNivel_Id is null 
  )
and
  (
    Curso.Id = nvl( p_Curso_Id ,0)
      or 
    p_Curso_Id is null
  )
group by Curso.Id
order by 1