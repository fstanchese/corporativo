select 
  Curso.Nome                            as Curso_Nome,
  CurrOfe.Id                            as CurrOfe_Id,
  Campus_gsrecognize(CurrOfe.Campus_Id) as Campus,
  Turma.Codigo                          as Turma,
  Turma.Id                              as Turma_Id,
  Matric.WPessoa_Id                     as WPessoa_Id,
  Matric.Id                             as Matric_Id
from 
  Curso,
  Curr,
  CurrOfe,
  Turma,
  TurmaOfe,
  Matric 
where 
  Curso.CursoNivel_Id = 6200000000002
and
  Curso.Id = Curr.Curso_Id 
and 
  Curr.Id = CurrOfe.Curr_Id 
and
  (
    p_PLetivo_Id is null
  or
    CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
  )
and 
  CurrOfe.Id = TurmaOfe.CurrOfe_Id 
and
  (
    Turma.Codigo like '%131%'
  or
    Turma.Codigo like '%122%'
  )
and
  Turma.Id = TurmaOfe.Turma_Id
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  (
    p_State_Id is null
  or
    Matric.State_Id = nvl( p_State_Id ,0)
  )
and
  (
    p_WPessoa_Id is null
  or
    Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)
  )
and 
  Matric.MatricTi_Id = 8300000000001
and
  Matric.CriProm_Id = 870000000003