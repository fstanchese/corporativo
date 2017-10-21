select 
  WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id) as Professor,  
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)   as CodDisc,
  ShortName(WPessoa.Nome,50)                     as NomeAluno,
  shortname(WPessoa.Nome,27)                     as NomeReduz,
  WPessoa.Codigo                                 as RAAluno,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)    as TurmaAluno,
  ShortName(Curso.Nome,15)                       as Curso,
  HoraProva.Id                                   as HoraProva_Id,
  Sala_gsRecognize(HoraProva.Sala_Id)            as SALA_ID_R,
  to_char(HoraProva.DATA,'dd/mm/yyyy')           as DATAX,
  to_char(HoraProva.DATA,'HH24:MI')              as HORAX
from 
  toxcd,
  curso,
  curr,
  currxdisc,
  gradalu,
  horaprova,
  wpessoa 
where
  wpessoa.id = gradalu.wpessoa_id
and
  (
    toxcd.currxdisc_id is null
      or
    toxcd.currxdisc_id = gradalu.currxdisc_id 
  )
and
  ( 
    p_Campus_Id is null
    or
    HoraProva.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  toxcd.turmaofe_id = gradalu.turmaofe_Id
and
  curso.id = curr.curso_id
and
  curr.id = currxdisc.curr_id
and
  currxdisc.id = gradalu.currxdisc_id
and
  horaprova.id = gradalu.horaprova_esp_id
and
  ( 
    p_Curso_Id is null
      or
    Curso.Id = nvl( p_Curso_Id , 0 )
  )
and
  ( 
    p_Facul_Id is null
      or
    HoraProva.Facul_id = nvl( p_Facul_Id , 0 )
  )
and
  (
    p_WPessoa_Id is null
      or
    TOXCD.WPessoa_ProfResp_Id = nvl ( p_WPessoa_Id , 0 )
  )
and
  HoraProva.CriAvalPDt_Id = p_CriAvalPDt_Id 
order by 1,2,3
