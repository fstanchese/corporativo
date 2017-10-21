select
  GradAlu_gnRetPLetivo(GradAlu.Id)    as PLetivo_Id,
  GradAlu_gsRetMediaFinal(GradAlu.Id) as MediaFinal,
  State_gsRecognize(State_Id)         as State,
  GradAlu.Id                          as Id,  
  GradAlu.Id                          as GradAlu_Id,
  GradAlu.State_Id                    as State_Id,
  GradAlu.Matric_Id                   as Matric_Id,
  GradAlu.DivTurma_Teoria_Id,     
  GradAlu.DivTurma_Pratica_Id,    
  GradAlu.DivTurma_Lab_Id,        
  Pletivo_gsRetNome(GradAlu_gnRetPLetivo(GradAlu.Id))    as PLetivo,
  GradAlu_gsNotaAlterada(GradAlu.N5) as N5ALT,
  GradAlu_gsNotaAlterada(GradAlu.N7) as N7ALT,
  TurmaOfe.Turma_Id,
  GradAlu.TurmaOfe_Id as TurmaOfe_Id 
from
  GradAlu,
  TurmaOfe
where
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  GradAlu.State_Id <> 3000000003002
and
  ( 
    p_State_Id is null
      or
    GradAlu.State_Id = nvl( p_State_Id ,0)
  ) 
and
  GradAlu.CurrXDisc_Id = nvl( p_CurrXDisc_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)

