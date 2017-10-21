select
  GradAlu.DivTurma_Teoria_Id          as DivTeoria_Id,
  GradAlu.DivTurma_Pratica_Id         as DivPratica_Id,
  WPessoa_gnParImpar(GradAlu.WPessoa_Id) as DivTurma_Id,
  GradAlu.Id,
  GradAlu.State_Id
from
  GradAlu
where
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) = nvl( p_PLetivo_Id , 0)
and
  GradAlu.State_Id <> 3000000003002
and
  GradAlu.CurrXDisc_Id = nvl( p_CurrXDisc_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
