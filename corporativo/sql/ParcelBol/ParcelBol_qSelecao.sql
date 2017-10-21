select
  Boleto.Id                                         as Id,
  Boleto_gnState(Boleto.Id)                         as State_Id,
  to_char(sysdate,'DD/MM/YYYY HH24:MI:SS')          as DataHora,
  Boleto.Referencia                                 as Referencia,
  p2(Boleto.Referencia,2)                           as ReferenciaMensalidade,
  Referencia || ' - R$' || to_char(Boleto.Valor,'9G990D99') || ' - ' || to_char(Boleto.DtVencto,'dd/mm/yyyy') || ' - ' ||  Boleto.NossoNum as Recognize, 
  State_gsRecognize(Boleto_gnState(Boleto.Id))      as Estado,
  Boleto.us                                         as US,
  Boleto.BoletoTi_Id                                as BoletoTi_Id,
  boletoti_gsrecognize(boletoti_id)                 as BOLETOTI,
  numdoc,
  dtvencto,
  to_char(valor,'999G990D99')                       as valor,
  to_char( boleto_gnmulta(boleto.id),'999G990D99')  as multa,
  to_char( boleto_gnmora (boleto.id),'999G990D99')  as mora,
  to_char( boleto_gnvalor(boleto.id),'999G990D99')  as total,
  state_gsrecognize(boleto_gnstate(boleto.id))      as staterecognize,
  ParcelBol.multa                                   as multaaplic,  
  ParcelBol.mora                                    as moraaplic,  
  to_char( ParcelBol.descontomulta,'999G990D99')    as descontomulta,
  to_char( ParcelBol.descontomora,'999G990D99')     as descontomora,
  Campus_gsRecognize(Campus_Id)                     as Campus_Recognize,
  Campus_Id                                         as Campus_Id,
  Boleto_gnValor(Boleto.Id,sysdate,ParcelBol.Mora,ParcelBol.Multa) + nvl(ParcelBol.DescontoMora,0) + nvl(ParcelBol.DescontoMulta,0) as VALORTOTAL,
  to_char( Boleto_gnValor(Boleto.Id,sysdate,ParcelBol.Mora,ParcelBol.Multa) + nvl(ParcelBol.DescontoMora,0) + nvl(ParcelBol.DescontoMulta,0),'999G990D99' ) as VALORTOTALFORMAT,
  Boleto_gnValor(Boleto.Id,nvl(ParcelBol.Dt,sysdate),ParcelBol.Mora,ParcelBol.Multa) + nvl(ParcelBol.DescontoMora,0) + nvl(ParcelBol.DescontoMulta,0) as ValorTotalDtParcel,
  to_char( Boleto_gnValor(Boleto.Id,nvl(ParcelBol.Dt,sysdate),ParcelBol.Mora,ParcelBol.Multa) + nvl(ParcelBol.DescontoMora,0) + nvl(ParcelBol.DescontoMulta,0),'999G990D99' ) as ValorTotalFormatDtParcel,
  Decode ( Multa, 'on', 0, Boleto_gnMulta( boleto.id , sysdate ) ) + DescontoMulta    as MULTAAPLICADA,
  Decode ( Mora, 'on', 0, Boleto_gnMora( boleto.id , sysdate ) ) + DescontoMora       as MORAAPLICADA
from
  Boleto,
  ParcelBol
where
  Boleto.Id = ParcelBol.Boleto_Id
and
  ParcelBol.Parcel_Id = nvl( p_Parcel_Id ,0)
order by OrdemRef