select
  WPessoa.Nome                                  as Nome,
  WPessoa.RGRNE                                 as RGRNE,
  WPessoa.Codigo                                as RA,
  TurmaOfe.Id                                   as TurmaOfe_Id,
  substr(TurmaOfe_gsRecognize(TurmaOfe_Id),0,5) as Turma,
  PLetivo_gsRecognize(CurrOfe.PLetivo_Id)       as Periodo
from
  WPessoa,
  CurrOfe,
  TurmaOfe,
  Matric
where
  WPessoa.Id = Matric.WPessoa_Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  CurrOfe.Id = TurmaOfe.Currofe_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.CriProm_Id = 870000000002
order by
  TurmaOfe.Id,WPessoa.Nome