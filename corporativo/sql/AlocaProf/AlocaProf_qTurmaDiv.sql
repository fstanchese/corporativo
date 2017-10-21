select
  divturma_gsrecognize(divturma_id) as divisao,
  alocaprof.divturma_id as divturma_id
from
  alocaprof,
  currxdisc
where
  alocaprof.divturma_id is not null
and
  alocaprof.currxdisc_id=currxdisc.id
and
  alocaprof.state_id=3000000037001
and
  alocaprof.turma_id = nvl ( p_Turma_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
and
  currxdisc.disc_id = nvl ( p_Disc_Id , 0 )
order by divisao
