select
  DivTurma_Teoria_Id,
  DivTurma_Pratica_Id,
  DivTurma_Lab_Id
from
  GradAlu
where
  CurrXDisc_Id = nvl( p_CurrXDisc_Id ,0)
and
  TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
and
  WPessoa_Id = nvl( p_WPessoa_Id ,0)
