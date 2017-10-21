select
  Curr.Id                   as Id,
  Curr.Codigo || ' - ' || Curr.CurrNomeHist || decode(Curr.CurrNivelDesc,null,Curr.CurrNivelDesc,' - ' || Curr.CurrNivelDesc) as Recognize
from
  Curr 
where
  Curr.Id <> 5800000000582
and
  Curr_Pai_Id = nvl ( p_Curr_Id ,0 )
and
  Curr.SerieInicio = nvl ( p_DuracXCi_Sequencia ,0 )
order by 
  recognize