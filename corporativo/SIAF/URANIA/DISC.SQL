select
  disc.codigo||';'||disc.nome
from
  disc,
  CurrXDisc,
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  WPessoa
where
  Disc.Id=CurrXDisc.Disc_Id
and
  CurrXDisc.Id = TOXCD.CurrXDisc_Id
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
group by disc.codigo,disc.nome
order by 1

