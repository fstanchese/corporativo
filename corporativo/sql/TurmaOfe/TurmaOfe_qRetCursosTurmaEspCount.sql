select
  Count(Curso_Id) as Cursos
from 
(
  select
    Curso.Nome as Curso_Nome,
    Curso.Id as Curso_Id
  from
    TurmaOfe,
    DEXCD,
    CurrXDisc,
    Curr,
    Curso,
    HoraAula,
    TOXCD
  where
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    HoraAula.TOXCD_ID = TOXCD.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    Curr.Curso_Id = Curso.Id
  and
    CurrXDisc.Curr_Id = Curr.Id
  and
    CurrXDisc.Id = DEXCD.CurrXDisc_Id
  and
    DEXCD.DiscEsp_Id = TurmaOfe.DiscEsp_Id
  and
    TurmaOfe.Id = p_TurmaOfe_Id
  group by Curso.Nome,Curso.Id
)
