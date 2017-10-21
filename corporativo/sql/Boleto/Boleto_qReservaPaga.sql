select
  Boleto.Id                               as Id,
  Recebimento.Valor                       as ValorPago,
  to_char(Recebimento.Valor,'999G999D99') as ValorPago_Format
from
  Boleto,
  Recebimento
where
  Recebimento.Id not in (select Recebimento_Id from ReembComp, Reemb where Reemb.Id = ReembComp.Reemb_Id and Reemb.WPessoa_Id = p_WPessoa_Id )
and
  Boleto.Id = Recebimento.Boleto_Id (+)
and
  Boleto.Referencia like '%' || p_O_Ano || '%'
and
  Boleto_gnState(Boleto.Id) in (3000000000004, 3000000000008)
and
  BoletoTi_Id = 92200000000008
and
  Boleto.WPessoa_Sacado_id = nvl( p_WPessoa_Id ,0)  

