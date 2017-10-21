select
  WPessoa.Id                         as WPessoa_Id,
  WPessoa.Codigo                     as RA,
  TurmaOfe_gnRetCurr(TurmaOfe_Id)    as Curr_Id,
  WPessoa_gsRecognize(WPessoa.Id)    as NomeAluno,
  Matric.Id                          as Matric_Id,
  State_gsRecognize(Matric.State_Id) as Situacao,
  TurmaOfe_gsRetCodTurma(Matric.TurmaOfe_Id) as TurmaOld,  
  Curr.Curso_Id                      as Curso_Id
from
  Matric,
  WPessoa,
  TurmaOfe,
  Curr,
  CurrOfe
where
  Matric.Id not in ( select matric_id from matrictransf )
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in ( 3000000002002,3000000002003,3000000002005,3000000002010,3000000002011,3000000002012 )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and  
  (
    p_Curso_Id is null
      or
    Curr.Curso_Id = nvl( p_Curso_Id , 0)
  )
and
  ( 
     p_WPessoa_Id is null
      or
     Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
  )  
and
  (
    p_TurmaOfe_Id is null
      or 
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )
  )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by 4
