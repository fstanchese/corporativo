select
  CriAvalP.*,
  CriAvalP_gsRecognize(CriAvalP.Id) as Recognize
from
  CriAvalP,
  CriAvalAp,
  CriAval
where
  CriAvalP.CriAval_Id = CriAval.Id
and
  CriAvalAp.CriAval_Id = CriAval.Id
and
  CriAvalAp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  CriAvalAp.CriAval_Id = nvl( p_CriAval_Id ,0)
order by
  CriAvalP.Id
