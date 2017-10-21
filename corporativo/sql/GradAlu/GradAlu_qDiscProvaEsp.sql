(
select 
  GradAlu.Id as Id,
  Disc_gsRecognize(Disc.Id) || Decode( p_CriAvalP_GradAluNota ,1,' - Nota -> '||GradAlu.N1,2,' - Nota -> '||GradAlu.N2,3,' - Nota -> '||GradAlu.N3,4,' - Nota -> '||GradAlu.N4,5,' - Nota -> '||GradAlu.N5,6,' - Nota -> '||GradAlu.N6) as Recognize
from
  GradAlu,
  CurrXDisc,
  Disc,
  TurmaOfe,
  CurrOfe
where
  ( 
    ( CriAvalP_gnSubstitutiva( p_CriAvalP_Id ) = 1 and (inscsubauto='on' or inscsub='on') )
    or
    CriAvalP_gnSubstitutiva( p_CriAvalP_Id ) = 0 
  )
and  
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
  nvl(GradAlu.HoraProva_Esp_Id,0) not in ( select id from horaprova where facul_id is not null and criavalpdt_id = nvl ( p_CriAvalPDt_Id , 0) )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  GradAlu.Wpessoa_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select 
  GradAlu.Id as Id,
  Disc_gsRecognize(Disc.Id) || Decode( p_CriAvalP_GradAluNota ,1,' - Nota -> '||GradAlu.N1,2,' - Nota -> '||GradAlu.N2,3,' - Nota -> '||GradAlu.N3,4,' - Nota -> '||GradAlu.N4,5,' - Nota -> '||GradAlu.N5,6,' - Nota -> '||GradAlu.N6) as Recognize
from
  gradalu,
  currxdisc,
  disc,
  turmaofe,
  discEsp
where
  ( 
    ( CriAvalP_gnSubstitutiva( p_CriAvalP_Id ) = 1 and (inscsubauto='on' or inscsub='on') )
    or
    CriAvalP_gnSubstitutiva( p_CriAvalP_Id ) = 0 
  )
and
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
  nvl(GradAlu.HoraProva_Esp_Id,0) not in ( select id from horaprova where facul_id is not null and criavalpdt_id = nvl ( p_CriAvalPDt_Id , 0) )
and
  discEsp.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
