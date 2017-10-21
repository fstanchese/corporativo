select
  Recebimento.DtPagto                                                   as DtPagto,
  substr(Boleto.Competencia,5,2)||'/'||substr(Boleto.Competencia,1,4)   as Comp,
  Boleto.Valor                                                          as principal,
  Recebimento.Valor                                                     as vlrpago,
  Recebimento.Mora+Recebimento.Multa                                    as MoraMulta,
  to_char(Boleto.Valor,'999G999D99')                                    as principalFormat,
  to_char(Recebimento.Valor,'999G999D99')                               as vlrpagoFormat,
  to_char(Recebimento.Mora+Recebimento.Multa,'999G999D99')              as MoraMultaFormat,
  Recebimento_gsOrigem(Recebimento.Id)                                  as OrigemRecebimento,
  Boleto.Competencia                                                    as BoletoCompetencia
from
  Recebimento,
  Boleto
where
  BoletoTi_Id = 92200000000012
and
  Boleto.Id = Boleto_Id
and
  DtPagto between p_O_Data1 and p_O_Data2
order by DtPagto,Boleto.Competencia

