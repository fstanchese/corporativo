select 
  HoraAula.Id as HoraAula_Id,
  AulaTi_Id   as AulaTi_Id,
  DivTurma_Id as DivTurma_Id,
  DivDisc_Id  as DivDisc_Id,
  HoraAula.DtInicio as DtInicio,
  HoraAula.DtTermino as DtTermino,
  to_char(HoraAula.DtInicio,'MM')     as MesInicio,
  to_char(HoraAula.DtTermino,'MM')    as MesTermino,
  to_char(to_date( p_O_Data1 ),'MM')  as OMesInicio,
  to_char(to_date( p_O_Data2 ),'MM')  as OMesTermino
from 
  HoraAula
where
  ( 
    HoraAula.DtInicio  <= to_date( p_O_Data2 )
    and
    HoraAula.DtTermino >= to_date( p_O_Data1 )
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