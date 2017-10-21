select
  CA.*,
  CA_gsrecognize(id) as RECOGNIZE
from
  CA
order by 
  data desc 
