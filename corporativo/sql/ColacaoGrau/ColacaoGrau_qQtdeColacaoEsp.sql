select
  count(*) as total
from
  pletivo,
  wpessoa,
  tempcolacao,
  matric,
  currofe,
  curr,
  turmaofe,
  colacaograu
where
  pletivo.id = currofe.pletivo_id
and
  colacaograu.curso_id not in ( select curso_id from colacaograu where colacaograuti_id = 124200000000001 and dtcolacao = p_ColacaoGrau_DtColacao )
and
  tempcolacao.dtcolacao = p_ColacaoGrau_DtColacao
and
  wpessoa.id=matric.wpessoa_id
and
  tempcolacao.matric_id = matric.id
and
  matric.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  curr.id = currofe.curr_id
and
  colacaograu.curso_id = curr.curso_id
