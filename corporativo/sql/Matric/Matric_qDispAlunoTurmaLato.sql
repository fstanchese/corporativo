select
  facul.nome         as faculNome,
  curso.nome         as cursoNome,
  turma.codigo       as turmaCodigo,
  periodo.nome       as periodoNome,
  curr.codigo        as currCodigo,
  sala.codigo        as salaCodigo,
  sala.metragem      as salaMts,
  sala.qtdmaxalun    as salaCart
from
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
  pLetivo.id = nvl( p_PLetivo_Id ,0)
and
  curso.id = nvl( p_Curso_Id ,0)
order by cursoNome, turmaCodigo
