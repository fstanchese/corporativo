select 
  nvl(count(*),0) as Total 
from 
  HoraAula 
where 
  HoraAula.TOXCD_Id = p_HoraAula_TOXCD_Id
and
  HoraAula.Horario_Id = p_HoraAula_Horario_Id
and 
  nvl(HoraAula.DivTurma_Id,0) = nvl( p_HoraAula_DivTurma_Id ,0)
and
  nvl(HoraAula.DivDisc_Id,0) = nvl( p_HoraAula_DivDisc_Id ,0)



