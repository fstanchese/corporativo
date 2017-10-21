select
  WPessoa.Nome                       as Nome,
  WPessoa.Codigo                     as RA,
  MatricHi.Us                        as Usuario,
  MatricHi.Dt                        as Data,
  Turmaofe_gsrecognize(MatricHi.Old) as Turma_Antiga,
  Turmaofe_gsrecognize(MatricHi.New) as Turma_Nova,
  State_gsrecognize(Matric.State_Id) as Situacao_Matric
from
  WPessoa,
  MatricHi,
  Matric,
  VestCla,
  VestOpcao,
  Vest
where
  WPessoa.Id = Matric.WPessoa_Id
and
  upper(MatricHi.Col) = 'TURMAOFE_ID'
and
  MatricHi.Matric_Id = Matric.Id
and
  Matric.Id = VestCla.Matric_Id
and
  VestCla.VestOpcao_Id = VestOpcao.Id
and
  VestOpcao.Vest_Id = Vest.Id 
and
  Vest.WPleito_Id = nvl( p_WPleito_Id ,0)
order by
  MatricHi.Dt