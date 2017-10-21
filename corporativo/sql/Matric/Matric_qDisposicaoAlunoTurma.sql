select
  campus.nome        as CampusNome,
  facul.nome         as faculNome,
  curso.nome         as cursoNome,
  turma.codigo       as turmaCodigo,
  periodo.nome       as periodoNome,
  curr.codigo        as currCodigo,
  sala.codigo        as salaCodigo,
  sala.metragem      as salaMts,
  sala.qtdmaxalun    as qtdmaxalun,
  sala.QTDCARTEIRAS  as qtdcarteiras,
  turmaofe.id        as turmaofe_id,
  periodo.id         as Periodo_Id,
  duracxci.sequencia as serie,
  curr.pletivo_inicial_id,
  curso.pletivo_curric_id,
  campus.id          as Campus_Id,
  99999999999-curr.pletivo_inicial_id as PletivoOrderBy,
  curso.id           as curso_Id
from
  duracxci,
  campus,
  periodo,
  sala,
  turmaofe,
  turma,
  facul,
  curso,
  currofe,
  curr,
  pLetivo
where
  turma.duracxci_id=duracxci.id
and
  campus.id=currofe.campus_id
and
  curso.facul_id = facul.id
and
  turma.periodo_id = periodo.id
and
  turma.curso_id = curso.id
and
  turmaofe.sala_id = sala.id (+)
and
  turmaofe.turma_id = turma.id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  currofe.pLetivo_id = pLetivo.id
and
  ( Turma.DuracXCi_Id = p_DuracXCi_Id or p_DuracXCi_Id is null )
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  (
     p_Facul_Id is null
     or
     Curso.Facul_Id = nvl ( p_Facul_Id , 0)
  )
and
  pLetivo.id = nvl( p_PLetivo_Id ,0)
and
  ( curso.id = nvl( p_Curso_Id ,0) or p_Curso_Id is null )
union
select
  campus.nome        as CampusNome,
  facul.nome         as faculNome,
  curso.nome         as cursoNome,
  turma.codigo       as turmaCodigo,
  periodo.nome       as periodoNome,
  null               as currCodigo,
  sala.codigo        as salaCodigo,
  sala.metragem      as salaMts,
  sala.qtdmaxalun    as qtdmaxalun,
  sala.QTDCARTEIRAS  as qtdcarteiras,
  turmaofe.id        as turmaofe_id,
  periodo.id         as Periodo_Id,
  null               as serie,
  null               as pletivo_inicial_id,
  curso.pletivo_curric_id,
  campus.id          as Campus_Id,
  99999999999        as PletivoOrderBy,
  curso.id           as curso_id
from
  campus,
  periodo,
  sala,
  turmaofe,
  turma,
  facul,
  curso,
  pLetivo,
  discesp
where
  campus.id=turma.campus_id
and
  curso.facul_id = facul.id
and
  turma.periodo_id = periodo.id(+)
and
  turma.curso_id = curso.id
and
  turmaofe.sala_id = sala.id (+)
and
  turmaofe.turma_id = turma.id
and
  turmaofe.discesp_id = discesp.id
and
  discesp.pLetivo_id = pLetivo.id
and
  ( Turma.DuracXCi_Id = p_DuracXCi_Id or p_DuracXCi_Id is null )
and
  pLetivo.id = nvl( p_PLetivo_Id ,0)
and
  curso.id = nvl( p_Curso_Id ,0)
and
  p_Facul_Id is null
and
  p_Campus_Id is null
and
  nvl ( p_Curso_Id , 0 ) = 5700000003177
order by CampusNome,periodoNome, serie , pletivoOrderBy, turmaCodigo
