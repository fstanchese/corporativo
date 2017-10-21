SELECT
  Id,
  WPessoa.Nome,
  WPessoa.RGRNE,
  WPessoa.CodigoFuncAntigo
FROM
  WPessoa
WHERE
  ( ( (
         RGRNE = p_WPessoa_RGRNE
         or 
         CodigoFuncAntigo = p_WPessoa_RGRNE
      )
      AND
      (
        p_WPessoa_RGRNE IS NOT NULL
      )
    )
    or
    (
      translate(upper(nome),'бацимстзг','AAAEIOOUC') LIKE '%'||replace( trim( translate(upper( p_WPessoa_Nome ),'бацимстзг','AAAEIOOUC') ),' ','%')||'%'
      AND
      p_WPessoa_Nome IS NOT NULL
    ) 
  )
AND
  Docente IS NOT NULL
ORDER BY 
  Nome