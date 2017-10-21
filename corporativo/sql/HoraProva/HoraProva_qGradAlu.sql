(
select
  toxcd_gsretturma(toxcd_id )                    as turma,
  currxdisc_gsretcoddisc(gradalu.currxdisc_id )  as disciplina,
  to_char(HoraProva.Data,'dd/mm/yyyy')           as Data,
  to_char(HoraProva.Data,'HH24:MI')              as Hora,
  sala_gsRecognize(HoraProva.Sala_Id)            as Sala,
  HoraProva.Duracao                              as Duracao,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)    as DivTurma,
  decode( p_CriAvalP_Id ,18800000000013,GradAlu.N1,18800000000014,GradAlu.N2,18800000000015,GradAlu.N4) as Nota 
from
  GradAlu,
  TOXCD,
  HoraProva
where
  gradalu.state_id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
  HoraProva.DivTurma_Id = WPessoa_gnParImpar( GradAlu.WPessoa_Id )
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  HoraProva.TOXCD_ID = TOXCD.Id
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
and
  GradAlu.Id = nvl( p_GradAlu_Id ,0)
)
union
(
select
  toxcd_gsretturma(toxcd_id )               as turma,
  currxdisc_gsretcoddisc(gradalu.currxdisc_id )     as disciplina,
  to_char(HoraProva.Data,'dd/mm/yyyy')         as Data,
  to_char(HoraProva.Data,'HH24:MI')            as Hora,
  sala_gsRecognize(HoraProva.Sala_Id)          as Sala,
  HoraProva.Duracao                            as Duracao,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)  as DivTurma,
  decode( p_CriAvalP_Id ,18800000000013,GradAlu.N1,18800000000014,GradAlu.N2,18800000000015,GradAlu.N4) as Nota 
from
  GradAlu,
  TOXCD,
  HoraProva
where
  gradalu.state_id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
(
  HoraProva.DivTurma_Id = 13500000000016
   or
  HoraProva.DivTurma_Id = GradAlu.DivTurma_Teoria_Id
   or
  HoraProva.DivTurma_Id = GradAlu.DivTurma_Pratica_Id 
) 
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  HoraProva.TOXCD_ID = TOXCD.Id
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
and
  GradAlu.Id = nvl( p_GradAlu_Id ,0)
)
union
(
select
  toxcd_gsretturma(toxcd_id )               as turma,
  currxdisc_gsretcoddisc(gradalu.currxdisc_id )     as disciplina,
  to_char(HoraProva.Data,'dd/mm/yyyy')         as Data,
  to_char(HoraProva.Data,'HH24:MI')            as Hora,
  sala_gsRecognize(HoraProva.Sala_Id)          as Sala,
  HoraProva.Duracao                            as Duracao,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)  as DivTurma,
  decode( p_CriAvalP_Id ,18800000000013,GradAlu.N1,18800000000014,GradAlu.N2,18800000000015,GradAlu.N4) as Nota 
from
  GradAlu,
  TOXCD,
  HoraProva,
  TurmaOfe
where
  gradalu.state_id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
  HoraProva.DivTurma_Id = WPessoa_gnParImpar( GradAlu.WPessoa_Id )
and
  TurmaOfe.CurrOfe_Id is null
and
  TurmaOfe.id = TOXCD.TurmaOfe_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  HoraProva.TOXCD_ID = TOXCD.Id 
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
and
  GradAlu.GradAluTi_Id <> 8500000000001 
and
  GradAlu.Id = nvl( p_GradAlu_Id ,0)
)
union
(
select
  toxcd_gsretturma(toxcd_id )               as turma,
  currxdisc_gsretcoddisc(gradalu.currxdisc_id )     as disciplina,
  to_char(HoraProva.Data,'dd/mm/yyyy')         as Data,
  to_char(HoraProva.Data,'HH24:MI')            as Hora,
  sala_gsRecognize(HoraProva.Sala_Id)          as Sala,
  HoraProva.Duracao                            as Duracao,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)  as DivTurma,
  decode( p_CriAvalP_Id ,18800000000013,GradAlu.N1,18800000000014,GradAlu.N2,18800000000015,GradAlu.N4) as Nota 
from
  GradAlu,
  TOXCD,
  HoraProva,
  TurmaOfe
where
  gradalu.state_id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.CurrOfe_Id is null
and
  TurmaOfe.id = TOXCD.TurmaOfe_Id
and
  HoraProva.TOXCD_ID = TOXCD.Id 
and
  HoraProva.DivTurma_Id = 13500000000016
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
and
  GradAlu.GradAluTi_Id <> 8500000000001 
and
  GradAlu.Id = nvl( p_GradAlu_Id ,0)
)
order by data

