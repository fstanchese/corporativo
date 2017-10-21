select
  HoraAula.*,
  Semana.Numero                                       as DiaSemana,
  Horario.HoraInicio                                  as Hora,
  nvl(DivTurma_gsRecognize(HoraAula.DivTurma_Id),' ') as Divisao
from
  HoraAula,
  Semana,
  Horario
where
  (
    p_O_Data1 between HoraAula.DtInicio and HoraAula.DtTermino
    or
    p_O_Data2 between HoraAula.DtInicio and HoraAula.DtTermino
  ) 
and
  Semana.Id = Horario.Semana_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.AgrupLPresencaAuto = nvl( p_HoraAula_AgrupLPresencaAuto ,0)
and
  Horario.Semana_Id = nvl( p_Semana_Id ,0)
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
order by
  Semana.Numero,Hora,Divisao
