select
  count(*),
  divturma_gsrecognize(divturma_id) as divisao,
  alocaprof.divturma_id as divturma_id
from
  alocaprof
where
  alocaprof.state_id=3000000037001
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
and
  alocaprof.currxdisc_id = nvl ( p_CurrXDisc_Id , 0 )
group by divturma_id order by 2