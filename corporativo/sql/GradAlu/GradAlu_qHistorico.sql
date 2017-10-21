select
  distinct GradAlu.CurrXDisc_Id as CurrXDisc_Id,
  decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
  decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc,
  CurrXDisc_gsRetDisc(CurrXDisc.Id) as Disc,
  nvl(DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9') as Serie,    
  CurrXDisc.DuracXCi_Id,
  CurrXDisc.Id as CurrXDisc_Hist_Id,
  CurrXDisc.DiscCat_Id,
  CurrXDisc.Disc_Id
from
  (
    select CurrXDisc.* from CurrXDisc,DuracXCi where DuracXCi.Id (+) = CurrXDisc.DuracXCi_Id and ( DuracXCi.Sequencia = p_DuracXCi_Sequencia or ( DuracXCi.Sequencia is null and CurrXDisc.DiscCat_Id > 5900000000002 ) ) and CurrXDisc.Curr_Id in ( select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id )
      union
    select currXDisc.* from CurrXDisc,DuracXCi where DuracXCi.Id (+) = CurrXDisc.DuracXCi_Id and ( DuracXCi.Sequencia < p_DuracXCi_Sequencia or ( DuracXCi.Sequencia is null and CurrXDisc.DiscCat_Id > 5900000000002 ) ) and CurrXDisc.Curr_Id in ( select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id union select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id )
  ) CurrXDisc,
  ( select * from GradAlu Where State_Id<>3000000003002 and GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0) ) GradAlu,
  DuracXCi
where
  ( 
    p_DuracXCi_Sequencia is null
      or
    DuracXCi.Sequencia <= nvl( p_DuracXCi_Sequencia ,0)
      or
    ( Curr_gnProximaSerie( p_Curr_Id , p_DuracXCi_Sequencia ) is null and DuracXCi.Sequencia is null )
  )
and
  DuracXCi.Id (+) = CurrXDisc.DuracXCi_Id
and
  CurrXDisc.DiscCat_Id < 5900000000099
and
  CurrXDisc.Id = GradAlu.CurrXDisc_Id (+)
order by
  OrdemSerie,OrdemDisc
