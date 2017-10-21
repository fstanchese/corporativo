select 
  Sala.Codigo       as Sala,
  Sala.QtdMaxCand   as Candidatos,
  Sala.VestAlocados as Alocados,
  Sala.VestOrdem    as Ordem,
  Count(Vest.Id)    as Confirmadas,
  Sala.Id           as Id,
  Sala.Campus_Id    as Campus_Id 
from 
  Sala,
  Vest,
  DebCred,
  Boleto 
where
  Sala.Id = Vest.Sala_Id
and
  Vest.WPleito_Id = 7900000000035
and
  Vest.Id = DebCred.Vest_Origem_Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  Boleto_gnState(Boleto.Id,trunc(sysdate),'CONSIDERAR_QUITADO') in (3000000000004,3000000000008,3000000000003)
and
  Boleto.Referencia = 'Vest 2013/3'
group by
  Sala.Campus_Id,Sala.VestOrdem,Sala.QtdMaxCand,Sala.Codigo,Sala.VestAlocados,Sala.Id
order by
  Sala.Campus_Id,Sala.VestOrdem