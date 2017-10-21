select  
  GradAlu.*,
  Disc.Codigo,
  Curr.Curso_Id
from 
  Curr,  
  CurrXDisc,
  CurrOfe,
  TurmaOfe,
  GradAlu,  
  Matric,
  Disc
where
  Disc.Id = CurrXDisc.Disc_Id
and
  Curr.id = CurrXDisc.Curr_id  
and
  CurrXDisc.DiscCat_Id not in (5900000000004,5900000000010)
and
  CurrXDisc.Id = GradAlu.CurrXDisc_Id
and
  Matric.State_Id > 3000000002001 
and  
  Matric.Id = GradAlu.Matric_Id 
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and  
  GradAlu.State_Id <> 3000000003002 
and  
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0 ) 
and  
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0 ) 
union 
select  
  GradAlu.*,
  DiscEsp.Codigo,
  Curr.Curso_Id
from  
  Curr,  
  CurrXDisc,
  DiscEsp,
  TurmaOfe,
  GradAlu,  
  Matric
where  
  Curr.id = CurrXDisc.Curr_id  
and
  CurrXDisc.Id = GradAlu.CurrXDisc_Id
and
  Matric.State_Id > 3000000002001 
and  
  Matric.Id = GradAlu.Matric_Id 
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id 
and  
  GradAlu.State_Id <> 3000000003002 
and  
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id , 0 ) 
and  
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0 ) 
