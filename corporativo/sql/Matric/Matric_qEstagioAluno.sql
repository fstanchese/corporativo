select * from (
select
  Matric.Id                  as Id,
  WPessoa.Codigo             as RA,
  WPessoa.Nome               as NomeAluno,
  shortname(WPessoa.Nome,27) as NomeReduz,
  Matric.WPessoa_Id          as WPessoa_Id
from
  Matric,
  WPessoa
where
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in ( 3000000002002,3000000002010,3000000002011,3000000002012 )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
union
select
  Matric.Id                  as Id,
  WPessoa.Codigo             as RA,
  WPessoa.Nome               as NomeAluno,
  shortname(WPessoa.Nome,27) as NomeReduz,
  Matric.WPessoa_Id          as WPessoa_Id
from
  TurmaOfe,
  Currofe,
  GradAlu,
  Matric,
  WPessoa
where
  GradAlu.Matric_Id = Matric.Id
and
  GradAlu.State_Id != 3000000003002
and
  Matric.MatricTi_Id = 8300000000002
and
  Matric.State_Id in ( 3000000002002,3000000002010,3000000002011,3000000002012 )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and 
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
and
  GradAlu.CurrXDisc_Id = nvl ( p_CurrXDisc_Id , 0)
and
  CurrOfe.Pletivo_Id = nvl ( p_PLetivo_Id , 0 )
) order by NomeAluno

