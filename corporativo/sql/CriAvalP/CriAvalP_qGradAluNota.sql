select
  Id,
  GradAluNota,
  Nome         as Recognize 
from
  criavalp
where
  criavalp.id not in ( 18800000000016, 18800000000017 )
and
  CriAval_Id = nvl( p_CriAval_Id ,0)
