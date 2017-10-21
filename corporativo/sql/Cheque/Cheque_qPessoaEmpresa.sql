
select 
  Cheque.*,  
  nvl(Cheque.OutroEmitente,WPessoa_gsRecognize(WPessoa.Id)) as Emitente, 
  Cheque.Id                                                 as Cheque_Id,
  Cheque_gsRecognize(Cheque.Id)                             as Recognize,
  Cheque_gnEmAberto(Cheque.Id)                              as EmAberto,
  to_char(Cheque.Valor,'999G999D99')                        as ValorFormatado
from
  Cheque,
  WPessoa
where 
  Cheque.WPessoa_Id = WPessoa.Id
and
  WPessoa.Id = nvl( p_Cheque_WPessoa_Id ,0)
and
  (
    Empresa_Id = nvl( p_Cheque_Empresa_Id ,0)
  or
    p_Cheque_Empresa_Id is null
  )