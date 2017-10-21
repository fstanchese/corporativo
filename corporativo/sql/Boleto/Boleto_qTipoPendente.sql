select
  WPessoa.Codigo                                                     as WPessoa_Codigo,
  WPessoa.Nome                                                       as WPessoa_Nome,
  Boleto.Referencia                                                  as Referencia,
  boletoti_gsrecognize(Boleto.BoletoTi_Id)                           as BOLETOTI,
  Boleto.numdoc                                                      as numdoc,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')                              as dtvenctoformatado,
  to_char(Boleto.valor,'999G990D99')                                 as valor,
  to_char( boleto_gnmulta(boleto.id),'999G990D99')                   as multa,
  to_char( boleto_gnmora (boleto.id),'999G990D99')                   as mora,
  to_char( boleto_gnvalor(boleto.id),'999G990D99')                   as total,
  state_gsrecognize(boleto_gnstate(boleto.id))                       as staterecognize,
  substr(Boleto.OrdemRef,5,2) || '/' || substr(Boleto.OrdemRef,1,4)  as ordemref_Format,
  substr(Boleto.OrdemRef,1,4)                                        as Ano,
  Boleto.DtVencto                                                    as DtVencto
from
  Boleto,
  WPessoa
where
  WPessoa.Id = Boleto.WPessoa_Sacado_Id 
and
  Boleto_gnState(Boleto.Id,sysdate, nvl( p_Boleto_Considerar , 'CONSIDERAR_ABERTO' ) ) = 3000000000002
and
  (
    WPessoa_Sacado_Id = p_WPessoa_Id 
  or
    p_WPessoa_Id is null 
  )
and
  Boleto.DtVencto between p_O_Data1 and p_O_Data2 
and
  Boleto.BoletoTi_Id = p_BoletoTi_Id
order by WPessoa.Nome, Boleto.OrdemRef
