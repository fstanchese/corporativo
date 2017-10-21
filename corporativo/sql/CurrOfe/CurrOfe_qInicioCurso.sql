
select   
  CurrOfe.Id,  
  CurrOfe.Curr_Id,  
  CurrOfe.Periodo_Id,  
  CurrOfe.Campus_Id,  
  CurrOfe.PLetivo_Id,  
  CurrOfe_gsRecognize(CurrOfe.Id)   as Recognize,
  Curr_gsRecognize(CurrOfe.Curr_Id) as Curr_Recognize,
  Curr.CurrNomeDipl,
  PLetivo_gsRecognize(CurrOfe.PLetivo_Id)
from   
  Curr,
  CurrOfe   
where
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
and
  Curr.Id = CurrOfe.Curr_id
and
  ( 
     p_Periodo_Id is null
       or 
     CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
  )
and   
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by
  8,9