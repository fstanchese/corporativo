select 
  count(*) as total
from 
  WPessoa,TurmaOfe,Matric,CurrOfe,Curr 
where 
  Curr.Id = CurrOfe.Curr_Id 
and 
  CurrOfe.Id = TurmaOfe.CurrOfe_Id 
and 
  WPessoa.Id = Matric.WPessoa_Id 
and 
  TurmaOfe.CurrOfe_Id = CurrOfe.Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id 
and 
  Matric.State_Id > 3000000002001 
and 
  to_number( '$v_AnoLetivo' )-to_number(to_char(wpessoa.dtnascto,'YYYY')) between p_Idade_Inicio and p_Idade_Termino
and 
  Curr.Curso_Id = nvl( p_Curso_Id , 0 )
and
  CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0)
and 
  WPessoa.Sexo_Id = nvl ( p_Sexo_Id , 0) 
and 
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )