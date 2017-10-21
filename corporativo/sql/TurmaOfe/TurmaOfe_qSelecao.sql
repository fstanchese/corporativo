(
select
  TurmaOfe.Id as Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id)    as Serie,
  TurmaOfe_gsRetPeriodo(TurmaOfe.Id)  as Periodo,
  turmaofe_gsrecognize(turmaofe.id) || ' - ' ||Campus.Nome||' - '||Matric_gnQtdeEstudando(TurmaOfe.Id, p_O_Data , p_O_Numero ) || ' - (' || Sala.QtdMaxAlun || ')' as recognize,
  TurmaOfe_gsRetCodCurr(TurmaOfe.Id)  as Curriculo,
  Curso.Id                            as Curso_Id,
  Curso.Nome                          as Curso_Nome,
  8300000000001                       as matricti_id,
  curr.codigo                         as codcurric,
  turmaofe.turma_id                   as turma_id,
  Campus_gsRecognize(Turma.Campus_Id) as Campus,
  TurmaOfe_gsRetCodTurma(TurmaOfe.Id) as Turma
from
  pletivo, 
  duracxci, 
  turma,
  turmaofe,
  currofe,
  curso,
  curr,
  campus,
  sala
where
  turma.campus_id=campus.id
and
  PLetivo.Id = CurrOfe.Pletivo_Id
and
  (
    p_CursoNivel_Id is null
    or
    Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0)
  )
and
  (
    p_Facul_Id is null
      or
    Curso.Facul_Id  = nvl( p_Facul_Id ,0)
  )
and
  (
    p_Campus_Id is null
      or
    Turma.Campus_Id  = nvl(  p_Campus_Id ,0)
  )
and
  (
     p_DuracXCi_Sequencia is null
       or
     DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0)
  )  
and
  duracxci.id=turma.duracxci_id
and
  turmaofe.sala_id = sala.id (+)
and
  turma.id=turmaofe.turma_id
and
  turmaofe.currofe_id = currofe.id
and
  (
     p_Curr_Id is null
       or
     Curr.Id = nvl ( p_Curr_Id , 0)
  )
and
  currofe.curr_id = curr.id
and
  curr.curso_id = curso.id
and
  (  
     p_Periodo_Id is null
       or
     CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
  )
and
 (  
     p_Curso_Id is null
       or
     Curr.Curso_Id = nvl( p_Curso_Id ,0)
  )
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
)
union
(
select
  TurmaOfe.Id as Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id)    as Serie,
  TurmaOfe_gsRetPeriodo(TurmaOfe.Id)  as Periodo,
  turmaofe_gsrecognize(turmaofe.id) || ' - ' ||Campus.Nome||' - '||Matric_gnQtdeEstudando(TurmaOfe.Id, p_O_Data , p_O_Numero ) || ' - (' || Sala.QtdMaxAlun || ')' as recognize,
  TurmaOfe_gsRetCodCurr(TurmaOfe.Id)  as Curriculo,
  Curso.Id                            as Curso_Id,
  Curso.Nome                          as Curso_Nome,
  8300000000002                       as matricti_id,
  null                                as codcurric,
  turmaofe.turma_id                   as turma_id,
  Campus_gsRecognize(Turma.Campus_Id) as Campus,
  TurmaOfe_gsRetCodTurma(TurmaOfe.Id) as Turma
from 
  pletivo,
  turma,
  turmaofe,
  discEsp,
  areaacad,
  curso,
  campus,
  sala
where
  turma.campus_id=campus.id
and
  pletivo.id=discesp.pletivo_id
and
  turma.curso_id = curso.id
and
  turmaofe.sala_id = sala.id (+)
and
  turma.id = turmaofe.turma_id
and
  turmaofe.discesp_id = discesp.id
and
  areaacad.id (+)= discesp.areaacad_id
and
  (
    p_Campus_Id is null
      or
    Turma.Campus_Id  = nvl(  p_Campus_Id ,0)
  )
and
  (
    p_Facul_Id is null
    or
    areaacad.facul_Id = nvl ( p_Facul_Id , 0)
  )
and
  ( 
    p_TurmaOfe_Id is null
    or
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  Curso.Id = nvl( p_Curso_Id ,0)
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
)
order by Recognize