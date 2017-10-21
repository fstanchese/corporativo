oDoc ( Retorna boletos em aberto )

select
  wboleto.id,
  wboleto.ref,
  wboleto.nossonr,
  wboleto.dtvencto,
  to_char(wboleto.valor,'9G999D99') as valor,
  wpessoa.nome
from
  wboleto,
  wpessoa
where
  wboleto.state_id = 3100000000002
and
  wpessoa.id = wboleto.wpessoa_sacado_id
and
  wpessoa.senha = p_wpessoa_senha
and
  (
    wpessoa.rgrne = p_wpessoa_rgrne
or
   wpessoa.codigo = p_wpessoa_rgrne
  )
order by
  wboleto.dtvencto
