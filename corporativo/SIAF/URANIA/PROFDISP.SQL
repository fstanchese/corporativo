select
  professor.codigofunc||';'||professor.nome||';'||profdisponivel.manha||'MATUTINO'  
from
  (
  select
    wpessoa.id,
    wpessoa.nome,
    wpessoa.codigofunc
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    Turma.Campus_Id=6400000000001 
  and  
    '11/09/2014' between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Turma.Curso_Id = nvl ( 5700000000006 , 0 )
  and
    Turma.Curso_Id = Curso.Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraAula.TOXCD_Id = TOXCD.Id
  and
    HoraAula.Horario_Id = Horario.Id
  and
    (
      WPessoa.Id = HoraAula.WPessoa_Prof1_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof2_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof3_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof4_Id
    )
  group by wpessoa.id,wpessoa.nome,wpessoa.codigofunc
  ) Professor,
  ProfDisponivel
where
  profdisponivel.wpessoa_id=professor.id
union
select
  professor.codigofunc||';'||professor.nome||';'||profdisponivel.tarde||'VESPERTINO'  
from
  (
  select
    wpessoa.id,
    wpessoa.nome,
    wpessoa.codigofunc
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    Turma.Campus_Id=6400000000001 
  and  
    '11/09/2014' between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Turma.Curso_Id = nvl ( 5700000000006 , 0 )
  and
    Turma.Curso_Id = Curso.Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraAula.TOXCD_Id = TOXCD.Id
  and
    HoraAula.Horario_Id = Horario.Id
  and
    (
      WPessoa.Id = HoraAula.WPessoa_Prof1_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof2_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof3_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof4_Id
    )
  group by wpessoa.id,wpessoa.nome,wpessoa.codigofunc
  ) Professor,
  ProfDisponivel
where
  profdisponivel.wpessoa_id=professor.id
union
select
  professor.codigofunc||';'||professor.nome||';'||profdisponivel.noite||'NOTURNO'  
from
  (
  select
    wpessoa.id,
    wpessoa.nome,
    wpessoa.codigofunc
  from
    HoraAula,
    Horario,
    TOXCD,
    TurmaOfe,
    Turma,
    Curso,
    WPessoa
  where
    Turma.Campus_Id=6400000000001 
  and  
    '11/09/2014' between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Turma.Curso_Id = nvl ( 5700000000006 , 0 )
  and
    Turma.Curso_Id = Curso.Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    HoraAula.TOXCD_Id = TOXCD.Id
  and
    HoraAula.Horario_Id = Horario.Id
  and
    (
      WPessoa.Id = HoraAula.WPessoa_Prof1_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof2_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof3_Id
      or
      WPessoa.Id = HoraAula.WPessoa_Prof4_Id
    )
  group by wpessoa.id,wpessoa.nome,wpessoa.codigofunc
  ) Professor,
  ProfDisponivel
where
  profdisponivel.wpessoa_id=professor.id
