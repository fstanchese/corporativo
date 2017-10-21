select
  Disc.Codigo           as CodDisc,
  TOXCD.Id              as TOXCD_Id,
  CriDivTur_Teoria_Id   as Teoria_Id,
  CriDivTur_Pratica_Id  as Pratica_Id,
  CriDivTur_Lab_Id      as Lab_Id,
  TOXCD.CurrXDisc_Id    as CurrXDisc_Id
from
  TOXCD,
  CurrXDisc,
  Disc
where
  CurrXDisc.Disc_Id = Disc.Id
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
and
  (
     TOXCD.CriDivTur_Teoria_Id is not null
       or
     TOXCD.CriDivTur_Pratica_Id is not null
       or
     TOXCD.CriDivTur_Lab_Id is not null
  )
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
order by 1