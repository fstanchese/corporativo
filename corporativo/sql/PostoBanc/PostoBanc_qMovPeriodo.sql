select
  PostoBanc.Id - 86200000000000                                                                                  as NumTransacao,
  Dt                                                                                                             as Dt,
  IP                                                                                                             as IP,
  to_number_def(replace(replace(substr(PostoBanc.transacao,1,10),'_',' '),'.',','))                              as VALOR,
  PostoBanc_gsTipoMovimento ( null, null, null, Transacao )                                                      as TipoMov,
  to_char( dt, 'dd/mm/yyyy' )                                                                                    as Dt_Format,
  to_char( dt, 'dd/mm/yy' )                                                                                      as DtAno_Format,
  to_char( dt, 'hh24:mi' )                                                                                       as Hora_Format,
  To_Char( to_number_def(replace(replace(substr(PostoBanc.transacao,1,10),'_',' '),'.',',')) , '99G999G990D99' ) as Valor_Format,
  PostoBanc.Id                                                                                                   as PostoBanc_Id
from 
  PostoBanc
Where
  substr(transacao, 1, 3) not in ( 'log' , 'des' )
and
  (
    PostoBanc.IP = p_PostoBanc_IP
  or
    p_PostoBanc_IP is null
  )
and
  to_date(PostoBanc.Dt) between  to_date ( nvl ( p_O_Data1 , sysdate ) ) and to_date ( nvl ( p_O_Data2 , sysdate ) )
order by 3,1
 