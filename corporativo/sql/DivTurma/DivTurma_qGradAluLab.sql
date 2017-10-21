select
  CurrXDisc_Id,
  TurmaOfe_Id
from
  TOXCD
where
  DivLab = p_O_Numero
and
(
  CriDivTur_Teoria_Id = nvl( p_CriDivTur_Id ,0)
or
  CriDivTur_Pratica_Id = nvl( p_CriDivTur_Id ,0)
or
  CriDivTur_Lab_Id = nvl( p_CriDivTur_Id ,0)
)
and
  TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)