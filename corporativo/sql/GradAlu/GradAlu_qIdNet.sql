select
  GradNet.*,
  Curr.Curso_Id as Curso_Id,
  Curr.Id as Curr_Id,
  CurrXDisc_gnSerie(CurrXDisc.Id) as Serie
from
  Curr,
  CurrXDisc,
  GradNet
where
  Curr.Id = CurrXDisc.Curr_Id
and
  CurrXDisc.Id = GradNet.CurrXDisc_Id  
and
  GradNet.Id = nvl( p_GradAlu_Id ,0)
