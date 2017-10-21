select
  id 
from
  AlocaProf
where
  nvl ( DivTurma_Id , 0 ) = nvl ( p_DivTurma_Id , 0 )
and
  AulaTi_Id = nvl ( p_AulaTi_Id , 0 )
and
  CurrXDisc_Id = nvl ( p_CurrXDisc_Id , 0 )
and
  Turma_Id = nvl ( p_Turma_Id , 0 )
and
  PLetivo_Id = nvl ( p_PLetivo_Id , 0 )

