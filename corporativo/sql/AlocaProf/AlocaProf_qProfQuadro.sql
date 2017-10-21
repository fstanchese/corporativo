select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  alocxhor.indice as Indice,
  alocxhor.alocaprof_id as alocaprof_id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  alocaprof_gsRetSala( AlocaProf.Pletivo_Id , AlocaProf.Turma_Id , AlocaProf.CurrXDisc_Id , AlocaProf.DivTurma_Id , HoraAula.Id , 'on' ) as sala  
from
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  HoraAula
where
  AlocaProf.State_Id = 3000000037001
and
  ( 
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id
    )
  )
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
     Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
     or
     p_Periodo_Id is null
  )
and
  (
     Horario.Semana_Id = nvl ( p_Semana_Id , 0 )
     or
     p_Semana_Id is null
  )
and
  AlocaProf.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
union
select
  to_char(horario.horainicio,'hh24:mi')            as horainicio,
  horario.semana_Id                                as semana_id,
  SubStr(TOXCD_gsRetTurma(HoraAula.TOXCD_Id),1,12) as turma,
  null                                             as disciplina,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id)       as divturma,
  null                                             as indicce,
  null                                             as alocaprof_id,
  null                                             as TipoAula,
  Sala_gsRecognize(TurmaOfe.Sala_Id)               as Sala
from
  turma,
  turmaofe,
  toxcd,
  HoraAula,
  Horario
where
  Turma.TurmaTi_Id = 6600000000002
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id 
and
  HoraAula.TOXCD_ID = TOXCD.Id
and  
  HoraAula.Horario_Id = Horario.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id , p_O_Data ) = 1
and
  HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id , 0)
order by semana_id,horainicio,turma,disciplina,divturma
