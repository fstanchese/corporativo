select
  alocaprof.pletivo_id as id,
  pletivo.nome as recognize 
from
  AlocaProf,
  Pletivo
where
  AlocaProf.Pletivo_Id = PLetivo.Id
and
  AlocaProf.PLetivo_Id >= 7200000000091 
group by alocaprof.pletivo_id,pletivo.nome
order by PLetivo.Nome desc
