select * from (
(
select
  CurrOfe.PLetivo_Id,
  Matric.WPessoa_Id,
  Lograd.Cep,
  WPessoa_gsRecognize(Matric.WPessoa_Id) as nome
from
  Matric,
  CurrOfe,
  TurmaOfe,
  WPessoa,
  Lograd,
  Bairro
where
  (
   Length(Lograd.Nome) > 27
   or
   Length(Bairro.Nome) > 23
  )
and
  Lograd.Bairro_Id = Bairro.Id
and
  Lograd.Cep between p_Lograd_CEP_Inicial and p_Lograd_CEP_Final
and
  Lograd.Id = WPessoa.Lograd_Id 
and
  WPessoa.Lograd_Entreg_Id is null
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.State_Id = 3000000002002
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0)
group by CurrOfe.PLetivo_Id,Matric.WPessoa_Id,Lograd.Cep
)
union
(
select
  DiscEsp.PLetivo_Id,
  Matric.WPessoa_Id,
  Lograd.Cep,
  WPessoa_gsRecognize(Matric.WPessoa_Id) as nome
from
  Matric,
  DiscEsp,
  TurmaOfe,
  WPessoa,
  Lograd,
  Bairro
where
  (
   Length(Lograd.Nome) > 27
   or
   Length(Bairro.Nome) > 23
  )
and
  Lograd.Bairro_Id = Bairro.Id
and
  Lograd.Cep between p_Lograd_CEP_Inicial and p_Lograd_CEP_Final
and
  Lograd.Id = WPessoa.Lograd_Id 
and
  WPessoa.Lograd_Entreg_Id is null
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  Matric.State_Id = 3000000002002
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id , 0)
group by DiscEsp.PLetivo_Id,Matric.WPessoa_Id,Lograd.Cep
)
union
(
select
  CurrOfe.PLetivo_Id,
  Matric.WPessoa_Id,
  Lograd.Cep,
  WPessoa_gsRecognize(Matric.WPessoa_Id) as nome
from
  Matric,
  CurrOfe,
  TurmaOfe,
  WPessoa,
  Lograd,
  Bairro
where
  (
   Length(Lograd.Nome) > 27
   or
   Length(Bairro.Nome) > 23
  )
and
  Lograd.Bairro_Id = Bairro.Id
and
  Lograd.Cep between p_Lograd_CEP_Inicial and p_Lograd_CEP_Final
and
  Lograd.Id = WPessoa.Lograd_Entreg_Id 
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Matric.State_Id = 3000000002002
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0)
group by CurrOfe.PLetivo_Id,Matric.WPessoa_Id,Lograd.Cep
)
union
(
select
  DiscEsp.PLetivo_Id,
  Matric.WPessoa_Id,
  Lograd.Cep,
  WPessoa_gsRecognize(Matric.WPessoa_Id) as nome
from
  Matric,
  DiscEsp,
  TurmaOfe,
  WPessoa,
  Lograd,
  Bairro
where
  (
   Length(Lograd.Nome) > 27
   or
   Length(Bairro.Nome) > 23
  )
and
  Lograd.Bairro_Id = Bairro.Id
and
  Lograd.Cep between p_Lograd_CEP_Inicial and p_Lograd_CEP_Final
and
  Lograd.Id = WPessoa.Lograd_Entreg_Id 
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  Matric.State_Id = 3000000002002
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id , 0)
group by DiscEsp.PLetivo_Id,Matric.WPessoa_Id,Lograd.Cep
)
)
group by PLetivo_Id,WPessoa_Id,Cep,Nome
order by Nome
