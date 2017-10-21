(
select
  TurmaOfe.Id as Id,
  TurmaOfe_gnRetSerie(TurmaOfe.Id)   as Serie,
  TurmaOfe_gsRetPeriodo(TurmaOfe.Id) as Periodo,
  TurmaOfe_gsRecognize(TurmaOfe.Id)  as Recognize,
  TurmaOfe_gsRetCodCurr(TurmaOfe.Id) as Curriculo,
  curso.id                           as curso_id,
  curso.nome                         as curso_nome
from 
  turmaofe,
  currofe,
  curso,
  curr,
  facul
where
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  curso.facul_id = facul.id
and
  curr.curso_id = curso.id
and
  (  
     p_TurmaOfe_Id is null
       or
     TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  (
    Facul.Id = nvl( p_Facul_Id ,0) 
      or
    p_Facul_Id is null
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
  TurmaOfe_gnRetSerie(TurmaOfe.Id)   as Serie,
  TurmaOfe_gsRetPeriodo(TurmaOfe.Id) as Periodo,
  TurmaOfe_gsRecognize(TurmaOfe.Id)  as Recognize,
  TurmaOfe_gsRetCodCurr(TurmaOfe.Id) as Curriculo,
  curso.id                           as curso_id,
  curso.nome                         as curso_nome
from 
  turma,
  turmaofe,
  discEsp,
  curso,
  areaacad,
  facul
where
  turma.curso_id = curso.id
and
  turma.id = turmaofe.turma_id
and
  turmaofe.discesp_id = discesp.id
and
  AreaAcad.Facul_Id = Facul.Id
and
  DiscEsp.AreaAcad_id = AreaAcad.Id
and
  (  
     p_TurmaOfe_Id is null
       or
     TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  (
    Facul.Id = nvl( p_Facul_Id ,0) 
      or
    p_Facul_Id is null
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