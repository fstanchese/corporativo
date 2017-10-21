select
  Matric.id          as Matric_Id,
  Turma.Id           as Turma_Id,
  Matric.CriProm_id  as CriProm_Id,
  Matric.WPessoa_Id  as WPessoa_Id,
  Matric.MatricTi_Id as MatricTi_Id
from
  Matric,
  Turma,
  TurmaOfe,
  CurrOfe,
  Curr,
  Curso
where
  Turma.Codigo Like nvl( p_Turma_Codigo , '%82%' )
and
  Turma.Id = TurmaOfe.Turma_Id
and
  Curso.CursoNivel_Id=6200000000002
and
  Curso.Id=Curr.Curso_Id
and
  Curr.Id=CurrOfe.Curr_Id
and
  Matric.State_Id = 3000000002002
and
  Matric.Matricti_Id=8300000000001
and
  Matric.TurmaOfe_Id=TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id=CurrOfe.Id
and
  CurrOfe.PLetivo_Id=nvl( p_PLetivo_Id , 7200000000063)