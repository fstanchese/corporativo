select
  CriAvalPDt.*,
  CriAval.Id as CRIAVAL_ID,
  CriAvalP.Nome as CriAvalP_Recognize,
  CriAvalP.GRADALUNOTA  
from
  CriAvalPDt,
  CriAvalP,
  CriAval
where
  CriAval.Id = CriAvalP.CriAval_Id
and
  CriAvalP.Id = CriAvalPDt.CriAvalP_Id
and
  CriAvalPDt.id = nvl( p_CriAvalPDt_Id ,0)
