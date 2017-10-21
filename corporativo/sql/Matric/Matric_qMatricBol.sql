select
  Distinct(Matric.Id)           as Id,
  Matric_gsRecognize(Matric.Id) as Recognize
from
  Boleto,
  DebCred,
  Matric
where
  Boleto.Referencia like p_Boleto_Referencia
and
  Boleto.Id = DebCred.Boleto_Destino_Id
and
  DebCred.Matric_Origem_Id = Matric.Id
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)