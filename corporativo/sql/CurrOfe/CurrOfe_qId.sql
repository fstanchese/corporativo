select   
  CurrOfe.id,  
  CurrOfe.Curr_Id,  
  CurrOfe.Periodo_Id,  
  CurrOfe.Campus_Id,  
  CurrOfe.PLetivo_Id,  
  CurrOfe_gsRecognize(CurrOfe.Id)   as Recognize,  
  Curr_gsRecognize(CurrOfe.Curr_Id) as Curr_Recognize, 
  Curr_gsRecognize(CurrOfe.Curr_Id) as Curr_Id_r, 
  Curr.Codigo                       as Curr_Codigo, 
  Curr.Curso_Id,
  CurrOfe.vestvagas,
  CurrOfe.vestchama,
  CurrOfe.Vest                      as VestOfer,
  Curr.CurrNomeHist || decode(Curr.CurrNivelDesc,null,Curr.CurrNivelDesc,' - ' || Curr.CurrNivelDesc) as NomeCurso                        
from  
  Curr,
  CurrOfe   
where   
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = nvl( p_CurrOfe_Id ,0)
