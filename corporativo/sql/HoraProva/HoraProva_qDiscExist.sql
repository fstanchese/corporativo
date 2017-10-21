select
  count(horaprova.id) as total
from
  HoraProva
where  
  HoraProva.TOXCD_Id = p_TOXCD_Id
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
