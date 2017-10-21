select
  DtMovimento                                         as DtMovimento,
  WPessoa_gsRecognize(WPessoa_Id)                     as Aluno,
  Cheque.OutroEmitente                                as OutroEmitente,
  Cheque.Numero                                       as Numero,
  Alinea_gsRecognize(Alinea_Id)                       as Alinea,
  ChequeMov.VlrPago                                   as ValorPago,
  Cheque.Valor                                        as ValorCheque,
  ChequeMovTi_gsRecognize(ChequeMovTi_Id)             as TpMovimentacao
from
  ChequeMov,
  Cheque
where
  Cheque.Id = ChequeMov.Cheque_Id
and
  DtMovimento between p_ChequeMov_DtMovimentoI and p_ChequeMov_DtMovimentoF
order by
  ChequeMovTi_Id,DtMovimento,Alinea_gsRecognize(Alinea_Id),Aluno,OutroEmitente