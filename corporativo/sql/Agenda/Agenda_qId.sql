select
  agenda.*,
  wpessoa_gsRecognize(agenda.wpessoa_id) as criador,
  wpessoa_gsRecognize(WPESSOA_ULTALT_ID) as alterador,
  to_char(agenda.dt, 'DD/MM/YYYY HH24:MI')            as DTCRIADO,
  to_char(agenda.lupd, 'DD/MM/YYYY HH24:MI')            as DTALT,
  AgendaAss_gsRecognize(Agenda.AgendaAss_Id) as AgendaAss,
  upper(WPessoa_gsNomeUs(WPessoa_UltAlt_Id)) as WPessoa_UltAlt,
  to_char(agenda.DtInicio,'yyyymmdd')        as DtInicioFormat
from
  Agenda
where
  id = p_Agenda_Id