select
  SUM(count(*)) as total
from
  Curr,
  Turma,
  CurrXDisc,
  Disc,
  AlocaProf,
  AlocXHor
where
  Curr.Id = CurrXDisc.Curr_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  CurrXDisc.Disc_Id = Disc.Id
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  (
    AlocXHor.Horario_01_Id = nvl ( p_Horario_Id , 0 ) 
    or
    AlocXHor.Horario_02_Id = nvl ( p_Horario_Id , 0 )
    or
    AlocXHor.Horario_03_Id = nvl ( p_Horario_Id , 0 )
    or
    AlocXHor.Horario_04_Id = nvl ( p_Horario_Id , 0 )
    or
    AlocXHor.Horario_05_Id = nvl ( p_Horario_Id , 0 )
    or
    AlocXHor.Horario_06_Id = nvl ( p_Horario_Id , 0 )
  )
and
 ( 
    ( 
      AlocXHor.Indice = 1
      and
      AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 ) 
    )
    or
    ( 
      AlocXHor.Indice = 2
      and
      AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 ) 
    )
    or
    ( 
      AlocXHor.Indice = 3
      and
      AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
    )
    or
    (
      AlocXHor.Indice = 4
      and
      AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 ) 
    )
    or
    (
      AlocXHor.Indice = 5
      and
      AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
    )
    or
    (
      AlocXHor.Indice = 6
      and
      AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
    )
  )
and
  AlocaProf.Id = AlocXHor.AlocaProf_Id 
group by turma.id
