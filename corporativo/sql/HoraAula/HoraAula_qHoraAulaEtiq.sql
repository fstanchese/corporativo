(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof1_Id ),25)           as Professor,
  HoraAula.WPessoa_Prof1_Id                                                as WPessoa_Id,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                                      as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                                       as Sala,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id,TurmaOfe_gnRetPLetivo(TurmaOfe.Id)) as CodDisc,
  shortname(TOXCD_gsRetDisciplina(HoraAula.TOXCD_Id),30)                   as Disciplina,
  Periodo_gsRecognize(Horario.Periodo_Id)                                  as Periodo,
  Curso.Nome                                                               as CursoNome,
  HoraAula.TOXCD_Id                                                        as TOXCD_Id,
  DivTurma_gsRecognize(DivTurma_Id)                                        as DivTurma,
  Turma.Campus_Id                                                          as Campus_Id,
  HoraAula.DivTurma_Id                                                     as DivTurma_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  CurrOfe,
  Admissao
where
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id(+) = HoraAula.WPessoa_Prof1_Id
and
  Curso.Id = Turma.Curso_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
      or
    p_TurmaOfe_Id is null 
  )  
and
  (
    TOXCD.Id = nvl( p_TOXCD_Id ,0)
      or
    p_TOXCD_Id is null 
  )  
and
  ( 
    Curso.Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    HoraAula.WPessoa_Prof1_Id = nvl(  p_WPessoa_Id , 0 )
     or
    p_WPessoa_Id is null
  )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curso.CursoNivel_Id = nvl( p_CursoNivel_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
and
  HoraAula.WPessoa_Prof1_Id is not null
group by HoraAula.WPessoa_Prof1_id,HoraAula.TOXCD_Id,TurmaOfe.Sala_Id,TurmaOfe.Id,Horario.Periodo_Id,Curso.Nome,HoraAula.DivTurma_Id,Turma.Campus_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof2_Id ),30)           as Professor,
  HoraAula.WPessoa_Prof2_Id                                                as WPessoa_Id,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                                      as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                                       as Sala,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id,TurmaOfe_gnRetPLetivo(TurmaOfe.Id)) as CodDisc,
  shortname(TOXCD_gsRetDisciplina(HoraAula.TOXCD_Id),30)                   as Disciplina,
  Periodo_gsRecognize(Horario.Periodo_Id)                                  as Periodo,
  Curso.Nome                                                               as CursoNome,
  HoraAula.TOXCD_Id                                                        as TOXCD_Id,
  DivTurma_gsRecognize(DivTurma_Id)                                        as DivTurma,
  Turma.Campus_Id                                                          as Campus_Id,
  HoraAula.DivTurma_Id                                                     as DivTurma_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  CurrOfe,
  Admissao
where
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id(+) = HoraAula.WPessoa_Prof2_Id
and
  Curso.Id = Turma.Curso_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
      or
    p_TurmaOfe_Id is null 
  )  
and
  (
    TOXCD.Id = nvl( p_TOXCD_Id ,0)
      or
    p_TOXCD_Id is null 
  )  
and
  ( 
    Curso.Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id , 0 )
     or
    p_WPessoa_Id is null
  )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curso.CursoNivel_Id = nvl( p_CursoNivel_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
and
  HoraAula.WPessoa_Prof2_Id is not null
group by HoraAula.WPessoa_Prof2_id,HoraAula.TOXCD_Id,TurmaOfe.Sala_Id,TurmaOfe.Id,Horario.Periodo_Id,Curso.Nome,HoraAula.DivTurma_Id,Turma.Campus_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof3_Id ),30)           as Professor,
  HoraAula.WPessoa_Prof3_Id                                                as WPessoa_Id,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                                      as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                                       as Sala,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id,TurmaOfe_gnRetPLetivo(TurmaOfe.Id)) as CodDisc,
  shortname(TOXCD_gsRetDisciplina(HoraAula.TOXCD_Id),30)                   as Disciplina,
  Periodo_gsRecognize(Horario.Periodo_Id)                                  as Periodo,
  Curso.Nome                                                               as CursoNome,
  HoraAula.TOXCD_Id                                                        as TOXCD_Id,
  DivTurma_gsRecognize(DivTurma_Id)                                        as DivTurma,
  Turma.Campus_Id                                                          as Campus_Id,
  HoraAula.DivTurma_Id                                                     as DivTurma_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  CurrOfe,
  Admissao
where
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id(+) = HoraAula.WPessoa_Prof3_Id
and
  Curso.Id = Turma.Curso_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
      or
    p_TurmaOfe_Id is null 
  )  
and
  (
    TOXCD.Id = nvl( p_TOXCD_Id ,0)
      or
    p_TOXCD_Id is null 
  )  
and
  ( 
    Curso.Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id , 0 )
     or
    p_WPessoa_Id is null
  )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curso.CursoNivel_Id = nvl( p_CursoNivel_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
and
  HoraAula.WPessoa_Prof3_Id is not null
group by HoraAula.WPessoa_Prof3_id,HoraAula.TOXCD_Id,TurmaOfe.Sala_Id,TurmaOfe.Id,Horario.Periodo_Id,Curso.Nome,HoraAula.DivTurma_Id,Turma.Campus_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof4_Id ),30)           as Professor,
  HoraAula.WPessoa_Prof4_Id                                                as WPessoa_Id,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                                      as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                                       as Sala,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id,TurmaOfe_gnRetPLetivo(TurmaOfe.Id)) as CodDisc,
  shortname(TOXCD_gsRetDisciplina(HoraAula.TOXCD_Id),30)                   as Disciplina,
  Periodo_gsRecognize(Horario.Periodo_Id)                                  as Periodo,
  Curso.Nome                                                               as CursoNome,
  HoraAula.TOXCD_Id                                                        as TOXCD_Id,
  DivTurma_gsRecognize(DivTurma_Id)                                        as DivTurma,
  Turma.Campus_Id                                                          as Campus_Id,
  HoraAula.DivTurma_Id                                                     as DivTurma_Id
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  CurrOfe,
  Admissao
where
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id(+) = HoraAula.WPessoa_Prof4_Id
and
  Curso.Id = Turma.Curso_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  (
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
      or
    p_TurmaOfe_Id is null 
  )  
and
  (
    TOXCD.Id = nvl( p_TOXCD_Id ,0)
      or
    p_TOXCD_Id is null 
  )  
and
  ( 
    Curso.Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id , 0 )
     or
    p_WPessoa_Id is null
  )
and
 (
   Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    or
   p_Periodo_Id is null
 )
and
 (
   Turma.Campus_Id = nvl( p_Campus_Id ,0)
    or
   p_Campus_Id is null
 )
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curso.CursoNivel_Id = nvl( p_CursoNivel_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
and
  HoraAula.WPessoa_Prof4_Id is not null
group by HoraAula.WPessoa_Prof4_id,HoraAula.TOXCD_Id,TurmaOfe.Sala_Id,TurmaOfe.Id,Horario.Periodo_Id,Curso.Nome,HoraAula.DivTurma_Id,Turma.Campus_Id
)
order by Professor,Campus_Id,CursoNome,Turma,CodDisc,Periodo
