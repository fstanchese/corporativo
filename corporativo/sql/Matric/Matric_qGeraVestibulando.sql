select
  WPessoa.Id       as WPessoa_Id,
  VestCla.Id       as VestCla_Id, 
  Min(TurmaOfe.Id) as TurmaOfe_Id,
  CurrOfe.Id       as CurrOfe_Id
from
  WPessoa,
  Vest,
  DuracXCi,
  Turma,
  TurmaOfe,
  CurrOfe,
  VestOpcao,
  VestCla
where
  WPessoa.Id = Vest.WPessoa_Id
and
  trunc(Vest.Dt) = p_Vest_Dt
and
  Vest.WPleito_Id = nvl( p_WPleito_Id ,0)
and
  Vest.Id = VestOpcao.Vest_Id
and
  DuracXCi.Sequencia = 1
and
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.Vest = 'on'
and
  CurrOfe.Id = VestOpcao.CurrOfe_Id
and
  VestOpcao.Id = VestCla.VestOpcao_Id
and
  VestCla.VestChama_Id = nvl( p_VestChama_Id ,0)
group by
  WPessoa.Id,VestCla.Id,CurrOfe.Id