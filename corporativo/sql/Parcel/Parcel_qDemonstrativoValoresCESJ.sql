select
  Parcel.Campus_Id                                                        as Campus_Id,
  count(ParcelP.Id)                                                       as QtdBoleto,
  to_char(ParcelP.DtVencto , 'mm/yyyy')                                   as VencimentoFormat,
  substr(Campus_gsRecognize(Parcel.Campus_Id),1,10)                       as Campus_Recognize,
  sum(ParcelXBol.VlrTxFinanc)                                             as VlrTxFinanc,
  sum(ParcelXBol.VlrPrincipal)                                            as VlrPrincipal,
  sum(ParcelXBol.VlrMulta)                                                as VlrMulta,
  sum(ParcelXBol.VlrMulta+ParcelXBol.VlrPrincipal+ParcelXBol.VlrTxFinanc) as VlrTotal,
  to_char(sum(ParcelXBol.VlrTxFinanc),'999G999D99')                       as VlrTxFinancFormat,
  to_char(sum(ParcelXBol.VlrPrincipal),'999G999D99')                      as VlrPrincipalFormat,
  to_char(sum(ParcelXBol.VlrMulta),'999G999D99')                          as VlrMultaFormat,
  to_char(sum(ParcelXBol.VlrMulta+ParcelXBol.VlrPrincipal+ParcelXBol.VlrTxFinanc),'999G999D99') as VlrTotalFormat
from
  Parcel,
  ParcelP,
  ParcelXBol
where
  ParcelP.Boleto_Id = ParcelXBol.Boleto_Dest_Id
and
  Parcel.Fies_id is not null
and
  ParcelP.Parcel_Id = Parcel.Id
and
  parcel.State_Id = 3000000020003
and
  (
    (
      trunc(parcel.dt) between nvl( p_O_Data1 , sysdate ) and nvl ( p_O_Data2 , sysdate )
    and
      p_Parcel_Id is null
    )
    or
    (
      p_Parcel_Id is not null
    and
      Parcel.Id = p_Parcel_Id
    )
  )
group by Parcel.Campus_Id, to_char(ParcelP.DtVencto , 'mm/yyyy'), to_char(ParcelP.DtVencto , 'yyyymm')
order by Campus_Recognize, to_char(ParcelP.DtVencto , 'yyyymm')
