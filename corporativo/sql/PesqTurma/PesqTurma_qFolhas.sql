select
  nvl(Count(*),0) as Total
from
  PesqFolha
where
  PesqFolha.PesqTurma_Id = nvl ( p_PesqTurma_Id ,0 )