select
  WPessoa.Id as WPessoa_Id,
  shortname(WPessoa.Nome,27) as NomeReduz
from
  WPessoa,
  CurrXDisc,
  Curso,
  Curr,
  GradaluTi,
  TempDpAdap,
  GradAlu,
  Matric
where
  matric.state_id=3000000002002
and
  TempDpAdap.GradAlu_Id = GradAlu.Id(+)
and
  TempDpAdap.Matric_Id = Matric.Id(+)
and
  TempDpAdap.GradAluTi_Id = GradAluTi.Id
and
  TempDpAdap.WPessoa_Id = WPessoa.Id
and
  TempDpAdap.CurrXDisc_Id = CurrXDisc.Id
and
  CurrXDisc.Disc_Id = Disc_Id
and
  CurrXDisc.Curr_Id = Curr.Id
and
  Curr.Curso_Id = Curso.Id
and
  curso.facul_id = 9600000000001
and
  TempDpAdap.PLetivo_Id = 7200000000059
group by wpessoa.id,wpessoa.nome
order by wpessoa.nome,wpessoa.id