select
  Cheque.*,
  Cheque.dt                     as DtCadastro,
  WPessoa.nome                  as Nome,
  Cheque.OutroEmitente          as OutroEmitente,
  WPessoa.codigo                as Codigo,
  Cheque_gsRetAlinea(Cheque.Id) as Alinea,
  Cheque_gnEmAberto(Cheque.Id)  as Pago
from
  Cheque,
  WPessoa
where
  (
    WPessoa_gnRetCampus(WPessoa.Id) = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  Cheque.WPessoa_Id = WPessoa.Id (+)
and
  Cheque_gnEmAberto(Cheque.Id) = 1
and
  trunc(Cheque.Dt) >= p_Cheque_DtInicio
and
  trunc(Cheque.Dt) <= p_Cheque_DtFinal
order by
  trunc(cheque.dt),wpessoa.nome