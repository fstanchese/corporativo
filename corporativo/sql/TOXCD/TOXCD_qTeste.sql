select
  AulaTi_gsRecognize(AulaTi_id) as AulaTi 
from
  Semana,
  Horario,
  TOXCD,
  HoraAula
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Semana.Id = Horario.Semana_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0) 
group by
  AulaTi_Id
