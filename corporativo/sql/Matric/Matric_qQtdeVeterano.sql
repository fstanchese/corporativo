select 
  count(Matric.Id)   as Qtde,
  DuracXCi.Sequencia as Sequencia,
  Periodo.Nome       as Periodo,
  CurrOfe.Periodo_Id as Periodo_Id,
  Curso.Nome         as Curso,
  Curr.Curso_Id      as Curso_Id,
  CurrOfe.Campus_Id  as Campus_Id,
  Campus.Nome        as Campus
from 
  Curr,
  Periodo,
  Campus,
  CurrOfe,
  TurmaOfe,
  Turma,
  Curso,
  DuracXCi, 
  WPessoa,
  Matric
where
  WPessoa.Id not in (select Vest.WPessoa_Id from Vest,VestOpcao,VestCla,DuracXCi,Turma,TurmaOfe,Matric where Vest.Id = VestOpcao.Vest_Id and VestOpcao.Id = VestCla.VestOpcao_Id and VestCla.Matric_Id = Matric.Id and DuracXCi.Sequencia >= 1 and DuracXCi.Id = Turma.DuracXCi_Id and Turma.Id = TurmaOfe.Turma_Id and TurmaOfe.Id = Matric.TurmaOfe_Id and Matric.State_Id = 3000000002002 and Vest.WPleito_Id > 7900000000032)
and
  DuracXCi.Id = Turma.DuracXCi_Id 
and 
  Turma.Id = TurmaOfe.Turma_Id
and
  Curso.CursoNivel_Id in (6200000000001,6200000000010,6200000000012)
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Periodo.Id = Currofe.Periodo_Id
and
  Campus.Id = CurrOfe.Campus_Id
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  WPessoa.Id = Matric.WPessoa_Id
and
  MatricTi_Id = 8300000000001
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
  )
and
  (
    CurrOfe.Vest is null
    or
    CurrOfe.Vest = 'on'
  )
and
  CurrOfe.Pletivo_Id = 7200000000083
group by DuracXCi.Sequencia,Curso.Nome,Curr.Curso_Id,Campus.Nome,CurrOfe.Campus_Id,Periodo.Nome,CurrOfe.Periodo_Id
order by Sequencia,Curso,Campus,Periodo