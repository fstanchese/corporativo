select  
  TurmaOfe.*
from  
  TurmaOfe
where
  TurmaOfe.id = nvl( p_TurmaOfe_Id ,0) 