select
  Curso.Id     as Curso_Id, 
  Curr.Id      as Curr_Id,
  Turma.Id     as Turma_Id,
  TurmaOfe.Id  as TurmaOfe_Id,
  Turma.Codigo as Turma
from
  Curso,
  Turma,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Curr
where
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id 
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TurmaOfe_gnRetSerie(TurmaOfe_Id)=5
and
  Curso.Codigo='1150'
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
group by Curso.Id,Curr.Id,Turma.Id,TurmaOfe.Id,Turma.Codigo
order by Turma