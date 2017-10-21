select
  Grupo    as Grupo,
  Ano      as Ano,
  count(*) as Qtd
from
  (
  Select 
    p2( Referencia, 1 ) as Grupo,
    SubStr(p2( Referencia, 2 ),1,4) As Ano
  from
    Boleto
  where 
    State_Base_Id <> 3000000000001
  and
    (
      BoletoTi_Id = nvl ( p_BoletoTi_Id , 0 )
    or
      p_BoletoTi_Id is null
    )
  and
    WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0)
  )
group by Ano, grupo
order by 2,1