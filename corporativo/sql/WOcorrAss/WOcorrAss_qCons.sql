
select
  L1.id, 
  replace(trim(L5.nome||'          '||
  L4.nome||'          '||
  L3.nome||'          '||
  L2.nome||'          '||
  L1.nome),'          ',' / ') "NOME"
from 
  wocorrass "L1",
  wocorrass "L2",
  wocorrass "L3",
  wocorrass "L4",
  wocorrass "L5"
where
  L4.autorel=L5.id(+)
and
  L3.autorel=L4.id(+)
and
  L2.autorel=L3.id(+)
and
  L1.autorel=L2.id(+)
and
  L1.id not in ( select autorel from wocorrass where autorel is not null )

