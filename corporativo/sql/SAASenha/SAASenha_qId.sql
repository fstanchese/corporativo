select
  SAASenha.*,
  to_char(SAASenha.Dt,'DD/MM/YYYY HH24:MI:SS') as DtHora,
  substr( numtoDSINTERVAL( time_diff (dt, chamar) , 'SECOND'),12,8) as Espera,
  substr( numtoDSINTERVAL( time_diff (chamar, atendida) , 'SECOND'),12,8) as Atendimento
from
  SAASenha
where
  SAASenha.Id = nvl( p_SAASenha_Id , 0)