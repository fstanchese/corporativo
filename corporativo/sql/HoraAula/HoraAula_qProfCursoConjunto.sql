select 
  CO.Turma_Curso as TurmaO,
  CO.Discip_Curso as DiscO,
  CO.Semana_Curso as SemanaO,
  CO.Hora_Curso as HoraO, 
  CD.Turma_Curso as TurmaD,
  CD.Discip_Curso as DiscD,
  CO.Curso_Id as CursoOri_Id,
  CD.Curso_Id as CursoDes_Id
from
  (
    select 
      TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma_Curso,
      TOXCD_gsRetCodDisc(TOXCD_Id, p_PLetivo_Id ) as Discip_Curso,
      to_char(HoraInicio,'hh24:mi') as Hora_Curso, 
      Semana_gsRecognize(Semana_Id) as Semana_Curso,
      TurmaOfe_Id as TurmaOfe_Id,
      Horario_Id as Horario_Id,
      TOXCD_Id as TOXCD_Id,
      Curso_Id as Curso_Id
    from
      ( 
      (
        select
          TOXCD.TurmaOfe_Id,
          HoraAula.TOXCD_Id,
          HoraAula.Horario_Id,
          Horario.Semana_Id,
          Horario.HoraInicio,
          Curr.Curso_Id 
        from
          HoraAula,
          Horario,
          TurmaOfe,
          CurrOfe,
          TOXCD,
          Curr
        where
          p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
        and
          Horario.Id = HoraAula.Horario_Id
        and
          HoraAula.TOXCD_Id = TOXCD.ID
        and
          TOXCD.TurmaOfe_Id = TurmaOfe.Id
        and
          TurmaOfe.CurrOfe_Id = CurrOfe.Id
        and
          CurrOfe.Curr_Id = Curr.Id
        and
          Curr.Curso_Id = nvl( p_Curso_Id ,0)
        and
          HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
      )
      union
      (
        select
          TOXCD.TurmaOfe_Id,
          HoraAula.TOXCD_Id,
          HoraAula.Horario_Id,
          Horario.Semana_Id,
          Horario.HoraInicio,
          Curr.Curso_Id  
        from
          HoraAula,
          Horario,
          TurmaOfe,
          CurrOfe,
          TOXCD,
          Curr
        where
          p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
        and
          Horario.Id = HoraAula.Horario_Id
        and
          HoraAula.TOXCD_Id = TOXCD.ID
        and
          TOXCD.TurmaOfe_Id = TurmaOfe.Id
        and
          TurmaOfe.CurrOfe_Id = CurrOfe.Id
        and
          CurrOfe.Curr_Id = Curr.Id
        and
          Curr.Curso_Id = nvl( p_Curso_Id ,0)
        and
          HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
       )
       union
       (
         select
           TOXCD.TurmaOfe_Id,
           HoraAula.TOXCD_Id,
           HoraAula.Horario_Id,
           Horario.Semana_Id,
           Horario.HoraInicio,
           Curr.Curso_Id  
         from
           HoraAula,
           Horario,
           TurmaOfe,
           CurrOfe,
           TOXCD,
           Curr
         where
           p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
         and
           Horario.Id = HoraAula.Horario_Id
         and
           HoraAula.TOXCD_Id = TOXCD.ID
         and
           TOXCD.TurmaOfe_Id = TurmaOfe.Id
         and
           TurmaOfe.CurrOfe_Id = CurrOfe.Id
         and
           CurrOfe.Curr_Id = Curr.Id
         and
           Curr.Curso_Id = nvl( p_Curso_Id ,0)
         and
           HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
       )
       union
       (
         select
           TOXCD.TurmaOfe_Id,
           HoraAula.TOXCD_Id,
           HoraAula.Horario_Id,
           Horario.Semana_Id,
           Horario.HoraInicio,
           Curr.Curso_Id 
         from
           HoraAula,
           Horario,
           TurmaOfe,
           CurrOfe,
           TOXCD,
           Curr
         where
           p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
         and
           Horario.Id = HoraAula.Horario_Id
         and
           HoraAula.TOXCD_Id = TOXCD.ID
         and
           TOXCD.TurmaOfe_Id = TurmaOfe.Id
         and
           TurmaOfe.CurrOfe_Id = CurrOfe.Id
         and
           CurrOfe.Curr_Id = Curr.Id
         and
           Curr.Curso_Id = nvl( p_Curso_Id ,0)
         and
           HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
       )
       ) 
  ) CO,  
  (
    select 
      TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma_Curso,
      TOXCD_gsRetCodDisc(TOXCD_Id, p_PLetivo_Id ) as Discip_Curso,
      to_char(HoraInicio,'hh24:mi') as Hora_Curso, 
      Semana_gsRecognize(Semana_Id) as Semana_Curso,
      TurmaOfe_Id as TurmaOfe_Id,
      Horario_Id as Horario_Id,
      TOXCD_Id,
      Curso_Id as Curso_Id 
    from
      ( 
      (
        select
          TOXCD.TurmaOfe_Id,
          HoraAula.TOXCD_Id,
          HoraAula.Horario_Id,
          Horario.Semana_Id,
          Horario.HoraInicio,
          Curr.Curso_Id 
        from
          HoraAula,
          Horario,
          TurmaOfe,
          CurrOfe,
          TOXCD,
          Curr
        where
          p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
        and
          Horario.Id = HoraAula.Horario_Id
        and
          HoraAula.TOXCD_Id = TOXCD.ID
        and
          TOXCD.TurmaOfe_Id = TurmaOfe.Id
        and
          TurmaOfe.CurrOfe_Id = CurrOfe.Id
        and
          CurrOfe.Curr_Id = Curr.Id
        and
          HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
      )
      union
      (
        select
          TOXCD.TurmaOfe_Id,
          HoraAula.TOXCD_Id,
          HoraAula.Horario_Id,
          Horario.Semana_Id,
          Horario.HoraInicio,
          Curr.Curso_Id 
        from
          HoraAula,
          Horario,
          TurmaOfe,
          CurrOfe,
          TOXCD,
          Curr
        where
          p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
        and
          Horario.Id = HoraAula.Horario_Id
        and
          HoraAula.TOXCD_Id = TOXCD.ID
        and
          TOXCD.TurmaOfe_Id = TurmaOfe.Id
        and
          TurmaOfe.CurrOfe_Id = CurrOfe.Id
        and
          CurrOfe.Curr_Id = Curr.Id
        and
          HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
       )
       union
       (
         select
           TOXCD.TurmaOfe_Id,
           HoraAula.TOXCD_Id,
           HoraAula.Horario_Id,
           Horario.Semana_Id,
           Horario.HoraInicio,
           Curr.Curso_Id 
         from
           HoraAula,
           Horario,
           TurmaOfe,
           CurrOfe,
           TOXCD,
           Curr
         where
           p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
         and
           Horario.Id = HoraAula.Horario_Id
         and
           HoraAula.TOXCD_Id = TOXCD.ID
         and
           TOXCD.TurmaOfe_Id = TurmaOfe.Id
         and
           TurmaOfe.CurrOfe_Id = CurrOfe.Id
         and
           CurrOfe.Curr_Id = Curr.Id
         and
           HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
       )
       union
       (
         select
           TOXCD.TurmaOfe_Id,
           HoraAula.TOXCD_Id,
           HoraAula.Horario_Id,
           Horario.Semana_Id,
           Horario.HoraInicio,
           Curr.Curso_Id 
         from
           HoraAula,
           Horario,
           TurmaOfe,
           CurrOfe,
           TOXCD,
           Curr
         where
           p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
         and
           Horario.Id = HoraAula.Horario_Id
         and
           HoraAula.TOXCD_Id = TOXCD.ID
         and
           TOXCD.TurmaOfe_Id = TurmaOfe.Id
         and
           TurmaOfe.CurrOfe_Id = CurrOfe.Id
         and
           CurrOfe.Curr_Id = Curr.Id
         and
           HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
       )
       ) ) 
  CD  
where
  ( 
    ( CO.TurmaOfe_Id = CD.TurmaOfe_Id and CO.TOXCD_Id <> CD.TOXCD_ID )
      or
    ( CO.TurmaOfe_Id <> CD.TurmaOfe_Id )
  ) 
and
  CO.Horario_Id = CD.Horario_Id
order by 1,2,3,4
