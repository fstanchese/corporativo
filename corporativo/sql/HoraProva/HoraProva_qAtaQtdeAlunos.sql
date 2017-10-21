select sum(total) as total from
(
(
select
  Count(WPessoa.codigo) as total
from 
  TurmaOfe,
  TOXCD,
  CurrXDisc,
  GradAlu,
  WPessoa,
  Turma,
  Matric
where
  Matric.Id = GradAlu.Matric_Id
and
  (  
    GradAlu.DivTurma_Pratica_Id = nvl( p_DivTurma_Id ,0)
     or 
    GradAlu.DivTurma_Teoria_Id = nvl( p_DivTurma_Id ,0)
     or 
    GradAlu.DivTurma_Lab_Id = nvl( p_DivTurma_Id ,0)
     or
    wpessoa_gnParImpar(GradAlu.WPessoa_Id) = nvl( p_DivTurma_Id ,0)
     or
    nvl( p_DivTurma_Id ,0) = 13500000000016
  )
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = WPessoa.Id
and
  Matric.State_Id = 3000000002002
and
  Matric.Id = GradAlu.Matric_Id 
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id 
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id 
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id 
and
  Turma.TurmaTi_Id =  nvl( p_TurmaTi_Id ,0)
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and 
  TOXCD.Id = nvl( p_TOXCD_Id ,0)
)
union
(
select
  Count(WPessoa.codigo) as total
from 
  GradAlu,
  WPessoa,
  TurmaOfe,
  Turma,
  TOXCD,
  matric
where
  Matric.Id = GradAlu.Matric_Id
and
  (  
    GradAlu.DivTurma_Pratica_Id = nvl( p_DivTurma_Id ,0)
     or 
    GradAlu.DivTurma_Teoria_Id = nvl( p_DivTurma_Id ,0)
     or 
    GradAlu.DivTurma_Lab_Id = nvl( p_DivTurma_Id ,0)
     or
    wpessoa_gnParImpar(GradAlu.WPessoa_Id) = nvl( p_DivTurma_Id ,0)
     or
    nvl( p_DivTurma_Id ,0) = 13500000000016
  )
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = WPessoa.Id
and
  Matric.State_Id = 3000000002002
and
  Matric.Id = GradAlu.Matric_Id 
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id 
and
  Turma.TurmaTi_Id = nvl( p_TurmaTi_Id ,0)
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.DiscEsp_Id is not null
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and 
  TOXCD.Id = nvl( p_TOXCD_Id ,0)
)
)