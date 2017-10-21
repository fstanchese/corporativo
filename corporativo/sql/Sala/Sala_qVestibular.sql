select
  Sala.QtdMaxCand             as Candidatos,
  lpad(Sala.VestOrdem,3,'0')  as Ordem,
  substr(Sala.Codigo,0,3)     as Sala,
  Sala.Campus_Id              as Campus_Id,
  Bloco.Nome                  as Bloco,
  Sala.Codigo                 as Codigo
from
  Bloco,
  Sala
where
  Bloco.Id = Sala.Bloco_Id
and
  Sala.VestOrdem is not null
order by
  Sala.Campus_Id,Sala.VestOrdem