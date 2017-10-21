select 
  to_char( nvl( Recebimento.DtPagto ,sysdate),'DD/MM/YYYY')    as DtPagto,
  Recebimento.Valor                                            as Valor,
  Matric.Id                                                    as Matric_Id,
  Matric.State_Id                                              as State_Id,
  WPessoa.Nome                                                 as Nome
from
 WPessoa,
 DuracXCi,
 Turma,
 Curso,
 Curr,
 CurrOfe, 
 TurmaOfe,
 Matric,
 Debcred,
 Recebimento,
 Boleto
where
  WPessoa.Id = Matric.WPessoa_Id
and
  DuracXCi.Id = Turma.DuracXCi_Id 
and 
  Turma.Id = TurmaOfe.Turma_Id
and
  Curso.CursoNivel_Id = 6200000000004
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Pletivo_Id = 7200000000090
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and  
  Matric.CriProm_Id = 870000000004
and
  Matric.State_Id = 3000000002000
and
  Matric.Id = DebCred.Matric_Origem_Id
and
  DebCred.Boleto_Destino_Id = Boleto.Id
and
  Recebimento.Boleto_id(+) = Boleto.Id
and
  Boleto.State_Base_Id in (3000000000003,3000000000004,3000000000008)
and
  Boleto.BoletoTi_Id = 92200000000003
and
  Boleto.Referencia like '%MAT%2013/07%'