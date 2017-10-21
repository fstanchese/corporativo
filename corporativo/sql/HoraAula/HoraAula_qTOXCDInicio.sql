select
  HoraAula.*
from
  HoraAula
where
  nvl ( HoraAula.DivTurma_Id , 0 ) = nvl ( p_DivTurma_Id , 0 )
and
  HoraAula.AulaTi_Id = nvl ( p_AulaTi_Id , 0 )
and
  HoraAula.TOXCD_Id = nvl ( p_TOXCD_Id , 0 )
order by HoraAula.DtInicio 

