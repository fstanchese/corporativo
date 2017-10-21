SELECT 
  Curso.*,
  Curso_gsRecognize(Curso.id)                            as Recognize, 
  WPessoa_gsRecognize(curso_gncoordenador( p_Curso_Id )) as WPessoa_Coordenador_Id_r,
  WPessoa_gsRecognize(Curso.WPessoa_AtivComp_Id)         as ProfResp,
  InstEns_gsRecognize(InstEns_Id)                        as InstEns_R,
  Curso_gsRecognize(Curso.Id) || ' - ' || InstEns.Codigo as NomeCodigo,
  InstEns.Nome                                           as NomeFacul,
  Facul.NomeCompleto                                     as FaculNome,
  Facul.Nome                                             as FaculNomeRed,
  WPessoa_gsRecognize(Facul.WPessoa_Diretor_Id)          as Diretor,
  Facul.WPessoa_Diretor_Id                               as WPessoa_Diretor_Id,
  WPessoa.Sexo_Id                                        as Sexo_Diretor
FROM 
  Curso,
  InstEns,
  Facul,
  WPessoa 
WHERE 
  WPessoa.Id (+) = Facul.WPessoa_Diretor_Id
AND
  Facul.Id (+) = Curso.Facul_Id 
AND
  Curso.InstEns_Id = InstEns.Id
AND
  Curso.Id = nvl ( p_Curso_Id , 0 )