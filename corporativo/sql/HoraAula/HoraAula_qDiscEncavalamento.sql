(
select
  Semana.Nome                                  as Dia,
  to_char(Horario.HoraInicio,'hh24:mi')        as Hora,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)  as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as CodDisc
from
  Semana,
  GradAlu,
  TOXCD,
  Horario,
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) = nvl( p_PLetivo_Id ,0)
and
  Horario.Semana_Id = Semana.Id
and
  Horario.Id = nvl( p_Horario_Id ,0)
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.DivTurma_Id is null
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  Semana.Nome                                  as Dia,
  to_char(Horario.HoraInicio,'hh24:mi')        as Hora,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)  as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as CodDisc
from
  Semana,
  GradAlu,
  TOXCD,
  Horario,
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) = nvl( p_PLetivo_Id ,0)
and
  Horario.Semana_Id = Semana.Id
and
  Horario.Id = nvl( p_Horario_Id ,0)
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.DivTurma_Id = GradAlu.DivTurma_Teoria_Id
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0) 
)
union
(
select
  Semana.Nome                                  as Dia,
  to_char(Horario.HoraInicio,'hh24:mi')        as Hora,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)  as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as CodDisc
from
  Semana,
  GradAlu,
  TOXCD,
  Horario,
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) = nvl( p_PLetivo_Id ,0)
and
  Horario.Semana_Id = Semana.Id
and
  Horario.Id = nvl( p_Horario_Id ,0)
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.DivTurma_Id = GradAlu.DivTurma_Pratica_Id
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  Semana.Nome                                  as Dia,
  to_char(Horario.HoraInicio,'hh24:mi')        as Hora,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)  as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as CodDisc
from
  Semana,
  GradAlu,
  TOXCD,
  Horario,
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) = nvl( p_PLetivo_Id ,0)
and
  Horario.Semana_Id = Semana.Id
and
  Horario.Id = nvl( p_Horario_Id ,0)
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.DivTurma_Id = GradAlu.DivTurma_Lab_Id
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
)
order by Turma desc