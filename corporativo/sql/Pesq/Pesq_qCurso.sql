select
  Pesq.Id,
  Pesq.Curso_Id
from
  Pesq
where
  Pesq.Sequencia = p_Pesq_Sequencia
and
  Pesq.PesqTi_Id = nvl ( p_PesqTi_Id  , 0 )
and
  Pesq.Semestre_Id = nvl ( p_Semestre_Id  , 0)
and
  Pesq.Ano_Id = nvl ( p_Ano_Id  , 0)