(
select
  toxcd.id     as id,
  disc.nome    as recognize
from
  toxcd,
  currxdisc,
  disc
where
  disc.id = currxdisc.disc_id
and
  currxdisc.id = toxcd.currxdisc_id
and
  toxcd.WPessoa_ProfResp_Id = nvl( p_WPessoa_Id ,0) 
)
union
(
select
  toxcd.id     as id,
  discesp.nome as recognize
from
  toxcd,
  discesp,
  turmaofe
where
  discesp.id = turmaofe.discesp_id
and
  turmaofe.id = toxcd.turmaofe_id
and
  toxcd.WPessoa_ProfResp_Id = nvl( p_WPessoa_Id ,0) 
)
order by recognize
