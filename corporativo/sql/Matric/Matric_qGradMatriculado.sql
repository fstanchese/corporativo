select 
  to_char( nvl( Recebimento.DtPagto ,sysdate),'DD/MM/YYYY')    as DtPagto,
  Recebimento.Valor                                            as Valor,
  Matric.Id                                                    as Matric_Id,
  Matric.State_Id                                              as State_Id,
  WPessoa.Nome                                                 as Nome, 
  initcap(p2(WPessoa.Nome,1))                                  as Nick,
  WPessoa.Email1                                               as Email
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
  Curso.CursoNivel_Id in ( 6200000000001, 6200000000010, 6200000000012 )
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Pletivo_Id = 7200000000083
and
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.State_Id in (3000000002000,3000000002001)
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
(
  (
      Matric.Id in (select Matric_Origem_Id from DebCred,Boleto where DebCred.Boleto_Destino_Id = Boleto.Id and Boleto.State_Base_Id in (3000000000003,3000000000004,3000000000008) and Boleto.BoletoTi_Id = 92200000000003 and Boleto.Referencia like '%2013/01A')
    and
      Matric.Id  = DebCred.Matric_Origem_Id
    and
      DebCred.Boleto_Destino_Id = Boleto.Id
    and
      Boleto.Referencia like '%2013/01B'
  )
  or
    Boleto.Referencia like '%2013/01'
)