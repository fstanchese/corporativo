select
  Pesq.Sequencia  as Id,
  Pesq.Sequencia || ' - ' ||Pesq.Complemento || decode(Pesq.curso_id,null,'',' - '||curso_gsretnome(pesq.curso_Id)) as Recognize
from
  Pesq,
  PesqQuest
where
  PesqQuest.Id (+)= Pesq.PesqQuest_Id 
and
  Pesq.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  Pesq.Semestre_Id = nvl ( p_Semestre_Id , 0 )
and
  Pesq.Ano_Id = nvl ( p_Ano_Id ,0 )
order by Sequencia