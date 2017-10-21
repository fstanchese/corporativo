
select
  id,
  turmaofe_gsRetPLetivo(turmaofe_id)        as pletivo,
  gradaluti_gsrecognize(gradaluti_id)       as gradaluti,
  currxdisc_gsrecognize(currxdisc_id)       as currxdisc_gsrecognize,
  currxdisc_gsRetCodDisc(currxdisc_id)      as disc,
  turmaofe_gsRetCodTurma(turmaofe_id)       as turma,
  state_gsRecognize(state_id)               as situacao,
  gradalu_gsRetNotasHtml(id,criaval_id)     as notas,
  F13                                       as faltas ,
  currxdisc_gnChTotal(gradalu.currxdisc_id, p_PLetivo_Id  , GradAlu.Id ) as ChAnual
from
  gradalu
where
  Gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
order by
  pletivo,disc
