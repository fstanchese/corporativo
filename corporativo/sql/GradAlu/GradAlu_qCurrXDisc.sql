select  
  CurrXDisc.Id         as Id,
  Disc.Nome            as Recognize,
  Curr.Codigo          as Curr_Codigo,
  Curr.Posicionamento  as Curr_Posicao,
  decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000003,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
  decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000003,'B'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc
from
  CargaHoraTi,
  CurrXDisc,
  Curr,
  Disc,
  DiscCat
where
  Disc.Id = CurrXDisc.Disc_Id
and
  CargaHoraTi.Id (+) = CurrXDisc.CargaHoraTi_Id
and
  DiscCat.Id (+) = CurrXDisc.DiscCat_Id
and
  Curr.Id = CurrXDisc.Curr_Id
and 
  (
    Curr_Id in 
     ( 
       select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id 
         union
       select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id 
     ) 
  )
order by
   Curr_Posicao,Curr_Codigo,OrdemSerie,OrdemDisc
