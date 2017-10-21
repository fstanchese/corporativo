select
  Descricao as NOME,
  WPessoa_gnCountCBO ( CBO.Id ) as QTDE
from
  CBO
order by
  Descricao
