select
  Parcel.Campus_Id                                                 as Campus_Id,
  count(ParcelP.Id)                                                as QtdBoleto,
  to_char(ParcelP.DtVencto , 'mm/yyyy')                            as VencimentoFormat,
  to_char(sum(ParcelP.Valor-ParcelP.VlrTxFinanc) , '9G999G990D99') as VlrDividaFormat,
  to_char(sum(ParcelP.VlrTxFinanc), '9G999G990D99')                as VlrTxFinancFormat,
  to_char(sum(ParcelP.Valor), '9G999G990D99')                      as VlrParceladoFormat,
  sum(ParcelP.Valor-ParcelP.VlrTxFinanc)                           as VlrDivida,
  sum(ParcelP.VlrTxFinanc)                                         as VlrTxFinanc,
  sum(ParcelP.Valor)                                               as VlrParcelado,
  Campus_gsRecognize(Parcel.Campus_Id)                             as Campus_Recognize
from
  ParcelP,
  Parcel
where
  Parcel.Fies_id is null
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