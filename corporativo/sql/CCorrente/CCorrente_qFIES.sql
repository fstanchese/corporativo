select
  CCorrente.Id,
  Banco.Nome || ' - ' || AgenciaNome as Recognize 
from
  CCorrente, Banco
where
  CCorrente.Banco_Id = Banco.Id
and
  UsarNoFIES = 'on'
order by
  Banco.Nome,AgenciaNome