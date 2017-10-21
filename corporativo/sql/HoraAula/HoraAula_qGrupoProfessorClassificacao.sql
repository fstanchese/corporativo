(
select
  Curso.Id                              as Curso_Id,
  Curso.Nome                            as Curso_Nome $v_Atributos
from
  HoraAula,
  WPessoa,
  TOXCD,
  TurmaOfe,
  Turma,
  CurrOfe,
  Curr,
  Curso
where
  HoraAula.WPessoa_Prof1_Id = WPessoa.Id
and
  Curr.Curso_Id = Curso.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  ( 
    Curr.Curso_Id = nvl ( p_Curso_Id , 0 )
    or 
    p_Curso_Id is null 
  )
and
  ( 
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 )
    or 
    p_Periodo_Id is null 
  )
and
  (
    Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
    or
    p_Campus_Id is null
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
group by Curso.Id,Curso.Nome $v_GroupBy
)
union
(
select
  Curso.Id                              as Curso_Id,
  Curso.Nome                            as Curso_Nome $v_Atributos
from
  HoraAula,
  WPessoa,
  TOXCD,
  TurmaOfe,
  Turma,
  DiscEsp,
  Curso
where
  Turma.Curso_Id = Curso.Id
and
  HoraAula.WPessoa_Prof1_Id = WPessoa.Id
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  ( 
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or 
    p_Curso_Id is null 
  )
and
  ( 
    Turma.Periodo_Id = nvl ( p_Periodo_Id , 0 )
    or 
    p_Periodo_Id is null 
  )
and
  (
    Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
    or
    p_Campus_Id is null
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
group by Curso.Id,Curso.Nome $v_GroupBy
)
order by Curso_Nome $v_OrderBy