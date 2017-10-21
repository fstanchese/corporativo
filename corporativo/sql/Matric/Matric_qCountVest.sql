select 
  Count(*) as Count
from
  Vest,
  VestOpcao, 
  VestCla,
  Matric
where
  Vest.WPleito_Id >= 7900000000033
and  
  Vest.Id = VestOpcao.Vest_Id 
and
  VestOpcao.Id = VestCla.VestOpcao_Id
and
  VestCla.Matric_Id = Matric.Id
and
(
  Matric.Id in (select Matric_Origem_Id from Matric,DebCred,Boleto where Matric.State_Id = 3000000002000 and Matric.Id = DebCred.Matric_Origem_Id and DebCred.Boleto_Destino_Id = Boleto.Id and Boleto.Referencia like '%2013/01A')
or
  Matric.State_Id in (3000000002001,3000000002002)
)  
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)