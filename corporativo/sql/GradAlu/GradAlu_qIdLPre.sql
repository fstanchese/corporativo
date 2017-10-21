select
  GradAlu.*,
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) as PLetivo_Id,
  TurmaOfe_gnRetTurmaTi(TurmaOfe_Id) as TurmaTi_Id,
  GradAlu_gsNotaAlterada(GradAlu.N1) as N1ALT,
  GradAlu_gsNotaAlterada(GradAlu.N2) as N2ALT,
  GradAlu_gsNotaAlterada(GradAlu.N4) as N4ALT,
  State.Nick as Situacao
from
  State,
  GradAlu
where
  State.Id = GradAlu.State_Id
and
  GradAlu.Id = nvl( p_GradAlu_Id ,0)
