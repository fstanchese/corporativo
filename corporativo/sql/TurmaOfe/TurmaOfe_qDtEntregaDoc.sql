select 
  TurmaOfe_gsRecognize(TurmaOfe_Id) || ' - ' || TurmaOfeHi.us ||' - ' ||to_date(old)||' --> '||to_date(new) as Recognize,
  TurmaOfeHi.dt  as Data,
  TurmaOfeHi.us  as Usuario,
  TurmaOfeHi.old as Anterior,
  TurmaOfeHi.new as Atual
from 
  TurmaOfeHi
where
  Upper(Col) = 'DTENTREGA_DOCSAA'
and
  TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
order by dt desc