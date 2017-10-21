(
  select
    WPessoa_Prof1_Id                      as WPessoa_Id,
    WPessoa_gsRecognize(WPessoa_Prof1_Id) as Professor,
    Turma.Campus_Id                       as Campus_Id,
    Campus_gsRecognize(Turma.Campus_Id)   as Campus_Recognize,
    Curso.Facul_Id                        as Facul_Id,
    Facul_gsRecognize(Curso.Facul_Id)     as Facul_Recognize
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    (
      p_Facul_Id is null
       or 
      Curso.Facul_Id = nvl( p_Facul_Id , 0)
    )
  and
   (
      p_Campus_Id is null
       or 
      Turma.Campus_Id = nvl( p_Campus_Id , 0)
    )
  and
    WPessoa.Id = HoraAula.WPessoa_Prof1_Id
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Turma.Curso_Id = Curso.Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraAula.TOXCD_Id = TOXCD.Id
  and
    HoraAula.WPessoa_Prof1_Id is not null
  and
    HoraAula.Horario_Id = Horario.Id
  and
    (
      p_WPessoa_Id is null
      or
      HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 ) 
    )
  group by
    WPessoa_Prof1_Id,Campus_Id,Curso.Id,Facul_Id
) 
union
(
  select
    WPessoa_Prof2_Id                      as WPessoa_Id,
    WPessoa_gsRecognize(WPessoa_Prof2_Id) as Professor,
    Turma.Campus_Id                       as Campus_Id,
    Campus_gsRecognize(Turma.Campus_Id)   as Campus_Recognize,
    Curso.Facul_Id                        as Facul_Id,
    Facul_gsRecognize(Curso.Facul_Id)     as Facul_Recognize
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
   (
      p_Facul_Id is null
       or 
      Curso.Facul_Id = nvl( p_Facul_Id , 0)
    )
  and
   (
      p_Campus_Id is null
       or 
      Turma.Campus_Id = nvl( p_Campus_Id , 0)
    )
  and
    WPessoa.Id = HoraAula.WPessoa_Prof2_Id
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Turma.Curso_Id = Curso.Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraAula.TOXCD_Id = TOXCD.Id
  and
    HoraAula.WPessoa_Prof2_Id is not null
  and
    HoraAula.Horario_Id = Horario.Id
  and
    (
      p_WPessoa_Id is null
      or
      HoraAula.WPessoa_Prof2_Id = nvl ( p_WPessoa_Id , 0 ) 
    )
  group by
    WPessoa_Prof2_Id,Campus_Id,Curso.Id,Facul_Id
) 
union
(
  select
    WPessoa_Prof3_Id                      as WPessoa_Id,
    WPessoa_gsRecognize(WPessoa_Prof3_Id) as Professor,
    Turma.Campus_Id                       as Campus_Id,
    Campus_gsRecognize(Turma.Campus_Id)   as Campus_Recognize,
    Curso.Facul_Id                        as Facul_Id,
    Facul_gsRecognize(Curso.Facul_Id)     as Facul_Recognize
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
   (
      p_Facul_Id is null
       or 
      Curso.Facul_Id = nvl( p_Facul_Id , 0)
    )
  and
   (
      p_Campus_Id is null
       or 
      Turma.Campus_Id = nvl( p_Campus_Id , 0)
    )
  and
    WPessoa.Id = HoraAula.WPessoa_Prof3_Id
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Turma.Curso_Id = Curso.Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraAula.TOXCD_Id = TOXCD.Id
  and
    HoraAula.WPessoa_Prof3_Id is not null
  and
    HoraAula.Horario_Id = Horario.Id
  and
    (
      p_WPessoa_Id is null
      or
      HoraAula.WPessoa_Prof3_Id = nvl ( p_WPessoa_Id , 0 ) 
    )
  group by
    WPessoa_Prof3_Id,Campus_Id,Curso.Id,Facul_Id
) 
union
(
  select
    WPessoa_Prof4_Id                      as WPessoa_Id,
    WPessoa_gsRecognize(WPessoa_Prof4_Id) as Professor,
    Turma.Campus_Id                       as Campus_Id,
    Campus_gsRecognize(Turma.Campus_Id)   as Campus_Recognize,
    Curso.Facul_Id                        as Facul_Id,
    Facul_gsRecognize(Curso.Facul_Id)     as Facul_Recognize
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    (
      p_Facul_Id is null
       or 
      Curso.Facul_Id = nvl( p_Facul_Id , 0)
    )
  and
    (
      p_Campus_Id is null
       or 
      Turma.Campus_Id = nvl( p_Campus_Id , 0)
    )
  and
    WPessoa.Id = HoraAula.WPessoa_Prof4_Id
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Turma.Curso_Id = Curso.Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraAula.TOXCD_Id = TOXCD.Id
  and
    HoraAula.WPessoa_Prof4_Id is not null
  and
    HoraAula.Horario_Id = Horario.Id
  and
    (
      p_WPessoa_Id is null
      or
      HoraAula.WPessoa_Prof4_Id = nvl ( p_WPessoa_Id , 0 ) 
    )
  group by
    WPessoa_Prof4_Id,Campus_Id,Curso.Id,Facul_Id
)
order by 2