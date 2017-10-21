select
  Contratante.*,
  Matric.Id             as MATRIC_ID,
  WPessoa.Id            as WPESSOA_ID,
  WPessoa.DtEmancipacao as DTEMANCIPACAO
from
  Contratante,
  Matric,
  WPessoa
where
  Wpessoa.Id = Matric.WPessoa_Id
and
  Matric.Id = Contratante.Matric_Id
and
  Contratante.Matric_Id = p_Matric_Id