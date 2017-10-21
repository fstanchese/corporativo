select
  toxcd.id     as id,
  disc.codigo  as disc,
  disc.nome    as nomedisc
from
  toxcd,
  currxdisc,
  disc
where
  disc.id (+) = currxdisc.disc_id
and
  currxdisc.id (+) = toxcd.currxdisc_id
and
  toxcd.turmaofe_id = nvl( p_TurmaOfe_Id ,0) 
order by
  nomedisc