select
  nvl(Count(*), 0) as Qtde 
from
  GradAlu,
  CurrXDisc
where
  (
    CurrXDisc.Disc_Id = nvl( p_Disc_Id , 0 )
      or
    p_Disc_Id is null 
  ) 
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id 
and
  GradAlu.HoraProva_Esp_Id = nvl( p_HoraProva_Id ,0)
