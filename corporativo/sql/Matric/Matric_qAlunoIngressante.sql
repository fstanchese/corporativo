select
  Curr.Curso_Id                       as curso_id,
  Curso_gsRecognize(Curr.Curso_Id)    as curso,
  Campus_gsRecognize(Turma.Campus_id) as campus,
  substr(WPessoa.Nome,0,70)           as nome,
  WPessoa.Codigo                      as codigo
from
  Matric,
  CurrOfe,
  TurmaOfe,
  WPessoa,
  Curr,
  Turma
where
  WPessoa.Codigo like '2010%'
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  Matricti_Id = 8300000000001
and
  Curr.Curso_Id = nvl ( p_Curso_Id , 0 )
and
  CurrOfe.Curr_Id = Curr.Id
and
  Turma.Campus_Id = nvl( p_Campus_Id , 0 )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.State_Id in ( 3000000002002, 3000000002003)
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by Curr.Curso_Id, Turma.Campus_Id, WPessoa.Nome, WPessoa.Codigo
order by Curso, Campus, WPessoa.Nome, WPessoa.Codigo