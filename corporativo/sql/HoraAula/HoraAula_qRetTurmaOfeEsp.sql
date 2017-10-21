(
select
  to_char(TurmaOfe.Id) as TurmaOfe_Id,
  HoraAula_gnAulaProfessor( HoraAula.WPessoa_Prof1_Id, 6600000000002, null,null,null, p_O_Data , TOXCD.Id ) as Aulas
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma
where
  Turma.TurmaTi_Id = 6600000000002
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
    HoraAula.WPessoa_Prof1_Id = p_WPessoa_Id
group by TurmaOfe.Id, WPessoa_Prof1_Id, TOXCD.Id
)
union
(
select
  to_char(TurmaOfe.Id) as TurmaOfe_Id,
  HoraAula_gnAulaProfessor( HoraAula.WPessoa_Prof2_Id, 6600000000002, null,null,null, p_O_Data , TOXCD.Id ) as Aulas
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma
where
  Turma.TurmaTi_Id = 6600000000002
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
    HoraAula.WPessoa_Prof2_Id = p_WPessoa_Id
group by TurmaOfe.Id, WPessoa_Prof2_Id, TOXCD.Id
)
union
(
select
  to_char(TurmaOfe.Id) as TurmaOfe_Id,
  HoraAula_gnAulaProfessor( HoraAula.WPessoa_Prof3_Id, 6600000000002, null,null,null, p_O_Data , TOXCD.Id ) as Aulas
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma
where
  Turma.TurmaTi_Id = 6600000000002
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
    HoraAula.WPessoa_Prof3_Id = p_WPessoa_Id
group by TurmaOfe.Id, WPessoa_Prof3_Id, TOXCD.Id
)
union
(
select
  to_char(TurmaOfe.Id) as TurmaOfe_Id,
  HoraAula_gnAulaProfessor( HoraAula.WPessoa_Prof4_Id, 6600000000002, null,null,null, p_O_Data , TOXCD.Id ) as Aulas
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma
where
  Turma.TurmaTi_Id = 6600000000002
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
    HoraAula.WPessoa_Prof4_Id = p_WPessoa_Id
group by TurmaOfe.Id, WPessoa_Prof4_Id, TOXCD.Id
)
