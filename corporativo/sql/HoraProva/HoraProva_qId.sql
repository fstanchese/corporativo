select
  HoraProva.*,
  Sala_gsRecognize(HoraProva.Sala_Id)       as SALA_ID_R,
  Campus_gsRecognize(HoraProva.Campus_Id)   as CAMPUS,
  WPessoa_gsRecognize(HoraProva.WPessoa_Id) as WPESSOA_ID_R,
  to_char(HoraProva.DATA,'dd/mm/yyyy')      as DATAX,
  to_char(HoraProva.DATA,'HH24:MI')         as HORAX
from
  horaProva
where
  horaProva.id = nvl( p_HoraProva_Id ,0)
