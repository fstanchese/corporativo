select
  PLetivo.Id   as Id,
  PLetivo.Nome as Recognize
from
  PLetivo,
  CriAvalAP
where
  (
    PLetivo.Ciclo_Id = nvl ( p_Ciclo_Id , 0 )
    or
    p_Ciclo_Id is null
  )
and
  CriAvalAp.PLetivo_Id = PLetivo.Id
group by PLetivo.Id,PLetivo.Nome
order by PLetivo.Nome Desc