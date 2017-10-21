select 
  1/count(Horario.Id) as Quantidade,
  count(Horario.Id)   as QtdeDivisoes
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = p_Semana_Id
and
  to_char(Horario.HoraInicio,'hh24:mi') = p_O_Search
and
  nvl(HoraAula.CustoZero,'off') = 'off'
and
(
  HoraAula.WPessoa_Prof1_Id = p_WPessoa_Id
or
  HoraAula.WPessoa_Prof2_Id = p_WPessoa_Id
or
  HoraAula.WPessoa_Prof3_Id = p_WPessoa_Id
or
  HoraAula.WPessoa_Prof4_Id = p_WPessoa_Id
)
