select
  count(horaprova.id) as total
from
  HoraProva
where  
  HoraProva.DivTurma_Id = nvl( p_DivTurma_Id ,0)
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
and
  HoraProva.TOXCD_Id = nvl( p_TOXCD_Id ,0)
