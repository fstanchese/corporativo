select
  boleto.id as Boleto_id, 
  rpad(trim(to_char(boleto.id,'999999999999999')),15) || ' ' ||
  rpad(trim(to_char(boleto.numdoc,'999999999999999')),13) || ' ' || 
  rpad(trim(to_char(wpessoa.id,'999999999999999')),15) || ' ' ||  
  to_char(boleto.dt,'dd/mm/yyyy') || ' ' ||
  to_char(boleto.dtvencto,'dd/mm/yyyy') || ' ' ||
  rpad(nvl(boleto.referencia,' '),20) || ' ' ||
  rpad(trim(to_char(boleto.valor,'999,999.99')),10) || ' ' ||
  rpad(trim(to_char(boleto.nossonum,'999999999999999')),13) || ' ' ||
  rpad(trim(to_char(boleto_gnstate(boleto.id),'99999999999999999')),15) || ' ' ||
  rpad(trim(to_char(wpessoa.codigo,'9999999999')),10) || ' ' ||
  rpad(trim(boleto.competencia),7) || ' ' ||
  rpad(trim(to_char(boleto.campus_id,'999999999999999')),15) || ' ' ||
  rpad(trim(to_char(boleto_ORIG_id,'999999999999999')),15) as Linha
from
  boleto,
  rateiobol,
  wpessoa 
where
  wpessoa.id = wpessoa_sacado_id 
and
  boleto.id = rateiobol.boleto_dest_Id 
and
  boleto.boletoti_id in ( 92200000000002 , 92200000000003, 92200000000009, 92200000000010 ) 
and
  state_base_id <> 3000000000001 
and
  boleto.ltxt is null