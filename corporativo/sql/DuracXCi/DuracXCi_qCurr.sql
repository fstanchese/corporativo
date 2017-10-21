select
  DuracXCi.Id,
  DuracXCi.Nome,
  DuracXCi.Sequencia,
  DuracXCi.Durac_Id,
  DuracXCi_gsRecognize(DuracXCi.Id) as recognize
from
  Durac,
  DuracXCi,
  Curr
where 
  DuracXCi.Sequencia >= Curr.SerieInicio
and
  DuracXCi.Sequencia < ( Curr.SerieInicio + Durac.NrCiclos )
and
  DuracXCi.Durac_Id = Durac.Id
and
  DuracXCi.Durac_Id = Curr.Durac_Id
and
  Curr.Id = nvl( p_Curr_Id ,0)
order by
  Sequencia