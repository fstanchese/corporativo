select
  wpessoa.Id,
  WPessoa.Nome,
  WPessoa.RGRNE,
  WPessoa.Codigo,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')  as cpfFormatado,
  bolsa_gsprouni(wpessoa.id,trunc(sysdate)) as prouni
from
  WPessoa
where
	codigo is not null
	
	and
	

  (
    WPessoa.Id = p_WPessoa_Id
  and
    p_WPessoa_Id is not null
  )
  or
    (
      RGRNE = p_WPessoa_RGRNE 
    and
      p_WPessoa_RGRNE is not null 
    )
  or 
    (
      Codigo = p_WPessoa_Codigo
    or 
      CPF = p_WPessoa_Codigo
    and
      p_WPessoa_Codigo is not null
    )
  or
  ( 
    translate(upper(wpessoa.nome),'ацимстзгй','AAEIOOUCE') like replace( trim( translate(upper( p_WPessoa_Nome ),'ацимстзгй','AAEIOOUCE') ),' ','%')||'%'
    and
    p_WPessoa_Nome is not null
  )
  
  
order by
  wpessoa.Nome

  
  
  