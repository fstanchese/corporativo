select
  Cheque.Agencia                             as Agencia,
  Cheque.Conta                               as Conta,
  Cheque.Numero                              as Numero,
  Cheque.Dt                                  as ChequeDt,
  Cheque.DtEmissao                           as DtEmissao,
  Cheque.Valor                               as ValorCheque,
  ChequeMov.Vlrpago                          as ValorPago,
  to_date(ChequeMov.DtMovimento, 'dd/mm/yy') as DtMovimento,
  Alinea.Alinea                              as Alinea,
  Banco.Numero                               as Banco,
  WPessoa.Codigo                             as Codigo, 
  WPessoa.Nome                               as Nome,
  Cheque.OutroEmitente                       as OutroEmitente
from
  ChequeMov, 
  Cheque,
  Alinea,
  ChequeMovTi,
  Banco,
  WPessoa
where
  Cheque.WPessoa_Id = WPessoa.Id (+)
and
  Cheque.Banco_Id = Banco.Id
and
  ChequeMov.Alinea_Id = Alinea.Id
and
  ChequeMov.ChequeMovTi_Id = ChequeMovTi.Id
and
  ChequeMov.Cheque_Id = Cheque.Id
and
  ChequeMov.ChequeMovTi_Id = p_ChequeMov_ChequeMovTi_Id 
and
  trunc( ChequeMov.DtMovimento) >= p_ChequeMov_DtMovimentoI
and
  trunc( ChequeMov.DtMovimento) <= p_ChequeMov_DtMovimentoF
order by 
  ChequeMov.DtMovimento, WPessoa.Nome
