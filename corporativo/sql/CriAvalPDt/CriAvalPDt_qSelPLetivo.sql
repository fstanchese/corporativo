select
  Count(*),
  PLetivo_Id as Id,
  PLetivo_gsRecognize(PLetivo_Id) as Recognize
from
  CriAvalPDt,
  PLetivo
where
  CriAvalPDt.PLetivo_Id = PLetivo.Id
and
  ( 
    p_Ciclo_Id is null
    or
    PLetivo.Ciclo_Id = nvl ( p_Ciclo_Id ,0)
  )
group by PLetivo_Id
order by 3 desc