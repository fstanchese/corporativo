
select 
  count(Cheque.Id) as count 
from 
  Cheque
where 
  (
    (
      ( Cheque.Numero = p_Cheque_Numero ) 
      and 
      ( p_Cheque_Numero is not null ) 
    ) 
    or 
    (
      ( Cheque.DtEmissao = p_Cheque_DtEmissao ) 
      and 
      ( p_Cheque_DtEmissao is not null ) 
    ) 
    or 
    (
      (   
        ( upper(OutroEmitente) like '%'||replace( trim( upper( p_O_Search ) ),' ','%')||'%' ) 
      or
        ( upper(WPessoa_gsRecognize(WPessoa_Id)) like '%'||replace( trim( upper( p_O_Search ) ),' ','%')||'%' ) 
      )
      and 
      ( p_O_Search is not null ) 
    ) 
  )