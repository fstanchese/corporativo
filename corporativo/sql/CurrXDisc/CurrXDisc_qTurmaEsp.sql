select  
  CurrXDisc.Id,
  rpad(CurrXDisc_gsRetSerie(CurrXDisc.Id),20)||' '||rpad(CurrXDisc_gsRetCodDisc(CurrXDisc.Id),10) as Recognize
from
  CurrXDisc,
  Curr
where
  CurrXDisc.Id != 6100000030681
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
order by Recognize
