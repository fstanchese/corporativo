select 
  Curr.Id          as Id,
  Curr.Codigo      as Codigo,
  CurrNomeApostila as CurrNomeApostila,
  CurrNomeApostila as Recognize,
  TurmaOfe_gnRetPLetivo(Matric.TurmaOfe_Id) as PLetivo_Id,
  PLetivo.Nome     as AnoConclusao
from 
  PLetivo,
  Curr,
  CurrOfe,
  TurmaOfe,
  Matric
where
  PLetivo.Id = CurrOfe.PLetivo_Id
and
  CurrOfe.PLetivo_Id = TurmaOfe_gnRetPLetivo(Matric.TurmaOfe_Id)
and
  Matric.State_Id = 3000000002012
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Curr.Id not in ( select apostila.curr_id from apostila,diplproc where diplproc.state_id <> 3000000026011 and diplproc.id=apostila.diplproc_id and apostila.diplproc_id = nvl( p_DiplProc_Id , 0) )
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)
and
  Curr.CurrNivel_Id = 7400000000002
and
  Curr.CurrNomeApostila is not null
and
  Curr.Id in ( select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by PRIOR Curr.Curr_Pai_Id = Curr.Id ) 
order by AnoConclusao