select
  Id,
  Descricao,
  CBO_gsrecognize(Id) as recognize 
from 
  CBO  
where
  upper(Descricao) like '%'||replace(upper( p_O_Search ),' ','%')||'%'
and
  trim( p_O_Search ) is not null
order by
  recognize
