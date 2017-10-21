
select
  toxcd.id                                as id,
  turmaofe_gsrecognize(toxcd.turmaofe_id) as recognize,
  discEsp.nome                            as disc
from
  toxcd,
  turmaofe,
  discEsp
where
  toxcd.turmaofe_id = turmaofe.id 
and
  turmaofe.discEsp_id = discEsp.id
and
  discEsp.id = nvl( p_DiscEsp_Id ,0)
order by
  recognize
