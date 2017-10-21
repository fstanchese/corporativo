select
  distinct(Boleto.Id),
  Boleto.NossoNum,
  Boleto.Valor,
  to_char(Boleto.Valor,'999G999G999D99') as Valor_Format,
  Boleto.State_Base_Id,
  Boleto.DtVencto,
  Boleto.Referencia,
  Boleto.Referencia || ' - ' || to_char(Boleto.Valor,'999G999G999D99') || ' - ' || State_GsRecognize(Boleto_gnState(Boleto.Id)) as Recognize,
  PagtoP.Parcela
from
  Boleto,
  DebCred,
  PagtoP
where
  PagtoP.Id is not null
and
  PagtoP.Id = DebCred.PagtoP_Id
and
  (
    Boleto.OrdemRef = p_Boleto_OrdemRef
  or
    p_Boleto_OrdemRef is null
  )
and
  Boleto.Id = DebCred.Boleto_Destino_Id
and
  (
    (
      DebCred.Matric_Origem_Id = nvl( p_Matric_Id , 0 )
    and
      p_Matric_Id is not null
    )
  or
    (
      DebCred.TempStrito_Origem_Id = nvl( p_TempStrito_Id , 0 )
    and
      p_TempStrito_Id is not null
    )
  )
order by
  Boleto.Referencia