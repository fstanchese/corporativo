select
  Pesq.Id
from
  Pesq
where
  Pesq.Sequencia = nvl ( p_Pesq_Sequencia , 0 )
and
  Pesq.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  Pesq.Semestre_Id = nvl ( p_Semestre_Id , 0 )
and
  Pesq.Ano_Id = nvl ( p_Ano_Id ,0 )
