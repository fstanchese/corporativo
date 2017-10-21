select
  HoraAula.Horario_Id,
  Horario.Semana_Id,
  HoraAula.WPessoa_Prof1_Id,
  HoraAula.WPessoa_Prof2_Id,
  HoraAula.WPessoa_Prof3_Id,
  HoraAula.WPessoa_Prof4_Id,
  HoraAula.TOXCD_Id,
  TOXCD.TurmaOfe_Id
from
  HoraAula,
  Horario,
  TurmaOfe,
  TOXCD
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Turmaofe.Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )