(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof1_Id ),25) as Professor,
  HoraAula.WPessoa_Prof1_Id                                      as WPessoa_Id,
  HoraAula.TOXCD_Id                                              as TOXCD_Id,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                          as CodDisc,
  ShortName(toxcd_gsretdisciplina(HoraAula.TOXCD_Id),40)         as Disciplina,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                            as Turma,
  TOXCD_gsRetCurso(HoraAula.TOXCD_Id)                            as Curso,
  Decode(HoraAula.WPessoa_Prof1_Id,WPessoa_ProfResp_Id,'X',' ')  as ProfResp 
from
  HoraAula,
  Horario,
  CurrXDisc,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Admissao
where
  (
    Admissao.Demissao > p_O_Data
    or 
    Admissao.Demissao is null
  )
and
  (
    p_Disc_Id is null
    or
    CurrXDisc.Disc_Id = nvl ( p_Disc_Id , 0 )
  )
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
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
    p_Campus_Id is null
     or 
    Turma.Campus_Id = nvl( p_Campus_Id , 0)
  )
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
    Curso.Facul_Id = nvl( p_Facul_Id ,0)
     or
    p_Facul_Id is null
  )
and
  (
    Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0 )
     or
    p_CursoNivel_Id is null
  ) 
and
  ( 
    Curso.Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    HoraAula.WPessoa_Prof1_Id = nvl(  p_WPessoa_Id ,0)
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
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.WPessoa_Prof1_Id is not null
group by HoraAula.WPessoa_Prof1_id,HoraAula.TOXCD_Id,TOXCD.WPessoa_ProfResp_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof2_Id ),25) as Professor,
  HoraAula.WPessoa_Prof2_Id                                      as WPessoa_Id,
  HoraAula.TOXCD_Id                                              as TOXCD_Id,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                          as CodDisc,
  ShortName(toxcd_gsretdisciplina(HoraAula.TOXCD_Id),40)            as Disciplina,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                            as Turma,
  TOXCD_gsRetCurso(HoraAula.TOXCD_Id)                            as Curso,
  Decode(HoraAula.WPessoa_Prof2_Id,WPessoa_ProfResp_Id,'X',' ')  as ProfResp
from
  HoraAula,
  Horario,
  CurrXDisc,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Admissao
where
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  (
    p_Disc_Id is null
    or
    CurrXDisc.Disc_Id = nvl ( p_Disc_Id , 0 )
  )
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
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
    p_Campus_Id is null
     or 
    Turma.Campus_Id = nvl( p_Campus_Id , 0)
  )
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
    Curso.Facul_Id = nvl( p_Facul_Id ,0)
     or
    p_Facul_Id is null
  )
and
  (
    Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0 )
     or
    p_CursoNivel_Id is null
  ) 
and
  ( 
    Curso.Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
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
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.WPessoa_Prof2_Id is not null
group by HoraAula.WPessoa_Prof2_id,HoraAula.TOXCD_Id,TOXCD.WPessoa_ProfResp_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof3_Id ),25) as Professor,
  HoraAula.WPessoa_Prof3_Id                                      as WPessoa_Id,
  HoraAula.TOXCD_Id                                              as TOXCD_Id,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                          as CodDisc,
  ShortName(toxcd_gsretdisciplina(HoraAula.TOXCD_Id),40)            as Disciplina,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                            as Turma,
  TOXCD_gsRetCurso(HoraAula.TOXCD_Id)                            as Curso,
  Decode(HoraAula.WPessoa_Prof3_Id,WPessoa_ProfResp_Id,'X',' ')  as ProfResp
from
  HoraAula,
  Horario,
  CurrXDisc,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Admissao
where
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  (
    p_Disc_Id is null
    or
    CurrXDisc.Disc_Id = nvl ( p_Disc_Id , 0 )
  )
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
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
    p_Campus_Id is null
     or 
    Turma.Campus_Id = nvl( p_Campus_Id , 0)
  )
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
    Curso.Facul_Id = nvl( p_Facul_Id ,0)
     or
    p_Facul_Id is null
  )
and
  (
    Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0 )
     or
    p_CursoNivel_Id is null
  ) 
and
  ( 
    Curso.Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
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
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.WPessoa_Prof3_Id is not null
group by HoraAula.WPessoa_Prof3_id,HoraAula.TOXCD_Id,TOXCD.WPessoa_ProfResp_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof4_Id ),25) as Professor,
  HoraAula.WPessoa_Prof4_Id                                      as WPessoa_Id,
  HoraAula.TOXCD_Id                                              as TOXCD_Id,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                          as CodDisc,
  ShortName(toxcd_gsretdisciplina(HoraAula.TOXCD_Id),40)            as Disciplina,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                            as Turma,
  TOXCD_gsRetCurso(HoraAula.TOXCD_Id)                            as Curso,
  Decode(HoraAula.WPessoa_Prof4_Id,WPessoa_ProfResp_Id,'X',' ')  as ProfResp
from
  HoraAula,
  Horario,
  CurrXDisc,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Admissao
where
  (
  Admissao.Demissao > p_O_Data
  or 
  Admissao.Demissao is null
  )
and
  (
    p_Disc_Id is null
    or
    CurrXDisc.Disc_Id = nvl ( p_Disc_Id , 0 )
  )
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
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
    Curso.Facul_Id = nvl( p_Facul_Id ,0)
     or
    p_Facul_Id is null
  )
and
  (
    Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0 )
     or
    p_CursoNivel_Id is null
  ) 
and
  ( 
    Curso.Id = nvl( p_Curso_Id ,0)
     or
    p_Curso_Id is null
  )
and
  (
    HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
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
    p_Campus_Id is null
     or 
    Turma.Campus_Id = nvl( p_Campus_Id , 0)
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.WPessoa_Prof4_Id is not null
group by HoraAula.WPessoa_Prof4_id,HoraAula.TOXCD_Id,TOXCD.WPessoa_ProfResp_Id
)
union
(
select
  shortname(WPessoa_gsRecognize( HoraAula.WPessoa_Prof1_Id ),25) as Professor,
  HoraAula.WPessoa_Prof1_Id                                      as WPessoa_Id,
  HoraAula.TOXCD_Id                                              as TOXCD_Id,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                          as CodDisc,
  ShortName(toxcd_gsretdisciplina(HoraAula.TOXCD_Id),40)         as Disciplina,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                            as Turma,
  TOXCD_gsRetCurso(HoraAula.TOXCD_Id)                            as Curso,
  Decode(HoraAula.WPessoa_Prof1_Id,WPessoa_ProfResp_Id,'X',' ')  as ProfResp 
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  Admissao,
  DiscEsp,
  AreaAcad
where
  (
    Admissao.Demissao > p_O_Data
    or 
    Admissao.Demissao is null
  )
and
  Admissao.WPessoa_Id(+) = HoraAula.WPessoa_Prof1_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = HoraAula.TOXCD_Id
and
  Horario.Id = HoraAula.Horario_Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  AreaAcad.Id = DiscEsp.AreaAcad_Id
and
  (
    p_Facul_Id is null
    or
    AreaAcad.Facul_Id = nvl ( p_Facul_Id , 0 )
  )
and
  (
    p_Campus_Id is null
    or 
    Turma.Campus_Id = nvl( p_Campus_Id , 0)
  )
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
    HoraAula.WPessoa_Prof1_Id = nvl(  p_WPessoa_Id ,0)
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
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  nvl ( p_Curso_Id , 0 ) = 5700000000069
and
  HoraAula.WPessoa_Prof1_Id is not null
group by HoraAula.WPessoa_Prof1_id,HoraAula.TOXCD_Id,TOXCD.WPessoa_ProfResp_Id
)
order by Curso,Turma,CodDisc