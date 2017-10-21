
select
  Durac.NrCiclos as Ciclos,
  Curr.SerieInicio
from
  Durac,
  Curr
where
  Curr.Durac_Id = Durac.Id
and
  Curr.Id = nvl( p_Curr_Id ,0)