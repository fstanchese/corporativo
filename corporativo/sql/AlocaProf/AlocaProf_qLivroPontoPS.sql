select
  count(*)                                       as total,
  shortname(Professor.Nome,35)                   as Professor,
  Turma.Codigo                                   as Turma,
  CurrXDisc_gsRetCodDisc(AlocaProf.CurrXDisc_Id) as CodDisc,
  Professor.Id                                   as Professor_Id,
  Horario.Semana_Id                              as Semana_Id,
  Horario.Periodo_Id                             as Periodo_Id,
  Turma.Id                                       as Turma_Id
from
  Professor,
  AlocaProf,
  AlocXHor,
  Horario,
  Turma
where
  substr(Turma.Codigo,1,4) in ('5APS','5BPS','5CPS')
and
  substr(AlocaProf.currxdisc_id,-5) not in ( 12318,12323,12308,15359,15344,15349,15354,21508,12313,18948,12309,12314,12319,12324,15355,15360,15345,21525,21513,21517,21521,15350,18952,18956,18961,18965 )
and
  AlocaProf.State_Id = 3000000037001
and
  ( 
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.Id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.Id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.Id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.Id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.Id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 1
      and
      AlocaProf.Professor_01_Id = Professor.Id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.Id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.Id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.Id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.Id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.Id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 2
      and
      AlocaProf.Professor_02_Id = Professor.Id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.Id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.Id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.Id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.Id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.Id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 3
      and
      AlocaProf.Professor_03_Id = Professor.Id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.Id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.Id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.Id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.Id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.Id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 4
      and
      AlocaProf.Professor_04_Id = Professor.Id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.Id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.Id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.Id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.Id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.Id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 5
      and
      AlocaProf.Professor_05_Id = Professor.Id
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.Id
      and
      AlocXHor.Horario_01_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.Id
      and
      AlocXHor.Horario_02_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.Id
      and
      AlocXHor.Horario_03_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.Id
      and
      AlocXHor.Horario_04_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = Professor.Id
      and
      AlocXHor.Horario_05_Id = Horario.Id
    )
    or
    ( 
      Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
      and
      AlocXHor.Horario_06_Id = Horario.Id
    )
  )
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  (
    ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
    ( p_SemanaI_Id is null and p_SemanaF_Id is null )
  )
and
  Turma.Campus_Id = nvl( p_Campus_Id ,0)
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
 alocaprof.pletivo_Id = nvl ( p_PLetivo_Id , 0 ) 
group by Professor.Nome,Turma.Id,Turma.Codigo,AlocaProf.CurrXDisc_Id,Professor.Id,Horario.Semana_Id,Horario.Periodo_Id
order by Periodo_Id,Semana_Id,Professor