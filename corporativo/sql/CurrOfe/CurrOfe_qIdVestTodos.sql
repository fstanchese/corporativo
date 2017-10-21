select 
  CurrOfe.Id                      as CurrOfe_Id,
  Curr.CurrNomeVest               as Curso,
  CurrOfe.Campus_Id               as Campus_Id,
  Campus_gsRecognize(Campus_Id)   as Campus_Recognize,
  Periodo_gsRecognize(Periodo_Id) as Periodo_Recognize,
  CurrOfe_gsRecognize(CurrOfe.Id) as Recognize,
  CurrOfe.Id                      as Id
from
  curr,
  currofe
where
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  CurrOfe.Vest = 'on'
order by 
  CurrOfe.Campus_Id,Curr.CurrNomeVest,CurrOfe.Periodo_Id