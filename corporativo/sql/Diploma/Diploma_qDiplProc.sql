select
  diploma.*,
  diplproc.curr_id                                as Curr_Id,
  diplproc.temptitulo_id                          as TempTitulo_id,
  Titulo_gsRecognize(Curr.Titulo_Id)              as Titulo,
  wpessoa_gsrecognize(diploma.wpessoa_reitor_id)  as Reitor,
  Decode(WPessoa.Sexo_Id,500000000001,'Profª.',500000000002,'Prof.')||' '||WPessoa_gsrecognize(WPessoa_Diretor_Id) as Diretor,
  Decode(WPessoa.Sexo_Id,500000000001,'a','')     as Sexo_Diretor,
  wpessoa_gsrecognize(diploma.wpessoa_dra_id)     as DRA,
  diplproc.state_id,
  diplproc.diplprocti_id,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc,
  nvl(to_char(Diploma.DtColacao,'DD-MM-YYYY'),'xx-xx-xxxx')   as DtColMk, 
  nvl(to_char(Diploma.DtExpedicao,'DD-MM-YYYY'),'xx-xx-xxxx') as DtExpMk,
  diplproc.matric_id 
from 
  wpessoa,
  diploma,
  diplproc,
  temptitulo,
  curr
where
  wpessoa.id = WPessoa_Diretor_Id
and
  diplproc.state_id <> 3000000026011
and
  (
     p_State_Id is null
     or
     diplproc.state_id = nvl ( p_State_Id , 0)
  )
and
  diplproc.id = diploma.diplproc_Id
and  
  curr.id (+) = diplproc.curr_id 
and  
  temptitulo.id (+) = diplproc.temptitulo_id 
and
  DiplProc.Id in
  ( select DiplProc.Id from DiplProc start with DiplProc.Id = nvl( p_DiplProc_Id ,0) connect by PRIOR DiplProc_Pai_Id = DiplProc.Id )
order by diplproc.nrprocesso