(
select
  TOXCD.Id||folhanota.divturma_id as Id,
  TOXCD_gsRetCodDisc(TOXCD.Id, p_PLetivo_Id  ) || ' - ' || DivTurma_gsRecognize(FolhaNota.DivTurma_Id) || Decode(FolhaNota_gnRetProcessada(  TOXCD.Id , p_CriAvalP_Id , FolhaNota.DivTurma_Id ),1,' - COMPLETO em '||to_char(folhanota.dtprocess,'dd/mm/yyyy hh24:mi:ss'),2,' - INCOMPLETO',3,' - LEITORA OTICA') as Recognize,
  FolhaNota_gnRetProcessada(  TOXCD.Id , p_CriAvalP_Id , FolhaNota.DivTurma_Id ) as Processada,
  FolhaNota.DivTurma_Id,
  TOXCD.Id as TOXCD_Id   
from
  TOXCD,
  CurrOfe,
  TurmaOfe,
  FolhaNota
where
  FolhaNota.Folha=1
and
  FolhaNota.CriAvalP_Id = nvl( p_CriAvalP_Id ,0 )
and
  FolhaNota.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id=TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id=CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0 )
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
)
union
(
select
  TOXCD.Id||folhanota.divturma_id as Id,
  DiscEsp.Nome || ' - ' || DivTurma_gsRecognize(FolhaNota.DivTurma_Id) || Decode(FolhaNota_gnRetProcessada( TOXCD.Id , p_CriAvalP_Id, FolhaNota.DivTurma_Id ),1,' - COMPLETO em '||to_char(folhanota.dtprocess,'dd/mm/yyyy hh24:mi:ss'),2,' - INCOMPLETO',3,' - LEITORA OTICA')||to_char(folhanota.dtprocess,'dd/mm/yyyy hh24:mm:ss') as Recognize,
  FolhaNota_gnRetProcessada(  TOXCD.Id , p_CriAvalP_Id , FolhaNota.DivTurma_Id ) as Processada,
  FolhaNota.DivTurma_Id,
  TOXCD.Id as TOXCD_Id  
from
  TOXCD,
  DiscEsp,
  TurmaOfe,
  FolhaNota
where
  FolhaNota.Folha=1
and
  FolhaNota.CriAvalP_Id = nvl( p_CriAvalP_Id ,0 )
and
  FolhaNota.TOXCD_Id = TOXCD.Id
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
)
order by Recognize
