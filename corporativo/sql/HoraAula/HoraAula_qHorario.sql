(
select
  SubStr(Semana_gsRecognize(Horario.Semana_id),1,3)  as DiaSemana,
  to_char(horario.horainicio,'hh24:mi')              as Hora,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)       as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)         as DivTurma,
  Sala_gsRecognize(HoraAula.Sala_Especial_Id)        as Sala,
  TurmaOfe_gsRetCodSala(GradAlu.TurmaOfe_Id)         as Turma_Sala,
  Semana.Numero
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
  SubStr(Semana_gsRecognize(Horario.Semana_id),1,3)  as DiaSemana,
  to_char(horario.horainicio,'hh24:mi')              as Hora,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)       as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)         as DivTurma,
  Sala_gsRecognize(HoraAula.Sala_Especial_Id)        as Sala,
  TurmaOfe_gsRetCodSala(GradAlu.TurmaOfe_Id)         as Turma_Sala,
  Semana.Numero
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
  SubStr(Semana_gsRecognize(Horario.Semana_id),1,3)  as DiaSemana,
  to_char(horario.horainicio,'hh24:mi')              as Hora,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)       as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)         as DivTurma,
  Sala_gsRecognize(HoraAula.Sala_Especial_Id)        as Sala,
  TurmaOfe_gsRetCodSala(GradAlu.TurmaOfe_Id)         as Turma_Sala,
  Semana.Numero
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
  SubStr(Semana_gsRecognize(Horario.Semana_id),1,3)  as DiaSemana,
  to_char(horario.horainicio,'hh24:mi')              as Hora,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)       as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)         as DivTurma,
  Sala_gsRecognize(HoraAula.Sala_Especial_Id)        as Sala,
  TurmaOfe_gsRetCodSala(GradAlu.TurmaOfe_Id)         as Turma_Sala,
  Semana.Numero
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
union
(
select
  SubStr(Semana_gsRecognize(Horario.Semana_id),1,3)  as DiaSemana,
  to_char(horario.horainicio,'hh24:mi')              as Hora,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)       as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)         as DivTurma,
  Sala_gsRecognize(HoraAula.Sala_Especial_Id)        as Sala,
  TurmaOfe_gsRetCodSala(GradAlu.TurmaOfe_Id)         as Turma_Sala,
  Semana.Numero
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
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.DivTurma_Id is null
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  TOXCD.CurrXDisc_Id Is Null
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
  SubStr(Semana_gsRecognize(Horario.Semana_id),1,3)  as DiaSemana,
  to_char(horario.horainicio,'hh24:mi')              as Hora,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)       as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)         as DivTurma,
  Sala_gsRecognize(HoraAula.Sala_Especial_Id)        as Sala,
  TurmaOfe_gsRetCodSala(GradAlu.TurmaOfe_Id)         as Turma_Sala,
  Semana.Numero
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
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.DivTurma_Id = GradAlu.DivTurma_Teoria_Id
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  TOXCD.CurrXDisc_Id Is Null
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
  SubStr(Semana_gsRecognize(Horario.Semana_id),1,3)  as DiaSemana,
  to_char(horario.horainicio,'hh24:mi')              as Hora,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)       as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)         as DivTurma,
  Sala_gsRecognize(HoraAula.Sala_Especial_Id)        as Sala,
  TurmaOfe_gsRetCodSala(GradAlu.TurmaOfe_Id)         as Turma_Sala,
  Semana.Numero
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
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.DivTurma_Id = GradAlu.DivTurma_Pratica_Id
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  TOXCD.CurrXDisc_Id Is Null
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
  SubStr(Semana_gsRecognize(Horario.Semana_id),1,3)  as DiaSemana,
  to_char(horario.horainicio,'hh24:mi')              as Hora,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                as Turma,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)       as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)         as DivTurma,
  Sala_gsRecognize(HoraAula.Sala_Especial_Id)        as Sala,
  TurmaOfe_gsRetCodSala(GradAlu.TurmaOfe_Id)         as Turma_Sala,
  Semana.Numero
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
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.DivTurma_Id = GradAlu.DivTurma_Lab_Id
and
  HoraAula.TOXCD_ID = TOXCD.Id
and
  TOXCD.CurrXDisc_Id Is Null
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
)
order by 8,2,3,4