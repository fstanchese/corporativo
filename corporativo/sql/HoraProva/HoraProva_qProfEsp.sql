select
  WPessoa_gsRecognize(HoraProva.WPessoa_Id)       as Professor,
  HoraProva.WPessoa_Id                            as ProfessorId,
  SubStr(TOXCD_gsRetDisciplina(HoraProva.TOXCD_Id),1,50) as Disciplina,
  to_char(HoraProva.data,'dd/mm/yyyy')            as Dia,
  to_char(HoraProva.data,'HH24:mi')               as Hora,
  Sala_gsRecognize(HoraProva.Sala_Id)             as Sala,
  CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id) as CriAvalPDt
from
  HoraProva
where
  (
    p_Facul_Id is null
      or
    HoraProva.Facul_Id  = nvl( p_Facul_Id ,0)
  )
and
  (
    p_WPessoa_Id is null
     or
    HoraProva.WPessoa_Id  = nvl( p_WPessoa_Id ,0)
  ) 
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
order by
  Professor