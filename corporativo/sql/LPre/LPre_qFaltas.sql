select
  lpre.*
from 
  lpre,
  horaaula,
  toxcd
where
  toxcd.currxdisc_id = nvl( p_CurrXDisc_Id ,0)
and
  horaaula.toxcd_id = toxcd.id
and
  lpre.horaaula_id = horaaula.id
and
  lpre.pletivop_id in
  (
    select
      id
    from
      pletivop
    where
      pletivo_id = nvl( p_PLetivo_Id ,0)
    and
    (
      p_PLetivoP_Id is null
      or
      id = nvl( p_PLetivoP_Id ,0)
    )
  )
