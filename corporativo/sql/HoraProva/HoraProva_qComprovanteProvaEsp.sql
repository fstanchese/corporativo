select 
  currxdisc_gsRetCodDisc(CurrXDisc_Id) as CODDISC,
  to_char(HoraProva.Data,'dd/mm/yyyy') as DATA,
  to_char(HoraProva.Data,'day')        as DIA,
  to_char(HoraProva.Data,'hh24:mi')    as HORA,
  Sala_gsRecognize(HoraProva.Sala_Id)  as SALA
from 
  GradAlu,
  HoraProva
where
  GradAlu.State_Id = 3000000003001
and
  WPessoa_Id = p_WPessoa_Id
order by 
  HoraProva.Data