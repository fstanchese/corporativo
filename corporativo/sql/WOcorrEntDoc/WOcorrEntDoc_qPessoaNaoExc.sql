(
select
  WOcorrEntDoc.UsEntrega              as UsEntrega,
  WOcorrEntDoc.DtEntrega              as DtEntrega,
  WOcorr_gnNumOcorrencia(WOcorr.Id)   as NumOcorrencia,
  WPessoa_gsRecognize(WPessoa_Id)     as WPessoa_Nome,
  WOcorr.Dt                           as WOcorr_Dt,
  to_char(WOcorr.Dt,'yyyy')           as WOcorr_Ano,
  WOcorrAss_gsRecognize(WOcorrAss_Id) as WOcorrAss_Recognize,
  WOcorr_gsRetDeferimento(WOcorr.Id)  as Parecer,
  WOcorrAss.Id                        as WOcorrAss_Id
from
  WOcorr,
  WOcorrAss,
  WOcorrEntDoc
where
  WOcorrEntDoc.State_Id = 3000000046001
and
  WOcorr.Id = WOcorrEntDoc.WOcorr_Id 
and
  WOcorrAss.Id in (5100000000035,5100000000335,5100000000342,5100000000020)
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorr.State_Id = 3000000011003 
and
  WOcorr.WPessoa_Id = p_WPessoa_Id 
)
union
(
select
  WOcorrEntDoc.UsEntrega              as UsEntrega,
  WOcorrEntDoc.DtEntrega              as DtEntrega,
  WOcorr_gnNumOcorrencia(WOcorr.Id)   as NumOcorrencia,
  WPessoa_gsRecognize(WPessoa_Id)     as WPessoa_Nome,
  WOcorr.Dt                           as WOcorr_Dt,
  to_char(WOcorr.Dt,'yyyy')           as WOcorr_Ano,
  WOcorrAss_gsRecognize(WOcorrAss_Id) as WOcorrAss_Recognize,
  WOcorr_gsRetDeferimento(WOcorr.Id)  as Parecer,
  WOcorrAss.Id                        as WOcorrAss_Id
from
  WOcorr,
  WOcorrAss,
  WOcorrEntDoc
where
  WOcorrEntDoc.State_Id = 3000000046001
and
  WOcorr_gsRetDeferimento(WOcorr.Id) = 'Deferido'
and
  WOcorr.Id = WOcorrEntDoc.WOcorr_Id 
and
  (
    WOcorrAss.DescSaida is not null
  or
    WOcorrAss.Id in (5100000000035,5100000000335,5100000000342,5100000000020)
  ) 
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorr.State_Id = 3000000011003 
and
  to_char(WOcorr.Dt,'yyyy') >= p_O_Ano 
and
  WOcorr.WPessoa_Id = p_WPessoa_Id 
)