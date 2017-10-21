select sum(Chs) as total from (
select
  CHS1 as ChS
from
  AlocaProf
where
  AlocaProf.State_Id = 3000000037001
and
  nvl(AlocaProf.EmConjunto1,'off') = 'off'
and
  AlocaProf.Professor_01_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS2 as ChS
from
  AlocaProf
where
  AlocaProf.State_Id = 3000000037001
and
  nvl(AlocaProf.EmConjunto2,'off') = 'off'
and
  AlocaProf.Professor_02_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS3 as ChS
from
  AlocaProf
where
  AlocaProf.State_Id = 3000000037001
and
  nvl(AlocaProf.EmConjunto3,'off') = 'off'
and
  AlocaProf.Professor_03_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS4 as ChS
from
  AlocaProf
where
  AlocaProf.State_Id = 3000000037001
and
  nvl(AlocaProf.EmConjunto4,'off') = 'off'
and
  AlocaProf.Professor_04_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS5 as ChS
from
  AlocaProf
where
  AlocaProf.State_Id = 3000000037001
and
  nvl(AlocaProf.EmConjunto5,'off') = 'off'
and
  AlocaProf.Professor_05_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
union all
select
  CHS6 as ChS
from
  AlocaProf
where
  AlocaProf.State_Id = 3000000037001
and
  nvl(AlocaProf.EmConjunto6,'off') = 'off'
and
  AlocaProf.Professor_06_Id = nvl ( p_Professor_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
)