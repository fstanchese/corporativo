select     
  CurrXDisc.Id                         as CurrXDisc_Ficha_Id,     
  CurrXDisc_gnAprovado(  p_WPessoa_Id  , CurrXDisc.Id ,  p_PLetivo_Id , p_CoordPr_Id ) as Aprovado,  
  decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id,GradAlu_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id,GradAlu_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000010,'99'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000014,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
  decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000004,'B'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000003,'C'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000010,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id),'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc,
  CurrXDisc_gsRetCodCurr(CurrXDisc.Id) as CodCurr,    
  CurrXDisc_gsRetSerie(CurrXDisc.Id)   as Serie,    
  CurrXDisc_gsRetCodDisc(CurrXDisc.Id) as CodDisc,    
  CurrXDisc_gsRetDisc(CurrXDisc.Id)    as NomDisc,    
  GradAlu_Id                           as GradAlu_Id,    
  DuracXCi.Id                          as DuracXCi_Id,     
  DuracXCi.Sequencia                   as Sequencia,     
  GradAlu_gsRetMediaFinal(GradAlu_Id)  as MediaGrad,    
  CurrXDisc.DiscCat_Id,    
  CurrXDisc.Disc_Id,    
  CXD.*    
from    
  DuracXCi,    
  CurrXDisc,    
  (    
    select     
      TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)  as Turma,    
      CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as Discip_Or,    
      State.Nick                                   as Situacao,    
      CurrXDisc.Id                                 as CurrXDisc_Id,    
      1370000000001                                as GradAExTi_Id,    
      GradAlu.Id                                   as GradAlu_Id,    
      null                                         as GradAluEx_Id,    
      CurrXDisc_gnCHTotal( CurrXDisc.Id, CurrOfe.PLetivo_Id , GradAlu.Id ) as ChOrigem,    
      Curr.Curso_Id                                as Curso_Id,    
      Curr.Id                                      as Curr_Id,    
      CurrOfe.PLetivo_Id                           as PLetivo_Id,
      CurrXDisc_gsRetSerie(GradAlu.CurrXDisc_Id)   as Serie_Or,    
      Decode(Matric.MatricTi_Id,8300000000002,Curr.Codigo,CurrXDisc_gsRetCodCurr(GradAlu.CurrXDisc_Id)) as Curr_Or,    
      CurrXDisc_gnCurr(GradAlu.CurrXDisc_Id) as Curr_Or_Id,    
      Decode(Matric.MatricTi_Id,8300000000002,Curr.Curso_Id,CurrXDisc_gnCurso(GradAlu.CurrXDisc_Id)) as Curso_Or    
    from      
      CurrOfe,      
      TurmaOfe,  
      Matric,    
      GradAlu,    
      CurrXDisc,    
      Curr,    
      State    
    where     
      CurrOfe.Id = TurmaOfe.CurrOfe_Id
    and
      TurmaOfe.Id = Matric.TurmaOfe_Id 
    and    
      Matric.Id = GradAlu.Matric_Id    
    and    
      State.Id = GradAlu.State_Id 
    and    
      ( 
         GradAlu.State_Id = 3000000003004
         or
         (CurrXDisc.DiscCat_Id > 5900000000002 and ( GradAlu.State_Id = 3000000003001 or GradAlu.State_Id = 3000000003004 or GradAlu.State_Id = 3000000003010 or GradAlu.State_Id = 3000000003011) )
       )
    and    
      CurrXDisc.Id = GradAlu.CurrXDisc_Id
    and    
      Curr.Id = CurrXDisc.Curr_Id
    and    
      GradAlu.WPessoa_Id = nvl(  p_WPessoa_Id  , 0 )    
    and 
      CurrOfe.PLetivo_Id <= nvl ( p_PLetivo_Id , 0 )
    and    
      Curr.Id in     
      (     
        select Curr.Id from Curr start with Curr.Id = nvl(  p_Curr_Id  ,0) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id     
          union    
        select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl(  p_Curr_Id  ,0) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id     
      )    
    union
    select     
      TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)  as Turma,    
      CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as Discip_Or,    
      State.Nick                                   as Situacao,    
      CurrXDisc.Id                                 as CurrXDisc_Id,    
      1370000000001                                as GradAExTi_Id,    
      GradAlu.Id                                   as GradAlu_Id,    
      null                                         as GradAluEx_Id,    
      CurrXDisc_gnCHTotal( CurrXDisc.Id, DiscEsp.PLetivo_Id , GradAlu.Id ) as ChOrigem,    
      Curr.Curso_Id                                as Curso_Id,    
      Curr.Id                                      as Curr_Id,    
      DiscEsp.PLetivo_Id                           as PLetivo_Id,
      CurrXDisc_gsRetSerie(GradAlu.CurrXDisc_Id)   as Serie_Or,    
      Decode(Matric.MatricTi_Id,8300000000002,Curr.Codigo,CurrXDisc_gsRetCodCurr(GradAlu.CurrXDisc_Id)) as Curr_Or,    
      CurrXDisc_gnCurr(GradAlu.CurrXDisc_Id) as Curr_Or_Id,    
      Decode(Matric.MatricTi_Id,8300000000002,Curr.Curso_Id,CurrXDisc_gnCurso(GradAlu.CurrXDisc_Id)) as Curso_Or 
    from      
      DiscEsp,      
      TurmaOfe,  
      Matric,    
      GradAlu,    
      CurrXDisc,    
      Curr,    
      State    
    where     
      DiscEsp.Id = TurmaOfe.DiscEsp_Id
    and
      TurmaOfe.Id = Matric.TurmaOfe_Id 
    and    
      Matric.Id = GradAlu.Matric_Id    
    and    
      State.Id = GradAlu.State_Id 
    and    
      GradAlu.State_Id = 3000000003004
    and    
      CurrXDisc.Id = GradAlu.CurrXDisc_Id
    and    
      Curr.Id = CurrXDisc.Curr_Id
    and    
      GradAlu.WPessoa_Id = nvl(  p_WPessoa_Id  , 0 )    
    and 
      DiscEsp.PLetivo_Id <= nvl ( p_PLetivo_Id , 0 )
    and    
      Curr.Id in     
      (     
        select Curr.Id from Curr start with Curr.Id = nvl(  p_Curr_Id  ,0) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id     
          union    
        select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl(  p_Curr_Id  ,0) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id     
      )
    ) CXD    
where    
  (
    CurrXDisc.Obrig='on' 
    or
    (
      nvl(CurrXDisc.Obrig,'off')='off' 
      and
      SubStr(Upper(CXD.Situacao),1,3)='APR'
    ) 
  )
and
  ( 
    CurrXDisc.DiscSel_Id is null
    or
    ( CurrXDisc.DiscSel_Id = 7500000000002 and CXD.CurrXDisc_Id is not null )
  )
and
  ( 
     CurrXDisc.Disc_Id != 5300000000882 
       or 
    ( CurrXDisc.Disc_Id = 5300000000882 and SubStr(Upper(CXD.Situacao),1,3)='APR') 
  )  
and
  (     
    ( (DuracXCi.Sequencia <= p_DuracXCi_Sequencia ) and ((DuracXCi.Sequencia >= p_O_SerieI or p_O_SerieI is null) and (DuracXCi.Sequencia <= p_O_SerieF or p_O_SerieF is null)) )    
      or    
    ( DuracXCi.Sequencia is null and ( p_UltimaSerie = p_O_SerieF and SubStr(Upper(CXD.Situacao),1,3)='APR') )  
      or    
    ( DuracXCi.Sequencia is null and p_O_SerieF = p_Duracao_Curso )
      or  
    ( CurrXDisc.Curr_Id in ( 5800000000320,5800000000310,5800000000305,5800000000405 ) and DuracXCi.Sequencia is null and p_O_SerieF = 3 )  
      or
    ( CurrXDisc.Curr_Id in ( 5800000000553,5800000000771 ) and DuracXCi.Sequencia is null and p_O_SerieF = 4 )  
  )  
and    
  DuracXCi.Id (+) = CurrXDisc.DuracXCi_Id    
and    
  CurrXDisc.Id = CXD.CurrXDisc_Id (+)    
and    
  CurrXDisc.Curr_Id in     
    (     
      select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id     
        union    
      select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id     
    )    
order by OrdemSerie,codcurr,OrdemDisc