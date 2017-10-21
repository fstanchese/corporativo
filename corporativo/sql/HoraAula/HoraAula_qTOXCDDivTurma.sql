select 
  Count(*),
  AulaTi_Id   as AulaTi_Id,
  DivTurma_Id as DivTurma_Id,
  DivDisc_Id  as DivDisc_Id
from 
  HoraAula
where
  (
     p_O_Data1 between HoraAula.DtInicio and HoraAula.DtTermino
     or
     p_O_Data2 between HoraAula.DtInicio and HoraAula.DtTermino
  )
and
  (
    p_DivDisc_Id is null
      or
    HoraAula.DivDisc_Id = nvl( p_DivDisc_Id ,0)
  )
and
  (
    p_DivTurma_Id is null
      or
    HoraAula.DivTurma_Id = nvl( p_DivTurma_Id ,0)
  )
and
  (
    p_AulaTi_Id is null
      or
    HoraAula.AulaTi_Id = nvl( p_AulaTi_Id ,0)
  )
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
group by AulaTi_Id,DivTurma_Id,DivDisc_Id
order by 2,3
