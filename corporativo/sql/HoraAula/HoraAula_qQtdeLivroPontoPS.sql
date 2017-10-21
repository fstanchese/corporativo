select
  sum(count(distinct(HoraAula.TOXCD_Id))) as qtde
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  DuracXCi
where
  (
    HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
      or
    HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
      or
    HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
      or
    HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
  )
and
  DuracXCi.Sequencia = 5
and
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Turma.Curso_Id = 5700000000036
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Horario.Id = HoraAula.Horario_Id
and
  Horario.Periodo_Id = nvl( p_Periodo_Id ,0) 
and
  Horario.Semana_Id = nvl( p_Semana_Id ,0)
 group by HoraAula.TOXCD_Id