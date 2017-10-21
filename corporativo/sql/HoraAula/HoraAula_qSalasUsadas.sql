select * from (
select
  TurmaOfe_gsRetCodTurma(TurmaOfe.Id)   as Turma,
  TurmaOfe_GsRetCodSala(TurmaOfe.Id)    as Sala,
  Bloco_gsRecognize(Sala.Bloco_Id)      as Bloco,
  Andar_gsRecognize(Sala.Andar_Id)      as Andar,
  To_Char(Horario.HoraInicio,'hh24:mi') as Hora
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  Sala
where
  Turma.Id = TurmaOfe.Turma_Id
and
  Sala.Id = TurmaOfe.Sala_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  (
     p_Periodo_Id is null
     or
     Turma.Periodo_Id = nvl ( p_Periodo_Id , 0)
  )
and
  (
     p_Campus_Id is null
     or
     Turma.Campus_Id = nvl ( p_Campus_Id , 0)
  )
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
union
select
  TOXCD_gsRetTurma(TOXCD.Id)            as Turma,
  Sala.Codigo                           as Sala,
  Bloco_gsRecognize(Sala.Bloco_Id)      as Bloco,
  Andar_gsRecognize(Sala.Andar_Id)      as Andar,
  To_Char(Horario.HoraInicio,'hh24:mi') as Hora
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  Sala
where
  Sala.Id = HoraAula.Sala_Especial_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  (
     p_Periodo_Id is null
     or
     Turma.Periodo_Id = nvl ( p_Periodo_Id , 0)
  )
and
  (
     p_Campus_Id is null
     or
     Turma.Campus_Id = nvl ( p_Campus_Id , 0)
  )
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.Sala_Especial_Id is not null
)
group by Turma,Sala,Bloco,Andar,Hora
order by Andar,Bloco,Turma,Hora
