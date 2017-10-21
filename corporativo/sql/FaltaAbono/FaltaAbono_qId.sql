select
  FaltaAbono.*,
  FaltaAbono_gsRecognize(FaltaAbono.Id) as Recognize,
  TurmaOfe_gnRetPletivo(TurmaOfe.Id)    as PLetivo_Id
from
  FaltaAbono,
  GradAlu,
  TurmaOfe,
  CurrOfe
where
  TurmaOfe.CurrOfe_Id = CurrOfe.Id(+)
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id(+)
and
  FaltaAbono.GradAlu_Id = GradAlu.Id(+)
and
  FaltaAbono.Id = nvl( p_FaltaAbono_Id ,0)
order by Recognize