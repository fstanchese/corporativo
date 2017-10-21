select
  WPessoa.Id        as WPessoa_Id, 
  WPessoa.Nome      as Nome,
  WPessoa.Codigo    as RA,
  WPessoa.FoneRes   as Fone
from
  Matric,
  WPessoa,
  TurmaOfe,
  DiscEsp
where
  Matric.State_Id in (3000000002002,3000000002003)
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.MatricTi_Id = 8300000000002
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  DiscEsp.PLetivo_Id = p_PLetivo_Id 
group by
  WPessoa.Id, WPessoa.Nome, WPessoa.Codigo, WPessoa.FoneRes
order by
  WPessoa.Nome