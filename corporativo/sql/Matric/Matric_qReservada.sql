select
  to_char( nvl( Recebimento.DtPagto ,sysdate),'DD/MM/YYYY')  as DtPagto,
  Recebimento.Valor                                          as Valor,
  Matric.Id                                                  as Matric_Id,
  WPessoa.Nome                                               as Nome, 
  initcap(p2(WPessoa.Nome,1))                                as Nick,
  WPessoa.Email1                                             as Email
from
  WPessoa,
  Matric,
  DebCred,
  Recebimento,
  Boleto
where
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.Id not in (select Matric_Id from Matrichi where col='State_Id')
and
  trunc(Matric.Dt) > '01/09/2012'
and
  Matric.DtReserva is null
and
  Matric.State_Id = 3000000002000
and
  Matric.Id = DebCred.Matric_Origem_Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  Recebimento.Boleto_Id(+) = Boleto.Id
and
  Boleto_gnState(Boleto.Id) in (3000000000004,3000000000008)
and
  Boleto.BoletoTi_Id = 92200000000008