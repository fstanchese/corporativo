select 
  gradalu.id                 as id,
  Disc_gsRecognize(disc.id)  as recognize
from
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  currofe
where
  gradalu.state_id in (3000000003001,3000000003007,3000000003004,3000000003005,3000000003008,3000000003006,3000000003009)
and
  gradalu.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  currxdisc.disc_id = disc.id
and
  gradalu.currxdisc_id = currxdisc.id
and
  ( 
    p_PLetivo_Id is null
    or
    currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
  )
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
union
select 
  gradalu.id                   as id,
  Disc_gsRecognize(disc.id)    as recognize
from
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  discEsp
where
  gradalu.state_id in (3000000003001,3000000003007,3000000003004,3000000003005,3000000003008,3000000003006,3000000003009)
and
  gradalu.turmaofe_id = turmaofe.id
and
  turmaofe.discEsp_id = discEsp.id
and
  currxdisc.disc_id = disc.id
and
  gradalu.currxdisc_id = currxdisc.id
and
  ( 
    p_PLetivo_Id is null
    or
    discEsp.pletivo_id = nvl( p_PLetivo_Id ,0)
  )
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
