select
  Sala.Codigo       as Sala,
  Sala.QtdMaxCand   as Candidatos,
  Sala.VestAlocados as Alocados,
  Sala.VestOrdem    as Ordem,
  Count(Vest.Id)    as Confirmadas,
  Sala.Id           as Id,
  Sala.Campus_Id    as Campus_Id
from
  Andar,
  Bloco,
  Sala,
  Vest,
  DebCred,
  Boleto
where
  Andar.Id = Sala.Andar_Id
and
  Bloco.Id = Sala.Bloco_Id
and
  Sala.Id = Vest.Sala_Id
and
  Vest.WPleito_Id = 7900000000038
and
  Vest.Id = DebCred.Vest_Origem_Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  Boleto_gnState(Boleto.Id,trunc(sysdate),'CONSIDERAR_QUITADO') in (3000000000004,3000000000008,3000000000003)
and
  Boleto.Referencia = 'Vest 2014'
group by
  Sala.Campus_Id,Sala.VestOrdem,Sala.QtdMaxCand,Sala.Codigo,Sala.VestAlocados,Sala.Id,Bloco.Nome,Andar.Nome
order by 
  Sala.Campus_Id,Sala.VestOrdem