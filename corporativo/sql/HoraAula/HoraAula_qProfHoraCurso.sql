select 
  Horario_Id
from
  ( 
  (
    select
      HoraAula.Horario_Id as Horario_Id
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
    group by HoraAula.Horario_Id
  )
  union
  (
    select
      HoraAula.Horario_Id as Horario_Id
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
    group by HoraAula.Horario_Id
  )
  union
  (
    select
      HoraAula.Horario_Id as Horario_Id
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
    group by HoraAula.Horario_Id
  )
  union
  (
    select
      HoraAula.Horario_Id as Horario_Id,
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
    group by HoraAula.Horario_Id
  )
  )