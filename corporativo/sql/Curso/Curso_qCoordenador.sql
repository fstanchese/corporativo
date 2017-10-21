select
  WPesXCargo.WPessoa_Id as Id
from
  cargo,
  wpesxcargo,
  cargoxcurso
where
  p_O_Dt between WPesXCargo.DtCargo and nvl(WPesXCargo.DtTermino,sysdate+1) 
and
  WPesXCargo.Cargo_Id = Cargo.Id
and
  Cargo.Cargo_Pai_Id in ( 14400000000416,14400000000439,14400000000461 )
and
  Cargo.Id = CargoXCurso.Cargo_Id
and
  CargoXCurso.Curso_Id = nvl( p_Curso_Id ,0)

