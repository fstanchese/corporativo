select 
  sum(total) as Total
from
  ( 
  (
    select
      Count(HoraAula.WPessoa_Prof1_Id) as Total,
      WPessoa_Prof1_id as prof_id  
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
    group by WPessoa_Prof1_Id
  )
  union
  (
    select
      Count(HoraAula.WPessoa_Prof2_Id) as Total,
      WPessoa_Prof2_id as prof_id  
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
    group by WPessoa_Prof2_Id
  )
  union
  (
    select
      Count(HoraAula.WPessoa_Prof3_Id) as Total,
      WPessoa_Prof3_id as prof_id  
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
    group by WPessoa_Prof3_Id
  )
  union
  (
    select
      Count(HoraAula.WPessoa_Prof4_Id) as Total,
      WPessoa_Prof4_id as prof_id  
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
    group by WPessoa_Prof4_Id
  )
  ) 