select
  PesqTurma.*,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma,
  TurmaOfe.Turma_Id as Turma_Id,
  TurmaOfe_gnRetSerie(TurmaOfe_Id) as Serie,
  Decode(DivTurma_Id,13500000000017,'Par - ',13500000000018,'Impar - ') || Decode(SubDivisao,null,'',SubDivisao || ' - ') as DivTurma,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id) || ' - ' || Decode(DivTurma_Id,13500000000017,'Par - ',13500000000018,'Impar - ') || Decode(SubDivisao,null,'',SubDivisao || ' - ') as DivSerie,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id) || Decode(DivTurma_Id,13500000000017,' - Par',13500000000018,' - Impar') || Decode(SubDivisao,null,'',' - ' ||SubDivisao) as Recognize
from
  TurmaOfe,
  PesqTurma
where
  TurmaOfe.Id = PesqTurma.TurmaOfe_Id
and
  PesqTurma.Id = nvl ( p_PesqTurma_Id , 0)