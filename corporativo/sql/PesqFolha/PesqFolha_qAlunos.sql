select
  WPessoa.Id as WPessoa_Id,
  WPessoa.Nome,
  WPessoa.Codigo as RA
from 
  Matric,
  WPessoa
where
  (  
    p_DivTurma_Id is null
     or
    nvl ( p_DivTurma_Id , 0 ) = 13500000000016
     or
    WPessoa_gnParImpar(Matric.WPessoa_Id) = nvl( p_DivTurma_Id ,0)
  )
and
  Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
and
  Matric.MatricTi_Id = 8300000000001
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.TurmaOfe_Id = nvl ( p_TurmaOfe_Id , 0)
order by 2