select
  diploma.*,
  diplproc.state_id,
  diplproc.diplprocti_id,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc  
from
  diploma,
  diplproc,
  temptitulo,
  curr
where
  diplproc.state_id <> 3000000026011
and
  diplproc.id = diploma.diplproc_Id
and
  curr.id (+) = diplproc.curr_id 
and
  temptitulo.id (+) = diplproc.temptitulo_id 
and
  (
    curr.titulo_id = nvl ( p_Titulo_Id , 0)
    or
    temptitulo.titulo_id = nvl ( p_Titulo_Id , 0)
  )
and
  diplproc.wpessoa_id = nvl ( p_WPessoa_Id ,0)
order by diploma.dtexpedicao desc

  