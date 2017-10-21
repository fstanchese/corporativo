select 
  Curso_gsRecognize(Curso.Id)               as Curso,
  Curso.Id                                  as Curso_Id,
  TOXCD.Id                                  as TOXCD_Id, 
  TOXCD_gsRetTurma(TOXCD.Id)                as CodTurma,
  TOXCD_gsRetCodDIsc(TOXCD.Id)              as CodDisc,
  WPessoa_gsRecognize(WPessoa_ProfAloc1_Id) as Prof1,
  WPessoa_gsRecognize(WPessoa_ProfAloc2_Id) as Prof2,
  WPessoa_gsRecognize(WPessoa_ProfAloc3_Id) as Prof3,
  WPessoa_gsRecognize(WPessoa_ProfAloc4_Id) as Prof4
from 
  TOXCD,  
  TurmaOfe,  
  CurrOfe,  
  Turma, 
  Curso,  
  Curr
where
  TOXCD.TurmaOfe_Id  = TurmaOfe.Id       
and 
  Curr.Curso_Id = Curso.Id               
and
  CurrOfe.Curr_Id = Curr.Id              
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id       
and
  TurmaOfe.Turma_Id = Turma.Id
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or
    p_Curso_Id is null
  )
and
  (
    Curso.Facul_Id = nvl ( p_Facul_Id , 0 )
    or
    p_Facul_Id is null
  )
and
  (  
    CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
    or 
    p_PLetivo_Id is null 
  )
and
  (
    TOXCD.WPessoa_ProfAloc1_Id = nvl ( p_WPessoa_Id , 0 )
    or
    TOXCD.WPessoa_ProfAloc2_Id = nvl ( p_WPessoa_Id , 0 )
    or
    TOXCD.WPessoa_ProfAloc3_Id = nvl ( p_WPessoa_Id , 0 )
    or
    TOXCD.WPessoa_ProfAloc4_Id = nvl ( p_WPessoa_Id , 0 )
    or
    p_WPessoa_Id is null
   ) 
order by curso,codturma,coddisc