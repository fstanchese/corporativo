select
  count(id)  as Total
from
  FaltaAbono
where
  trunc( FaltaAbono.DtInicio) <= trunc( to_date( p_O_Dt ) )
and
  trunc( FaltaAbono.DtFinal ) >= trunc( to_date( p_O_Dt ) )
and
  (
    FaltaAbono.GradAlu_Id is null
  or
    FaltaAbono.GradAlu_Id = nvl( p_GradAlu_Id ,0)
  )
and
  FaltaAbono.WPessoa_Id = nvl( p_WPessoa_Id ,0)
