select 
  Matric.Id,
  WPessoa_gnCodigo(Matric.WPessoa_Id)                as Codigo_Aluno,
  turmaofe_gnRetSerie ( turmaofe_id )                as serie,
  Matric_gsRecognize(id)                             as Recognize,
  TurmaOfe_gsRecognize( turmaofe_id )                as turma,
  Curso_gsRecognize(Matric_gnRetCurso(Matric.Id))    as curso,
  TurmaOfe_gnRetCursoNivel( TurmaOfe_Id )            as CursoNivel_Id,
  Matric_gnEVestibulando( Matric.Id , p_PLetivo_Id ) as Vestibulando
from
  matric
where
  turmaofe_gnRetPLetivo(TurmaOfe_Id) = nvl( p_PLetivo_Id , 0 )
and
  Matric.MatricTi_Id in ( 8300000000001 , 8300000000002 )
and
  matric.state_id in ( 3000000002002 , 3000000002003 )
and
  WPessoa_Id = nvl ( p_WPessoa_Id ,0 )
