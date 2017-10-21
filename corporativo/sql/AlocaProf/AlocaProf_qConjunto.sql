select
  Turma.Codigo 
from
  Turma,
  CurrXDisc,
  Curr,
  AlocaProf
where
  Curr.Curso_Id <> nvl ( p_Curso_Id , 0 )
and
  Curr.Id = CurrXDisc.Curr_Id
and
  Turma.Id = AlocaProf.Turma_Id
and
  CurrXDisc.Id = AlocaProf.CurrXDisc_Id
and
  CurrXDisc.Disc_Id = nvl ( p_Disc_Id , 0 )
and
  AlocaProf.State_Id = 3000000037001
and
  Turma.Periodo_Id = nvl ( p_Periodo_Id , 0 )
and
  Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
and
  AlocaProf.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
and
(
  AlocaProf.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
  or
  AlocaProf.WPessoa_Prof2_Id = nvl ( p_WPessoa_Id , 0 )
  or
  AlocaProf.WPessoa_Prof3_Id = nvl ( p_WPessoa_Id , 0 )
  or
  AlocaProf.WPessoa_Prof4_Id = nvl ( p_WPessoa_Id , 0 )
)
group by turma.codigo
order by Turma.Codigo

