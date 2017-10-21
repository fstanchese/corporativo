select
  shortname(WPessoa.nome,25)  as Aluno,
  WPessoa.codigo              as Codigo,
  GradAlu.n1                  as n1,
  GradAlu.n2                  as n2,
  GradAlu.n3                  as n3,
  GradAlu.n4                  as n4,
  GradAlu.n5                  as n5,
  GradAlu.State_Id            as State_Id
from
  TurmaOfe,
  TOXCD,
  CurrXDisc,
  GradAlu,
  WPessoa
where
  GradAlu.WPessoa_Id = WPessoa.Id
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
and
  TOXCD.Id = nvl( p_TOXCD_Id ,0)
order by
  WPessoa.Nome
