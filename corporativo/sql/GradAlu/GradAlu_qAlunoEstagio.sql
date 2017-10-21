select
  CurrXDisc_gsRetCodDisc(CurrXDisc.Id)             as CodDisc,
  CurrXDisc_gsRetDisc(CurrXDisc.Id)                as NomDisc,
  CurrXDisc_gsRetSerie(CurrXDisc.Id)               as Serie,
  nvl(State.Nome,'S/ Cadastro')                    as Situacao,
  GradAlu_gsRetMediaFinal(GRADALU.Id)              as Media,
  GradAlu_gnRetPLetivo( GRADALU.Id )               as PLetivo_Id,
  CurrXDisc_gnChTotal( CurrXDisc.Id , GradAlu_gnRetPLetivo( GRADALU.Id ) , GRADALU.Id ) as ChTotal,
  decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
  decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc
from
  State,
  DuracXCi,
  Curr,
  CurrXDisc,
  (select * from GradAlu where GradAlu.State_Id <> 3000000003002 and GradAlu.WPessoa_Id = nvl ( p_WPessoa_Id , 0 ) ) GRADALU
where
  currxdisc.id not in 
  (
    (
     select
       CurrXDisc.Id
     from
       DuracXCi,
       Curr,
       CurrXDisc,
       (select * from GradAlu where GradAlu.State_Id = 3000000003004 and GradAlu.WPessoa_Id = nvl ( p_WPessoa_Id   , 0 ) ) GRADALU,
       CXDEqui
     where
       CXDEqui.CurrXDisc_Id = CurrXDisc.Id 
     and
       GRADALU.CurrXDisc_Id = CXDEqui.CurrXDisc_Equi_Id
     and
       (  
          DuracXCi.Sequencia <= p_DuracXCi_Sequencia
          or 
          Curr_gnProximaSerie( p_Curr_Id , p_DuracXCi_Sequencia ) is null and DuracXCi.Sequencia is null  
       ) 
     and
       CurrXDisc.DuracXCi_Id = DuracXCi.Id (+)
     and
       (
         (CurrXDisc.DiscCat_Id > 5900000000002 and CurrXDisc.DiscCat_Id <> 5900000000004 and CurrXDisc.DiscCat_Id <> 5900000000006 and CurrXDisc.DiscCat_Id <> 5900000000009 and CurrXDisc.DiscCat_Id <> 5900000000005)
         or
         (CurrXDisc.DiscCat_Id = 5900000000004 and Curr.Curso_Id = 5700000000006)
         or
         (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000011)
         or
         (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000012)
         or
         (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000014)
         or
         (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000008)
       )  
     and
       CurrXDisc.Curr_Id = Curr.Id
     and
       (
         Curr_Id in 
         ( 
           select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id , 0 ) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id 
           union
           select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl( p_Curr_Id , 0 ) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id 
         ) 
       )
    union
select
  CurrXDisc.Id
from
  State,
  DuracXCi,
  Curr,
  CurrXDisc,
  (select * from GradAlu where GradAlu.State_Id = 3000000003004 and GradAlu.WPessoa_Id = nvl ( p_WPessoa_Id , 0 ) ) GRADALU,
  CXDEqui
where
  State.Id = GRADALU.State_Id
and
  CXDEqui.CurrXDisc_Id = CurrXDisc.Id 
and
  GRADALU.CurrXDisc_Id = CXDEqui.CurrXDisc_Equi_Id
and
  (  
    DuracXCi.Sequencia <= p_DuracXCi_Sequencia
      or 
    Curr_gnProximaSerie( p_Curr_Id , p_DuracXCi_Sequencia ) is null and DuracXCi.Sequencia is null  
  ) 
and
  (
    (CurrXDisc.DiscCat_Id > 5900000000002 and CurrXDisc.DiscCat_Id <> 5900000000004 and CurrXDisc.DiscCat_Id <> 5900000000006 and CurrXDisc.DiscCat_Id <> 5900000000009 and CurrXDisc.DiscCat_Id <> 5900000000005)
    or
    (CurrXDisc.DiscCat_Id = 5900000000004 and Curr.Curso_Id = 5700000000006)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000011)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000012)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000014)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000008)
  )  
and
  CurrXDisc.DuracXCi_Id = DuracXCi.Id (+)
and
  ( CurrXDisc.DiscCat_Id > 5900000000002 and (CurrXDisc.DiscCat_Id <> 5900000000004 or Curr.Curso_Id = 5700000000006) )
and
  CurrXDisc.Curr_Id = Curr.Id
and
  (
    Curr_Id in 
     ( 
       select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id , 0 ) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id 
         union
       select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl( p_Curr_Id , 0 ) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id 
     ) 
  )
    )
  )
and
  State.Id (+) = GRADALU.State_Id
and
  GRADALU.CurrXDisc_Id (+) = CurrXDisc.Id 
and
  (  
    DuracXCi.Sequencia <= p_DuracXCi_Sequencia
      or 
    Curr_gnProximaSerie( p_Curr_Id , p_DuracXCi_Sequencia ) is null and DuracXCi.Sequencia is null  
  ) 
and
  CurrXDisc.DuracXCi_Id = DuracXCi.Id (+)
and
  (
    (CurrXDisc.DiscCat_Id > 5900000000002 and CurrXDisc.DiscCat_Id <> 5900000000004 and CurrXDisc.DiscCat_Id <> 5900000000006 and CurrXDisc.DiscCat_Id <> 5900000000009 and CurrXDisc.DiscCat_Id <> 5900000000005)
    or
    (CurrXDisc.DiscCat_Id = 5900000000004 and Curr.Curso_Id = 5700000000006)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000011)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000012)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000014)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000008)
  )  
and
  CurrXDisc.Curr_Id = Curr.Id
and
  (
    Curr_Id in 
     ( 
       select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id , 0 ) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id 
         union
       select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl( p_Curr_Id , 0 ) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id 
     ) 
  )
union
select
  CurrXDisc_gsRetCodDisc(CurrXDisc.Id)             as CodDisc,
  CurrXDisc_gsRetDisc(CurrXDisc.Id)                as NomDisc,
  CurrXDisc_gsRetSerie(CurrXDisc.Id)               as Serie,
  nvl(State.Nome,'S/ Cadastro')                    as Situacao,
  GradAlu_gsRetMediaFinal(GRADALU.Id)              as Media,
  GradAlu_gnRetPLetivo( GRADALU.Id )               as PLetivo_Id,
  CurrXDisc_gnChTotal( CurrXDisc.Id , GradAlu_gnRetPLetivo( GRADALU.Id ) , GRADALU.Id ) as ChTotal,
  decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
  decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc
from
  State,
  DuracXCi,
  Curr,
  CurrXDisc,
  (select * from GradAlu where GradAlu.State_Id <> 3000000003002 and GradAlu.WPessoa_Id = nvl ( p_WPessoa_Id , 0 ) ) GRADALU,
  CXDEqui
where
  State.Id = GRADALU.State_Id
and
  CXDEqui.CurrXDisc_Id = CurrXDisc.Id 
and
  GRADALU.CurrXDisc_Id = CXDEqui.CurrXDisc_Equi_Id
and
  (  
    DuracXCi.Sequencia <= p_DuracXCi_Sequencia
      or 
    Curr_gnProximaSerie( p_Curr_Id , p_DuracXCi_Sequencia ) is null and DuracXCi.Sequencia is null  
  ) 
and
  (
    (CurrXDisc.DiscCat_Id > 5900000000002 and CurrXDisc.DiscCat_Id <> 5900000000004 and CurrXDisc.DiscCat_Id <> 5900000000006 and CurrXDisc.DiscCat_Id <> 5900000000009 and CurrXDisc.DiscCat_Id <> 5900000000005)
    or
    (CurrXDisc.DiscCat_Id = 5900000000004 and Curr.Curso_Id = 5700000000006)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000011)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000012)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000014)
    or
    (CurrXDisc.DiscCat_Id = 5900000000005 and Curr.Curso_Id = 5700000000008)
  )  
and
  CurrXDisc.DuracXCi_Id = DuracXCi.Id (+)
and
  ( CurrXDisc.DiscCat_Id > 5900000000002 and (CurrXDisc.DiscCat_Id <> 5900000000004 or Curr.Curso_Id = 5700000000006) )
and
  CurrXDisc.Curr_Id = Curr.Id
and
  (
    Curr_Id in 
     ( 
       select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id , 0 ) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id 
         union
       select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl( p_Curr_Id , 0 ) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id 
     ) 
  )
order by ordemserie,ordemdisc