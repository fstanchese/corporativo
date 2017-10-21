select
  WOcorr_gnQtdePeriodo( Tabela.Id, p_PLetivo_Atual_Id , p_Campus_Id , p_Mes_Id )     as PeriodoAtual,
  WOcorr_gnQtdePeriodo( Tabela.Id, p_PLetivo_Anterior_Id , p_Campus_Id , p_Mes_Id )  as PeriodoAnterior,
  WOcorrAss_gsRecognize(Tabela.Id)                                                   as WOcorrAss_Recognize
from 
  (
select
  distinct(wocorrass_Id) as Id
from
  WOcorr
where
  to_char(dt,'yyyymm') = p_WOcorr_AnoMes ) Tabela
order by WOcorrAss_Recognize
