select
  Campus.Id as Id
from
  Campus,
  Currofe,
  TurmaOfe,
  Matric 
where
  Campus.Id(+) = CurrOfe.Campus_Id
and
  CurrOfe.Id(+) = TurmaOfe.Currofe_Id  
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.Id = nvl( p_Matric_Id ,0)
