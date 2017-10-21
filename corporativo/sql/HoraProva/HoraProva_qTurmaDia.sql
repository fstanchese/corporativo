(
select
  WPessoa_gsRecognize(HoraProva.WPessoa_Id)       as Professor,
  WPessoa.Apelido                                 as Apelido,
  Turma.Codigo                                    as Turma,
  Disc.Codigo                                     as Disciplina,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)     as DivTurma,
  to_char(HoraProva.data,'dd/mm/yyyy')            as Dia,
  to_char(HoraProva.data,'HH24:mi')               as Hora,
  HoraProva.Duracao                               as Duracao,
  Sala_gsRecognize(HoraProva.Sala_Id)             as Sala,
  CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id) as Prova,
  Curso.Nome                                      as Curso,
  Periodo.Nome                                    as Periodo,
  WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id)  as ProfResp 
from
  wpessoa,
  HoraProva,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma,
  Periodo,
  CurrXDisc,
  Disc,
  Curr,
  Curso
where
  wpessoa.id (+) = horaprova.wpessoa_id 
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  Turma.Periodo_Id = Periodo.Id
and
  (
  p_Campus_Id is null
  or
  Turma.Campus_Id = nvl( p_Campus_Id ,0)
  )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
and
  HoraProva.TOXCD_Id = TOXCD.Id
and
  to_char(HoraProva.data,'dd/mm/yyyy') = p_HoraProva_DataProva
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
)
union
(
select
  WPessoa_gsRecognize(HoraProva.WPessoa_Id)       as Professor,
  WPessoa.Apelido                                 as Apelido,
  Turma.Codigo                                    as Turma,
  DiscEsp.NomeReduz                               as Disciplina,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)     as DivTurma,
  to_char(HoraProva.data,'dd/mm/yyyy')            as Dia,
  to_char(HoraProva.data,'HH24:mi')               as Hora,
  HoraProva.Duracao                               as Duracao,
  Sala_gsRecognize(HoraProva.Sala_Id)             as Sala,
  CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id) as Prova,
  Curso.Nome                                      as Curso,
  AreaAcad_gsRecognize(DiscEsp.AreaAcad_Id)       as Periodo,
  WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id)  as ProfResp 
from
  wpessoa,
  Curso,
  HoraProva,
  TOXCD,
  TurmaOfe,
  Turma,
  DiscEsp
where
  wpessoa.id (+) = horaprova.wpessoa_id 
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  Turma.Campus_Id = nvl( p_Campus_Id ,0)
and
  Turma.Curso_Id = Curso.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  HoraProva.TOXCD_Id = TOXCD.Id 
and
  toxcd.turmaofe_id=turmaofe.id 
and
  TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
and
  to_char(HoraProva.data,'dd/mm/yyyy') = p_HoraProva_DataProva
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
)
order by
  Turma,Dia,Hora,Disciplina