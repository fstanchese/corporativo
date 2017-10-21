
select   
  CurrOfe.Id,  
  CurrOfe.Curr_Id,  
  CurrOfe.Periodo_Id,  
  CurrOfe.Campus_Id,  
  CurrOfe.PLetivo_Id,  
  PLetivo.Nome || ' - ' || Curr.Codigo || ' - ' || Campus.Nome || ' - ' || Curr.CurrNomeHist || decode(Curr.CurrCompNome,null,'',' - ' || Curr.CurrCompNome) || decode(Curr.CurrNivelDesc,null,'',' - ' || Curr.CurrNivelDesc) || ' - ' || Periodo.Nome as Recognize,
  Curr_gsRecognize(CurrOfe.Curr_Id) as Curr_Recognize,
  Curr.CurrNomeDipl,
  PLetivo_gsRecognize(Curr.PLetivo_Inicial_Id),
  Curso.Nome as CursoNome
from   
  Campus,
  Periodo,
  Curr,
  CurrOfe,
  PLetivo,
  Curso
where
  Periodo.Id = CurrOfe.Periodo_Id
and
  Campus.Id = CurrOfe.Campus_Id
and
  Pletivo.Id = CurrOfe.PLetivo_Id
and
  Curr.Curso_Id = Curso.Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  (
     p_Periodo_Id is null
     or
     CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
     p_Campus_Id is null
     or
     CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 )
  )
and   
  PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by
  Recognize