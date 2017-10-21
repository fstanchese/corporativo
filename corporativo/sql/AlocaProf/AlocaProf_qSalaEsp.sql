select
  TDXSala.Sala_Id as Id,
  Sala_gsRecognize(TDXSala.Sala_Id) as Recognize 
from
  CurrOfe,
  TurmaOfe,
  TOXCD,
  TDXSala
where
  TDXSala.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  (
    nvl ( TDXSala.HoraAula_Id , 0 ) = nvl ( p_HoraAula_Id , 0 )
    or
    TDXSala.HoraAula_Id is null
  )
and
  nvl ( TDXSala.DivTurma_Id , 0 ) = nvl ( p_DivTurma_Id , 0 )
and
  TOXCD.CurrXDisc_Id = nvl ( p_CurrXDisc_Id , 0 )
and
  TurmaOfe.Turma_Id = nvl ( p_Turma_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
