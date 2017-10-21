select
  count(matric.id) as count
from
  gradalu,matric
where
  matric.id = matric_id
and
  gradalu.id in (
     select
       WOcorrInf.Conteudo
     from
       WOcorr,
       WOcorrInf
     where
       WOcorrInf.Informacao = 8
     and
       WOcorr.Id = WOcorrInf.WOcorr_Id
     and
       WOcorr.Id in
       (
         select
           WOcorr_Id
         from
           WOcorrInf
         where
           Conteudo = to_char( p_HoraProva_CriAvalPDt_Id )
       )
     and
       WOcorrAss_Id = 5100000000017
   )