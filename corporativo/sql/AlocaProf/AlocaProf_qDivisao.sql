select
  count(*) as total
from
  alocaprof
where
  alocaprof.professor_01_id is not null
and
  alocaprof.divturma_id is not null
and
  alocaprof.aulati_id=13300000000002
and
  alocaprof.state_id=3000000037001
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 )
and
  alocaprof.currxdisc_id = nvl ( p_CurrXDisc_Id , 0 )
and
  alocaprof.turma_id = nvl ( p_Turma_Id , 0 )
