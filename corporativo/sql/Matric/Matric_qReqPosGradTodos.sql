select
  PLetivo.Nome             as Periodo,
  WPessoa.Id               as WPessoa_Id,
  WPessoa.Nome             as Nome,
  WPessoa.Codigo           as Codigo,
  WPessoa.RGRNE            as RGRNE,
  WPessoa.CPF              as CPF,
  WPessoa.FoneRes          as Telefone,
  Lograd.Nome              as Endereco,
  Lograd.CEP               as CEP,
  WPessoa.EnderNum         as Complemento,
  Bairro.Nome              as Bairro,
  Cidade.Nome              as Cidade,
  Estado.Sigla             as Estado,
  Curso.Nome               as Curso,
  Turma.Codigo             as Turma,
  substr(Turma.Codigo,5,2) as Turma_Abrev,
  Campus.Nome              as Campus
from
  Estado,
  Cidade,
  Bairro,
  Lograd,
  Curso,
  Curr,
  PLetivo,
  CurrOfe,
  Campus,
  Turma,
  TurmaOfe,
  WPessoa,
  Matric
where
  Estado.Id(+) = Cidade.Estado_Id
and
  Cidade.Id(+) = Bairro.Cidade_Id
and
  Bairro.Id(+)  = Lograd.Bairro_Id
and
  Lograd.Id(+) = WPessoa.Lograd_Id
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  PLetivo.Id = CurrOfe.PLetivo_Id 
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Campus.Id = Turma.Campus_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.Data is null
and
  Matric.State_Id = 3000000002000
and
  Matric.CriProm_Id = 870000000003
order by
  Campus.Nome,Turma.Codigo,WPessoa.Nome