select
  shortName(WPessoa.Nome,25) as Nome,
  WPessoa.Codigo             as Codigo,
  WPessoa.Id                 as WPessoa_Id,
  matric.matricti_id                as matricti_id
from
  WPessoa,
  Matric
where
  Matric.Id not in ( select matrictransf.matric_id from matrictransf )
and
  Matric.State_Id in (3000000002002,3000000002003,3000000002010,3000000002011,3000000002012) 
and
  WPessoa.Id = Matric.WPessoa_Id
and
  (
    Matric.MatricTi_Id = nvl( p_MatricTi_Id ,0) 
    or
    p_MatricTi_Id is null
  )
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
group by WPessoa.Codigo,WPessoa.Nome,WPessoa.Id,matric.matricti_id
order by 1