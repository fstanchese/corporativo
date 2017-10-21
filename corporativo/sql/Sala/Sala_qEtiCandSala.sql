select
  Sala.Codigo                                 as Sala,
  Sala.Campus_Id                              as Campus_Id,
  upper(Campus_gsRecognize(Sala.Campus_Id))   as Campus_Recognize,
  initcap(shortname(WPessoa.Nome,35))         as Nome_Reduzido,
  initcap(WPessoa.Nome)                       as Nome,
  lpad(Vest.Inscricao, 5, '0')||'-'||dacmod10(nvl ( Vest.Inscricao ,0)) as Inscricao,
  WPessoa.Foneres                             as Foneres,
  WPessoa.Fonecel                             as Fonecel
from
  Boleto,
  DebCred,
  Sala,
  Vest,
  WPessoa
where
  Boleto_gnState(Boleto.Id,trunc(sysdate),'CONSIDERAR_QUITADO') in (3000000000004,3000000000008,3000000000003)
and
  Boleto.Referencia = 'Vest 2010/2'
and
  Boleto.Id = DebCred.Boleto_Destino_Id
and
  DebCred.Vest_Origem_Id = Vest.Id
and
  (
    p_Campus_Id is null
  or
    Sala.Campus_Id = nvl( p_Campus_Id ,0)
  )
and
  Sala.Id = Vest.Sala_Id
and
  Vest.WPleito_Id = 7900000000021
and
  Vest.WPessoa_Id = WPessoa.Id
order by
  Sala,Nome