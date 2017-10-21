SELECT
  Id,
  WPessoa.Nome,
  WPessoa.RGRNE,
  WPessoa.CodigoFunc,
  WPessoa.CPF 
FROM
  WPessoa
WHERE
  ( ( ( RGRNE = p_WPessoa_RGRNE
        or 
        CodigoFunc = p_WPessoa_RGRNE
      )
      AND
      (
        p_WPessoa_RGRNE IS NOT NULL
      )
    )
    or
    (
    translate(upper(nome),'ацимстзг','AAEIOOUC') LIKE replace( trim( translate(upper( p_WPessoa_Nome ),'ацимстзг','AAEIOOUC') ),' ','%')||'%'
    AND
    p_WPessoa_Nome IS NOT NULL
    ) 
  )
AND
  CodigoFunc IS NOT NULL
ORDER BY 
  nome
