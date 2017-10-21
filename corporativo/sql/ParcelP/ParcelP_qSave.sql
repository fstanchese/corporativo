select
   ParcelP.Id as ParcelP_Id, 
   rpad(trim(to_char( parcel.id - 104400000000000,'999999999999999')),15) || ' ' ||
   rpad(trim(to_char( boleto_gnNossonum(parcelp.boleto_id),'999999999999999')),15) || ' ' ||
   rpad(trim(to_char(parcelxbol.vlrprincipal,'999,990.00')),10) || ' ' ||
   rpad(trim(to_char(parcelxbol.vlrmulta,'999,990.00')),10) || ' ' ||
   rpad(trim(to_char(parcelxbol.vlrmora,'999,990.00')),10) || ' ' || 
   rpad(trim(to_char(parcelxbol.vlrtxfinanc,'999,990.00')),10) as Linha
  from 
   parcelp,
   parcelxbol, 
   parcel   
  where 
   parcelp.ltxt is null 
  and 
   parcelxbol.boleto_dest_id=parcelp.boleto_id  
  and 
   parcel.id=parcelp.parcel_id 
  and 
   parcel.state_id=3000000020003  
  and 
   to_date(parcel.dt) < to_date(sysdate) 
  order by 1,2