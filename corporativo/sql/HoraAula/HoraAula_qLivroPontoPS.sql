(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof1_Id ),35)  as Professor,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                             as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                              as Sala,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                           as CodDisc,
  HoraAula.WPessoa_Prof1_Id                                       as WPessoa_Id,
  HoraAula.TOXCD_Id                                               as TOXCD_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Horario.Periodo_Id                                              as Periodo_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  DuracXCi
where
  substr(toxcd.currxdisc_id,-5) not in ( 12318,12323,12308,15359,15344,15349,15354,21508,12313,18948,12309,12314,12319,12324,15355,15360,15345,21525,21513,21517,21521,15350,18952,18956,18961,18965 )
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
  HoraAula.WPessoa_Prof1_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
group by 
  HoraAula.TOXCD_Id,HoraAula.WPessoa_Prof1_Id, TurmaOfe.Sala_Id, Horario.Semana_Id,Horario.Periodo_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof2_Id ),35)  as Professor,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                             as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                              as Sala,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                           as CodDisc,
  HoraAula.WPessoa_Prof2_Id                                       as WPessoa_Id,
  HoraAula.TOXCD_Id                                               as TOXCD_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Horario.Periodo_Id                                              as Periodo_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  DuracXCi
where
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
  HoraAula.WPessoa_Prof2_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof2_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
group by 
  HoraAula.TOXCD_Id,HoraAula.WPessoa_Prof2_Id, TurmaOfe.Sala_Id, Horario.Semana_Id,Horario.Periodo_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof3_Id ),35)  as Professor,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                             as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                              as Sala,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                           as CodDisc,
  HoraAula.WPessoa_Prof3_Id                                       as WPessoa_Id,
  HoraAula.TOXCD_Id                                               as TOXCD_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Horario.Periodo_Id                                              as Periodo_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  DuracXCi
where
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
  HoraAula.WPessoa_Prof3_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof3_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
group by 
  HoraAula.TOXCD_Id,HoraAula.WPessoa_Prof3_Id, TurmaOfe.Sala_Id, Horario.Semana_Id,Horario.Periodo_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof4_Id ),35)  as Professor,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                             as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                              as Sala,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                           as CodDisc,
  HoraAula.WPessoa_Prof4_Id                                       as WPessoa_Id,
  HoraAula.TOXCD_Id                                               as TOXCD_Id,
  Horario.Semana_Id                                               as Semana_Id,
  Horario.Periodo_Id                                              as Periodo_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  DuracXCi
where
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
  HoraAula.WPessoa_Prof4_Id is not null
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof4_Id , p_O_Data ) = 1
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
group by 
  HoraAula.TOXCD_Id,HoraAula.WPessoa_Prof4_Id,TurmaOfe.Sala_Id, Horario.Semana_Id,Horario.Periodo_Id
)
order by
  Periodo_Id,Semana_Id,Professor