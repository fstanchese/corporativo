(
select
  TurmaOfe.Id as Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id)   as Serie,
  TurmaOfe_gsRetPeriodo(TurmaOfe.Id) as Periodo,
  TurmaOfe_gsRecognize(TurmaOfe.Id)  as Recognize,
  TurmaOfe_gsRetCodCurr(TurmaOfe.Id) as Curriculo,
  curso.id                           as curso_id,
  curso.nome                         as curso_nome,
  Turma.Codigo                       as Turma_Codigo
from 
  turma,
  turmaofe,
  currofe,
  curso,
  curr
where
  turma.id = turmaofe.turma_id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  curr.curso_id = curso.id
and
  (
    p_Periodo_Id is null
     or
    turma.Periodo_Id = nvl( p_Periodo_Id ,0)
  )
and
  (
    p_Campus_Id is null
      or
    turma.campus_id = nvl( p_Campus_Id , 0)
  ) 
and
  ( 
    p_Curso_Id is null
     or 
    Curr.Curso_Id = nvl( p_Curso_Id ,0)
  )
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
union
select
  TurmaOfe.Id as Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id)   as Serie,
  TurmaOfe_gsRetPeriodo(TurmaOfe.Id) as Periodo,
  TurmaOfe_gsRecognize(TurmaOfe.Id)  as Recognize,
  TurmaOfe_gsRetCodCurr(TurmaOfe.Id) as Curriculo,
  curso.id                           as curso_id,
  curso.nome                         as curso_nome,
  Turma.Codigo                       as Turma_Codigo
from 
  turma,
  turmaofe,
  discEsp,
  curso
where
  turma.curso_id = curso.id
and
  turma.id = turmaofe.turma_id
and
  turmaofe.discesp_id = discesp.id
and
  (
    p_Periodo_Id is null
     or
    turma.Periodo_Id = nvl( p_Periodo_Id ,0)
  )
and
  (
    p_AreaAcad_Id is null
      or
    DiscEsp.AreaAcad_Id = nvl( p_AreaAcad_Id ,0)
  )
and
  (
    p_Campus_Id is null
      or
    turma.campus_id = nvl( p_Campus_Id , 0)
  ) 
and
  (
    p_Curso_Id is null
      or
    curso.id = nvl( p_Curso_Id ,0)
  )
and
  DiscEsp.pletivo_id = nvl( p_PLetivo_Id ,0) 
)
order by 7,2,3,4
