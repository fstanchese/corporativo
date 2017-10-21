select
  decode(nota,null,to_char(PesqFolha_gnNotaAMI2( p_Ano_Id , p_Semestre_Id , TurmaOfe_gnRetSerie(PesqTurma.TurmaOfe_Id) , PesqFolha.Acertos , PesqGab.QtdQuest ),'90.00'),nota)  as NotaAMI,
  pesqfolha.conteudo,
  pesqfolha.nota,
  pesqfolha.id
from
  PesqFolha,
  PesqGab,
  PesqTurma,
  TurmaOfe,
  CurrOfe,
  Curr,
  Curso
where
  PesqGab.Id = PesqTurma.PesqGab_Id
and
  Curso.Facul_Id = 9600000000001
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  PesqTurma.TurmaOfe_Id = TurmaOfe.Id
and
  PesqFolha.PesqTurma_Id = PesqTurma.Id
and
  PesqTurma.PesqTi_Id = nvl ( p_PesqTi_Id , 0 )
and
  PesqTurma.Semestre_Id = nvl ( p_Semestre_Id , 0)
and
  PesqTurma.Ano_Id = nvl ( p_Ano_Id , 0) 
and
  PesqFolha.WPessoa_Id = nvl ( p_WPessoa_Id , 0) 
