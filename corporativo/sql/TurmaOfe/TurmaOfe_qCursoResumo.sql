(
select
  TurmaOfe.Id as Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id)    as Serie,
  TurmaOfe_gsRetPeriodo(TurmaOfe.Id)  as Periodo,
  TurmaOfe_gsRecognize(TurmaOfe.Id)   as Recognize,
  TurmaOfe_gsRetCodCurr(TurmaOfe.Id)  as Curriculo,
  Curso.Id                            as Curso_Id,
  Curso.Nome                          as Curso_Nome,
  TurmaOfe_gnRetPeriodo(TurmaOfe.Id)  as Periodo_Id,
  TurmaOfe_gsRetCodTurma(TurmaOfe.Id) as Turma,
  Campus_gsRecognize(Turma.Campus_Id) as Campus
from 
  TurmaOfe,
  CurrOfe,
  Curso,
  Curr,
  Turma,
  DuracXCi
where
  (
    p_DuracXCi_Sequencia is null
    or
    DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
  )
and
  (  
     p_Periodo_Id is null
       or
     CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
  )
and
  (
    p_Campus_Id is null
      or
    Turma.Campus_Id  = nvl(  p_Campus_Id ,0)
  )
and
  Turma.DuracXCi_Id = DuracXCi.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  Turmaofe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  Curr.Curso_Id = Curso.Id
and
 (
   p_Curso_Id is null
     or
   Curr.Curso_Id = nvl( p_Curso_Id ,0) 
 ) 
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
)
union
(
select
  TurmaOfe.Id as Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id)    as Serie,
  TurmaOfe_gsRetPeriodo(TurmaOfe.Id)  as Periodo,
  TurmaOfe_gsRecognize(TurmaOfe.Id)   as Recognize,
  TurmaOfe_gsRetCodCurr(TurmaOfe.Id)  as Curriculo,
  Curso.Id                            as Curso_Id,
  Curso.Nome                          as Curso_Nome,
  TurmaOfe_gnRetPeriodo(TurmaOfe.Id)  as Periodo_Id,
  TurmaOfe_gsRetCodTurma(TurmaOfe.Id) as Turma,
  Campus_gsRecognize(Turma.Campus_Id) as Campus
from 
  Turma,
  Turmaofe,
  DiscEsp,
  Curso
where
  (
    p_Campus_Id is null
      or
    Turma.Campus_Id  = nvl(  p_Campus_Id ,0)
  )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  Turma.Curso_Id = Curso.Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.id
and
  (
    p_Curso_Id is null
      or
    Curso.Id = nvl( p_Curso_Id ,0)
  )
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
)
order by 7,2,3,4