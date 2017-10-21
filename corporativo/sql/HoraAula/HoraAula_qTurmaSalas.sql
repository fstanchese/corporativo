select * from (
    select
      Campus_gsRecognize(CurrOfe.Campus_Id) as CAMPUS,
      CursoNivel.Codigo                     as CURSONIVEL,
      Curso.NomeRed                         as CURSO,
      Turma.Codigo                          as TURMA_CODIGO,
      To_Char(Horario.HoraInicio,'hh24:mi') as HORA,
      Bloco_gsRecognize(Sala.Bloco_Id)      as BLOCO,
      Andar_gsRecognize(Sala.Andar_Id)      as ANDAR,
      Sala.Codigo                           as SALA_CODIGO
    from
      Sala,
      CurrOfe,
      Curr,
      Curso,
      CursoNivel,
      TurmaOfe,
      Turma,
      Campus,
      HoraAula,
      Horario,
      TOXCD
    where
      TurmaOfe.Turma_id = Turma.Id
    and
      Sala.Id = TurmaOfe.Sala_Id
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id
    and
      Curso.CursoNivel_Id = CursoNivel.Id
    and
      Curr.Curso_Id = Curso.Id
    and
      CurrOfe.Curr_Id = Curr.Id
    and
      CurrOfe.PLetivo_Id in ( select id from pletivo where anocorrente='on' )
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      Horario.Id = HoraAula.Horario_Id
    and
      ( TurmaOfe.Id = p_TurmaOfe_Id or p_TurmaOfe_Id is null )
    and
      ( Curso.Id = p_Curso_Id or p_Curso_Id is null )
    and
      ( p_Periodo_Id is null or Turma.Periodo_Id = nvl ( p_Periodo_Id , 0) )
    and
      (
        ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
        ( p_SemanaI_Id is null and p_SemanaF_Id is null )
      )
    and
      ( CurrOfe.Campus_Id = p_Campus_Id or p_Campus_Id is null ) 
    union
    select
      Campus_gsRecognize(Turma.Campus_Id)   as CAMPUS,
      CursoNivel.Codigo                     as CURSONIVEL,
      Curso.NomeRed                         as CURSO,
      Turma.Codigo                          as TURMA_CODIGO,
      To_Char(Horario.HoraInicio,'hh24:mi') as HORA,
      Bloco_gsRecognize(Sala.Bloco_Id)      as BLOCO,
      Andar_gsRecognize(Sala.Andar_Id)      as ANDAR,
      Sala.Codigo                           as SALA_CODIGO
    from
      Sala,
      TurmaOfe,
      Turma,
      DiscEsp,
      DEXCD,
      CurrXDisc,
      Curr,
      Curso,
      CursoNivel,
      HoraAula,
      Horario,
      TOXCD
    where
      TurmaOfe.Turma_id = Turma.Id
    and
      Sala.Id = TurmaOfe.Sala_Id
    and
      TurmaOfe.DiscEsp_Id = DiscEsp.Id
    and
      DEXCD.DiscEsp_Id = DiscEsp.Id
    and
      DEXCD.CurrXDisc_Id = CurrXDisc.Id
    and
      CurrXDisc.Curr_Id = Curr.Id
    and
      Curr.Curso_Id = Curso.Id
    and
      Curso.CursoNivel_Id = CursoNivel.Id
    and
      DiscEsp.PLetivo_Id in ( select id from pletivo where anocorrente='on' )
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      Horario.Id = HoraAula.Horario_Id
    and
      ( TurmaOfe.Id = p_TurmaOfe_Id or p_TurmaOfe_Id is null )
    and
      ( Curso.Id = p_Curso_Id or p_Curso_Id is null )
    and
      ( p_Periodo_Id is null or Turma.Periodo_Id = nvl ( p_Periodo_Id , 0) )
    and
      (
        ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
        ( p_SemanaI_Id is null and p_SemanaF_Id is null )
      )
    and
      ( Turma.Campus_Id = nvl ( p_Campus_Id , 0 ) or p_Campus_Id is null )
union
    select
      Campus_gsRecognize(Turma.Campus_Id)   as CAMPUS,
      CursoNivel.Codigo                     as CURSONIVEL,
      Curso.NomeRed                         as CURSO,
      Turma.Codigo                          as TURMA_CODIGO,
      To_Char(Horario.HoraInicio,'hh24:mi') as HORA,
      Bloco_gsRecognize(Sala.Bloco_Id)      as BLOCO,
      Andar_gsRecognize(Sala.Andar_Id)      as ANDAR,
      Sala.Codigo                           as SALA_CODIGO
    from
      HoraAula,
      Horario,
      TOXCD,
      TurmaOfe,
      Turma,
      Sala,
      CurrOfe,
      Curr,
      Curso,
      CursoNivel
    where
      Sala.Id = HoraAula.Sala_Especial_Id
    and
      Turma.Id = TurmaOfe.Turma_Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      Horario.Id = HoraAula.Horario_Id
    and
      Curr.Curso_Id = Curso.Id
    and
      Curso.CursoNivel_Id = CursoNivel.Id
    and
      TurmaOfe.CurrOfe_Id = CurrOfe.Id
    and
      CurrOfe.Curr_Id = Curr.Id
    and
      ( TurmaOfe.Id = p_TurmaOfe_Id or p_TurmaOfe_Id is null )
    and
      ( Curso.Id = p_Curso_Id or p_Curso_Id is null )
    and
      ( p_Periodo_Id is null or Turma.Periodo_Id = nvl ( p_Periodo_Id , 0) )
    and
      ( p_Campus_Id is null or Turma.Campus_Id = nvl ( p_Campus_Id , 0) )
  and
    (
      ( Horario.Semana_Id >= p_SemanaI_Id and Horario.Semana_Id <= p_SemanaF_Id )
      or
      ( p_SemanaI_Id is null and p_SemanaF_Id is null )
    )
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    HoraAula.Sala_Especial_Id is not null
  group by Campus_gsRecognize(Turma.Campus_Id), CursoNivel.Codigo, Curso.NomeRed, Turma.Codigo, To_Char(Horario.HoraInicio,'hh24:mi'), Bloco_gsRecognize(Sala.Bloco_Id), Andar_gsRecognize(Sala.Andar_Id), Sala.Codigo
) order by CAMPUS, ANDAR, BLOCO, CURSO, TURMA_CODIGO, HORA