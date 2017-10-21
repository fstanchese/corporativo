select * from 
(
select
  GradAlu.WPessoa_Id,
  CurrOfe.Curr_Id,
  WPessoa_gsRecognize(GradAlu.WPessoa_Id) as NomeAluno
from
  GradAluHi,
  GradAlu,
  TurmaOfe,
  CurrOfe,
  Matric
where
  Matric.Atualizar is not null
and
  GradAluHi.Col like 'N%'
and
  GradAluHi.Old is not null
and
  GradAlu.Matric_Id    = Matric.Id
and
  TurmaOfe.CurrOfe_Id  = CurrOfe.Id
and
  GradAlu.TurmaOfe_Id  = TurmaOfe.Id
and
  GradAlu.GradAluTi_Id = 8500000000001
and
  GradAluHi.GradAlu_Id = GradAlu.Id
and
  CurrOfe.PLetivo_Id = nvl ( 7200000000082 , 0)
union
select
  GradAlu.WPessoa_Id,
  CurrOfe.Curr_Id,
  WPessoa_gsRecognize(GradAlu.WPessoa_Id)    as NomeAluno
from
  GradAluHi,
  GradAlu,
  ( select id,matric_pai_id,turmaofe_id,atualizar from matric where matric_pai_id is not null) MATRICPAI,
  matric,
  turmaofe,
  CurrOfe
where
 ( Matric.Atualizar is not null or matricpai.atualizar is not null )
and
  GradAluHi.Col like 'N%'
and
  GradAluHi.Old is not null
and
  TurmaOfe.CUrrOfe_Id = CurrOfe.Id
and
  turmaofe.id=matric.turmaofe_Id
and
  matricpai.matric_pai_id=matric.id
and
  MATRICPAI.id = gradalu.matric_Id
and
  GradAlu.GradAluTi_Id <> 8500000000001
and
  GradAluHi.GradAlu_Id = GradAlu.Id
and
  CurrOfe.PLetivo_Id = nvl( 7200000000082 , 0 )
)
group by wpessoa_id,curr_id,nomealuno
order by 3