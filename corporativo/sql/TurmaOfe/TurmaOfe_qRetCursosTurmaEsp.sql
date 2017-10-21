select
  Curso.Nome                             as Curso,
  Curso.Id                               as Curso_Id,
  CCXCurso_gsRetCodigoCCusto( Curso.Id ) as CCusto,
  CCXCurso_gnRetIdCCusto( Curso.Id )     as CCusto_Id
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
  nvl(HoraAula.CustoZero,'off')='off'
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
order by 1