(
  select
    WPessoa_gsRecognize(WPessoa_Prof1_Id)   as Professor,
    Curso_gsRecognize(Curso.Id)             as Curso,
    Facul_gsRecognize(Facul_Id)             as Facul
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    WPessoa.Id = HoraAula.WPessoa_Prof1_Id
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    (
      p_Campus_Id is null
      or
      turma.campus_id = nvl ( p_Campus_Id , 0)
    )
  and
   (
     p_Periodo_Id is null
     or
     turma.periodo_id = nvl ( p_Periodo_Id, 0)
    )
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
  group by
    WPessoa_Prof1_Id,Curso.Id,Facul_Id
) 
union
(
  select
    WPessoa_gsRecognize(WPessoa_Prof2_Id)   as Professor,
    Curso_gsRecognize(Curso.Id)             as Curso,
    Facul_gsRecognize(Facul_Id)             as Facul
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    WPessoa.Id = HoraAula.WPessoa_Prof2_Id
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    (
      p_Campus_Id is null
      or
      turma.campus_id = nvl ( p_Campus_Id , 0)
    )
  and
   (
     p_Periodo_Id is null
     or
     turma.periodo_id = nvl ( p_Periodo_Id, 0)
    )
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
  group by
    WPessoa_Prof2_Id,Curso.Id,Facul_Id
) 
union
(
  select
    WPessoa_gsRecognize(WPessoa_Prof3_Id)   as Professor,
    Curso_gsRecognize(Curso.Id)             as Curso,
    Facul_gsRecognize(Facul_Id)             as Facul
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    WPessoa.Id = HoraAula.WPessoa_Prof3_Id
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    (
      p_Campus_Id is null
      or
      turma.campus_id = nvl ( p_Campus_Id , 0)
    )
  and
   (
     p_Periodo_Id is null
     or
     turma.periodo_id = nvl ( p_Periodo_Id, 0)
    )
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
  group by
    WPessoa_Prof3_Id,Curso.Id,Facul_Id
) 
union
(
  select
    WPessoa_gsRecognize(WPessoa_Prof4_Id)   as Professor,
    Curso_gsRecognize(Curso.Id)             as Curso,
    Facul_gsRecognize(Facul_Id)             as Facul
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    WPessoa.Id = HoraAula.WPessoa_Prof4_Id
  and
    (
      p_Campus_Id is null
      or
      turma.campus_id = nvl ( p_Campus_Id , 0)
    )
  and
   (
     p_Periodo_Id is null
     or
     turma.periodo_id = nvl ( p_Periodo_Id, 0)
    )
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
  group by
    WPessoa_Prof4_Id,Curso.Id,Facul_Id
)
order by 1,2