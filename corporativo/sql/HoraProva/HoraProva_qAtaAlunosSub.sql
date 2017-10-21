(
select
  WPessoa.nome    as Aluno,
  WPessoa.codigo  as Codigo,
  Replace(To_char(GradAlu_gsNotaFormatValor2(GradAlu.N3)),',','.') as Nota,
  GradAlu.InscSub as InscSub,
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
  Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
and
  Matric.Id = GradAlu.Matric_Id
and
  ( 
     GradAlu.InscSubAuto = 'on'
       or
     GradAlu.InscSub = 'on'
  )
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
  GradAlu.State_Id in ( 3000000003001,3000000003004,3000000003006,3000000003007,3000000003008 )
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
  replace(to_char(GradAlu_gsNotaFormatValor2(GradAlu.N3)),',','.') as Nota,
  GradAlu.InscSub as InscSub,
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
  Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
and
  Matric.Id = GradAlu.Matric_Id
and
  ( 
     GradAlu.InscSubAuto = 'on'
       or
     GradAlu.InscSub = 'on'
  )
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
  GradAlu.State_Id in ( 3000000003001,3000000003004,3000000003006,3000000003007,3000000003008 )
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