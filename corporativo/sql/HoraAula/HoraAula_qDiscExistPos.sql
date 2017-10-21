(
select
   HoraAula.Dtinicio,
   HoraAula.DtTermino
from
  HoraAula
where
  HoraAula.DtTermino > to_date( p_O_Data1 )
and
  to_date( p_O_Data2 ) > HoraAula.DtTermino
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
union
select
  HoraAula.Dtinicio,
  to_date( p_O_Data2 ) as DtTermino
from
  HoraAula
where
  HoraAula.DtTermino > to_date( p_O_Data1 )
and
  to_date( p_O_Data2 ) <= HoraAula.DtTermino
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
union
select
  to_date( p_O_Data1 ) as DtInicio,
  HoraAula.DtTermino
from
  HoraAula
where
  HoraAula.DtTermino > to_date( p_O_Data1 )
and
  to_date( p_O_Data1 ) > HoraAula.DtInicio
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
union
select
  HoraAula.DtInicio,
  HoraAula.DtTermino 
from
  HoraAula
where
  HoraAula.DtTermino > to_date( p_O_Data1 )
and
  to_date( p_O_Data1 ) <= HoraAula.DtInicio
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
)
order by 1