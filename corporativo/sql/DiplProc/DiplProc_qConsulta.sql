select
  DiplProc.*,
  State_gsRecognize(DiplProc.State_Id)       as State,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc, 
  DiplProcTi_gsRecognize(DiplProc.DiplProcTi_Id) as TipoProcesso
from
  DiplProc,
  TempTitulo,
  Curr  
where
  curr.id (+)    = diplproc.curr_id 
and
  temptitulo.id (+) = diplproc.temptitulo_id 
and
  (
    ( p_Curso_Id is null and p_Titulo_Id is null )
    or
    curr.curso_id = nvl ( p_Curso_Id , 0)
    or
    temptitulo.titulo_id = nvl ( p_Titulo_Id , 0)
  )

and
  DiplProc.WPessoa_Id = nvl ( p_WPessoa_Id ,0)  
order by nrprocesso

