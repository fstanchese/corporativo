select
  HoraAula.*,
  HoraAula_gsRecognize (HoraAula.Id) as RECOGNIZE
from
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
order by
  Id
