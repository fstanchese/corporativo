SELECT
  CurrXDisc.Id as Id,
  Curr.Codigo as CodCurr,
  Disc.Codigo as CodDisc,
  Disc.Nome   as NomDisc,
  CurrXDisc.Fichasequencia,
  CurrXDisc_gsRetSerie(CurrXDisc.Id) as Serie,  
  decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id,null),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id,null),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000010,'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000014,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
  decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000004,'B'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000003,'C'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000010,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id),5900000000017,'Z'||CurrXDisc_gsRetDisc(CurrXDisc.Id),'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc
FROM
  DuracXCi,
  CurrXDisc,
  Disc,
  Curr,
  Curso
WHERE
  Disc.Id = CurrXDisc.Disc_Id
AND
  DuracXCi.Id (+)= CurrXDisc.DuracXCi_Id
AND
  Curr.Id = CurrXDisc.Curr_Id
AND
  Curso.Id = Curr.Curso_Id
AND
  CurrXDisc.Curr_Id IN     
    (     
      SELECT Curr.Id FROM Curr start WITH Curr.Id = nvl( p_Curr_Id ,0) connect BY Curr.Curr_Pai_Id = PRIOR Curr.Id     
        UNION    
      SELECT Curr.Curr_Pai_Id FROM Curr start WITH Curr.Id = nvl( p_Curr_Id ,0) connect BY Curr.Id = PRIOR Curr.Curr_Pai_Id     
    )    
ORDER BY OrdemSerie,Curr.Codigo,OrdemDisc
