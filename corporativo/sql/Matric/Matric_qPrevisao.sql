select
  WPessoa.Id                              as WPessoa_Id,
  TurmaOfe_gnRetCurr(TurmaOfe_Id)         as Curr_Id,
  WPessoa_gsRecognize(WPessoa.Id)         as NomeAluno,
  Matric.Id                               as Matric_Id,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id)     as Turma,
  PLetivo_gsRecognize(CurrOfe.PLetivo_Id) as PLetivo_Recognize,
  WPessoa_gnCodigo(WPessoa.Id)            as Codigo
from
  Matric,
  WPessoa,
  TurmaOfe,
  Curr,
  CurrOfe
where
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011 )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  CurrOfe.Curr_Id = Curr.Id
and    
  Curr.Curso_Id = nvl( p_Curso_Id , 0)
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by 5,3