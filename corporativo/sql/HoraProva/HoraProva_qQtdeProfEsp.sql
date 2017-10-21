select 
  sum(qtdtot) as total,
  Curso,
  Professor,
  CodDisc,
  Sala,
  Sala_Id
from 
  (
    (
      select 
        count(*) as qtdtot,
        Curso_gsRecognize(Curso.Id)              as Curso,
        WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id) as Professor,  
        Disc.Codigo   as CodDisc,
        sala_gsrecognize(horaprova.sala_id) as Sala,
        horaprova.sala_id as sala_id
      from 
        disc,
        toxcd,
        curso,
        curr,
        currxdisc,
        gradalu,
        horaprova,
        turmaofe,
        currofe 
      where
        disc.id = currxdisc.disc_id
      and
        toxcd.currxdisc_id = gradalu.currxdisc_id 
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
        turmaofe.currofe_id=currofe.id
      and
        gradalu.turmaofe_id=turmaofe.id
      and
        Curso.Facul_Id = HoraProva.Facul_Id
      and
        CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
      and
        ( 
          p_Campus_Id is null
          or
          HoraProva.Campus_Id = nvl ( p_Campus_Id ,0)
        )
      and
        ( 
           p_Facul_Id is null
            or
           HoraProva.Facul_id = nvl( p_Facul_Id , 0 )
        )
      and
        HoraProva.CriAvalPDt_Id = nvl ( p_CriAvalPDt_Id  , 0 )
      group by curso.id,toxcd.wpessoa_profresp_id,disc.codigo,horaprova.sala_id
    )  
    union all
    ( 
      select 
        count(*) as qtdtot,
        Curso_gsRecognize(Curso.Id)              as Curso,
        WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id) as Professor,  
        Disc.Codigo   as CodDisc,
        sala_gsrecognize(horaprova.sala_id) as Sala,
        horaprova.sala_id as sala_id
      from 
        disc,
        toxcd,
        curso,
        curr,
        currxdisc,
        gradalu,
        horaprova,
        turmaofe,
        discesp 
      where
        disc.id = currxdisc.disc_id
      and
        toxcd.currxdisc_id is null
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
        Discesp.PLetivo_Id = nvl( p_PLetivo_Id , 0 )
      and
        turmaofe.discesp_id = discesp.id
      and
        gradalu.turmaofe_id = turmaofe.id
      and
        ( 
          p_Campus_Id is null
          or
          HoraProva.Campus_Id = nvl ( p_Campus_Id ,0)
        )
      and
        ( 
          p_Facul_Id is null
            or
          HoraProva.Facul_id = nvl( p_Facul_Id , 0 )
        )
      and
        HoraProva.CriAvalPDt_Id = nvl ( p_CriAvalPDt_Id , 0 )
      group by curso.id,toxcd.wpessoa_profresp_id,disc.codigo,horaprova.sala_id
    )
  )
group by Curso,Professor,CodDisc,Sala,Sala_Id
order by 2,5,3,4
