select
  DiplProc.Id as Id
from
  DiplProc,
  Curr,
  TempTitulo
where
  diplproc.state_id <> 3000000026011
and
  curr.id (+)    = diplproc.curr_id 
and
  temptitulo.id (+) = diplproc.temptitulo_id 
and
  (
    curr.titulo_id = nvl (  p_Titulo_Id , 0)
    or
    temptitulo.titulo_id = nvl ( p_Titulo_Id , 0)
  )
and
  DiplProc.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
and
  DiplProc.DiplProcTi_Id = nvl ( p_DiplProcTi_Id , 0 )
  
