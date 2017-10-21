select
  nvl(sum(aula),0)              as qtdeAulas,
  nvl(count(aula),0)            as countAulas,
  count(distinct(professores))  as QtdeProfessores 
from
  ( 
    (
    select
      count(WPessoa_Prof1_Id) as aula,
      WPessoa_Prof1_Id        as professores,
      'AU'                    as Tipo,
      Horario.Id              as Horario,
      to_char(Horario.HoraInicio,'hh24:mi')              as Hora
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
      Curr.Curso_Id = p_Curso_Id 
    and
      Curr.id = CurrOfe.Curr_Id 
    and
      (
        CurrOfe.Periodo_Id = p_Periodo_Id 
        or
        p_Periodo_Id is null
      ) 
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and
      (
        Turma.Campus_Id = p_Campus_Id
        or 
        p_Campus_Id is null
      )  
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id 
    and
      TOXCD.Id = HoraAula.TOXCD_Id 
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
    and 
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
    group by WPessoa_Prof1_Id,Horario.Id,to_char(Horario.HoraInicio,'hh24:mi')
    ) 
    union 
    (
    select
      count(WPessoa_Prof2_Id)  as aula,
      WPessoa_prof2_Id         as professores,
      'AU'                     as Tipo,
      Horario.Id               as Horario,
      to_char(Horario.HoraInicio,'hh24:mi')               as Hora 
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
      Curr.Curso_Id = p_Curso_Id
    and
      Curr.Id = currofe.Curr_Id 
    and
      (
        CurrOfe.Periodo_Id = p_Periodo_Id 
        or
        p_Periodo_Id is null
      ) 
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and
      (
        Turma.Campus_Id = p_Campus_Id
        or 
        p_Campus_Id is null
      )  
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id 
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof2_Id, 0 ) , p_O_Data ) = 1
    and
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
    group by WPessoa_Prof2_Id,Horario.Id,to_char(Horario.HoraInicio,'hh24:mi')
    ) 
    union 
    (
    select
      count(WPessoa_Prof3_Id)  as aula,
      WPessoa_Prof3_Id         as professores,
      'AU'                     as Tipo,
      Horario.Id               as Horario,
      to_char(Horario.HoraInicio,'hh24:mi')               as Hora 
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
      Curr.Curso_Id = p_Curso_Id 
    and
      Curr.id = CurrOfe.Curr_Id 
    and
      (
        CurrOfe.Periodo_Id = p_Periodo_Id 
        or
        p_Periodo_Id is null
      ) 
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and
      (
        Turma.Campus_Id = p_Campus_Id
      or 
        p_Campus_Id is null
      )  
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id 
    and
      TOXCD.Id = HoraAula.TOXCD_Id 
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof3_Id, 0 ) , p_O_Data ) = 1
    and
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
    group by WPessoa_Prof3_Id,Horario.Id,to_char(Horario.HoraInicio,'hh24:mi')
    )
    union 
    (
    select
      count(WPessoa_Prof4_Id)  as aula,
      WPessoa_Prof4_Id         as professores,
      'AU'                     as Tipo,
      Horario.Id               as Horario,
      to_char(Horario.HoraInicio,'hh24:mi')               as Hora
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
      Curr.Curso_Id = p_Curso_Id
    and
      Curr.id = CurrOfe.Curr_Id 
    and
      (
        CurrOfe.Periodo_Id = p_Periodo_Id 
        or
        p_Periodo_Id is null
      ) 
    and
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and
      (
        Turma.Campus_Id = p_Campus_Id
        or 
        p_Campus_Id is null
      )  
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id 
    and
      TOXCD.Id = HoraAula.TOXCD_Id 
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof4_Id, 0 ) , p_O_Data ) = 1
    and
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
    group by WPessoa_Prof4_Id,Horario.Id,to_char(Horario.HoraInicio,'hh24:mi')
    ) 
       $v_DedicacaoT
    union
    (
    select
      count(WPessoa_Prof1_Id)  as aula,
      WPessoa_Prof1_Id         as professores,
      'LI'                     as Tipo,
      Horario.Id               as Horario,
      to_char(Horario.HoraInicio,'hh24:mi')               as Hora 
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
      Curso.CursoNivel_Id = 6200000000003
    and
      HoraAula.WPessoa_Prof1_Id = WPessoa.Id
    and
      Turma.Curso_Id = p_Curso_Id 
    and
      DiscEsp.Id = TurmaOfe.DiscEsp_Id
    and
      (
        Turma.Campus_Id = p_Campus_Id
        or
        p_Campus_Id is null
      )
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
    and
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    group by WPessoa_Prof1_Id,Horario.Id,to_char(Horario.HoraInicio,'hh24:mi')
    )
    union
    (
    select
      count(WPessoa_Prof1_Id)  as aula,
      WPessoa_Prof1_Id         as professores,
      'DP'                     as Tipo,
      Horario.Id               as Horario,
      to_char(Horario.HoraInicio,'hh24:mi')               as Hora 
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
      Curso.CursoNivel_Id = 6200000000001
    and
      HoraAula.WPessoa_Prof1_Id = WPessoa.Id
    and
      Turma.Curso_Id = p_Curso_Id 
    and
      DiscEsp.Id = TurmaOfe.DiscEsp_Id
    and
      (
        Turma.Campus_Id = p_Campus_Id
        or
        p_Campus_Id is null
      )
    and
      TurmaOfe.Turma_Id = Turma.Id
    and
      TurmaOfe.Id = TOXCD.TurmaOfe_Id
    and
      TOXCD.Id = HoraAula.TOXCD_Id
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
    and
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    group by WPessoa_Prof1_Id,Horario.Id,to_char(Horario.HoraInicio,'hh24:mi')
    )
  )
 