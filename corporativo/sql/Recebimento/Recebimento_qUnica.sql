select
  to_char(sum(Boleto_gnPrincipal(Boleto.Id)),'999999D99')                           as ValorPrincipal,
  WPessoa.Id                                                                        as WPessoa_Id,
  to_char(trunc(sum(Boleto.Valor) * 0.05,2),'0000000000000D09')                     as ValorISSBoletoNFe,
  to_char(trunc(trunc((sum(Boleto.Valor) * 0.05 ),2) * 0.3,2),'0000000000000D09')   as ValorCred,
  to_char(sum(Boleto_gnPrincipal(Boleto.Id)),'0000000000000D09')                    as ValorPrincipalNFe
from
  Recebimento,
  Boleto,
  WPessoa,
  Lograd,
  Bairro,
  Cidade,
  Estado
where
  Recebimento.NFeNaoEnviar is null
and
  Cidade.Estado_Id = Estado.Id (+)
and
  Bairro.Cidade_Id = Cidade.Id (+)
and
  Lograd.Bairro_Id = Bairro.Id (+)
and
  WPessoa.Lograd_Id = Lograd.Id (+)
and
  Recebimento.Parcel_Origem_Id is null
and
  Recebimento.Boleto_Origem_Id is null
and
  (
    WPessoa.Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )
and
  WPessoa.Id = Boleto.WPessoa_Sacado_Id
and
  (
    Boleto.Campus_Id = nvl( p_Campus_Id , 0)
  or
    p_Campus_Id is null
  )
and
  (
    Boleto.BoletoTi_Id = nvl( p_BoletoTi_Id , 0 )
      or
    p_BoletoTi_Id is null
  )
and
  Boleto.Id = Recebimento.Boleto_Id
and
  Recebimento.DtPagto between to_date( p_O_Data1 ) and to_date( p_O_Data2 )
group by WPessoa.Id
