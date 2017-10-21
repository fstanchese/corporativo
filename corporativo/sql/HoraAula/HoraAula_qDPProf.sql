select
  Curso_gsRecognize(Turma.Curso_Id)     as Curso_Recognize, 
  Turma.Codigo                          as Turma_Recognize,
  HoraAula.TOXCD_Id                     as TOXCD_Id,
  Sala_gsRecognize(TurmaOfe.Sala_Id)    as Sala_Recognize,
  HoraAula_gnAulaProfessor( p_WPessoa_Id ,6600000000002, 5700000000069 ,null,null, p_O_Data ,HoraAula.TOXCD_Id) as Horas
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Horario,
  DiscEsp,
  WPessoa
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  WPessoa.Id = HoraAula.WPessoa_Prof1_Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Turma.Curso_Id = 5700000000069
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  Turma.TurmaTi_Id = 6600000000002
and
(
  HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
or
  HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
or
  HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
or
  HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
or
  p_WPessoa_Id is null
)
and
  HoraAula.Horario_Id = Horario.Id
group by 
  HoraAula.TOXCD_Id,Turma.Codigo,Turma.Curso_Id,TurmaOfe.Sala_Id