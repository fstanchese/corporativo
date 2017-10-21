select
  Turma.Codigo                                as Turma_Recognize,
  Disc.Nome                                   as nomedisc,
  Disc.Codigo                                 as coddisc,
  DivDisc.Nome                                as divdisc,
  to_char(Horario.HoraInicio,'hh24:mi')       as hora,
  AulaTi_gsRecognize(HoraAula.AulaTi_Id)      as tipoaula,
  nvl(WPessoa_gsRecognize(WPessoa_Prof1_Id),'*** SEM PROFESSOR ***') as prof1,
  WPessoa_gsRecognize(WPessoa_Prof2_Id)       as prof2,
  WPessoa_gsRecognize(WPessoa_Prof3_Id)       as prof3,
  WPessoa_gsRecognize(WPessoa_Prof4_Id)       as prof4,
  Sala_gsRecognize(Sala_Especial_Id)          as salaespecial,
  nvl(DivTurma_gsRecognize(DivTurma_Id),' ')  as divisao,
  Semana_gsRecognize(Semana.Id)               as diasemana,
  substr(Semana_gsRecognize(Semana.Id),1,3)   as dia_abrev,
  Semana.Numero                               as numero,
  DivDisc.Id                                  as divdisc_id,
  HoraAula.Id                                 as horaaula_id,
  Campus_gsRecognize(Turma.Campus_Id)         as campus,
  CurrXDisc.DuracXCi_Id                       as DuracXCi_Id,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id) as Serie,
  Periodo_gsRecognize(Turma.Periodo_Id)       as Periodo_Recognize,
  Sala_gsRecognize(TurmaOfe.Sala_Id)          as Sala_Recognize
from
  Semana,
  Horario,
  CurrXDisc,
  Disc,
  TOXCD,
  HoraAula,
  TurmaOfe,
  DivDisc,
  Turma
where
  nvl ( p_O_Data , sysdate ) between HoraAula.DtInicio and HoraAula.DtTermino
and
  DivDisc.Id (+) = HoraAula.DivDisc_Id
and
  Semana.Id = Horario.Semana_Id
and
  Horario.Id (+) = HoraAula.Horario_Id 
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Disc.Id = CurrXDisc.Disc_Id
and
  CurrXDisc.Id = TOXCD.CurrXDisc_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  Turma.Id=TurmaOfe.Turma_Id
and
  (
    Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
    or
    p_Campus_Id is null
  )
and
  Turma.Curso_Id = nvl ( p_Curso_Id ,0 )
order by CurrXDisc.DuracXCi_Id,semana.id,Turma.Campus_Id desc,Turma.Codigo,to_char(horario.horainicio,'hh24:mi'), nvl(DivTurma_gsRecognize(DivTurma_Id),' ')
