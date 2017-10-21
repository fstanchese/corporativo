select 
  count(*) as COUNT
from
  currxdisc
where
(
  gradalu_gnCXDPaga ( nvl( p_WPessoa_Id ,0) , currxdisc.id ) = 0
)
and
  duracxci_gnRetSequencia(duracxci_id) <= nvl(  p_DuracXCi_Serie ,0)
and
  Curr_Id in ( 
             (
             select
               curr.id
             from
               curr
             where
               curr.id = nvl( p_Curr_Id ,0)
             )
             union
             (
             select
               curr_pai_id
             from
               curr
             where
               curr.id = nvl( p_Curr_Id ,0)
             )
             )
