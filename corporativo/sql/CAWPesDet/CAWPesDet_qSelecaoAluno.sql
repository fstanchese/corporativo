select
  wpessoa.Id,
  WPessoa.Nome,
  wpessoa.cpf
  
from
  WPessoa,CAWPesDet
  
where

	wpessoa.id = cawpesdet.wpessoa_id
	
	and

   (
    (
      CPF = p_WPessoa_CPF 
    and
      p_WPessoa_CPF is not null 
    )
  
  or
  ( 
    translate(upper(wpessoa.nome),'ацимстзгй','AAEIOOUCE') like replace( trim( translate(upper( p_WPessoa_Nome ),'ацимстзгй','AAEIOOUCE') ),' ','%')||'%'
    and
    p_WPessoa_Nome is not null
  )
  
  )
  
  and caevento_id = p_CAEvento_Id

group by wpessoa.id, wpessoa.nome, wpessoa.cpf
  
order by
  wpessoa.Nome
