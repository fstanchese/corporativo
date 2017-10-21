
select
  * 
from
  ChequeMovTi
where
  Id = nvl( p_ChequeMovTi_Id ,0)
