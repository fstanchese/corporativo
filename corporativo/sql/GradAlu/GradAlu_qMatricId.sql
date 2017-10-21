select
  GradAlu.*,
  LPre_gnFaltasTot( GradAlu.Id ) as Faltas,
  CurrXDisc.DiscCat_Id,
  CurrXDisc.NotaTi_Id
from
  GradAlu,
  CurrXDisc
where
  CurrXDisc.Id = GradAlu.CurrXDisc_Id
and
  GradAlu.Matric_Id = nvl( p_Matric_Id ,0)
