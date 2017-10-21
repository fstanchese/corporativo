
(
select 
  to_char(WPESSOA_PROF1_id)             as id,
  wpessoa_gsrecognize(WPESSOA_PROF1_id) as recognize
from
  horaaula 
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  TOXCD_ID = nvl( p_TOXCD_Id ,0)
)
union
(
select 
  to_char(WPESSOA_PROF2_id)             as id,
  wpessoa_gsrecognize(WPESSOA_PROF2_id) as recognize
from
  horaaula 
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  WPESSOA_PROF2_id is not null
and
  TOXCD_ID = nvl( p_TOXCD_Id ,0)
)
union
(
select 
  to_char(WPESSOA_PROF3_id)             as id,
  wpessoa_gsrecognize(WPESSOA_PROF3_id) as recognize
from
  horaaula 
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  WPESSOA_PROF3_id is not null
and
  TOXCD_ID = nvl( p_TOXCD_Id ,0)
)
union
(
select 
  to_char(WPESSOA_PROF4_id)             as id,
  wpessoa_gsrecognize(WPESSOA_PROF4_id) as recognize
from
  horaaula 
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  WPESSOA_PROF4_id is not null
and
  TOXCD_ID = nvl( p_TOXCD_Id ,0)
)
order by
  2
