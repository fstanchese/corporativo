
select 
  count(*) as qtdaulas
from
  horaaula 
where
  toxcd_id = nvl( p_TOXCD_Id ,0) 
