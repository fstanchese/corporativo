select
  to_char(sum(boleto_gnPrincipal(Boleto.Id)),'999G999G999D99') as Principal,
  to_char(sum(Recebimento.Multa),'999G999G999D99')             as Multa,
  to_char(sum(Recebimento.Mora),'999G999G999D99')              as Mora,
  to_char(sum(boleto_gnValor(Boleto.Id)),'999G999G999D99')     as Total,
  decode(substr(Boleto.Competencia,5,2),'01','Janeiro','02','Fevereiro','03','Março','04','Abril','05','Maio','06','Junho','07','Julho','08','Agosto','09','Setembro','10','Outubro','11','Novembro','12','Dezembro') || '/' || substr(Boleto.Competencia,1,4) as Competencia
from
  Boleto,
  Recebimento
where
  Boleto.BoletoTi_Id = p_BoletoTi_Id
and
  Boleto.Id=Recebimento.Boleto_Id
and
  $v_TipoPagto is not null
and
  trunc(Recebimento.DtPagto) between p_O_Data1 and p_O_Data2
group by Boleto.Competencia
