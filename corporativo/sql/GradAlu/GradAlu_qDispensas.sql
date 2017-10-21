select 
  CurrXDisc.Id                                                                         as Id,
  Disc.Codigo                                                                          as Disc,
  CurrXDisc_gsRetSerie(CurrXDisc.Id)                                                   as Serie,
  rpad(DuracXCi_gsRecognize(DuracXCi.Id),20)||' - '||CurrXDisc_gsRetCodDisc(CurrXDisc.Id)||' - '||CurrXDisc_gsRetDisc(CurrXDisc.Id) as Descricao
from
  DiscCat,
  Disc,
  CurrXDisc,
  Curr,
  DuracXCi
where
  (
    p_DiscCat_Id is null
      or
    CurrXDisc.DiscCat_Id <= nvl( p_DiscCat_Id ,0)
  )
and
  DiscCat.Id (+) = CurrXDisc.DiscCat_Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  nvl( CurrXDisc.Obrig , 'off' ) = 'on'
and
  ( 
    p_DuracXCi_Sequencia is null
      or
    DuracXCi.Sequencia >= nvl( p_DuracXCi_Sequencia ,0)
      or
    ( Curr_gnProximaSerie(Curr.Id, p_DuracXCi_Sequencia ) is null and DuracXCi.Sequencia is null )
  )
and
  DuracXCi.Id = CurrXDisc.DuracXCi_Id
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
order by Serie,Disc
