
select
  L1.id, 
  L1.codigo,
  L1.nomenet,
  L1.descricao,
  L1.descsaida,
  L1.descentrada,
  L1.temporesposta,
  L1.internet,
  L1.ativo,
  L1.info, 
  L1.wtxServico_id,
  L1.motivo,
  wtxServico_gsValor(L1.wtxServico_id) as valor,
  replace(trim(L5.nome||'          '||
  L4.nome||'          '||
  L3.nome||'          '||
  L2.nome||'          '||
  L1.nome),'          ',' / ') as nome
from 
  wocorrass L1,
  wocorrass L2,
  wocorrass L3,
  wocorrass L4,
  wocorrass L5
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
and
  L1.ativo = 'on'
order by
  L1.nomenet
