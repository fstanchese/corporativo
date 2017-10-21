(
select
  WPessoa.nome    as Aluno,
  WPessoa.codigo  as Codigo,
  GradAlu.Id      as GradAlu_Id,
  WPessoa.Id      as WPessoa_Id 
from 
  TurmaOfe,
  TOXCD,
  CurrXDisc,
  GradAlu,
  WPessoa,
  Turma,
  Matric
where
  Matric.State_Id in ( 3000000002002,3000000002003 )
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.State_Id = 3000000003001
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
  GradAlu.WPessoa_Id = WPessoa.Id
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id 
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id 
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id 
and
  (
    Turma.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  Turma.TurmaTi_Id = nvl( p_TurmaTi_Id ,0)
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
  WPessoa.nome    as Aluno,
  WPessoa.codigo  as Codigo,
  GradAlu.Id      as GradAlu_Id,
  WPessoa.Id      as WPessoa_Id  
from 
  GradAlu,
  WPessoa,
  TurmaOfe,
  Turma,
  TOXCD,
  Matric
where
  Matric.State_Id in ( 3000000002002,3000000002003 )
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.State_Id = 3000000003001
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
  GradAlu.WPessoa_Id = WPessoa.Id
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id 
and
  (
    Turma.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
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
order by 
  1