select
  count(WOcorr.Id) as Qtde,
  to_char(dt,'yyyy') as ano
from
  WOcorr
where
  WOcorr.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
group by to_char(dt,'yyyy')
order by ano