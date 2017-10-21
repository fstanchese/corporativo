select
  TO_CHAR(WBOLETO.NOSSONR,'0000000000009') as NOSSONR,
  substr(p2(wboleto.ref,2),6,2)||'/'||substr(p2(wboleto.ref,2),1,4)||substr(p2(wboleto.ref,2),8,1) as parcela,
  to_char(WBOLETO.DTGERACAO,'dd/mm/yyyy') as DTGERACAO,
  to_char(WBOLETO.DTPAGTO,'dd/mm/yyyy')   as DTPAGTO,
  to_char(WBOLETO.DTVENCTO,'dd/mm/yyyy')  as DTVENCTO,
  WBOLETO.INSTRUCOES,
  WBOLETO.COMPOSICAO,
  to_char(VALOR,'9999.99') as valor,
  WBOLETO.NRDOC,
  WBOLETO.REF,
  WBOLETO.AGENCIA,
  WBOLETO.CONTACORRENTE,
  trim(WBOLETO.AGENCIA)||'-'||substr(WBOLETO.CONTACORRENTE,1,5)||'-'||substr(WBOLETO.CONTACORRENTE,6,2)||'-'||substr(WBOLETO.CONTACORRENTE,8,1) as CODIGOCEDENTE,
  trim(WBOLETO.AGENCIA)||'/'|| WBOLETO.CONTACORRENTE as CODIGOCEDENTENOVA,
  substr(REF,1,4)              as ref1,
  substr(REF,-2,2)             as refsub2,
  isnum ( substr(REF,-2,2) )   as refsub2isnum,
  replace(to_char(VALOR,'9999D99'),'.',',') as valorFormatado
from 
  WBoleto
where
  WBoleto.NrDoc = nvl( p_WBoleto_NrDoc ,0)
and
  WBoleto.State_Id = nvl( p_WBoleto_State_Id ,0)
and
  WBoleto.WPessoa_Sacado_Id = nvl( p_WPessoa_Sacado_Id ,0)