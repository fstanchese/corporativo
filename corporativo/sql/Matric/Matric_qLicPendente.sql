select 
  count(WPessoa.Id) as QtdeApr,
  WPessoa.Id        as WPessoa_Id,
  WPessoa.Nome      as Nome
from
  WPessoa,
  Matric,
  GradAlu
where
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.State_Id = 3000000002010
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.GradAluti_Id = 8500000000004
group by 
  WPessoa.Id,WPessoa.Nome
having 
  count(WPessoa.Id) < 6
order by
  WPessoa.Nome