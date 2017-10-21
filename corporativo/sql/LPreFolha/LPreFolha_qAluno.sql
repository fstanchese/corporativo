(
select
  shortname(WPessoa.nome,25) as Aluno,
  WPessoa.codigo             as Codigo,
  WPessoa.Id                 as Id,
  GradAlu.Id                 as GradAlu_Id
from 
  TurmaOfe,
  TOXCD,
  CurrXDisc,
  Matric,
  GradAlu,
  WPessoa,
  Turma
where
  matric.id not in (select matric_id from matrictransf) 
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
    p_DivTurma_Id is null
  )
and
  GradAlu.WPessoa_Id = WPessoa.Id
and
  Matric.State_Id in ( 3000000002002,3000000002003 )
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id 
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id 
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id 
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
  WPessoa.nome   as Aluno,
  WPessoa.codigo as Codigo,
  WPessoa.Id     as Id,
  GradAlu.Id     as GradAlu_Id 
from 
  GradAlu,
  WPessoa,
  Matric,
  TurmaOfe,
  Turma,
  TOXCD
where
  matric.id not in (select matric_id from matrictransf) 
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
    p_DivTurma_Id is null
  )
and
  GradAlu.WPessoa_Id = WPessoa.Id
and
  Matric.State_Id in ( 3000000002002,3000000002003 )
and
  Matric.Id = GradAlu.Matric_Id
and
  GradAlu.State_Id = 3000000003001
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
order by 
  1