select
  GradAlu.Id                           as GradAlu_Id, 
  TurmaOfe_gsRetPLetivo(TurmaOfe_Id)   as PLetivo,
  CurrXDisc_gsRetCodDisc(CurrXDisc_Id) as Disc,
  CurrXDisc_gsRetDisc(CurrXDisc_Id)    as NomeDisc,
  GradAlu.F13                          as F13,
  GradAlu.N1                           as N1,
  GradAlu.N2                           as N2,
  GradAlu.N3                           as N3,
  GradAlu.N4                           as N4,
  GradAlu.N5                           as N5,
  State.nick                           as Situacao
from
  GradAlu,
  State
where
  GradAlu.State_Id in (3000000003001,3000000003004,3000000003005,3000000003006,3000000003007,3000000003008)
and
  (
    GradAlu.CurrXDisc_Id = nvl( p_CurrXDisc_Id ,0) 
      or
    p_CurrXDisc_Id is null
  )
and
  GradAlu.State_Id = State.Id
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
and
  GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
