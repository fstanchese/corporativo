select
  toxcd.id                              as toxcd_id,
  horario.Id                            as horario_id,
  alocaProf.aulati_id                   as aulati_id,
  alocaProf.divTurma_id                 as divturma_id,
  professor.wpessoa_id                  as wpessoa_id,
  professor.id                          as professor_id,
  to_char(horario.horainicio,'hh24:mi') as horainicio,
  semana.numero                         as semana,
  alocxhor.indice                       as indice,
  alocxhor.id                           as alocxhor_id,
  alocaprof.id                          as alocaprof_id,
  alocaprof.currxdisc_id                as currxdisc_id,
  currxdisc.disc_id                     as disc_id
from
  currxdisc,
  semana,
  alocaprof,
  alocxhor,
  horario,
  turma,
  professor,
  toxcd,
  turmaofe,
  currofe
where
  alocaprof.currxdisc_id=currxdisc.id
and
  horario.semana_id = semana.id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.CurrXDisc_Id = AlocaProf.CurrXDisc_Id
and
  TurmaOfe.Turma_Id = AlocaProf.Turma_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  ( 
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
  )
and
  alocaprof.turma_id = turma.Id
and
  alocxhor.alocaprof_id = alocaprof.id
and
  alocaprof.state_id=3000000037001
and
  (  
    p_AlocaProf_Id is null
    or
    alocaprof.id = nvl ( p_AlocaProf_Id , 0 )
  )
and
  (
     p_AlocXHor_Indice is null
     or
     AlocXHor.Indice = nvl ( p_AlocXHor_Indice , 0 )
  )
and
  currofe.pletivo_id = nvl ( p_PLetivo_Id , 0 )
and
  alocaprof.pletivo_id = nvl ( p_PLetivo_Id , 0 ) 
and
  alocaprof.turma_Id = nvl ( p_Turma_Id , 0 )
order by toxcd_id,aulati_id,divturma_id,indice,semana,horainicio