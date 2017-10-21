select * from
(
select
  to_char(Horario.HoraInicio,'hh24:mi') as Horario,
  Horario.Semana_id                     as Semana_Id
from
  HoraAula,
  Horario,
  TurmaOfe,
  TOXCD,
  CurrXDisc
where
  wpessoa_prof1_id is not null
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  toxcd.currxdisc_id=currxdisc.id
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Turmaofe.Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )
union all
select
  to_char(Horario.HoraInicio,'hh24:mi') as Horario,
  Horario.Semana_id                     as Semana_Id
from
  HoraAula,
  Horario,
  TurmaOfe,
  TOXCD,
  CurrXDisc
where
  wpessoa_prof2_id is not null
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  toxcd.currxdisc_id=currxdisc.id
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Turmaofe.Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )
union all
select
  to_char(Horario.HoraInicio,'hh24:mi') as Horario,
  Horario.Semana_id                     as Semana_Id
from
  HoraAula,
  Horario,
  TurmaOfe,
  TOXCD,
  CurrXDisc
where
  wpessoa_prof3_id is not null
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  toxcd.currxdisc_id=currxdisc.id
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Turmaofe.Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )
union all
select
  to_char(Horario.HoraInicio,'hh24:mi') as Horario,
  Horario.Semana_id                     as Semana_Id
from
  HoraAula,
  Horario,
  TurmaOfe,
  TOXCD,
  CurrXDisc
where
  wpessoa_prof4_id is not null
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  toxcd.currxdisc_id=currxdisc.id
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Turmaofe.Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )
)