select   
  Curso.Id                    as id,
  curso_gsrecognize(curso.id) as recognize
from
  PesqTurma,
  TurmaOfe, 
  Curso,
  CurrOfe,
  Curr
where
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  (
    p_Campus_Id is null
      or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  (
    p_CursoNivel_Id is null 
      or 
    CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
  )
and
  (
    Curso.Facul_Id = nvl( p_Facul_Id , 0)
      or
    p_Facul_Id is null
  )
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and 
  PesqTurma.TurmaOfe_Id = TurmaOfe.Id
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0)
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0)
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0)
and
  InstEns_Id = 8900000000001
group by curso.id
order by Recognize