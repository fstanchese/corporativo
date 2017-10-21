select
  Matric.Id                                                 as Id,
  Curr.Id                                                   as Curr_Id,
  Matric.WPessoa_Id                                         as WPessoa_Id,
  Curr.Curso_Id                                             as Curso_Id,
  CurrOfe.Campus_Id                                         as Campus_Id,
  CurrOfe.Periodo_Id                                        as Periodo_Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id)                          as Serie,
  MatricTi_Id                                               as MatricTi_Id,
  Turma_gsRecognize(Matric_gnRetTurma(Matric.Id))           as Turma_Recognize,
  Matric.State_Id                                           as State_Id,
  State_gsRecognize(Matric.State_Id)                        as State_Recognize,
  shortname(Curr.CurrNomeHist,80)                           as Curso_Recognize,
  DuracXCi_gnRetSequencia(TurmaOfe_gnDuracXCi(TurmaOfe.Id)) as DuracXCi_Sequencia,
  CurrOfe.Id                                                as CurrOfe_Id,
  Curr.CurrNomeVest                                         as NomeVest,
  Matric_gnEVestibulando( Matric.Id , p_PLetivo_Id )        as Vestibulando,
  Campus_gsRecognize(CurrOfe.Campus_Id)                     as Campus_Recognize,
  Periodo_gsRecognize(CurrOfe.Periodo_Id)                   as Periodo_Recognize
from
  WPessoa,
  Matric,
  TurmaOfe,
  CurrOfe,
  Curr,
  Curso
where
  (
    p_O_Texto is null
    or
    substr(WPessoa.Codigo,1,4) = p_O_Texto
  )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Curso.CursoNivel_Id IN ( 6200000000001,6200000000010 )
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id > 3000000002001
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  (
     p_WPessoa_Id is null
     or
     Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0)
  )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by matric.state_id