select
  CurrXDisc_gsRetCodDisc(GradAlu_gnRetCurrXDisc(conteudo))             as CodDisc,
  CurrXDisc_gsRetDisc(GradAlu_gnRetCurrXDisc(conteudo))                as Disciplina,
  shortname(CurrXDisc_gsRetDisc(GradAlu_gnRetCurrXDisc(conteudo)),25)  as DiscAbrev,
  conteudo,
  to_char(WOcorr.dt,'DD/MM/YYYY HH24:mi:ss')                           as Data
from 
  WOcorrinf,
  WOcorr
where
  WOcorrinf.WOcorr_Id = WOcorr.Id
and
  wocorr_id in 
  (      
    select 
      wocorr_id 
    from 
      WOcorrInf
    where
      WOcorr_id in 
      ( 
        select
          id
        from
          WOcorr 
        where
          WOcorrass_id = p_WOcorrAss_Id
        and
          WPessoa_Id = p_WPessoa_Id
      )
    and
      Conteudo = to_char( p_HoraProva_CriAvalPDt_Id )
  )
and
  Informacao = 8