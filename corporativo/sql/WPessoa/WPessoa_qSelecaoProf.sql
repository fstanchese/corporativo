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
      translate(upper(nome),'���������','AAAEIOOUC') LIKE '%'||replace( trim( translate(upper( p_WPessoa_Nome ),'���������','AAAEIOOUC') ),' ','%')||'%'
      AND
      p_WPessoa_Nome IS NOT NULL
    ) 
  )
AND
  Docente IS NOT NULL
ORDER BY 
  Nome