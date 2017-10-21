(
select 
  GradAlu.*,
  Disc_gsRecognize(Disc.Id)||' - '||to_char(HoraProva.Data,'dd/mm/yyyy')||' - '||to_char(HoraProva.Data,'hh24:mi')||' - '||Sala_gsRecognize(HoraProva.Sala_Id)||' - '||HoraProva.Duracao||' min '||decode(HoraProva.WPessoa_Id,null,'',' - '||WPessoa_gsRecognize(HoraProva.WPessoa_Id))||' - '||gradalu.us||' - '||to_char(gradalu.dt,'dd/mm/yyyy') as Recognize,
  Disc.Codigo as CodDisc,
  to_char(HoraProva.Data,'dd/mm/yyyy') as data,
  to_char(HoraProva.Data,'hh24:mi') as hora,
  Sala_gsRecognize(HoraProva.Sala_Id) as sala,
  HoraProva.Duracao||' ´ ' as duracao
from
  GradAlu,
  CurrXDisc,
  Disc,
  TurmaOfe,
  CurrOfe,
  HoraProva
where
  GradAlu.State_Id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  GradAlu.HoraProva_Esp_Id = HoraProva.Id
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  GradAlu.Wpessoa_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select 
  GradAlu.*,
  Disc_gsRecognize(Disc.Id)||' - '||to_char(HoraProva.Data,'dd/mm/yyyy')||' - '||to_char(HoraProva.Data,'hh24:mi')||' - '||Sala_gsRecognize(HoraProva.Sala_Id)||' - '||HoraProva.Duracao||' min '||decode(HoraProva.WPessoa_Id,null,'',' - '||WPessoa_gsRecognize(HoraProva.WPessoa_id))||' - '||gradalu.us||' - '||to_char(gradalu.dt,'dd/mm/yyyy') as Recognize,
  Disc.Codigo as CodDisc,
  to_char(HoraProva.Data,'dd/mm/yyyy') as data,
  to_char(HoraProva.Data,'hh24:mi') as hora,
  Sala_gsRecognize(HoraProva.Sala_Id) as sala,
  HoraProva.Duracao||' ´ ' as duracao
from
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  discEsp,
  horaprova
where
  gradalu.state_id not in (3000000003002,3000000003003,3000000003009,3000000003010)
and
  gradalu.turmaofe_id = turmaofe.id
and
  turmaofe.discEsp_id = discEsp.id
and
  currxdisc.disc_id = disc.id
and
  gradalu.currxdisc_id = currxdisc.id
and
  gradalu.horaprova_esp_id = horaprova.id
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
and
  discEsp.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
