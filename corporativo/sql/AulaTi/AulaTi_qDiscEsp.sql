
select 
  aulaTi.id,
  aulaTi.nome||' - '||discEsp_gnChAnualTipo(discEsp.id,substr(aulaTi.nome,1,1))||' aulas' as recognize 
from
  aulaTi,
  discEsp
where
  (
   ( aulaTi.id = 13300000000001 and nvl(discEsp.chSemanalTeoria,0) <> 0 )
    or
   ( aulaTi.id = 13300000000002 and nvl(discEsp.chSemanalPratica,0) <> 0 )
    or
   ( aulaTi.id = 13300000000003 and nvl(discEsp.chSemanalLab,0) <> 0 )
  )
and
  discEsp.id = nvl ( p_DiscEsp_Id , 0 )
