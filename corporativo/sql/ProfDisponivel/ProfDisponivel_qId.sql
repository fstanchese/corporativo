select
  ProfDisponivel.*,
  WPessoa_gsRecognize(ProfDisponivel.WPessoa_Id) as WPessoa_Label
from
  ProfDisponivel
where
  Id = nvl( p_ProfDisponivel_Id ,0)