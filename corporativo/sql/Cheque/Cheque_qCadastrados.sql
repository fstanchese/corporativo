select
  Cheque.*,
  Cheque.dt                              as DtCadastro,
  WPessoa.nome                           as Aluno,
  cheque.OutroEmitente                   as OutroEmitente,
  WPessoa.codigo                         as Codigo,
  Cheque_gnEmAberto(Cheque.Id)           as EmAberto,
  Chequemov_gsCobrancaExterna(Cheque.Id) as EscritorioCobranca
from
  Cheque,
  WPessoa
where
  Cheque.WPessoa_Id = WPessoa.Id (+)
and
  trunc(Cheque.Dt) >= p_Cheque_DtInicio
and
  trunc(Cheque.Dt) <= p_Cheque_DtFinal
order by
  trunc(cheque.dt),wpessoa.nome