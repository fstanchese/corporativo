select distinct 
  BoletoDest.Id as Boleto_Id,
  rpad(trim(to_char(boletoDest.id,'999999999999999')),15) || '; ' || 
  rpad(trim(to_char(boletoDest.numdoc,'999999999999999')),13) || '; ' || 
  rpad(trim(to_char(wpessoa.id,'999999999999999')),15)  || '; ' || 
  to_char(boletoDest.dt,'dd/mm/yyyy')  || '; ' || 
  to_char(boletoDest.dtvencto,'dd/mm/yyyy')  || '; ' || 
  rpad(nvl(boletoOrig.referencia,' '),20)  || '; ' ||    
  rpad(trim(to_char(boletoDest.valor,'999,999.99')),10)  || '; ' || 
  rpad(trim(to_char(boletoDest.nossonum,'999999999999999')),13)  || '; ' || 
  rpad(trim(to_char(boleto_gnstate(boletoDest.id),'99999999999999999')),15)  || '; ' || 
  rpad(trim(to_char(wpessoa.codigo,'9999999999')),10)  || '; ' || 
  rpad(trim(boletoDest.competencia),7)  || '; ' || 
  rpad(trim(to_char(boletoDest.campus_id,'999999999999999')),15)  || '; ' || 
  rpad(trim(to_char(boletoOrig.NumDoc,'999999999999999')),13) as Linha
from
  boleto boletodest,
  boleto boletoorig,
  debcred debcreddest,
  debcred debcredOrig,
  wpessoa
where
  not exists (select
                boleto_dest_id 
              from 
                rateiobol 
              where 
                boletoDest.id = boleto_dest_Id ) 
and
  wpessoa.id = BoletoDest.wpessoa_sacado_id 
and
  BoletoOrig.Id=DebCredOrig.Boleto_Destino_Id 
and
  DebcredOrig.id=debcreddest.debcred_Or_Id  
and
  debcreddest.boleto_destino_id = boletodest.id 
and
  Boletodest.boletoti_id in ( 92200000000015 ) 
and
  Boletodest.state_base_id <> 3000000000001 
and
  boletoDest.ltxt is null