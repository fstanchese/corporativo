select 
  count(*) as total
from 
  WPessoa,TurmaOfe,Matric,VestCla,VestOpcao,Vest,CurrOfe,Curr 
where 
  Curr.Id = CurrOfe.Curr_Id 
and 
  TurmaOfe.CurrOfe_Id = VestOpcao.CurrOfe_Id 
and 
  CurrOfe.Id = VestOpcao.CurrOfe_Id 
and 
  WPessoa.Id = Vest.WPessoa_Id 
and 
  TurmaOfe.CurrOfe_Id = CurrOfe.Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id 
and 
  Matric.Id = VestCla.Matric_Id 
and 
  VestCla.VestOpcao_Id = VestOpcao.Id 
and 
  VestOpcao.Vest_Id = Vest.Id 
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
  Vest.WPleito_Id in $v_WPleito_Id