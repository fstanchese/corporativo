select
  * 
from
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.DivDisc_Id is null
and
  TOXCD_Id = nvl( p_TOXCD_Id ,0)
