select
  Pesq.*,
  Pesq_gsRecognize(Pesq.Id)||decode(Pesq.Complemento,null,'',' - '||Pesq.Complemento)||decode(Pesq.Curso_Id,null,'',' - '||Curso_gsRetNome(Curso_Id)) as Recognize 
from
  Pesq
where
  (
    p_Campus_Id is null
    or
    Pesq.Campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  Pesq.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  Pesq.Semestre_Id = nvl ( p_Semestre_Id , 0 )
and
  Pesq.Ano_Id = nvl ( p_Ano_Id ,0 )
order by Sequencia