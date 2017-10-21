select
  referencia,
  boletoti_gsrecognize(boletoti_id) as BOLETOTI,
  numdoc,
  to_char(dtvencto,'dd/mm/yyyy')    as dtvenctoformatado,
  to_char(valor,'999G990D99')       as valor,
  to_char( boleto_gnmulta(boleto.id),'999G990D99')       as multa,
  to_char( boleto_gnmora (boleto.id),'999G990D99')       as mora,
  to_char( boleto_gnvalor(boleto.id),'999G990D99')       as total,
  state_gsrecognize(boleto_gnstate(boleto.id))           as staterecognize,
  substr(ordemref,5,2) || '/' || substr(ordemref,1,4)    as ordemref_Format,
  substr(ordemref,1,4)                                   as Ano
from
  Boleto
where
  Boleto_gnState(Id,sysdate, nvl( p_Boleto_Considerar , 'CONSIDERAR_ABERTO' ) ) = 3000000000002
and
  state_base_id != 3000000000007
and
  ( 
    (
      p_BoletoTi_Id is null
    and
      BoletoTi_Id in (92200000000002,92200000000003,92200000000010,92200000000012)
    )
    or
    ( 
      p_BoletoTi_Id is not null
    and
      p_BoletoTi_Id = BoletoTi_Id
    )
  )
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
order by ordemref
