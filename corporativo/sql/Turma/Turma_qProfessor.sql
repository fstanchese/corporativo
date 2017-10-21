(
select 
  toxcd.id as toxcd_id,
  substr(turma_gsrecognize(turmaofe.turma_id),1,30) ||' - '|| substr(currxdisc_gsretcoddisc(toxcd.currxdisc_id),1,30) as turma_disciplina
from
  currofe,
  turmaofe,
  toxcd,
  gradalu,
  horaaula
where
  turmaofe.currofe_id = currofe.id
and
  gradalu.turmaofe_id = turmaofe.id
and
  gradalu.turmaofe_id = toxcd.turmaofe_id
and
  toxcd.id = horaaula.toxcd_id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  toxcd.wpessoa_profresp_id = nvl( p_WPessoa_Id ,0)
group by toxcd.id, toxcd.currxdisc_id, turmaofe.turma_id
)
union
(
select 
  toxcd.id as toxcd_id,
  substr(turma_gsrecognize(turmaofe.turma_id),1,30) ||' - '|| substr(toxcd_gsretcoddisc(toxcd.id),1,30) as turma_disciplina
from
  discesp,
  turmaofe,
  toxcd,
  gradalu,
  horaaula
where
  turmaofe.discesp_id = discesp.id
and
  gradalu.turmaofe_id = turmaofe.id
and
  gradalu.turmaofe_id = toxcd.turmaofe_id
and
  toxcd.id = horaaula.toxcd_id
and
  discesp.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  toxcd.wpessoa_profresp_id = nvl( p_WPessoa_Id ,0)
group by toxcd.id, turmaofe.turma_id
)
order by 2
