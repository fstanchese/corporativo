select
  count(*) as total
from
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0 )