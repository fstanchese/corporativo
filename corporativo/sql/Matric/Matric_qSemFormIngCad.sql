select
  WPessoa.*,
  WPessoa.Id   as WPessoa_Id,
  Turma.Codigo as Turma
from
  WPessoa,
  Curso,
  Curr,
  CurrOfe,
  DuracXCi,
  Turma,
  TurmaOfe,
  Matric
where
  WPessoa.Id = Matric.WPessoa_Id
and
  Curso.CursoNivel_Id in (6200000000001,6200000000010,6200000000012)
and
  Curso.Id = nvl( p_Curso_Id ,0)
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Pletivo_Id = nvl( p_PLetivo_Id ,0)
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and
  DuracXCi.Sequencia = 1			
and
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id  
and
  not exists (select Id from VestCla where Matric_Id = Matric.Id)
and
  Matric.IP is null
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id > 3000000002001
order by
  WPessoa.Nome