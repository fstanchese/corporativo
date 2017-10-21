select
  Pagto.Id    as Id,
  Pagto.Nome || ' - R$' || trim(to_char(Pagto_gnValor(Id),'999G999G999D99')) ||'/R$'||trim(to_char(Pagto_gnValor(Id,'on'),'999G999G999D99')) as Recognize
from
  Pagto
where
  (
    p_O_Data between DtInicio and DtTermino
  or
    p_O_Data is null
  )
and
  Pagto.UsarDCex = 'on'
order by
  Recognize