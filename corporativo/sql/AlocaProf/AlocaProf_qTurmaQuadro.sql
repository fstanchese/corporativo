select
  alocaprof_gsRetSala( AlocaProf.Pletivo_Id , AlocaProf.Turma_Id , AlocaProf.CurrXDisc_Id , AlocaProf.DivTurma_Id , HoraAula.id , 'on' ) as sala,
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  semana_gsrecognize(horario.semana_id) as diasemana,
  Turma.Codigo as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as Disciplina,
  CurrXDisc_gsRetDisc(AlocaProf.CurrXDisc_Id) as NomeDisc, 
  Professor.Nome as Professor,
  DivTurma_gsRecognize(AlocaProf.DivTurma_Id) as DivTurma,
  alocxhor.indice as Indice,
  alocxhor.alocaprof_id as alocaprof_id,
  AulaTi_gsRecognize(AlocaProf.AulaTi_Id) as TipoAula,
  horario.id as horario_id,
  professor.id as professor_id,
  horaaula.id as horaaula_id
from
  AlocaProf,
  AlocXHor,
  Horario,
  Turma,
  Professor,
  HoraAula
where
  AlocaProf.State_Id = 3000000037001
and 
  ( 
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
      and
      AlocXHor.HoraAula_06_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
      and
      AlocXHor.HoraAula_01_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
      and
      AlocXHor.HoraAula_02_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
      and
      AlocXHor.HoraAula_03_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
      and
      AlocXHor.HoraAula_04_Id = HoraAula.Id 
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
      and
      AlocXHor.HoraAula_05_Id = HoraAula.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
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
  AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
order by semana_id,horainicio,divturma,disciplina,indice,professor
