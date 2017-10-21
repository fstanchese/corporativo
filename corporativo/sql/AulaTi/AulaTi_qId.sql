select 
  id, 
  nome
from 
  AulaTi
where
  AulaTi.Id = nvl ( p_AulaTi_Id , 0 )