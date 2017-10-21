select  
  CurrXDisc.*,
  CurrXDisc_gnCHTotal( CurrXDisc.Id, p_PLetivo_Id ) as CHAnual,
  DiscCat_gsRecognize(CurrXDisc.DiscCat_Id) ||' - '||CurrXDisc_gsRecognize(CurrXDisc.Id)           as Recognize,
  Curr_gsRecognize(CurrXDisc.Curr_Id)           as Curr_Recognize,
  CurrXDisc_gsRetSerie(CurrXDisc.Id)            as Serie,
  Disc_gsRecognize(CurrXDisc.Disc_Id)           as Disc,
  Curr.Codigo                                   as Curr_Codigo,
  Curr.CurrNomeDipl                             as Curso_Nome,
  CurrXDisc_gsRetCodDisc(CurrXDisc.Id)          as CodDisc,
  DiscCat_gsRecognize(CurrXDisc.DiscCat_Id)     as Categoria,
  DiscCat.Estagio, 
  Curr.CurrNomeHist || decode(Curr.CurrNivelDesc,null,Curr.CurrNivelDesc,' - ' || Curr.CurrNivelDesc) as NomeCurso,
  decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000003,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
  decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000003,'B'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc
from
  DiscCat,
  CurrXDisc,
  Curr
where
  DiscCat.Id (+) = CurrXDisc.DiscCat_Id
and
  Curr.Id = CurrXDisc.Curr_Id
and 
  Curr_Id = nvl( p_Curr_Id ,0)
order by OrdemSerie,OrdemDisc
