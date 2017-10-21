select
  nvl(sum(Aula),0)    as QtdeAulas,
  nvl(count(Aula),0)  as CountAulas,
  Curso_Id            as Curso_Id,
  WPessoa_Id          as WPessoa_Id,
  WPessoa.Nome        as NomeProfessor,
  shortname(Curso.Nome,40) as CursoNome
from
  ( 
    select
      count(WPessoa_Prof1_Id)  as aula,
      WPessoa_Prof1_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora,
      curr.curso_id            as curso_id
    from
      Horario,
      HoraAula,
      WPessoa,
      TOXCD,
      TurmaOfe,
      Turma,
      CurrOfe,
      Curr,
      Curso 
    where 
      HoraAula.Horario_Id = Horario.Id
    and
      HoraAula.WPessoa_Prof1_Id = WPessoa.Id 
    and
      Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
    and
      Curr.Curso_Id = Curso.Id 
    and
      Curr.id = CurrOfe.Curr_Id 
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id 
    and
      TOXCD.Id = HoraAula.TOXCD_Id 
    and
      (
         p_HoraAula_CustoZero is null
         or
         nvl( HoraAula.CustoZero, 'off' ) = p_HoraAula_CustoZero
      )
    and
      (
        Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
        or 
        p_Campus_Id is null
      )  
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
    and 
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
    and
      (
        p_WPessoa_Id is null 
        or
        HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id ,0 )
      ) 
    group by WPessoa_Prof1_Id,Horario.Semana_Id,HoraInicio,curr.curso_id
  union 
    select
      count(WPessoa_Prof2_Id)  as aula,
      WPessoa_Prof2_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora,
      curr.curso_id            as curso_id
    from
      Horario,
      HoraAula,
      WPessoa,
      TOXCD,
      TurmaOfe,
      Turma,
      CurrOfe,
      Curr,
      Curso 
    where 
      HoraAula.Horario_Id = Horario.Id
    and
      HoraAula.WPessoa_Prof2_Id = WPessoa.Id 
    and
      Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
    and
      Curr.Curso_Id = Curso.Id 
    and
      Curr.id = CurrOfe.Curr_Id 
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id 
    and
      TOXCD.Id = HoraAula.TOXCD_Id 
    and
      (
         p_HoraAula_CustoZero is null
         or
         nvl( HoraAula.CustoZero, 'off' ) = p_HoraAula_CustoZero
      )
    and
      (
        Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
        or 
        p_Campus_Id is null
      )  
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof2_Id, 0 ) , p_O_Data ) = 1
    and 
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
    and
      (
        p_WPessoa_Id is null 
        or
        HoraAula.WPessoa_Prof2_Id = nvl ( p_WPessoa_Id ,0 )
      ) 
    group by WPessoa_Prof2_Id,Horario.Semana_Id,HoraInicio,curr.curso_id
    union 
    select
      count(WPessoa_Prof3_Id)  as aula,
      WPessoa_Prof3_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora,
      curr.curso_id            as curso_id
    from
      Horario,
      HoraAula,
      WPessoa,
      TOXCD,
      TurmaOfe,
      Turma,
      CurrOfe,
      Curr,
      Curso 
    where 
      HoraAula.Horario_Id = Horario.Id
    and
      HoraAula.WPessoa_Prof3_Id = WPessoa.Id 
    and
      Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
    and
      Curr.Curso_Id = Curso.Id 
    and
      Curr.id = CurrOfe.Curr_Id 
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id 
    and
      TOXCD.Id = HoraAula.TOXCD_Id 
    and
      (
         p_HoraAula_CustoZero is null
         or
         nvl( HoraAula.CustoZero, 'off' ) = p_HoraAula_CustoZero
      )
    and
      (
        Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
        or 
        p_Campus_Id is null
      )  
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof3_Id, 0 ) , p_O_Data ) = 1
    and 
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
    and
      (
        p_WPessoa_Id is null 
        or
        HoraAula.WPessoa_Prof3_Id = nvl ( p_WPessoa_Id ,0 )
      )
    group by WPessoa_Prof3_Id,Horario.Semana_Id,HoraInicio,curr.curso_id
    union 
    select
      count(WPessoa_Prof4_Id)  as aula,
      WPessoa_Prof4_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora,
      curr.curso_id            as curso_id
    from
      Horario,
      HoraAula,
      WPessoa,
      TOXCD,
      TurmaOfe,
      Turma,
      CurrOfe,
      Curr,
      Curso 
    where 
      HoraAula.Horario_Id = Horario.Id
    and
      HoraAula.WPessoa_Prof4_Id = WPessoa.Id 
    and
      Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
    and
      Curr.Curso_Id = Curso.Id 
    and
      Curr.id = CurrOfe.Curr_Id 
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id 
    and
      TOXCD.Id = HoraAula.TOXCD_Id 
    and
      (
         p_HoraAula_CustoZero is null
         or
         nvl( HoraAula.CustoZero, 'off' ) = p_HoraAula_CustoZero
      )
    and
      (
        Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
        or 
        p_Campus_Id is null
      )  
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof4_Id, 0 ) , p_O_Data ) = 1
    and 
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
    and
      (
        p_WPessoa_Id is null 
        or
        HoraAula.WPessoa_Prof4_Id = nvl ( p_WPessoa_Id ,0 )
      ) 
    group by WPessoa_Prof4_Id,Horario.Semana_Id,HoraInicio,curr.curso_id
    union 
    select
      count(WPessoa_Prof1_Id)  as aula,
      WPessoa_Prof1_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora,
      turma.curso_id           as curso_id
    from
      Horario,
      HoraAula,
      WPessoa,
      TOXCD,
      TurmaOfe,
      Turma,
      DiscEsp,
      Curso
    where
      HoraAula.Horario_Id = Horario.Id
    and
      Turma.Curso_Id = Curso.Id
    and
      HoraAula.WPessoa_Prof1_Id = WPessoa.Id
    and
      DiscEsp.Id = TurmaOfe.DiscEsp_Id
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      (
         p_HoraAula_CustoZero is null
         or
         nvl( HoraAula.CustoZero, 'off' ) = p_HoraAula_CustoZero
      )
    and
      (
        Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
        or 
        p_Campus_Id is null
      )  
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
    and
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and
      (
         p_WPessoa_Id is null 
         or
         HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id ,0 )
      )  
    group by WPessoa_Prof1_Id,Horario.Semana_Id,HoraInicio,turma.curso_id
  ) HoraAula,
  Curso,
  WPessoa
where
  WPessoa.Id = HoraAula.WPessoa_Id
and
  Curso.Id = HoraAula.Curso_Id
and
  ( 
    p_Curso_Id is null
    or
    Curso.Id = nvl ( p_Curso_Id , 0)
  )
group by Curso_Id,Curso.Nome,WPessoa_Id,WPessoa.Nome
order by Curso.Nome