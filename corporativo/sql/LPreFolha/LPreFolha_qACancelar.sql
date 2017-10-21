select
  LPreFolha.Id
from
  LPreFolha,
  LPre
where
  LPre.Id = LPreFolha.LPre_Id
and
  LPreFolha.State_Id = 3000000009004
and 
  LPre.DT1 < sysdate-60
