
select 
  aulaTi.id,
  aulaTi.nome||' - '||currxdisc_gnChAnualTipo(currxdisc.id,substr(aulaTi.nome,1,1))||' aulas' as recognize 
from
  aulaTi,
  currxdisc
where
  (
    ( aulaTi.id = 13300000000001 and (nvl(currxdisc.chSemanalTeoria,0)+nvl(currxdisc.chSemanalExerc,0)) <> 0 )
    or
    ( aulaTi.id = 13300000000002 and nvl(currxdisc.chSemanalPratica,0) <> 0 )
    or
    ( aulaTi.id = 13300000000003 and nvl(currxdisc.chSemanalLab,0) <> 0 )
  )
and
  currxdisc.id = nvl ( p_CurrXDisc_Id , 0)
