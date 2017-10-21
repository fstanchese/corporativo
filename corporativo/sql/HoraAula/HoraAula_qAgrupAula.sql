select
  HoraAula.AGRUPLPRESENCAAUTO,
  Horario.Semana_id, 
  count(*) as Aulas
from
  HoraAula,
  Horario
where
  (
    p_O_Data1 between HoraAula.DtInicio and HoraAula.DtTermino
    or
    p_O_Data2 between HoraAula.DtInicio and HoraAula.DtTermino
  )
and
  Horario.Id=HoraAula.Horario_Id 
and
  nvl(HoraAula.AulaTi_Id,0) = nvl( p_AulaTi_Id ,0)
and
  nvl(HoraAula.DivDisc_Id,0) = nvl ( p_DivDisc_Id , 0 )
and
  nvl(HoraAula.DivTurma_Id,0) = nvl ( p_DivTurma_Id , 0 )
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
group by
  HoraAula.AGRUPLPRESENCAAUTO,Horario.Semana_Id
